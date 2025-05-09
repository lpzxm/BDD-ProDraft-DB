CREATE PROCEDURE [dbo].[sp_Entrenador_CreateObservacionJugador]
    @entrenador_id INT,
    @jugador_id INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el entrenador puede observar a este jugador
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Category_players] cp
            JOIN [dbo].[Category_sport] cs ON cp.[id_category] = cs.[id]
            JOIN [dbo].[Entrenador] e ON cs.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND cp.[id_player] = @jugador_id
        )
            THROW 50070, 'No tienes permisos para observar este jugador', 1;
            
        -- Validar la observación
        IF LEN(@observacion) < 10
            THROW 50071, 'La observación debe tener al menos 10 caracteres', 1;
            
        -- Insertar nueva observación
        INSERT INTO [dbo].[Observaciones_Jugador] (
            [id_atleta], [observacion]
        )
        VALUES (
            @jugador_id, @observacion
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Observaciones_Jugador', 'INSERT', 
            (SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO