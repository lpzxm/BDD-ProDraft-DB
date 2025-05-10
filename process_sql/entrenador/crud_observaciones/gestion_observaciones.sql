--CREAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_CreateObservacion]
    @entrenador_id INT,
    @jugador_id INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        -- Validar jugador
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Jugador] WHERE [id] = @jugador_id)
            THROW 50012, 'Jugador no encontrado', 1;
            
        -- Validar observación
        IF LEN(@observacion) < 5
            THROW 50013, 'La observación debe tener al menos 5 caracteres', 1;
            
        -- Insertar
        INSERT INTO [dbo].[Observaciones_Jugador] (
            [id_atleta], [observacion]
        )
        VALUES (
            @jugador_id, @observacion
        );
        
        -- Bitácora
        DECLARE @new_id INT = SCOPE_IDENTITY();
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Observaciones_Jugador',
            @accion = 'INSERT',
            @valores_nuevos = (SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @new_id FOR JSON PATH);
        
        SELECT @new_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO

--ACTUALIZAR
CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_UpdateObservacion]
    @entrenador_id INT,
    @observacion_id INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y observación
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Observaciones_Jugador] 
            WHERE [id] = @observacion_id
        )
            THROW 50014, 'Observación no encontrada', 1;
            
        -- Validar observación
        IF LEN(@observacion) < 5
            THROW 50013, 'La observación debe tener al menos 5 caracteres', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id FOR JSON PATH
        );
            
        -- Actualizar
        UPDATE [dbo].[Observaciones_Jugador]
        SET 
            [observacion] = @observacion
        WHERE [id] = @observacion_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Observaciones_Jugador',
            @accion = 'UPDATE',
            @valores_anteriores = @old_data,
            @valores_nuevos = (SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id FOR JSON PATH);
        
        SELECT @observacion_id AS id;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO


--ELIMINAR

CREATE OR ALTER PROCEDURE [dbo].[sp_Entrenador_DeleteObservacion]
    @entrenador_id INT,
    @observacion_id INT
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        -- Validar entrenador y observación
        IF NOT EXISTS (SELECT 1 FROM [dbo].[Entrenador] WHERE [id] = @entrenador_id)
            THROW 50001, 'Entrenador no válido', 1;
            
        IF NOT EXISTS (
            SELECT 1 FROM [dbo].[Observaciones_Jugador] 
            WHERE [id] = @observacion_id
        )
            THROW 50014, 'Observación no encontrada', 1;
            
        -- Guardar datos antiguos
        DECLARE @old_data NVARCHAR(MAX) = (
            SELECT * FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id FOR JSON PATH
        );
            
        -- Eliminar
        DELETE FROM [dbo].[Observaciones_Jugador] WHERE [id] = @observacion_id;
        
        -- Bitácora
        EXEC [dbo].[sp_RegistrarBitacora] 
            @usuario = SYSTEM_USER,
            @tabla = 'Observaciones_Jugador',
            @accion = 'DELETE',
            @valores_anteriores = @old_data;
        
        SELECT 1 AS resultado;
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO