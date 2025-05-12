USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_DeleteJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_DeleteJugador;
GO

CREATE PROCEDURE dbo.SP_DeleteJugador
    @id_player INT
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        -- Verificar existencia
        IF NOT EXISTS (SELECT 1 FROM dbo.Jugador WHERE id = @id_player)
            THROW 51005, 'El jugador no existe.', 1;

        DELETE FROM dbo.Jugador
        WHERE id = @id_player;

        SELECT @@ROWCOUNT AS RowsDeleted;
    END TRY
    BEGIN CATCH
        DECLARE @errMsg NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @errNum INT         = ERROR_NUMBER();
        RAISERROR(@errMsg, 16, 1);
        RETURN @errNum;
    END CATCH
END;
GO


--Flujo normal y con errores
USE prodraftdb;
GO

-- Insertamos dos jugadores para tener IDs conocidos
INSERT INTO dbo.Jugador (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion)
VALUES
  ('test1@example.com','pwd','Test','Uno','2010-01-01',2001,'3°','A'),
  ('test2@example.com','pwdd','Test','Dos','2011-02-02',2002,'4°','B');
GO

-- Verificamos los IDs asignados
PRINT 'IDs iniciales de Jugador:';
SELECT id, email FROM dbo.Jugador;
GO

-- ----------------------------------------------------------------------
-- 2) FLUJO NORMAL: borrado válido
-- ----------------------------------------------------------------------
PRINT '--- FLUJO NORMAL: borrado del jugador con id = 1 ---';
BEGIN TRY
    DECLARE @rowsDeleted INT;
    EXEC @rowsDeleted = dbo.SP_DeleteJugador @id_player = 1;
    PRINT 'RowsDeleted = ' + CAST(@rowsDeleted AS VARCHAR(10));
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO


PRINT 'Estado de Jugador tras FLUJO NORMAL:';
SELECT id, email FROM dbo.Jugador;
GO

-- ----------------------------------------------------------------------
-- 3) ERROR 51005: intentar borrar id que NO existe (ej. 99)
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51005: borrado de jugador no existente (id = 99) ---';
BEGIN TRY
    EXEC dbo.SP_DeleteJugador @id_player = 99;
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 4) ERROR 51005: intentar borrar un id ya borrado (id = 1 de nuevo)
-- ----------------------------------------------------------------------
PRINT '--- ERROR 51005: borrado de jugador ya eliminado (id = 1) ---';
BEGIN TRY
    EXEC dbo.SP_DeleteJugador @id_player = 1;
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO

-- ----------------------------------------------------------------------
-- 5) BORRADO ADICIONAL: borramos el segundo jugador (id = 2)
-- ----------------------------------------------------------------------
PRINT '--- BORRADO ADICIONAL: borrado del jugador con id = 2 ---';
BEGIN TRY
    DECLARE @rowsDeleted2 INT;
    EXEC @rowsDeleted2 = dbo.SP_DeleteJugador @id_player = 2;
    PRINT 'RowsDeleted = ' + CAST(@rowsDeleted2 AS VARCHAR(10));
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO


PRINT 'Estado FINAL de Jugador (debe estar VACÍA):';
SELECT id, email FROM dbo.Jugador;
GO

