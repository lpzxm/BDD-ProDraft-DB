USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_ReadJugador', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_ReadJugador;
GO

CREATE PROCEDURE dbo.SP_ReadJugador
    @id_player INT = NULL  -- Si es NULL, devuelve todos
AS
BEGIN
    SET NOCOUNT ON;

    IF @id_player IS NULL
    BEGIN
        SELECT *
        FROM dbo.Jugador;
    END
    ELSE
    BEGIN
        SELECT *
        FROM dbo.Jugador
        WHERE id = @id_player;
    END
END;
GO

--Flujo normal y con excepciones
-- ----------------------------------------------------------------------
-- 2) FLUJO NORMAL: devolver TODOS los jugadores (parámetro omiso / NULL)
-- ----------------------------------------------------------------------
PRINT '--- FLUJO NORMAL: todos los jugadores ---';
EXEC dbo.SP_ReadJugador;  -- @id_player = NULL por defecto
GO

-- ----------------------------------------------------------------------
-- 3) FLUJO NORMAL: devolver UN jugador existente (id = 2)
-- ----------------------------------------------------------------------
PRINT '--- FLUJO NORMAL: jugador con id = 2 ---';
EXEC dbo.SP_ReadJugador @id_player = 3;
GO

-- ----------------------------------------------------------------------
-- 4) CASO: id que NO existe (debería devolver 0 filas)
-- ----------------------------------------------------------------------
PRINT '--- CASO: id no existente (id = 99) ---';
EXEC dbo.SP_ReadJugador @id_player = 99;
GO

-- ----------------------------------------------------------------------
-- 5) ERROR: parámetro de tipo inválido (cadena en INT)
-- ----------------------------------------------------------------------
PRINT '--- ERROR: tipo de parámetro inválido ---';
BEGIN TRY
    EXEC dbo.SP_ReadJugador @id_player = 'ABC';
END TRY
BEGIN CATCH
    PRINT 'ERROR ' + CAST(ERROR_NUMBER() AS VARCHAR(10))
          + ': ' + ERROR_MESSAGE();
END CATCH;
GO
