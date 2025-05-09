-- CASO EXITOSO: Asignar puntaje válido
EXEC [dbo].[sp_Entrenador_AsignarPuntaje]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @rubrica_id = @rubrica_id,
    @puntaje = 8;

-- CASO FALLIDO: Asignar puntaje fuera de rango (debe fallar)
EXEC [dbo].[sp_Entrenador_AsignarPuntaje]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @rubrica_id = @rubrica_id,
    @puntaje = 15; -- Puntaje máximo es 10