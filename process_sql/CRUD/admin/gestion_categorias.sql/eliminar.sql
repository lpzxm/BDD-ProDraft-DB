CREATE PROCEDURE [dbo].[sp_Admin_DeleteCategoria]
    @admin_id INT,
    @categoria_id INT
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
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
        
        -- Eliminar jugadores asignados primero
        DELETE FROM [dbo].[Category_players] 
        WHERE [id_category] = @categoria_id;
        
        -- Eliminar categoría
        DELETE FROM [dbo].[Category_sport] 
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            THROW 50032, 'Categoría no encontrada', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Category_sport', 'DELETE',
            @valores_anteriores
        );
        
        COMMIT TRANSACTION;
        
        SELECT 'Categoría eliminada correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0
            ROLLBACK TRANSACTION;
            
        THROW;
    END CATCH
END
GO