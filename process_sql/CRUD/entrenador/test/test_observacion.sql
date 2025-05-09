-- CASO EXITOSO: Crear observación válida
EXEC [dbo].[sp_Entrenador_CreateObservacionJugador]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @observacion = 'Excelente desempeño en el último partido, muestra gran potencial';
DECLARE @observacion_id INT = SCOPE_IDENTITY();

SELECT 'Observación creada exitosamente con ID: ' + CAST(@observacion_id AS NVARCHAR(10)) AS Resultado;

-- CASO FALLIDO: Crear observación muy corta (debe fallar)
EXEC [dbo].[sp_Entrenador_CreateObservacionJugador]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @observacion = 'Bien'; -- Menos de 10 caracteres


-- CASO EXITOSO: Eliminar observación
EXEC [dbo].[sp_Entrenador_DeleteObservacionJugador]
    @entrenador_id = @entrenador_id,
    @observacion_id = @observacion_id;

-- Verificar que la observación fue eliminada
SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id;