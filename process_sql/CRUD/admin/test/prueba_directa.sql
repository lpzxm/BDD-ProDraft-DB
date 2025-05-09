-- 1. Limpiar la base de datos (opcional, solo para pruebas)
/*
DELETE FROM [dbo].[Bitacora];
DELETE FROM [dbo].[Observaciones_Entrenador];
DELETE FROM [dbo].[Observaciones_Jugador];
DELETE FROM [dbo].[Rubric_Score_player];
DELETE FROM [dbo].[Category_players];
DELETE FROM [dbo].[Jugador];
DELETE FROM [dbo].[Entrenador];
DELETE FROM [dbo].[Category_sport];
DELETE FROM [dbo].[Admin];
DELETE FROM [dbo].[Deporte];
*/

-- 2. Insertar datos básicos iniciales

-- Insertar un deporte
INSERT INTO [dbo].[Deporte] ([nombre]) 
VALUES ('Fútbol');
DECLARE @futbol_id INT = SCOPE_IDENTITY();

-- Insertar un administrador
INSERT INTO [dbo].[Admin] ([nombre], [apellidos], [email], [contraseña])
VALUES ('Admin', 'Principal', 'admin@prodraft.com', 'AdminPass123!');
DECLARE @admin_id INT = SCOPE_IDENTITY();

-- Insertar un entrenador
INSERT INTO [dbo].[Entrenador] (
    [email], [contraseña], [nombres], [fechaNacimiento], [id_sport]
)
VALUES (
    'entrenador@prodraft.com', 'EntrenadorPass123!', 'Carlos', '1980-01-01', @futbol_id
);
DECLARE @entrenador_id INT = SCOPE_IDENTITY();

-- 3. Ahora podemos ejecutar los procedimientos correctamente

-- Ejemplo 1: Crear categoría correctamente
EXEC [dbo].[sp_Admin_CreateCategoria]
    @admin_id = @admin_id,
    @id_sport = @futbol_id,
    @img = 'futbol_sub15.jpg',
    @nombre = 'Sub-15',
    @reglas = 'Reglas oficiales de fútbol para categoría Sub-15 según FIFA';
DECLARE @categoria_id INT = SCOPE_IDENTITY();

-- Ejemplo 2: Crear jugador
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador1@prodraft.com',
    @contraseña = 'JugadorPass123!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2008-01-15',
    @codigo = 1001,
    @grado = '3ro',
    @seccion = 'A';
DECLARE @jugador_id INT = SCOPE_IDENTITY();

-- Ejemplo 3: Crear observación
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_id,
    @observacion = 'El entrenador necesita mejorar la puntualidad';
DECLARE @observacion_id INT = SCOPE_IDENTITY();

-- 4. Verificar los datos insertados
SELECT * FROM [dbo].[Deporte];
SELECT * FROM [dbo].[Admin];
SELECT * FROM [dbo].[Entrenador];
SELECT * FROM [dbo].[Category_sport];
SELECT * FROM [dbo].[Jugador];
SELECT * FROM [dbo].[Observaciones_Entrenador];