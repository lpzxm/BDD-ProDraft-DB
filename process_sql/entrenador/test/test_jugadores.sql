-- Éxito: Creación correcta de jugador
EXEC [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id = @entrenador_id,
    @email = 'jugador1@test.com',
    @contraseña = 'JugadorPass1!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2005-06-15',
    @codigo = 1001,
    @grado = '3ro',
    @seccion = 'A';


    -- Error: Entrenador no existe
EXEC [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id = 9999,
    @email = 'jugador2@test.com',
    @contraseña = 'JugadorPass1!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2005-06-15',
    @codigo = 1002,
    @grado = '3ro',
    @seccion = 'A';

-- Error: Email inválido
EXEC [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id = @entrenador_id,
    @email = 'emailinvalido',
    @contraseña = 'JugadorPass1!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2005-06-15',
    @codigo = 1003,
    @grado = '3ro',
    @seccion = 'A';

-- Error: Jugador demasiado joven
EXEC [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id = @entrenador_id,
    @email = 'jugador3@test.com',
    @contraseña = 'JugadorPass1!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2020-06-15',
    @codigo = 1004,
    @grado = '3ro',
    @seccion = 'A';

-- Éxito: Actualización correcta
EXEC [dbo].[sp_Entrenador_UpdateJugador]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador_obs_id,
    @grado = '5to',
    @seccion = 'C';

-- Error: Intento de actualizar jugador que no existe
EXEC [dbo].[sp_Entrenador_UpdateJugador]
    @entrenador_id = @entrenador_id,
    @jugador_id = 9999,
    @grado = '5to';