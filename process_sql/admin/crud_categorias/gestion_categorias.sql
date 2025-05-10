--CREAR
CREATE OR ALTER PROCEDURE [dbo].[Admin_CreateCategoria]
    @admin_email NVARCHAR(255),
    @deporte_nombre NVARCHAR(255),
    @categoria_nombre NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener ID del deporte
        DECLARE @deporte_id INT;
        SELECT @deporte_id = [id] FROM [dbo].[Deporte] WHERE [nombre] = @deporte_nombre;
        
        IF @deporte_id IS NULL
            RAISERROR('Deporte no encontrado', 16, 1);
            
        -- Validar nombre
        IF LEN(@categoria_nombre) < 3
            RAISERROR('Nombre de categoría muy corto (mínimo 3 caracteres)', 16, 1);
            
        -- Insertar categoría
        INSERT INTO [dbo].[Category_sport] ([id_sport], [nombre])
        VALUES (@deporte_id, @categoria_nombre);
        
        -- Registrar en bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Category_sport',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Category_sport] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ACTUALIZAR
CREATE OR ALTER PROCEDURE [dbo].[Admin_UpdateCategoria]
    @admin_email NVARCHAR(255),
    @categoria_id INT,
    @nuevo_nombre NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar nombre
        IF LEN(@nuevo_nombre) < 3
            RAISERROR('Nombre de categoría muy corto', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
            
        -- Actualizar categoría
        UPDATE [dbo].[Category_sport]
        SET [nombre] = @nuevo_nombre
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Categoría no encontrada', 16, 1);
            
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Category_sport',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO


--ELIMINAR

CREATE OR ALTER PROCEDURE [dbo].[Admin_DeleteCategoria]
    @admin_email NVARCHAR(255),
    @categoria_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Verificar que no tenga jugadores asignados
        IF EXISTS (SELECT 1 FROM [dbo].[Category_players] WHERE [id_category] = @categoria_id)
            RAISERROR('No se puede eliminar, la categoría tiene jugadores asignados', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
            
        -- Eliminar categoría
        DELETE FROM [dbo].[Category_sport]
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Categoría no encontrada', 16, 1);
            
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Category_sport',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO