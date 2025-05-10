--CREAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_CreateJugador]
    @entrenador_id INT,
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @fechaNacimiento DATE,
    @codigo INT,
    @grado NVARCHAR(50),
    @seccion NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        -- Validaciones
        IF LEN(@contraseña) < 8
            THROW 50002, 'La contraseña debe tener al menos 8 caracteres', 1;
            
        IF @email NOT LIKE '%_@__%.__%'
            THROW 50003, 'Formato de email inválido', 1;
            
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [email] = @email)
            THROW 50004, 'Email ya registrado', 1;
            
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [codigo] = @codigo)
            THROW 50005, 'Código ya en uso', 1;
            
        IF DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 12
            THROW 50006, 'El jugador debe tener al menos 12 años', 1;
            
        -- Insertar
        INSERT INTO [dbo].[Jugador] (
            [email], [contraseña], [nombres], [apellidos], 
            [fechaNacimiento], [codigo], [grado], [seccion]
        )
        VALUES (
            @email, @contraseña, @nombres, @apellidos, 
            @fechaNacimiento, @codigo, @grado, @seccion
        );
        
        -- Bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
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

--ACTUALIZAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_UpdateJugador]
    @entrenador_id INT,
    @jugador_id INT,
    @nombres NVARCHAR(255) = NULL,
    @apellidos NVARCHAR(255) = NULL,
    @grado NVARCHAR(50) = NULL,
    @seccion NVARCHAR(50) = NULL,
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y jugador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            THROW 50007, 'Jugador no encontrado', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
            
        -- Actualizar
        UPDATE [dbo].[Jugador]
        SET 
            [nombres] = ISNULL(@nombres, [nombres]),
            [apellidos] = ISNULL(@apellidos, [apellidos]),
            [grado] = ISNULL(@grado, [grado]),
            [seccion] = ISNULL(@seccion, [seccion]),
            [status_img_academic] = ISNULL(@status_img_academic, [status_img_academic]),
            [status_img_conduct] = ISNULL(@status_img_conduct, [status_img_conduct]),
            [status_sport] = ISNULL(@status_sport, [status_sport])
        WHERE [id] = @jugador_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
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

--ELIMINAR

CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_DeleteJugador]
    @entrenador_id INT,
    @jugador_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        -- Validar jugador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            THROW 50007, 'Jugador no encontrado', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Jugador] WHERE [id] = @jugador_id FOR JSON PATH
        );
            
        -- Eliminar
        DELETE FROM [dbo].[Jugador] WHERE [id] = @jugador_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
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

