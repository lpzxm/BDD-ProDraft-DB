USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_CreateJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_CreateJugador;
GO

/**
  SP_CreateJugador
  Descripción:
    Crea un nuevo jugador tras validar:
      – Formato de email.
      – Edad dentro de rango permitido (10–18 años).
      – Unicidad de email y código.
      – Grado válido (1°–6°) y sección (letra A–Z).
  Parámetros:
    @email           NVARCHAR(255)  – Correo en formato usuario@dominio.ext
    @contraseña      NVARCHAR(255)  – Texto libre
    @nombres         NVARCHAR(255)  – No vacío
    @apellidos       NVARCHAR(255)  – No vacío
    @fechaNacimiento DATE           – Fecha que genera edad 10–18
    @codigo          INT            – Único en la tabla
    @grado           NVARCHAR(50)   – '1°','2°','3°','4°','5°','6°'
    @seccion         NVARCHAR(50)   – Una letra de la A a la Z
  Salida:
    NewJugadorId INT – ID generado
  Errores:
    51010 – Formato de email inválido.
    51011 – Edad fuera de rango 10–18.
    51012 – Grado no válido.
    51013 – Sección no válida.
    51000 – Email duplicado.
    51001 – Código duplicado.
**/
CREATE PROCEDURE dbo.SP_CreateJugador
    @email             NVARCHAR(255),
    @contraseña        NVARCHAR(255),
    @nombres           NVARCHAR(255),
    @apellidos         NVARCHAR(255),
    @fechaNacimiento   DATE,
    @codigo            INT,
    @grado             NVARCHAR(50),
    @seccion           NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        -- 1. Email: patrón simple usuario@dominio.ext
        IF @email NOT LIKE '%_@__%.__%' 
            THROW 51010, 'Formato de email inválido. Debe ser usuario@dominio.ext', 1;

        -- 2. Edad: entre 10 y 18 años
        DECLARE @edad INT = DATEDIFF(YEAR, @fechaNacimiento, GETDATE())
                         - CASE 
                             WHEN MONTH(@fechaNacimiento) > MONTH(GETDATE())
                               OR (MONTH(@fechaNacimiento)=MONTH(GETDATE())
                                   AND DAY(@fechaNacimiento)>DAY(GETDATE()))
                             THEN 1 ELSE 0 END;
        IF @edad < 10 OR @edad > 18
            THROW 51011, 'Edad fuera de rango (10-18 años). Edad calculada: ' + CAST(@edad AS NVARCHAR(3)), 1;

        -- 3. Grado válido
        IF @grado NOT IN ('1°','2°','3°','4°','5°','6°')
            THROW 51012, 'Grado inválido. Debe ser uno de: 1°,2°,3°,4°,5°,6°', 1;

        -- 4. Sección: sola letra A–Z
        IF @seccion NOT LIKE '[A-Z]' 
            THROW 51013, 'Sección inválida. Debe ser una única letra A-Z', 1;

        -- 5. Unicidad de email y código
        IF EXISTS (SELECT 1 FROM dbo.Jugador WHERE email = @email)
            THROW 51000, 'Ya existe un jugador con ese correo electrónico.', 1;
        IF EXISTS (SELECT 1 FROM dbo.Jugador WHERE codigo = @codigo)
            THROW 51001, 'Ya existe un jugador con ese código.', 1;

        -- Inserción
        INSERT INTO dbo.Jugador
            (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion)
        VALUES
            (@email, @contraseña, @nombres, @apellidos, @fechaNacimiento, @codigo, @grado, @seccion);

        SELECT SCOPE_IDENTITY() AS NewJugadorId;
    END TRY
    BEGIN CATCH
        DECLARE @errMsg NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @errNum INT         = ERROR_NUMBER();
        RAISERROR(@errMsg, 16, 1);
        RETURN @errNum;
    END CATCH
END;
GO
