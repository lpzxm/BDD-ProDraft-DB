CREATE PROCEDURE [dbo].[sp_Entrenador_RemoveJugadorCategoria]
    @entrenador_id INT,
    @jugador_id INT,
    @categoria_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el entrenador tiene permisos sobre la categoría
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Entrenador] e
            JOIN [dbo].[Category_sport] cs ON e.[id_sport] = cs.[id_sport]
            WHERE e.[id] = @entrenador_id AND cs.[id] = @categoria_id
        )
            THROW 50059, 'No tienes permisos para esta categoría', 1;
            
        -- Obtener datos para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_players] 
            WHERE [id_player] = @jugador_id AND [id_category] = @categoria_id
            FOR JSON PATH
        );
        
        -- Eliminar la relación
        DELETE FROM [dbo].[Category_players] 
        WHERE [id_player] = @jugador_id AND [id_category] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            THROW 50060, 'El jugador no está asignado a esta categoría', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Category_players', 'DELETE',
            @valores_anteriores
        );
        
        SELECT 'Jugador eliminado de la categoría correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO