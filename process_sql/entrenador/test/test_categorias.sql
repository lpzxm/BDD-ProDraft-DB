-- Éxito: Creación correcta de categoría
EXEC [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub15.jpg',
    @nombre = 'Sub-15',
    @reglas = 'Reglas oficiales de fútbol para categoría Sub-15 según FIFA';


-- Error: Nombre muy corto
EXEC [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub12.jpg',
    @nombre = 'S',
    @reglas = 'Reglas oficiales de fútbol para categoría Sub-12 según FIFA';

-- Error: Reglas muy cortas
EXEC [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub18.jpg',
    @nombre = 'Sub-18',
    @reglas = 'Reglas';


-- Primero creamos una categoría para eliminar
EXEC [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id = @entrenador_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub10.jpg',
    @nombre = 'Sub-10',
    @reglas = 'Reglas adaptadas para niños de 10 años';
DECLARE @categoria_eliminar_id INT = SCOPE_IDENTITY();

-- Éxito: Eliminación correcta
EXEC [dbo].[sp_Entrenador_DeleteCategoria]
    @entrenador_id = @entrenador_id,
    @categoria_id = @categoria_eliminar_id;

-- Error: Intento de eliminar categoría que no existe
EXEC [dbo].[sp_Entrenador_DeleteCategoria]
    @entrenador_id = @entrenador_id,
    @categoria_id = 9999;