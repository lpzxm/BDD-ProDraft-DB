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
