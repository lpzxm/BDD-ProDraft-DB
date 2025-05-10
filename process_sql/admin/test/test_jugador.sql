EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador1@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2008-05-15',
    @codigo = 1001;
-- Debe retornar el ID del nuevo jugador


EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador1@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Juan',
    @apellidos = 'Pérez',
    @fechaNacimiento = '2008-05-15',
    @codigo = 1001;
-- Debe retornar el ID del nuevo jugador


-- Ejecutar dos veces el mismo código
EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador.duplicado@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Duplicado',
    @apellidos = 'Test',
    @fechaNacimiento = '2009-01-01',
    @codigo = 1002;
-- Segunda ejecución debe fallar con "Email ya registrado"


EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador.joven@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Niño',
    @apellidos = 'Prueba',
    @fechaNacimiento = '2020-01-01', -- Menor de 12 años
    @codigo = 1003;
-- Debe fallar con "El jugador debe tener al menos 12 años"

-- Crear jugador de prueba
EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador.actualizar@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Original',
    @apellidos = 'Apellido',
    @fechaNacimiento = '2009-06-15',
    @codigo = 2001;
DECLARE @jugador_actualizar_id INT = SCOPE_IDENTITY();

-- Actualizar datos
EXEC [dbo].[Admin_UpdateJugador]
    @admin_email = 'admin@prodraft.com',
    @jugador_id = @jugador_actualizar_id,
    @nombres = 'Actualizado',
    @apellidos = 'Modificado';
-- Debe ejecutarse sin errores


-- Crear segundo jugador
EXEC [dbo].[Admin_CreateJugador]
    @admin_email = 'admin@prodraft.com',
    @email = 'jugador2@prodraft.com',
    @contraseña = 'Jugador123!',
    @nombres = 'Segundo',
    @apellidos = 'Jugador',
    @fechaNacimiento = '2008-07-20',
    @codigo = 2002;

-- Intentar actualizar con código duplicado
EXEC [dbo].[Admin_UpdateJugador]
    @admin_email = 'admin@prodraft.com',
    @jugador_id = @jugador_actualizar_id,
    @codigo = 2002; -- Código ya en uso
-- Debe fallar con "Código ya en uso"