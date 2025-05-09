CREATE OR ALTER PROCEDURE [dbo].[sp_Admin_CreateCategoria]
    @admin_id INT,
    @id_sport INT,
    @img NVARCHAR(255),
    @nombre NVARCHAR(255),
    @reglas NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Validar que el deporte existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Deporte] WHERE [id] = @id_sport)
            THROW 50014, 'El deporte especificado no existe', 1;
            
        -- Validar datos de categoría
        IF LEN(@nombre) < 3
            THROW 50030, 'El nombre de la categoría es demasiado corto', 1;
            
        IF LEN(@reglas) < 10
            THROW 50031, 'Las reglas deben tener al menos 10 caracteres', 1;
            
        -- Insertar nueva categoría
        INSERT INTO [dbo].[Category_sport] (
            [id_sport], [img], [nombre], [reglas]
        )
        VALUES (
            @id_sport, @img, @nombre, @reglas
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Category_sport', 'INSERT', 
            (SELECT * FROM [dbo].[Category_sport] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO