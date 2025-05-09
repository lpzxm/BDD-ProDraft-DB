CREATE PROCEDURE [dbo].[sp_Admin_DeleteJugador]
    @admin_id INT,
    @jugador_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        BEGIN TRANSACTION;
        
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Obtener datos para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
        
        -- Eliminar observaciones del jugador primero
        DELETE FROM [dbo].[Observaciones_Jugador] 
        WHERE [id_atleta] = @jugador_id;
        
        -- Eliminar puntajes de rúbrica
        DELETE FROM [dbo].[Rubric_Score_player] 
        WHERE [id_player] = @jugador_id;
        
        -- Eliminar de categorías
        DELETE FROM [dbo].[Category_players] 
        WHERE [id_player] = @jugador_id;
        
        -- Eliminar jugador
        DELETE FROM [dbo].[Jugador] 
        WHERE [id] = @jugador_id;
        
        IF @@ROWCOUNT = 0
            THROW 50009, 'Jugador no encontrado', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Jugador', 'DELETE',
            @valores_anteriores
        );
        
        COMMIT TRANSACTION;
        
        SELECT 'Jugador eliminado correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0
            ROLLBACK TRANSACTION;
            
        THROW;
    END CATCH
END
GO