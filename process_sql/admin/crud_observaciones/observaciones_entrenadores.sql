--CREAR

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
            [id_admin], [id_entrenador], [observacion]
        )
        VALUES (
            @admin_id, @entrenador_id, @observacion
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--LEER
CREATE OR ALTER PROCEDURE [dbo].[Admin_GetObservacionesEntrenador]
    @admin_email NVARCHAR(255),
    @entrenador_email NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener observaciones
        SELECT 
            o.[id],
            a.[nombre] + ' ' + a.[apellidos] AS administrador,
            e.[email] AS entrenador,
            e.[nombres] AS nombre_entrenador,
            o.[observacion],
            o.[fecha]
        FROM [dbo].[Observaciones_Entrenador] o
        JOIN [dbo].[Admin] a ON o.[id_admin] = a.[id]
        JOIN [dbo].[Entrenador] e ON o.[id_entrenador] = e.[id]
        WHERE (@entrenador_email IS NULL OR e.[email] = @entrenador_email)
        ORDER BY o.[fecha] DESC;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ELIMINAR
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
            
        -- Eliminar observación
        DELETE FROM [dbo].[Observaciones_Entrenador]
        WHERE [id] = @observacion_id;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Observación no encontrada', 16, 1);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

