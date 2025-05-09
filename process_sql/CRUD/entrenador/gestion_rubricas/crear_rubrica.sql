CREATE PROCEDURE [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id INT,
    @description NVARCHAR(MAX),
    @max_puntaje INT,
    @nombre NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Obtener el deporte del entrenador
        DECLARE @id_sport INT;
        SELECT @id_sport = [id_sport] FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id;
        
        IF @id_sport IS NULL
            THROW 50061, 'Entrenador no encontrado', 1;
            
        -- Validar datos
        IF LEN(@description) < 10
            THROW 50062, 'La descripción debe tener al menos 10 caracteres', 1;
            
        IF @max_puntaje <= 0
            THROW 50063, 'El puntaje máximo debe ser positivo', 1;
            
        IF LEN(@nombre) < 3
            THROW 50064, 'El nombre debe tener al menos 3 caracteres', 1;
            
        -- Insertar nueva rúbrica
        INSERT INTO [dbo].[Rubric_fields] (
            [description], [max_puntaje], [nombre], [id_sport]
        )
        VALUES (
            @description, @max_puntaje, @nombre, @id_sport
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Rubric_fields', 'INSERT', 
            (SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO