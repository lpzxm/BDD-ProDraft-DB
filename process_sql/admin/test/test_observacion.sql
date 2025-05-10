-- Primero necesitamos un entrenador
EXEC [dbo].[Admin_CreateEntrenador]
    @admin_email = 'admin@prodraft.com',
    @email = 'entrenador.obs@prodraft.com',
    @contraseña = 'Entrenador123!',
    @nombres = 'Para',
    @fechaNacimiento = '1982-01-01',
    @deporte_nombre = 'Baloncesto';

-- Crear observación
EXEC [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_email = 'entrenador.obs@prodraft.com',
    @observacion = 'El entrenador mostró excelente manejo técnico del grupo';
-- Debe retornar el ID de la nueva observación


EXEC [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_email = 'entrenador.obs@prodraft.com',
    @observacion = 'Bien'; -- Muy corta
-- Debe fallar con "La observación debe tener al menos 10 caracteres"


EXEC [dbo].[Admin_CreateObservacionEntrenador]
    @admin_email = 'admin@prodraft.com',
    @entrenador_email = 'noexiste@prodraft.com',
    @observacion = 'Observación de prueba para entrenador inexistente';
-- Debe fallar con "Entrenador no encontrado"