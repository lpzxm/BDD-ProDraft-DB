USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_UpdateJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_UpdateJugador;
GO

/**
  SP_UpdateJugador
  Descripción:
    Actualiza los datos de un jugador. Valida, si se proporcionan, los campos:
      – Formato de email.
      – Edad (a partir de nueva fechaNacimiento) entre 10–18 años.
      – Grado válido (1°–6°) y sección (A–Z).
      – Unicidad de email y código.
  Parámetros:
    @id_player       INT            – ID del jugador a modificar (requerido)
    @email           NVARCHAR(255)  – (Opcional) Nuevo correo
    @contraseña      NVARCHAR(255)  – (Opcional) Nueva contraseña
    @nombres         NVARCHAR(255)  – (Opcional) Nuevos nombres
    @apellidos       NVARCHAR(255)  – (Opcional) Nuevos apellidos
    @fechaNacimiento DATE           – (Opcional) Nueva fecha de nacimiento
    @codigo          INT            – (Opcional) Nuevo código
    @grado           NVARCHAR(50)   – (Opcional) Nuevo grado (1°–6°)
    @seccion         NVARCHAR(50)   – (Opcional) Nueva sección (A–Z)
  Salida:
    RowsAffected INT – Número de filas actualizadas
  Errores:
    51002 – Jugador no existe.
    51010 – Formato de email inválido.
    51011 – Edad fuera de rango (10–18 años).
    51012 – Grado no válido.
    51013 – Sección no válida.
    51003 – Email duplicado.
    51004 – Código duplicado.
**/
CREATE PROCEDURE dbo.SP_UpdateJugador
    @id_player         INT,
    @email             NVARCHAR(255)     = NULL,
    @contraseña        NVARCHAR(255)     = NULL,
    @nombres           NVARCHAR(255)     = NULL,
    @apellidos         NVARCHAR(255)     = NULL,
    @fechaNacimiento   DATE              = NULL,
    @codigo            INT               = NULL,
    @grado             NVARCHAR(50)      = NULL,
    @seccion           NVARCHAR(50)      = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        -- 1. Verificar existencia
        IF NOT EXISTS (SELECT 1 FROM dbo.Jugador WHERE id = @id_player)
            THROW 51002, 'No existe el jugador especificado.', 1;

        -- 2. Validaciones sobre los parámetros no nulos
        IF @email IS NOT NULL
        BEGIN
            IF @email NOT LIKE '%_@__%.__%'
                THROW 51010, 'Formato de email inválido. Debe ser usuario@dominio.ext', 1;
            IF EXISTS (
                SELECT 1 FROM dbo.Jugador 
                WHERE email = @email AND id <> @id_player
            )
                THROW 51003, 'Otro jugador ya usa ese correo electrónico.', 1;
        END

        IF @fechaNacimiento IS NOT NULL
        BEGIN
            DECLARE @edad INT = DATEDIFF(YEAR, @fechaNacimiento, GETDATE())
                             - CASE 
                                 WHEN MONTH(@fechaNacimiento) > MONTH(GETDATE())
                                   OR (MONTH(@fechaNacimiento)=MONTH(GETDATE())
                                       AND DAY(@fechaNacimiento)>DAY(GETDATE()))
                                 THEN 1 ELSE 0 END;
            IF @edad < 10 OR @edad > 18
                THROW 51011, 'Edad fuera de rango (10-18 años). Edad calculada: ' + CAST(@edad AS NVARCHAR(3)), 1;
        END

        IF @grado IS NOT NULL
            AND @grado NOT IN ('1°','2°','3°','4°','5°','6°')
            THROW 51012, 'Grado inválido. Debe ser uno de: 1°,2°,3°,4°,5°,6°', 1;

        IF @seccion IS NOT NULL
            AND @seccion NOT LIKE '[A-Z]'
            THROW 51013, 'Sección inválida. Debe ser una única letra A-Z', 1;

        IF @codigo IS NOT NULL
        BEGIN
            IF EXISTS (
                SELECT 1 FROM dbo.Jugador 
                WHERE codigo = @codigo AND id <> @id_player
            )
                THROW 51004, 'Otro jugador ya usa ese código.', 1;
        END

        -- 3. Realizar actualización
        UPDATE dbo.Jugador
        SET
            email           = COALESCE(@email,           email),
            contraseña      = COALESCE(@contraseña,      contraseña),
            nombres         = COALESCE(@nombres,         nombres),
            apellidos       = COALESCE(@apellidos,       apellidos),
            fechaNacimiento = COALESCE(@fechaNacimiento, fechaNacimiento),
            codigo          = COALESCE(@codigo,          codigo),
            grado           = COALESCE(@grado,           grado),
            seccion         = COALESCE(@seccion,         seccion)
        WHERE id = @id_player;

        SELECT @@ROWCOUNT AS RowsAffected;
    END TRY
    BEGIN CATCH
        DECLARE @errMsg NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @errNum INT         = ERROR_NUMBER();
        RAISERROR(@errMsg, 16, 1);
        RETURN @errNum;
    END CATCH
END;
GO



-- 1) Intentar actualizar email a formato inválido
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @email     = 'sin-arroba.com';

-- 2) Cambiar fechaNacimiento fuera de rango
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @fechaNacimiento = '2000-01-01';

-- 3) Actualizar grado y sección correctos
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @grado   = '5°',
    @seccion = 'B';
