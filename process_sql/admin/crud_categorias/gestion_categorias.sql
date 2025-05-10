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
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--LEER
CREATE OR ALTER PROCEDURE [dbo].[Admin_GetCategorias]
    @admin_email NVARCHAR(255),
    @deporte_nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener categorías
        SELECT 
            c.[id],
            d.[nombre] AS deporte,
            c.[nombre] AS categoria
        FROM [dbo].[Category_sport] c
        JOIN [dbo].[Deporte] d ON c.[id_sport] = d.[id]
        WHERE (@deporte_nombre IS NULL OR d.[nombre] = @deporte_nombre);
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
            
        -- Actualizar categoría
        UPDATE [dbo].[Category_sport]
        SET [nombre] = @nuevo_nombre
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Categoría no encontrada', 16, 1);
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
            
        -- Eliminar categoría
        DELETE FROM [dbo].[Category_sport]
        WHERE [id] = @categoria_id;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Categoría no encontrada', 16, 1);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO