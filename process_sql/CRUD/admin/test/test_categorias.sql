-- CASO EXITOSO: Crear categoría de fútbol
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub15.jpg',
    @nombre = 'Sub-15',
    @reglas = 'Reglas oficiales de fútbol para categoría Sub-15 según FIFA';
DECLARE @categoria_futbol_id INT = SCOPE_IDENTITY();

-- CASO EXITOSO: Crear categoría de baloncesto
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @basquet_id,
    @img = 'basquet_sub18.jpg',
    @nombre = 'Sub-18',
    @reglas = 'Reglas FIBA para categoría Sub-18 con adaptaciones locales';
DECLARE @categoria_basquet_id INT = SCOPE_IDENTITY();

-- CASO FALLIDO: Nombre muy corto
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @futbol_id,
    @img = 'futbol_error.jpg',
    @nombre = 'S', -- Nombre demasiado corto
    @reglas = 'Reglas de prueba';

-- CASO FALLIDO: Reglas muy cortas
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @basquet_id,
    @img = 'basquet_error.jpg',
    @nombre = 'Sub-12',
    @reglas = 'Reglas'; -- Reglas demasiado cortas

-- CASO FALLIDO: Deporte no existe
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = 999999, -- ID inexistente
    @img = 'error.jpg',
    @nombre = 'Error',
    @reglas = 'Reglas de prueba para categoría error';


-- CASO EXITOSO: Actualizar reglas
EXEC [dbo].[sp_Admin_UpdateCategoria]
    @admin_id = @admin_id,
    @categoria_id = @categoria_futbol_id,
    @reglas = 'Nuevas reglas actualizadas 2023 según normativa FIFA';

-- CASO EXITOSO: Actualizar imagen
EXEC [dbo].[sp_Admin_UpdateCategoria]
    @admin_id = @admin_id,
    @categoria_id = @categoria_basquet_id,
    @img = 'nueva_imagen_basquet.jpg';

-- CASO FALLIDO: Categoría no existe
EXEC [dbo].[sp_Admin_UpdateCategoria]
    @admin_id = @admin_id,
    @categoria_id = 999999, -- ID inexistente
    @nombre = 'Inexistente';

-- CASO FALLIDO: Nombre muy corto
EXEC [dbo].[sp_Admin_UpdateCategoria]
    @admin_id = @admin_id,
    @categoria_id = @categoria_futbol_id,
    @nombre = 'S'; -- Nombre demasiado corto


-- CASO EXITOSO: Eliminar categoría sin jugadores
-- Primero creamos una categoría temporal
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @futbol_id,
    @img = 'temp_cat.jpg',
    @nombre = 'Temporal',
    @reglas = 'Categoría temporal para pruebas';
DECLARE @temp_categoria_id INT = SCOPE_IDENTITY();

-- Luego la eliminamos
EXEC [dbo].[sp_Admin_DeleteCategoria]
    @admin_id = @admin_id,
    @categoria_id = @temp_categoria_id;

-- CASO FALLIDO: Eliminar categoría con jugadores
-- Primero creamos un jugador
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador.categoria@prodraft.com',
    @contraseña = 'JugadorCat123!',
    @nombres = 'Categoria',
    @apellidos = 'Test',
    @fechaNacimiento = '2007-05-15',
    @codigo = 100002,
    @grado = '4to',
    @seccion = 'B';
DECLARE @jugador_categoria_id INT = SCOPE_IDENTITY();

-- Asignamos el jugador a la categoría
INSERT INTO [dbo].[Category_players] ([id_player], [id_category])
VALUES (@jugador_categoria_id, @categoria_futbol_id);

-- Intentamos eliminar la categoría
EXEC [dbo].[sp_Admin_DeleteCategoria]
    @admin_id = @admin_id,
    @categoria_id = @categoria_futbol_id;

-- CASO FALLIDO: Categoría no existe
EXEC [dbo].[sp_Admin_DeleteCategoria]
    @admin_id = @admin_id,
    @categoria_id = 999999; -- ID inexistente


