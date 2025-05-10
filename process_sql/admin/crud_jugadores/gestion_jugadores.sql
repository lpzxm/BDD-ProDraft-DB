-- =============================================
-- Procedimiento para crear jugador con bitácora
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_CreateJugador]
    @admin_email NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @fechaNacimiento DATE,
    @codigo INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar email
        IF @email NOT LIKE '%_@__%.__%'
            RAISERROR('Formato de email inválido', 16, 1);
            
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [email] = @email)
            RAISERROR('Email ya registrado', 16, 1);
            
        -- Validar código único
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [codigo] = @codigo)
            RAISERROR('Código ya en uso', 16, 1);
            
        -- Validar edad
        IF DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 12
            RAISERROR('El jugador debe tener al menos 12 años', 16, 1);
            
        -- Insertar jugador
        INSERT INTO [dbo].[Jugador] (
            [email], [contraseña], [nombres], [apellidos], [fechaNacimiento], [codigo]
        )
        VALUES (
            @email, @contraseña, @nombres, @apellidos, @fechaNacimiento, @codigo
        );
        
        -- Registrar en bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Jugador',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Jugador] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para obtener jugadores (solo lectura)
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_GetJugadores]
    @admin_email NVARCHAR(255),
    @filtro_nombre NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Obtener jugadores
        SELECT 
            [id],
            [email],
            [nombres],
            [apellidos],
            [fechaNacimiento],
            [codigo],
            DATEDIFF(YEAR, [fechaNacimiento], GETDATE()) AS edad,
            [grado],
            [seccion],
            [status_img_academic],
            [status_img_conduct],
            [status_sport]
        FROM [dbo].[Jugador]
        WHERE 
            @filtro_nombre IS NULL OR 
            [nombres] LIKE '%' + @filtro_nombre + '%' OR 
            [apellidos] LIKE '%' + @filtro_nombre + '%';
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para actualizar jugador con bitácora
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_UpdateJugador]
    @admin_email NVARCHAR(255),
    @jugador_id INT,
    @nombres NVARCHAR(255) = NULL,
    @apellidos NVARCHAR(255) = NULL,
    @fechaNacimiento DATE = NULL,
    @codigo INT = NULL,
    @grado NVARCHAR(50) = NULL,
    @seccion NVARCHAR(50) = NULL,
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar que el jugador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            RAISERROR('Jugador no encontrado', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
            
        -- Validar código único si se actualiza
        IF @codigo IS NOT NULL AND EXISTS (
            SELECT 1 FROM [dbo].[Jugador] 
            WHERE [codigo] = @codigo AND [id] <> @jugador_id
        )
            RAISERROR('Código ya en uso', 16, 1);
            
        -- Validar edad si se actualiza
        IF @fechaNacimiento IS NOT NULL AND DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 12
            RAISERROR('El jugador debe tener al menos 12 años', 16, 1);
            
        -- Actualizar jugador
        UPDATE [dbo].[Jugador]
        SET 
            [nombres] = ISNULL(@nombres, [nombres]),
            [apellidos] = ISNULL(@apellidos, [apellidos]),
            [fechaNacimiento] = ISNULL(@fechaNacimiento, [fechaNacimiento]),
            [codigo] = ISNULL(@codigo, [codigo]),
            [grado] = ISNULL(@grado, [grado]),
            [seccion] = ISNULL(@seccion, [seccion]),
            [status_img_academic] = ISNULL(@status_img_academic, [status_img_academic]),
            [status_img_conduct] = ISNULL(@status_img_conduct, [status_img_conduct]),
            [status_sport] = ISNULL(@status_sport, [status_sport])
        WHERE [id] = @jugador_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Jugador',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH);
        
        SELECT @jugador_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

-- =============================================
-- Procedimiento para eliminar jugador con bitácora
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[Admin_DeleteJugador]
    @admin_email NVARCHAR(255),
    @jugador_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar admin
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [email] = @admin_email)
            RAISERROR('Acceso no autorizado', 16, 1);
            
        -- Validar que el jugador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            RAISERROR('Jugador no encontrado', 16, 1);
            
        -- Verificar que no tenga observaciones
        IF EXISTS (SELECT 1 FROM [dbo].[Observaciones_Jugador] WHERE [id_atleta] = @jugador_id)
            RAISERROR('No se puede eliminar, el jugador tiene observaciones registradas', 16, 1);
            
        -- Verificar que no esté en categorías
        IF EXISTS (SELECT 1 FROM [dbo].[Category_players] WHERE [id_player] = @jugador_id)
            RAISERROR('No se puede eliminar, el jugador está asignado a categorías', 16, 1);
            
        -- Guardar datos antiguos para bitácora
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
            
        -- Eliminar jugador
        DELETE FROM [dbo].[Jugador]
        WHERE [id] = @jugador_id;
        
        -- Registrar en bitácora
        EXEC [dbo].[sp_RegistrarBitacora]
            @usuario = @admin_email,
            @tabla = 'Jugador',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO
