-- CASO EXITOSO: Crear rúbrica de evaluación
EXEC [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id = @entrenador_id,
    @description = 'Habilidad técnica con el balón',
    @max_puntaje = 10,
    @nombre = 'Técnica';
DECLARE @rubrica_id INT = SCOPE_IDENTITY();

SELECT 'Rúbrica creada exitosamente con ID: ' + CAST(@rubrica_id AS NVARCHAR(10)) AS Resultado;