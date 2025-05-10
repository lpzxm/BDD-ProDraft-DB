-- =============================================
-- Procedimiento para inicio de sesión de jugador
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Jugador_Login]
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Verificar credenciales
        SELECT 
            [id],
            [email],
            [nombres],
            [apellidos],
            [fechaNacimiento],
            [codigo],
            [grado],
            [seccion]
        FROM [dbo].[Jugador]
        WHERE [email] = @email AND [contraseña] = @contraseña;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Credenciales incorrectas', 16, 1);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para ver estado de rendimiento
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Jugador_GetRendimiento]
    @jugador_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Verificar que el jugador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            RAISERROR('Jugador no encontrado', 16, 1);
            
        -- Obtener datos básicos del jugador
        SELECT 
            j.[nombres] + ' ' + j.[apellidos] AS nombre_completo,
            j.[grado],
            j.[seccion],
            DATEDIFF(YEAR, j.[fechaNacimiento], GETDATE()) AS edad,
            j.[status_img_academic],
            j.[status_img_conduct],
            j.[status_sport]
        FROM [dbo].[Jugador] j
        WHERE j.[id] = @jugador_id;
        
        -- Obtener categorías del jugador
        SELECT 
            c.[nombre] AS categoria,
            d.[nombre] AS deporte
        FROM [dbo].[Category_players] cp
        JOIN [dbo].[Category_sport] c ON cp.[id_category] = c.[id]
        JOIN [dbo].[Deporte] d ON c.[id_sport] = d.[id]
        WHERE cp.[id_player] = @jugador_id;
        
        -- Obtener puntajes de rúbricas
        SELECT 
            rf.[nombre] AS criterio,
            rsp.[puntaje],
            rf.[max_puntaje],
            CAST(rsp.[puntaje] AS FLOAT)/rf.[max_puntaje]*100 AS porcentaje
        FROM [dbo].[Rubric_Score_player] rsp
        JOIN [dbo].[Rubric_fields] rf ON rsp.[id_rubric_field] = rf.[id]
        WHERE rsp.[id_player] = @jugador_id
        ORDER BY rf.[nombre];
        
        -- Obtener observaciones
        SELECT 
            o.[observacion],
            o.[fecha]
        FROM [dbo].[Observaciones_Jugador] o
        WHERE o.[id_atleta] = @jugador_id
        ORDER BY o.[fecha] DESC;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para cambiar contraseña
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Jugador_ChangePassword]
    @jugador_id INT,
    @contraseña_actual NVARCHAR(255),
    @nueva_contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar contraseña actual
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Jugador] 
            WHERE [id] = @jugador_id AND [contraseña] = @contraseña_actual
        )
            RAISERROR('La contraseña actual es incorrecta', 16, 1);
            
        -- Validar nueva contraseña
        IF LEN(@nueva_contraseña) < 8
            RAISERROR('La nueva contraseña debe tener al menos 8 caracteres', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT [id], [email] FROM [dbo].[Jugador] 
            WHERE [id] = @jugador_id FOR JSON PATH
        );
            
        -- Actualizar contraseña
        UPDATE [dbo].[Jugador]
        SET [contraseña] = @nueva_contraseña
        WHERE [id] = @jugador_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = (SELECT [email] FROM [dbo].[Jugador] WHERE [id] = @jugador_id),
            @tabla = 'Jugador',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT [id], [email] FROM [dbo].[Jugador] 
                              WHERE [id] = @jugador_id FOR JSON PATH);
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO