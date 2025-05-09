CREATE OR ALTER PROCEDURE [dbo].[sp_Admin_CreateJugador]
    @admin_id INT,
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
        -- Validar que el administrador existe
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Admin] WHERE [id] = @admin_id)
            THROW 50020, 'Administrador no válido', 1;
            
        -- Resto de validaciones...
        IF LEN(@contraseña) < 8
            THROW 50001, 'La contraseña debe tener al menos 8 caracteres', 1;
            
        IF @email NOT LIKE '%_@__%.__%'
            THROW 50002, 'El formato del email no es válido', 1;
            
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [email] = @email)
            THROW 50003, 'El email ya está registrado', 1;
            
        IF EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [codigo] = @codigo)
            THROW 50004, 'El código ya está en uso', 1;
            
        IF DATEDIFF(YEAR, @fechaNacimiento, GETDATE()) < 12
            THROW 50005, 'El jugador debe tener al menos 12 años', 1;
            
        -- Insertar nuevo jugador
        INSERT INTO [dbo].[Jugador] (
            [email], [contraseña], [nombres], [apellidos], 
            [fechaNacimiento], [codigo], [grado], [seccion]
        )
        VALUES (
            @email, @contraseña, @nombres, @apellidos, 
            @fechaNacimiento, @codigo, @grado, @seccion
        );
        
        -- Registrar en bitácora
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], [nombre_tabla], [transaccion], [valores_nuevos]
        )
        VALUES (
            SYSTEM_USER, 'Jugador', 'INSERT', 
            (SELECT * FROM [dbo].[Jugador] WHERE [id] = SCOPE_IDENTITY() FOR JSON PATH)
        );
        
        SELECT SCOPE_IDENTITY() AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO