CREATE PROCEDURE [dbo].[sp_Admin_UpdateCategoria]
    @admin_id INT,
    @categoria_id INT,
    @img NVARCHAR(255) = NULL,
    @nombre NVARCHAR(255) = NULL,
    @reglas NVARCHAR(MAX) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Obtener valores anteriores para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
        
        -- Actualizar datos
        UPDATE [dbo].[Category_sport]
        SET 
            [img] = ISNULL(@img, [img]),
            [nombre] = ISNULL(@nombre, [nombre]),
            [reglas] = ISNULL(@reglas, [reglas])
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            THROW 50032, 'Categoría no encontrada', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Category_sport', 'UPDATE',
            @valores_anteriores,
            (SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH)
        );
        
        SELECT 'Categoría actualizada correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO