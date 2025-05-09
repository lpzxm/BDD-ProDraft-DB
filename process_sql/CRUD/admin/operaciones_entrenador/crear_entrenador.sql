CREATE PROCEDURE [dbo].[sp_Admin_UpdateEntrenador]
    @admin_id INT,
    @entrenador_id INT,
    @nombres NVARCHAR(255) = NULL,
    @fechaNacimiento DATE = NULL,
    @id_sport INT = NULL,
    @descripcion NVARCHAR(MAX) = NULL,
    @cloudinary_id NVARCHAR(255) = NULL,
    @url NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Validaciones de datos
        IF @fechaNacimiento IS NOT NULL AND DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 18
            THROW 50015, 'El entrenador debe tener al menos 18 años', 1;
            
        IF @id_sport IS NOT NULL AND NOT EXISTS (SELECT 1 FROM [dbo].[Deporte] WHERE [id] = @id_sport)
            THROW 50014, 'El deporte especificado no existe', 1;
            
        -- Obtener valores anteriores para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH
        );
        
        -- Actualizar datos
        UPDATE [dbo].[Entrenador]
        SET 
            [nombres] = ISNULL(@nombres, [nombres]),
            [fechaNacimiento] = ISNULL(@fechaNacimiento, [fechaNacimiento]),
            [id_sport] = ISNULL(@id_sport, [id_sport]),
            [descripcion] = ISNULL(@descripcion, [descripcion]),
            [cloudinary_id] = ISNULL(@cloudinary_id, [cloudinary_id]),
            [url] = ISNULL(@url, [url])
        WHERE [id] = @entrenador_id;
        
        IF @@ROWCOUNT = 0
            THROW 50016, 'Entrenador no encontrado', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Entrenador', 'UPDATE',
            @valores_anteriores,
            (SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH)
        );
        
        SELECT 'Entrenador actualizado correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO