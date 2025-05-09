CREATE PROCEDURE [dbo].[sp_Admin_DeleteEntrenador]
    @admin_id INT,
    @entrenador_id INT
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
            SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH
        );
        
        -- Eliminar observaciones del entrenador primero
        DELETE FROM [dbo].[Observaciones_Entrenador] 
        WHERE [id_entrenador] = @entrenador_id;
        
        -- Eliminar entrenador
        DELETE FROM [dbo].[Entrenador] 
        WHERE [id] = @entrenador_id;
        
        IF @@ROWCOUNT = 0
            THROW 50016, 'Entrenador no encontrado', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Entrenador', 'DELETE',
            @valores_anteriores
        );
        
        COMMIT TRANSACTION;
        
        SELECT 'Entrenador eliminado correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0
            ROLLBACK TRANSACTION;
            
        THROW;
    END CATCH
END
GO