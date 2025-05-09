-- CASO EXITOSO: Agregar jugador con requisitos aprobados
EXEC [dbo].[sp_Entrenador_AddJugadorCategoria]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador1_id,
    @categoria_id = @categoria_id;

-- CASO FALLIDO: Agregar jugador con requisitos pendientes (debe fallar)
EXEC [dbo].[sp_Entrenador_AddJugadorCategoria]
    @entrenador_id = @entrenador_id,
    @jugador_id = @jugador2_id,
    @categoria_id = @categoria_id;