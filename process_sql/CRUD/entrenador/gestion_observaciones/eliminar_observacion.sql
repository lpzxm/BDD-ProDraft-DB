CREATE PROCEDURE [dbo].[sp_Entrenador_DeleteObservacionJugador]
    @entrenador_id INT,
    @observacion_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que la observación pertenece a un jugador del entrenador
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Observaciones_Jugador] oj
            JOIN [dbo].[Category_players] cp ON oj.[id_atleta] = cp.[id_player]
            JOIN [dbo].[Category_sport] cs ON cp.[id_category] = cs.[id]
            JOIN [dbo].[Entrenador] e ON cs.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND oj.[id] = @observacion_id
        )
            THROW 50072, 'No tienes permisos para eliminar esta observación', 1;
            
        -- Obtener datos para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id FOR JSON PATH
        );
        
        -- Eliminar observación
        DELETE FROM [dbo].[Observaciones_Jugador] 
        WHERE [id] = @observacion_id;
        
        IF @@ROWCOUNT = 0
            THROW 50073, 'Observación no encontrada', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Observaciones_Jugador', 'DELETE',
            @valores_anteriores
        );
        
        SELECT 'Observación eliminada correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO