--CREAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id INT,
    @id_sport INT,
    @img NVARCHAR(255),
    @nombre NVARCHAR(255),
    @reglas NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y deporte
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Entrenador] 
            WHERE [id] = @entrenador_id AND [id_sport] = @id_sport
        )
            THROW 50001, 'Entrenador no autorizado para este deporte', 1;
            
        -- Validaciones
        IF LEN(@nombre) < 3
            THROW 50010, 'Nombre de categoría demasiado corto', 1;
            
        IF LEN(@reglas) < 10
            THROW 50011, 'Las reglas deben tener al menos 10 caracteres', 1;
            
        -- Insertar
        INSERT INTO [dbo].[Category_sport] (
            [id_sport], [img], [nombre], [reglas]
        )
        VALUES (
            @id_sport, @img, @nombre, @reglas
        );
        
        -- Bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
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
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_UpdateCategoria]
    @entrenador_id INT,
    @categoria_id INT,
    @img NVARCHAR(255) = NULL,
    @nombre NVARCHAR(255) = NULL,
    @reglas NVARCHAR(MAX) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y categoría
        DECLARE @id_sport INT;
        
        SELECT @id_sport = [id_sport] 
        FROM [dbo].[Category_sport] 
        WHERE [id] = @categoria_id;
        
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Entrenador] 
            WHERE [id] = @entrenador_id AND [id_sport] = @id_sport
        )
            THROW 50001, 'Entrenador no autorizado para esta categoría', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
            
        -- Actualizar
        UPDATE [dbo].[Category_sport]
        SET 
            [img] = ISNULL(@img, [img]),
            [nombre] = ISNULL(@nombre, [nombre]),
            [reglas] = ISNULL(@reglas, [reglas])
        WHERE [id] = @categoria_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Category_sport',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH);
        
        SELECT @categoria_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO


--ELIMINAR

CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_DeleteCategoria]
    @entrenador_id INT,
    @categoria_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y categoría
        DECLARE @id_sport INT;
        
        SELECT @id_sport = [id_sport] 
        FROM [dbo].[Category_sport] 
        WHERE [id] = @categoria_id;
        
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Entrenador] 
            WHERE [id] = @entrenador_id AND [id_sport] = @id_sport
        )
            THROW 50001, 'Entrenador no autorizado para esta categoría', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Category_sport] WHERE [id] = @categoria_id FOR JSON PATH
        );
            
        -- Eliminar
        DELETE FROM [dbo].[Category_sport] WHERE [id] = @categoria_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Category_sport',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO