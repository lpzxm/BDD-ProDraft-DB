--CREAR
CREATE OR ALTER PROCEDURE [dbo].[Admin_CreateEntrenador]
    @admin_email NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @fechaNacimiento DATE,
    @deporte_nombre NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar email
        IF @email NOT LIKE '%_@__%.__%'
            RAISERROR('Formato de email inválido', 16, 1);
            
        IF EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [email] = @email)
            RAISERROR('Email ya registrado', 16, 1);
            
        -- Validar contraseña
        IF LEN(@contraseña) < 8
            RAISERROR('Contraseña muy corta (mínimo 8 caracteres)', 16, 1);
            
        -- Validar edad
        IF DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 18
            RAISERROR('El entrenador debe tener al menos 18 años', 16, 1);
            
        -- Obtener deporte
        DECLARE @deporte_id INT;
        SELECT @deporte_id = [id] FROM [dbo].[Deporte] WHERE [nombre] = @deporte_nombre;
        
        IF @deporte_id IS NULL
            RAISERROR('Deporte no encontrado', 16, 1);
            
        -- Insertar entrenador
        INSERT INTO [dbo].[Entrenador] (
            [email], [contraseña], [nombres], [fechaNacimiento], [id_sport]
        )
        VALUES (
            @email, @contraseña, @nombres, @fechaNacimiento, @deporte_id
        );
        
        -- Registrar en bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Entrenador',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Entrenador] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ACTUALIZAR
CREATE OR ALTER PROCEDURE [dbo].[Admin_UpdateEntrenador]
    @admin_email NVARCHAR(255),
    @entrenador_id INT,
    @nombres NVARCHAR(255) = NULL,
    @fechaNacimiento DATE = NULL,
    @deporte_nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar que el entrenador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            RAISERROR('Entrenador no encontrado', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH
        );
            
        -- Validar edad si se actualiza
        IF @fechaNacimiento IS NOT NULL AND DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 18
            RAISERROR('El entrenador debe tener al menos 18 años', 16, 1);
            
        -- Obtener deporte si se actualiza
        DECLARE @deporte_id INT = NULL;
        IF @deporte_nombre IS NOT NULL
        BEGIN
            SELECT @deporte_id = [id] FROM [dbo].[Deporte] WHERE [nombre] = @deporte_nombre;
            IF @deporte_id IS NULL
                RAISERROR('Deporte no encontrado', 16, 1);
        END
        
        -- Actualizar entrenador
        UPDATE [dbo].[Entrenador]
        SET 
            [nombres] = ISNULL(@nombres, [nombres]),
            [fechaNacimiento] = ISNULL(@fechaNacimiento, [fechaNacimiento]),
            [id_sport] = ISNULL(@deporte_id, [id_sport])
        WHERE [id] = @entrenador_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Entrenador',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH);
        
        SELECT @entrenador_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ELIMINAR
CREATE OR ALTER PROCEDURE [dbo].[Admin_DeleteEntrenador]
    @admin_email NVARCHAR(255),
    @entrenador_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar que el entrenador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            RAISERROR('Entrenador no encontrado', 16, 1);
            
        -- Verificar que no tenga observaciones
        IF EXISTS (SELECT 1 FROM [dbo].[Observaciones_Entrenador] WHERE [id_entrenador] = @entrenador_id)
            RAISERROR('No se puede eliminar, el entrenador tiene observaciones registradas', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id FOR JSON PATH
        );
            
        -- Eliminar entrenador
        DELETE FROM [dbo].[Entrenador]
        WHERE [id] = @entrenador_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Entrenador',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--LEER
CREATE OR ALTER PROCEDURE [dbo].[Admin_GetEntrenadores]
    @admin_email NVARCHAR(255),
    @deporte_nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener entrenadores
        SELECT 
            e.[id],
            e.[email],
            e.[nombres],
            e.[fechaNacimiento],
            d.[nombre] AS deporte,
            DATEDIFF(YEAR, e.[fechaNacimiento], GETDATE()) AS edad
        FROM [dbo].[Entrenador] e
        JOIN [dbo].[Deporte] d ON e.[id_sport] = d.[id]
        WHERE (@deporte_nombre IS NULL OR d.[nombre] = @deporte_nombre);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO