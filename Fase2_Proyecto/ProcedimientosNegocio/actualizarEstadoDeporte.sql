USE prodraftdb;
GO

IF OBJECT_ID('dbo.SP_ActualizarStatusSport', 'P') IS NOT NULL
    DROP PROCEDURE dbo.SP_ActualizarStatusSport;
GO

/**
  SP_ActualizarStatusSport
  Descripción:
    Actualiza el campo status_sport de todos los jugadores en función de su promedio de puntaje:
      – 'Activo' si el promedio ≥ @MinPromedio.
      – 'Pendiente' en caso contrario.
    Utiliza un CTE para calcular promedios y un único UPDATE masivo.
  Parámetros:
    @MinPromedio INT – Umbral mínimo de promedio. Debe ser un entero ≥ 0.
  Salida:
    JugadoresActualizados INT – Número de filas actualizadas.
  Errores:
    53000 – Parámetro @MinPromedio inválido.
    53001 – Error interno al procesar la actualización.
**/
CREATE PROCEDURE dbo.SP_ActualizarStatusSport
    @MinPromedio INT
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        -- 1. Validación del parámetro
        IF @MinPromedio IS NULL OR @MinPromedio < 0
            THROW 53000, 'El parámetro @MinPromedio debe ser un entero mayor o igual a 0.', 1;

        -- 2. Cálculo de promedios y actualización masiva
        ;WITH Promedios AS (
            SELECT
                j.id            AS id_player,
                AVG(rsp.puntaje) AS PromedioPuntaje
            FROM dbo.Jugador j
            JOIN dbo.Rubric_Score_player rsp
              ON j.id = rsp.id_player
            GROUP BY j.id
        )
        UPDATE j
        SET status_sport = CASE
            WHEN p.PromedioPuntaje >= @MinPromedio THEN 'Activo'
            ELSE 'Pendiente'
        END
        FROM dbo.Jugador j
        JOIN Promedios p
          ON j.id = p.id_player;

        -- 3. Devolver el conteo de registros actualizados
        SELECT @@ROWCOUNT AS JugadoresActualizados;
    END TRY
    BEGIN CATCH
        DECLARE @errMsg NVARCHAR(4000) = ERROR_MESSAGE();
        RAISERROR('53001: Error en actualizarEstadoDeporte', 16, 1, @errMsg);
        RETURN 53001;
    END CATCH
END;
GO

-- Ejemplo de prueba:
EXEC dbo.SP_ActualizarStatusSport @MinPromedio = 14;

-- Verificación:
SELECT id, nombres, apellidos, status_sport
FROM dbo.Jugador;
