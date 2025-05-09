CREATE PROCEDURE [dbo].[sp_Entrenador_UpdateRubrica]
    @entrenador_id INT,
    @rubrica_id INT,
    @description NVARCHAR(MAX) = NULL,
    @max_puntaje INT = NULL,
    @nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que la rúbrica pertenece al deporte del entrenador
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Rubric_fields] rf
            JOIN [dbo].[Entrenador] e ON rf.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND rf.[id] = @rubrica_id
        )
            THROW 50065, 'No tienes permisos para editar esta rúbrica', 1;
            
        -- Validar datos si se proporcionan
        IF @description IS NOT NULL AND LEN(@description) < 10
            THROW 50062, 'La descripción debe tener al menos 10 caracteres', 1;
            
        IF @max_puntaje IS NOT NULL AND @max_puntaje <= 0
            THROW 50063, 'El puntaje máximo debe ser positivo', 1;
            
        IF @nombre IS NOT NULL AND LEN(@nombre) < 3
            THROW 50064, 'El nombre debe tener al menos 3 caracteres', 1;
            
        -- Obtener valores anteriores para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id FOR JSON PATH
        );
        
        -- Actualizar rúbrica
        UPDATE [dbo].[Rubric_fields]
        SET 
            [description] = ISNULL(@description, [description]),
            [max_puntaje] = ISNULL(@max_puntaje, [max_puntaje]),
            [nombre] = ISNULL(@nombre, [nombre])
        WHERE [id] = @rubrica_id;
        
        IF @@ROWCOUNT = 0
            THROW 50066, 'Rúbrica no encontrada', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Rubric_fields', 'UPDATE',
            @valores_anteriores,
            (SELECT * FROM [dbo].[Rubric_fields] WHERE [id] = @rubrica_id FOR JSON PATH)
        );
        
        SELECT 'Rúbrica actualizada correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO