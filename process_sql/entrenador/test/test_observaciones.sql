-- Primero necesitamos un jugador
EXEC [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id = @entrenador_id,
    @email = 'jugador_obs@test.com',
    @contraseña = 'JugadorPass1!',
    @nombres = 'Luis',
    @apellidos = 'Gómez',
    @fechaNacimiento = '2006-03-20',
    @codigo = 2001,
    @grado = '4to',
    @seccion = 'B';
DECLARE @jugador_obs_id INT = SCOPE_IDENTITY();

-- Éxito: Creación correcta de observación
EXEC [dbo].[sp_Entrenador_CreateObservacion]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador_obs_id,
    @observacion = 'El jugador muestra excelente actitud en los entrenamientos';

-- Error: Observación muy corta
EXEC [dbo].[sp_Entrenador_CreateObservacion]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador_obs_id,
    @observacion = 'OK';

-- Error: Jugador no existe
EXEC [dbo].[sp_Entrenador_CreateObservacion]
    @entrenador_id = @entrenador_id,
    @jugador_id = 9999,
    @observacion = 'El jugador no asiste a entrenamientos';