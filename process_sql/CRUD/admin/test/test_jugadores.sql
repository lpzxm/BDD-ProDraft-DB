-- CASO EXITOSO: Crear jugador básico
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador1@prodraft.com',
    @contraseña = 'JugadorPass123!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2008-03-20',
    @codigo = 100003,
    @grado = '3ro',
    @seccion = 'A';
DECLARE @jugador1_id INT = SCOPE_IDENTITY();

-- CASO EXITOSO: Crear jugador con fecha exacta para edad mínima (12 años)
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador2@prodraft.com',
    @contraseña = 'JugadorPass456!',
    @nombres = 'Ana',
    @apellidos = 'Gómez',
    @fechaNacimiento = DATEADD(YEAR, -12, GETDATE()), -- Exactamente 12 años
    @codigo = 100004,
    @grado = '4to',
    @seccion = 'B';
DECLARE @jugador2_id INT = SCOPE_IDENTITY();

-- CASO FALLIDO: Email duplicado
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador1@prodraft.com', -- Email existente
    @contraseña = 'OtroPass123!',
    @nombres = 'Pedro',
    @apellidos = 'Martínez',
    @fechaNacimiento = '2009-04-12',
    @codigo = 100005,
    @grado = '2do',
    @seccion = 'C';

-- CASO FALLIDO: Código duplicado
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador3@prodraft.com',
    @contraseña = 'JugadorPass789!',
    @nombres = 'Luis',
    @apellidos = 'Rodríguez',
    @fechaNacimiento = '2008-11-05',
    @codigo = 100003, -- Código existente
    @grado = '5to',
    @seccion = 'A';

-- CASO FALLIDO: Edad mínima no cumplida
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'jugador.joven@prodraft.com',
    @contraseña = 'JovenPass123!',
    @nombres = 'Joven',
    @apellidos = 'Prueba',
    @fechaNacimiento = '2015-02-15', -- Menor de 12
    @codigo = 100006,
    @grado = '1ro',
    @seccion = 'B';


-- CASO EXITOSO: Actualizar datos básicos
EXEC [dbo].[sp_Admin_UpdateJugador]
    @admin_id = @admin_id,
    @jugador_id = @jugador1_id,
    @apellidos = 'Pérez López', -- Cambio de apellidos
    @grado = '4to', -- Cambio de grado
    @status_img_academic = 'aprobado'; -- Aprobar documentación

-- CASO EXITOSO: Aprobar todos los estados
EXEC [dbo].[sp_Admin_UpdateJugador]
    @admin_id = @admin_id,
    @jugador_id = @jugador2_id,
    @status_img_academic = 'aprobado',
    @status_img_conduct = 'aprobado',
    @status_sport = 'aprobado';

-- CASO FALLIDO: Estado no válido
EXEC [dbo].[sp_Admin_UpdateJugador]
    @admin_id = @admin_id,
    @jugador_id = @jugador1_id,
    @status_img_academic = 'invalido'; -- Estado no permitido

-- CASO FALLIDO: Jugador no existe
EXEC [dbo].[sp_Admin_UpdateJugador]
    @admin_id = @admin_id,
    @jugador_id = 999999, -- ID inexistente
    @nombres = 'Inexistente';


-- CASO EXITOSO: Eliminar jugador sin dependencias
-- Primero creamos un jugador temporal
EXEC [dbo].[sp_Admin_CreateJugador]
    @admin_id = @admin_id,
    @email = 'temp.jugador@prodraft.com',
    @contraseña = 'TempPass123!',
    @nombres = 'Temporal',
    @apellidos = 'Prueba',
    @fechaNacimiento = '2009-07-20',
    @codigo = 100007,
    @grado = '2do',
    @seccion = 'C';
DECLARE @temp_jugador_id INT = SCOPE_IDENTITY();

-- Luego lo eliminamos
EXEC [dbo].[sp_Admin_DeleteJugador]
    @admin_id = @admin_id,
    @jugador_id = @temp_jugador_id;

-- CASO FALLIDO: Eliminar jugador con observaciones
-- Primero creamos una observación
INSERT INTO [dbo].[Observaciones_Jugador] ([id_atleta], [observacion])
VALUES (@jugador1_id, 'Observación de prueba para evitar eliminación');

-- Intentamos eliminar
EXEC [dbo].[sp_Admin_DeleteJugador]
    @admin_id = @admin_id,
    @jugador_id = @jugador1_id;

-- CASO FALLIDO: Eliminar jugador con puntajes
-- Primero creamos un campo de rúbrica
INSERT INTO [dbo].[Rubric_fields] ([description], [max_puntaje], [nombre], [id_sport])
VALUES ('Habilidad técnica', 10, 'Técnica', @futbol_id);
DECLARE @rubrica_id INT = SCOPE_IDENTITY();

-- Creamos un puntaje
INSERT INTO [dbo].[Rubric_Score_player] ([puntaje], [id_player], [id_rubric_field])
VALUES (8, @jugador2_id, @rubrica_id);

-- Intentamos eliminar
EXEC [dbo].[sp_Admin_DeleteJugador]
    @admin_id = @admin_id,
    @jugador_id = @jugador2_id;

-- CASO FALLIDO: Jugador no existe
EXEC [dbo].[sp_Admin_DeleteJugador]
    @admin_id = @admin_id,
    @jugador_id = 999999; -- ID inexistente


