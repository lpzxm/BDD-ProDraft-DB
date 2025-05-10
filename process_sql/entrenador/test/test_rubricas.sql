-- Éxito: Creación correcta de rúbrica
EXEC [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @description = 'Evaluación de técnica individual',
    @max_puntaje = 10,
    @nombre = 'Técnica';

-- Error: Entrenador no pertenece al deporte
DECLARE @basquet_id INT;
INSERT INTO [dbo].[Deporte] ([nombre]) VALUES ('Básquetbol');
SET @basquet_id = SCOPE_IDENTITY();

EXEC [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id = @entrenador_id,
    @id_sport = @basquet_id,
    @description = 'Evaluación de lanzamiento',
    @max_puntaje = 10,
    @nombre = 'Lanzamiento';

-- Error: Puntaje máximo inválido
EXEC [dbo].[sp_Entrenador_CreateRubrica]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @description = 'Evaluación de condición física',
    @max_puntaje = -5,
    @nombre = 'Condición Física';