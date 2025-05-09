CREATE PROCEDURE [dbo].[sp_Entrenador_UpdateJugador]
    @entrenador_id INT,
    @jugador_id INT,
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el entrenador tiene jugadores en sus categorías
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Category_players] cp
            JOIN [dbo].[Category_sport] cs ON cp.[id_category] = cs.[id]
            JOIN [dbo].[Entrenador] e ON cs.[id_sport] = e.[id_sport]
            WHERE e.[id] = @entrenador_id AND cp.[id_player] = @jugador_id
        )
            THROW 50054, 'No tienes permisos para editar este jugador', 1;
            
        -- Validar estados si se proporcionan
        IF @status_img_academic IS NOT NULL AND @status_img_academic NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50055, 'Estado académico no válido', 1;
            
        IF @status_img_conduct IS NOT NULL AND @status_img_conduct NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50056, 'Estado de conducta no válido', 1;
            
        IF @status_sport IS NOT NULL AND @status_sport NOT IN ('pendiente', 'aprobado', 'rechazado')
            THROW 50057, 'Estado deportivo no válido', 1;
            
        -- Obtener valores anteriores para bitácora
        DECLARE @valores_anteriores NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
        
        -- Actualizar solo los campos permitidos
        UPDATE [dbo].[Jugador]
        SET 
            [status_img_academic] = ISNULL(@status_img_academic, [status_img_academic]),
            [status_img_conduct] = ISNULL(@status_img_conduct, [status_img_conduct]),
            [status_sport] = ISNULL(@status_sport, [status_sport])
        WHERE [id] = @jugador_id;
        
        IF @@ROWCOUNT = 0
            THROW 50058, 'Jugador no encontrado', 1;
            
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion],
            [valores_anteriores], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Jugador', 'UPDATE',
            @valores_anteriores,
            (SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH)
        );
        
        SELECT 'Jugador actualizado correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO