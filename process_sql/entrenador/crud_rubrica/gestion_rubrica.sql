--CREAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id INT,
    @id_sport INT,
    @description NVARCHAR(MAX),
    @max_puntaje INT,
    @nombre NVARCHAR(255)
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
        IF @max_puntaje <= 0
            THROW 50008, 'El puntaje máximo debe ser positivo', 1;
            
        IF LEN(@nombre) < 3
            THROW 50009, 'Nombre de rúbrica demasiado corto', 1;
            
        -- Insertar
        INSERT INTO [dbo].[Rubric_fields] (
            [description], [max_puntaje], [nombre], [id_sport]
        )
        VALUES (
            @description, @max_puntaje, @nombre, @id_sport
        );
        
        -- Bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Rubric_fields',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ACTUALIZAR

CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_UpdateRubrica]
    @entrenador_id INT,
    @rubrica_id INT,
    @description NVARCHAR(MAX) = NULL,
    @max_puntaje INT = NULL,
    @nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y rúbrica
        DECLARE @id_sport INT;
        
        SELECT @id_sport = [id_sport] 
        FROM [dbo].[Rubric_fields] 
        WHERE [id] = @rubrica_id;
        
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Entrenador] 
            WHERE [id] = @entrenador_id AND [id_sport] = @id_sport
        )
            THROW 50001, 'Entrenador no autorizado para esta rúbrica', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id FOR JSON PATH
        );
            
        -- Actualizar
        UPDATE [dbo].[Rubric_fields]
        SET 
            [description] = ISNULL(@description, [description]),
            [max_puntaje] = ISNULL(@max_puntaje, [max_puntaje]),
            [nombre] = ISNULL(@nombre, [nombre])
        WHERE [id] = @rubrica_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Rubric_fields',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id FOR JSON PATH);
        
        SELECT @rubrica_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ELIMINAR

CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_DeleteRubrica]
    @entrenador_id INT,
    @rubrica_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y rúbrica
        DECLARE @id_sport INT;
        
        SELECT @id_sport = [id_sport] 
        FROM [dbo].[Rubric_fields] 
        WHERE [id] = @rubrica_id;
        
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Entrenador] 
            WHERE [id] = @entrenador_id AND [id_sport] = @id_sport
        )
            THROW 50001, 'Entrenador no autorizado para esta rúbrica', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id FOR JSON PATH
        );
            
        -- Eliminar
        DELETE FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Rubric_fields',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO