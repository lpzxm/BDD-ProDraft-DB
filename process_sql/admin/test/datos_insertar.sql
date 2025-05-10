-- 1. Configuración inicial
INSERT INTO [dbo].[Admin] ([nombre], [apellidos], [email], [contraseña])
VALUES ('Admin', 'Principal', 'admin@prodraft.com', 'Admin123!');

INSERT INTO [dbo].[Deporte] ([nombre]) VALUES ('Fútbol'), ('Baloncesto');

-- 2. Probar CRUD de Entrenadores
-- Crear
EXEC [dbo].[Admin_CreateEntrenador]
    @admin_email = 'admin@prodraft.com',
    @email = 'entrenador1@prodraft.com',
    @contraseña = 'Entrenador123!',
    @nombres = 'Carlos',
    @fechaNacimiento = '1985-01-01',
    @deporte_nombre = 'Fútbol';
DECLARE @entrenador_id INT = SCOPE_IDENTITY();

-- Leer
EXEC [dbo].[Admin_GetEntrenadores] @admin_email = 'admin@prodraft.com';

-- Actualizar
EXEC [dbo].[Admin_UpdateEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_id = @entrenador_id,
    @nombres = 'Carlos Alberto';

-- 3. Probar CRUD de Jugadores
-- Crear
EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador1@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2010-05-15',
    @codigo = 1001;
DECLARE @jugador_id INT = SCOPE_IDENTITY();

-- Leer
EXEC [dbo].[Admin_GetJugadores] @admin_email = 'admin@prodraft.com';

-- 4. Probar CRUD de Observaciones
-- Crear
EXEC [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_email = 'entrenador1@prodraft.com',
    @observacion = 'Excelente desempeño en el entrenamiento de ayer';
DECLARE @observacion_id INT = SCOPE_IDENTITY();

-- Leer
EXEC [dbo].[Admin_GetObservacionesEntrenador] 
    @admin_email = 'admin@prodraft.com';

-- Eliminar (comentar para mantener datos en pruebas)
-- EXEC [dbo].[Admin_DeleteObservacionEntrenador]
--    @admin_email = 'admin@prodraft.com',
--    @observacion_id = @observacion_id;




-- Limpiar datos de prueba (opcional)
/*
DELETE FROM [dbo].[Observaciones_Entrenador];
DELETE FROM [dbo].[Category_players];
DELETE FROM [dbo].[Jugador];
DELETE FROM [dbo].[Category_sport];
DELETE FROM [dbo].[Entrenador];
DELETE FROM [dbo].[Deporte];
DELETE FROM [dbo].[Admin];
*/

-- Insertar datos base
INSERT INTO [dbo].[Admin] ([nombre], [apellidos], [email], [contraseña])
VALUES ('Admin', 'Principal', 'admin@prodraft.com', 'Admin123!');

INSERT INTO [dbo].[Deporte] ([nombre]) 
VALUES ('Fútbol'), ('Baloncesto'), ('Voleibol');