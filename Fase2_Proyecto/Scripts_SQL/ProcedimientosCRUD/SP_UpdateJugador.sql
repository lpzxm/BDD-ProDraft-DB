USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_UpdateJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_UpdateJugador;
GO

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
            BEGIN
                DECLARE @msgEdad NVARCHAR(255) = 
                    'Edad fuera de rango (10-18 años). Edad calculada: ' + CAST(@edad AS NVARCHAR(3));
                THROW 51011, @msgEdad, 1;
            END
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
        DECLARE @errNum INT = ERROR_NUMBER();
        RAISERROR(@errMsg, 16, 1);
        RETURN @errNum;
    END CATCH
END;
GO

-- 1) Email inválido
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @email     = 'sin-arroba.com';

-- 2) Edad fuera de rango
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @fechaNacimiento = '2000-01-01';

-- 3) Actualización válida
EXEC dbo.SP_UpdateJugador 
    @id_player = 1, 
    @grado   = '5°',
    @seccion = 'B';


--Flujo normal y con errores
USE prodraftdb;
GO


-- Insertamos dos jugadores para tener datos iniciales
INSERT INTO dbo.Jugador (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion)
VALUES
  ('maria.lopez@example.com','pwwrtd','María','López','2010-06-05',4001,'4°','A'),
  ('carlos.sanchez@example.com','perwd','Carlos','Sánchez','2009-08-20',4002,'5°','B');
GO

-- Mostrar estado inicial
PRINT 'Estado inicial de Jugador:';
SELECT id, email, codigo, grado, seccion FROM dbo.Jugador;
GO

-- ----------------------------------------------------------------------
-- 2) ERROR 51002: intentar actualizar un id que NO existe (id = 99)
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51002: jugador no existe ---';
BEGIN TRY
    EXEC dbo.SP_UpdateJugador 
        @id_player = 99,
        @email     = 'nuevo.email@example.com';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 3) ERROR 51010: formato de email inválido
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51010: email inválido ---';
BEGIN TRY
    EXEC dbo.SP_UpdateJugador 
        @id_player = 18,
        @email     = 'sin-arroba.com';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO



-- ----------------------------------------------------------------------
-- 6) ERROR 51011: edad fuera de rango (fechaNacimiento que da edad >18)
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51011: edad fuera de rango ---';
BEGIN TRY
    EXEC dbo.SP_UpdateJugador 
        @id_player       = 18,
        @fechaNacimiento = '2000-01-01';  -- edad ≈25
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 7) ERROR 51012: grado inválido
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51012: grado inválido ---';
BEGIN TRY
    EXEC dbo.SP_UpdateJugador 
        @id_player = 8,
        @grado     = '7°';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 8) ERROR 51013: sección inválida
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51013: sección inválida ---';
BEGIN TRY
    EXEC dbo.SP_UpdateJugador 
        @id_player = 18,
        @seccion   = 'AA';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 9) FLUJO NORMAL: actualizaciones válidas
-- ----------------------------------------------------------------------
PRINT '--- FLUJO NORMAL: múltiples campos válidos ---';
BEGIN TRY
    DECLARE @rows INT;
    EXEC @rows = dbo.SP_UpdateJugador 
        @id_player       = 16,
        @email           = 'maria.actualizada@example.com',
        @contraseña      = 'NuevaPwd123',
        @nombres         = 'María Actualizada',
        @apellidos       = 'López Pérez',
        @fechaNacimiento = '2011-05-05',
        @codigo          = 5001,
        @grado           = '6°',
        @seccion         = 'C';
    PRINT 'RowsAffected = ' + CAST(@rows AS VARCHAR(10));
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 10) Verificar estado final de la tabla
-- ----------------------------------------------------------------------
PRINT 'Estado FINAL de Jugador:';
SELECT id, email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion
FROM dbo.Jugador;
GO
