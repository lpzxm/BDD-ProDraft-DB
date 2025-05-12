USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_CreateJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_CreateJugador;
GO

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
        BEGIN
            DECLARE @msgEdad NVARCHAR(255) = 
                'Edad fuera de rango (10-18 años). Edad calculada: ' + CAST(@edad AS NVARCHAR(3));
            THROW 51011, @msgEdad, 1;
        END

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
        DECLARE @errNum INT = ERROR_NUMBER();
        RAISERROR(@errMsg, 16, 1);
        RETURN @errNum;
    END CATCH
END;
GO

--Ejecucion de flujo normal y con errores
USE prodraftdb;
GO

-- ----------------------------------------------------------------------
-- 1) Asegurarnos de partir de una tabla limpia
-- ----------------------------------------------------------------------
TRUNCATE TABLE dbo.Jugador;
GO

-- ----------------------------------------------------------------------
-- 2) Flujo NORMAL: inserción válida
-- ----------------------------------------------------------------------
PRINT '--- FLUJO NORMAL: inserción válida ---';
BEGIN TRY
    DECLARE @newId INT;
    EXEC dbo.SP_CreateJugador
        @email           = 'juan.perez@example.com',
        @contraseña      = 'Secreto123',
        @nombres         = 'Juan',
        @apellidos       = 'Pérez',
        @fechaNacimiento = '2010-05-15',
        @codigo          = 1001,
        @grado           = '5°',
        @seccion         = 'C';
    SELECT @newId = NewJugadorId FROM (SELECT SCOPE_IDENTITY() AS NewJugadorId) AS T;
    PRINT 'Jugador creado con ID = ' + CAST(@newId AS VARCHAR(10));
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 3) ERROR 51010: formato de email inválido
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51010: email inválido ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'sin-arroba.com',
        @contraseña      = 'pwd',
        @nombres         = 'Ana',
        @apellidos       = 'Lopez',
        @fechaNacimiento = '2012-01-01',
        @codigo          = 1002,
        @grado           = '3°',
        @seccion         = 'A';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 4) ERROR 51011: edad fuera de rango (<10 o >18)
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51011: edad fuera de rango ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'pedro.ramirez@example.com',
        @contraseña      = 'pwd',
        @nombres         = 'Pedro',
        @apellidos       = 'Ramírez',
        @fechaNacimiento = '2000-01-01',
        @codigo          = 1003,
        @grado           = '4°',
        @seccion         = 'B';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 5) ERROR 51012: grado inválido
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51012: grado inválido ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'laura.mendez@example.com',
        @contraseña      = 'pwd',
        @nombres         = 'Laura',
        @apellidos       = 'Méndez',
        @fechaNacimiento = '2011-07-20',
        @codigo          = 1004,
        @grado           = '7°',
        @seccion         = 'D';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 6) ERROR 51013: sección inválida
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51013: sección inválida ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'carlos.gomez@example.com',
        @contraseña      = 'pwd',
        @nombres         = 'Carlos',
        @apellidos       = 'Gómez',
        @fechaNacimiento = '2012-03-12',
        @codigo          = 1005,
        @grado           = '2°',
        @seccion         = 'AA';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 7) ERROR 51000: email duplicado
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51000: email duplicado ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'juan.perez@example.com',
        @contraseña      = 'otraPwd',
        @nombres         = 'Juan2',
        @apellidos       = 'Pérez2',
        @fechaNacimiento = '2010-06-10',
        @codigo          = 1006,
        @grado           = '5°',
        @seccion         = 'C';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 8) ERROR 51001: código duplicado
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51001: código duplicado ---';
BEGIN TRY
    EXEC dbo.SP_CreateJugador
        @email           = 'sofia.ramos@example.com',
        @contraseña      = 'pwd',
        @nombres         = 'Sofía',
        @apellidos       = 'Ramos',
        @fechaNacimiento = '2011-11-11',
        @codigo          = 1001,
        @grado           = '6°',
        @seccion         = 'E';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10)) + ': ' + ERROR_MESSAGE();
END CATCH;
GO

