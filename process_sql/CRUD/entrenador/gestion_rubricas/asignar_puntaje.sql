CREATE PROCEDURE [dbo].[sp_Entrenador_AsignarPuntaje]
    @entrenador_id INT,
    @jugador_id INT,
    @rubrica_id INT,
    @puntaje INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el entrenador puede evaluar a este jugador
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Category_players] cp
            JOIN [dbo].[Category_sport] cs ON cp.[id_category] = cs.[id]
            JOIN [dbo].[Entrenador] e ON cs.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND cp.[id_player] = @jugador_id
        )
            THROW 50067, 'No tienes permisos para evaluar este jugador', 1;
            
        -- Validar que la rúbrica pertenece al deporte del entrenador
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Rubric_fields] rf
            JOIN [dbo].[Entrenador] e ON rf.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND rf.[id] = @rubrica_id
        )
            THROW 50068, 'No tienes permisos para usar esta rúbrica', 1;
            
        -- Validar que el puntaje está dentro del rango permitido
        DECLARE @max_puntaje INT;
        SELECT @max_puntaje = [max_puntaje] 
        FROM [dbo].[Rubric_fields] 
        WHERE [id] = @rubrica_id;
        
        IF @puntaje < 0 OR @puntaje > @max_puntaje
            THROW 50069, 'Puntaje fuera del rango permitido', 1;
            
        -- Insertar o actualizar puntaje
        IF EXISTS (
            SELECT 1 
            FROM [dbo].[Rubric_Score_player] 
            WHERE [id_player] = @jugador_id AND [id_rubric_field] = @rubrica_id
        )
        BEGIN
            -- Actualizar puntaje existente
            UPDATE [dbo].[Rubric_Score_player]
            SET [puntaje] = @puntaje
            WHERE [id_player] = @jugador_id AND [id_rubric_field] = @rubrica_id;
            
            SELECT 'Puntaje actualizado correctamente' AS mensaje;
        END
        ELSE
        BEGIN
            -- Insertar nuevo puntaje
            INSERT INTO [dbo].[Rubric_Score_player] (
                [puntaje], [id_player], [id_rubric_field]
            )
            VALUES (
                @puntaje, @jugador_id, @rubrica_id
            );
            
            SELECT 'Puntaje asignado correctamente' AS mensaje;
        END
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Rubric_Score_player', 'INSERT/UPDATE', 
            (SELECT * FROM [dbo].[Rubric_Score_player] 
             WHERE [id_player] = @jugador_id AND [id_rubric_field] = @rubrica_id 
             FOR JSON PATH)
        );
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO