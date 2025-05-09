CREATE PROCEDURE [dbo].[sp_Admin_UpdateJugador]
    @admin_id INT,
    @jugador_id INT,
    @nombres NVARCHAR(255) = NULL,
    @apellidos NVARCHAR(255) = NULL,
    @grado NVARCHAR(50) = NULL,
    @seccion NVARCHAR(50) = NULL,
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Validar estados si se proporcionan
        IF @status_img_academic IS NOT NULL AND @status_img_academic NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50006, 'Estado académico no válido', 1;
            
        IF @status_img_conduct IS NOT NULL AND @status_img_conduct NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50007, 'Estado de conducta no válido', 1;
            
        IF @status_sport IS NOT NULL AND @status_sport NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50008, 'Estado deportivo no válido', 1;
            
        -- Obtener valores anteriores para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
        
        -- Actualizar datos
        UPDATE [dbo].[Jugador]
        SET 
            [nombres] = ISNULL(@nombres, [nombres]),
            [apellidos] = ISNULL(@apellidos, [apellidos]),
            [grado] = ISNULL(@grado, [grado]),
            [seccion] = ISNULL(@seccion, [seccion]),
            [status_img_academic] = ISNULL(@status_img_academic, [status_img_academic]),
            [status_img_conduct] = ISNULL(@status_img_conduct, [status_img_conduct]),
            [status_sport] = ISNULL(@status_sport, [status_sport])
        WHERE [id] = @jugador_id;
        
        IF @@ROWCOUNT = 0
            THROW 50009, 'Jugador no encontrado', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Jugador', 'UPDATE',
            @valores_anteriores,
            (SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH)
        );
        
        SELECT 'Jugador actualizado correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO