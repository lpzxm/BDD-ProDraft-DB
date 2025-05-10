-- =============================================
-- Procedimiento para crear observación de entrenador con bitácora
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email NVARCHAR(255),
    @entrenador_email NVARCHAR(255),
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        DECLARE @admin_id INT;
        SELECT @admin_id = [id] FROM [dbo].[Admin] WHERE [email] = @admin_email;
        
        IF @admin_id IS NULL
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener entrenador
        DECLARE @entrenador_id INT;
        SELECT @entrenador_id = [id] FROM [dbo].[Entrenador] WHERE [email] = @entrenador_email;
        
        IF @entrenador_id IS NULL
            RAISERROR('Entrenador no encontrado', 16, 1);
            
        -- Validar observación
        IF LEN(@observacion) < 10
            RAISERROR('La observación debe tener al menos 10 caracteres', 16, 1);
            
        -- Insertar observación
        INSERT INTO [dbo].[Observaciones_Entrenador] (
            [id_admin], [id_entrenador], [observacion], [fecha]
        )
        VALUES (
            @admin_id, @entrenador_id, @observacion, GETDATE()
        );
        
        -- Registrar en bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Observaciones_Entrenador',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Observaciones_Entrenador] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para obtener observaciones de entrenadores (solo lectura)
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_GetObservacionesEntrenador]
    @admin_email NVARCHAR(255),
    @entrenador_email NVARCHAR(255) = NULL,
    @fecha_inicio DATE = NULL,
    @fecha_fin DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar rango de fechas
        IF @fecha_inicio IS NOT NULL AND @fecha_fin IS NOT NULL AND @fecha_inicio > @fecha_fin
            RAISERROR('La fecha de inicio no puede ser mayor a la fecha fin', 16, 1);
            
        -- Obtener observaciones
        SELECT 
            o.[id],
            a.[nombre] + ' ' + a.[apellidos] AS administrador,
            e.[email] AS entrenador,
            e.[nombres] AS nombre_entrenador,
            o.[observacion],
            o.[fecha],
            d.[nombre] AS deporte
        FROM [dbo].[Observaciones_Entrenador] o
        JOIN [dbo].[Admin] a ON o.[id_admin] = a.[id]
        JOIN [dbo].[Entrenador] e ON o.[id_entrenador] = e.[id]
        JOIN [dbo].[Deporte] d ON e.[id_sport] = d.[id]
        WHERE (@entrenador_email IS NULL OR e.[email] = @entrenador_email)
          AND (@fecha_inicio IS NULL OR CONVERT(DATE, o.[fecha]) >= @fecha_inicio)
          AND (@fecha_fin IS NULL OR CONVERT(DATE, o.[fecha]) <= @fecha_fin)
        ORDER BY o.[fecha] DESC;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para eliminar observación de entrenador con bitácora
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_DeleteObservacionEntrenador]
    @admin_email NVARCHAR(255),
    @observacion_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar que la observación existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Observaciones_Entrenador] WHERE [id] = @observacion_id)
            RAISERROR('Observación no encontrada', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Observaciones_Entrenador] WHERE [id] = @observacion_id FOR JSON PATH
        );
            
        -- Eliminar observación
        DELETE FROM [dbo].[Observaciones_Entrenador]
        WHERE [id] = @observacion_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Observaciones_Entrenador',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

