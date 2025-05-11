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
