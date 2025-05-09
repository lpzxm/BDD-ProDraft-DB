-- Consultar la bitácora para verificar que todas las operaciones quedaron registradas
SELECT 
    [id_reg],
    [nombre_tabla],
    [transaccion],
    [fecha_hora_sistema],
    LEN([valores_anteriores]) AS len_anteriores,
    LEN([valores_nuevos]) AS len_nuevos
FROM [dbo].[Bitacora]
ORDER BY [fecha_hora_sistema] DESC;

-- Consultar detalles de algunas entradas de bitácora
SELECT 
    [id_reg],
    [nombre_tabla],
    [transaccion],
    [valores_anteriores],
    [valores_nuevos]
FROM [dbo].[Bitacora]
WHERE [nombre_tabla] = 'Jugador' OR [nombre_tabla] = 'Entrenador'
ORDER BY [fecha_hora_sistema] DESC;