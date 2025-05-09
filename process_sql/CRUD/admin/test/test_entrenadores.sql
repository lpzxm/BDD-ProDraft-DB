-- Limpiar datos de prueba anteriores (opcional, solo si es un entorno de prueba)
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

-- Crear administrador principal de prueba
EXEC [dbo].[sp_Admin_Create]
    @nombre = 'Admin',
    @apellidos = 'Principal',
    @email = 'admin@prodraft.com',
    @contraseña = 'AdminPass123!';
DECLARE @admin_id INT = SCOPE_IDENTITY();

-- Crear deportes de prueba
INSERT INTO [dbo].[Deporte] ([nombre]) VALUES ('Fútbol');
DECLARE @futbol_id INT = SCOPE_IDENTITY();

INSERT INTO [dbo].[Deporte] ([nombre]) VALUES ('Baloncesto');
DECLARE @basquet_id INT = SCOPE_IDENTITY();

-- Crear entrenadores base
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.futbol@prodraft.com',
    @contraseña = 'EntrenadorPass123!',
    @nombres = 'Carlos',
    @fechaNacimiento = '1980-05-15',
    @id_sport = @futbol_id;
DECLARE @entrenador_futbol_id INT = SCOPE_IDENTITY();

EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.basquet@prodraft.com',
    @contraseña = 'EntrenadorPass456!',
    @nombres = 'Ana',
    @fechaNacimiento = '1985-10-22',
    @id_sport = @basquet_id;
DECLARE @entrenador_basquet_id INT = SCOPE_IDENTITY();


-- CASO EXITOSO: Crear nuevo entrenador
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'nuevo.entrenador@prodraft.com',
    @contraseña = 'NuevoPass123!',
    @nombres = 'Luis',
    @fechaNacimiento = '1982-08-30',
    @id_sport = @futbol_id;

-- CASO FALLIDO: Email duplicado
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.futbol@prodraft.com', -- Email existente
    @contraseña = 'OtroPass123!',
    @nombres = 'Pedro',
    @fechaNacimiento = '1983-04-12',
    @id_sport = @futbol_id;

-- CASO FALLIDO: Contraseña muy corta
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.corto@prodraft.com',
    @contraseña = 'abc', -- Contraseña corta
    @nombres = 'Juan',
    @fechaNacimiento = '1981-11-05',
    @id_sport = @futbol_id;

-- CASO FALLIDO: Edad mínima no cumplida
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.joven@prodraft.com',
    @contraseña = 'JovenPass123!',
    @nombres = 'Joven',
    @fechaNacimiento = '2010-02-15', -- Menor de 18
    @id_sport = @futbol_id;

-- CASO FALLIDO: Deporte no existe
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'entrenador.error@prodraft.com',
    @contraseña = 'ErrorPass123!',
    @nombres = 'Error',
    @fechaNacimiento = '1980-01-01',
    @id_sport = 999999; -- ID de deporte inexistente

-- CASO EXITOSO: Actualizar datos básicos
EXEC [dbo].[sp_Admin_UpdateEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id,
    @nombres = 'Carlos Alberto', -- Cambio de nombre
    @descripcion = 'Entrenador profesional con 10 años de experiencia';

-- CASO EXITOSO: Cambiar de deporte
EXEC [dbo].[sp_Admin_UpdateEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_basquet_id,
    @id_sport = @futbol_id; -- Cambio de baloncesto a fútbol

-- CASO FALLIDO: Entrenador no existe
EXEC [dbo].[sp_Admin_UpdateEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = 999999, -- ID inexistente
    @nombres = 'Inexistente';

-- CASO FALLIDO: Edad mínima no cumplida
EXEC [dbo].[sp_Admin_UpdateEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id,
    @fechaNacimiento = '2010-01-01'; -- Fecha que lo hace menor de edad

-- CASO EXITOSO: Eliminar entrenador sin dependencias
-- Primero creamos un entrenador temporal
EXEC [dbo].[sp_Admin_CreateEntrenador]
    @admin_id = @admin_id,
    @email = 'temp.entrenador@prodraft.com',
    @contraseña = 'TempPass123!',
    @nombres = 'Temporal',
    @fechaNacimiento = '1983-07-20',
    @id_sport = @basquet_id;
DECLARE @temp_entrenador_id INT = SCOPE_IDENTITY();

-- Luego lo eliminamos
EXEC [dbo].[sp_Admin_DeleteEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @temp_entrenador_id;

-- CASO FALLIDO: Eliminar entrenador con observaciones
-- Primero creamos una observación
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id,
    @observacion = 'Observación de prueba para evitar eliminación';

-- Intentamos eliminar
EXEC [dbo].[sp_Admin_DeleteEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id;

-- CASO FALLIDO: Entrenador no existe
EXEC [dbo].[sp_Admin_DeleteEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = 999999; -- ID inexistente

