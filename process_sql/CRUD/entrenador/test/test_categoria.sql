-- CASO EXITOSO: Crear categoría
EXEC [dbo].[sp_Entrenador_CreateCategoria]
    @entrenador_id = @entrenador_id,
    @id_sport = @deporte_id,
    @img = 'futbol_sub15.jpg',
    @nombre = 'Sub-15',
    @reglas = 'Reglas oficiales de fútbol para categoría Sub-15 según FIFA';
DECLARE @categoria_id INT = SCOPE_IDENTITY();

SELECT 'Categoría creada exitosamente con ID: ' + CAST(@categoria_id AS NVARCHAR(10)) AS Resultado;



-- CASO EXITOSO: Eliminar jugador de categoría
EXEC [dbo].[sp_Entrenador_RemoveJugadorCategoria]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @categoria_id = @categoria_id;

-- Verificar que ya no está en la categoría
SELECT * FROM [dbo].[Category_players] WHERE [id_player] = @jugador1_id;


