USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_MarcarRevision', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_MarcarRevision;
GO

/**
  SP_MarcarRevision
  Descripción:
    Recorre en lote todos los jugadores cuyo promedio de puntaje sea menor
    al umbral especificado y actualiza su status_sport a 'Revisión'.
    Utiliza un bucle WHILE y control de errores.
  Parámetro:
    @MaxPromedio INT – Umbral máximo de promedio. Si AVG < @MaxPromedio, pasa a Revisión.
  Salida:
    CantJugadores INT – Total de jugadores procesados.
  Errores:
    52000 – Error interno al procesar el lote.
**/
CREATE PROCEDURE dbo.SP_MarcarRevision
    @MaxPromedio INT
AS
BEGIN
    SET NOCOUNT ON;
    DECLARE @CantJugadores INT = 0;
    DECLARE @CurrId INT;
    DECLARE @Promedio FLOAT;

    BEGIN TRY
        -- Cursor simulado con WHILE usando una tabla temporal de IDs
        DECLARE @Temp TABLE (RowNum INT IDENTITY(1,1), id_player INT);
        INSERT INTO @Temp (id_player)
        SELECT j.id
        FROM dbo.Jugador j
        JOIN dbo.Rubric_Score_player rsp ON j.id = rsp.id_player
        GROUP BY j.id
        HAVING AVG(rsp.puntaje) < @MaxPromedio;

        DECLARE @MaxRow INT;
        SELECT @MaxRow = MAX(RowNum) FROM @Temp;

        DECLARE @Index INT = 1;
        WHILE @Index <= @MaxRow
        BEGIN
            SELECT @CurrId = id_player FROM @Temp WHERE RowNum = @Index;

            -- Obtener promedio
            SELECT @Promedio = AVG(rsp.puntaje)
            FROM dbo.Rubric_Score_player rsp
            WHERE rsp.id_player = @CurrId;

            -- Actualizar status_sport
            UPDATE dbo.Jugador
            SET status_sport = 'Revisión'
            WHERE id = @CurrId;

            SET @CantJugadores += 1;
            SET @Index += 1;
        END

        -- Devolver conteo
        SELECT @CantJugadores AS CantJugadores;
    END TRY
    BEGIN CATCH
        DECLARE @errMsg NVARCHAR(4000) = ERROR_MESSAGE();
        RAISERROR('52000: Error al procesar SP_MarcarRevision – %s', 16, 1, @errMsg);
        RETURN 52000;
    END CATCH
END;
GO


-- Supongamos que queremos marcar a quienes promedian < 12
EXEC dbo.SP_MarcarRevision @MaxPromedio = 12;

-- Verifica los cambios
SELECT id, nombres, apellidos, status_sport
FROM dbo.Jugador
WHERE status_sport = 'Revisión';
