CREATE PROCEDURE [dbo].[sp_Entrenador_AddJugadorCategoria]
    @entrenador_id INT,
    @jugador_id INT,
    @categoria_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar que el entrenador existe y está asignado al deporte de la categoría
        IF NOT EXISTS (
            SELECT 1 
            FROM [dbo].[Entrenador] e
            JOIN [dbo].[Category_sport] cs ON e.[id_sport] = cs.[id_sport]
            WHERE e.[id] = @entrenador_id AND cs.[id] = @categoria_id
        )
            THROW 50050, 'No tienes permisos para asignar jugadores a esta categoría', 1;
            
        -- Validar que el jugador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            THROW 50051, 'Jugador no encontrado', 1;
            
        -- Validar que el jugador no está ya en la categoría
        IF EXISTS (
            SELECT 1 
            FROM [dbo].[Category_players] 
            WHERE [id_player] = @jugador_id AND [id_category] = @categoria_id
        )
            THROW 50052, 'El jugador ya está asignado a esta categoría', 1;
            
        -- Validar que el jugador tiene todos los requisitos aprobados
        DECLARE @status_academic NVARCHAR(255), @status_conduct NVARCHAR(255), @status_sport NVARCHAR(255);
        
        SELECT 
            @status_academic = [status_img_academic],
            @status_conduct = [status_img_conduct],
            @status_sport = [status_sport]
        FROM [dbo].[Jugador]
        WHERE [id] = @jugador_id;
        
        IF @status_academic <> 'aprobado' OR @status_conduct <> 'aprobado' OR @status_sport <> 'aprobado'
            THROW 50053, 'El jugador no tiene todos los requisitos aprobados', 1;
            
        -- Asignar jugador a categoría
        INSERT INTO [dbo].[Category_players] (
            [id_player], 
            [id_category]
        )
        VALUES (
            @jugador_id, 
            @categoria_id
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Category_players', 'INSERT', 
            (SELECT * FROM [dbo].[Category_players] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT 'Jugador asignado a categoría correctamente' AS mensaje;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO