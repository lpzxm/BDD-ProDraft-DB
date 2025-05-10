EXEC [dbo].[Admin_CreateEntrenador]
    @admin_email = 'admin@prodraft.com',
    @email = 'entrenador.futbol@prodraft.com',
    @contraseña = 'Entrenador123!',
    @nombres = 'Carlos',
    @fechaNacimiento = '1985-01-01',
    @deporte_nombre = 'Fútbol';
-- Debe retornar el ID del nuevo entrenador

EXEC [dbo].[Admin_CreateEntrenador]
    @admin_email = 'noexiste@prodraft.com', -- Email admin no existe
    @email = 'entrenador2@prodraft.com',
    @contraseña = 'Entrenador123!',
    @nombres = 'Pedro',
    @fechaNacimiento = '1980-01-01',
    @deporte_nombre = 'Fútbol';
-- Debe fallar con "Acceso no autorizado"


-- Obtener todos los entrenadores
EXEC [dbo].[Admin_GetEntrenadores] @admin_email = 'admin@prodraft.com';

-- Filtrar por deporte
EXEC [dbo].[Admin_GetEntrenadores] 
    @admin_email = 'admin@prodraft.com',
    @deporte_nombre = 'Fútbol';

    -- Credenciales inválidas
EXEC [dbo].[Admin_GetEntrenadores] @admin_email = 'noautorizado@prodraft.com';
-- Debe fallar con "Acceso no autorizado"

-- Primero crear un entrenador para eliminar
EXEC [dbo].[Admin_CreateEntrenador]
    @admin_email = 'admin@prodraft.com',
    @email = 'entrenador.eliminar@prodraft.com',
    @contraseña = 'Entrenador123!',
    @nombres = 'ParaEliminar',
    @fechaNacimiento = '1983-01-01',
    @deporte_nombre = 'Voleibol';
DECLARE @entrenador_eliminar_id INT = SCOPE_IDENTITY();

-- Luego eliminarlo
EXEC [dbo].[Admin_DeleteEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_id = @entrenador_eliminar_id;
-- Debe ejecutarse sin errores


-- Crear observación primero
EXEC [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_email = 'entrenador.obs@prodraft.com',
    @observacion = 'Esta observación previene la eliminación';

-- Intentar eliminar
EXEC [dbo].[Admin_DeleteEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_id = (SELECT TOP 1 [id] FROM [dbo].[Entrenador] WHERE [email] = 'entrenador.obs@prodraft.com');
-- Debe fallar con "No se puede eliminar, el entrenador tiene observaciones registradas"