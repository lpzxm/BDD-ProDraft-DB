CREATE PROCEDURE [dbo].[sp_Admin_DeleteObservacionEntrenador]
    @admin_id INT,
    @observacion_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Obtener datos para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Observaciones_Entrenador] WHERE [id] = @observacion_id FOR JSON PATH
        );
        
        -- Eliminar observación
        DELETE FROM [dbo].[Observaciones_Entrenador] 
        WHERE [id] = @observacion_id;
        
        IF @@ROWCOUNT = 0
            THROW 50041, 'Observación no encontrada', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores]
        )
        VALUES (
            SYSTEM_USER, 'Observaciones_Entrenador', 'DELETE',
            @valores_anteriores
        );
        
        SELECT 'Observación eliminada correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO