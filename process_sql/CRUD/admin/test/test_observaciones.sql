-- CASO EXITOSO: Crear observación a entrenador
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id,
    @observacion = 'El entrenador mostró excelente manejo del grupo en el último partido';
DECLARE @obs1_id INT = SCOPE_IDENTITY();

-- CASO EXITOSO: Crear observación con contenido largo
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_basquet_id,
    @observacion = REPLICATE('Observación detallada. ', 20); -- Observación larga
DECLARE @obs2_id INT = SCOPE_IDENTITY();

-- CASO FALLIDO: Observación muy corta
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = @entrenador_futbol_id,
    @observacion = 'Corta'; -- Menos de 10 caracteres

-- CASO FALLIDO: Entrenador no existe
EXEC [dbo].[sp_Admin_CreateObservacionEntrenador]
    @admin_id = @admin_id,
    @entrenador_id = 999999, -- ID inexistente
    @observacion = 'Observación para entrenador inexistente';


-- CASO EXITOSO: Eliminar observación
EXEC [dbo].[sp_Admin_DeleteObservacionEntrenador]
    @admin_id = @admin_id,
    @observacion_id = @obs2_id;

-- CASO FALLIDO: Observación no existe
EXEC [dbo].[sp_Admin_DeleteObservacionEntrenador]
    @admin_id = @admin_id,
    @observacion_id = 999999; -- ID inexistente

