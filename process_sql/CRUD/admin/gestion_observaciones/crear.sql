CREATE PROCEDURE [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id INT,
    @entrenador_id INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Validar que el entrenador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50016, 'Entrenador no encontrado', 1;
            
        -- Validar la observación
        IF LEN(@observacion) < 10
            THROW 50040, 'La observación debe tener al menos 10 caracteres', 1;
            
        -- Insertar nueva observación
        INSERT INTO [dbo].[Observaciones_Entrenador] (
            [id_admin], [id_entrenador], [observacion]
        )
        VALUES (
            @admin_id, @entrenador_id, @observacion
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Observaciones_Entrenador', 'INSERT', 
            (SELECT * FROM [dbo].[Observaciones_Entrenador] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO