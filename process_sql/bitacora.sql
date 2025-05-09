-- Tabla Bitácora para trazabilidad
CREATE TABLE [dbo].[Bitacora](
    [id_reg] [int] IDENTITY(1,1) PRIMARY KEY,
    [usuario_sistema] [nvarchar](255) NOT NULL,
    [fecha_hora_sistema] [datetime] DEFAULT GETDATE(),
    [nombre_tabla] [nvarchar](255) NOT NULL,
    [transaccion] [nvarchar](50) NOT NULL,
    [valores_anteriores] [nvarchar](max) NULL,
    [valores_nuevos] [nvarchar](max) NULL
)
GO

-- Ejemplo de trigger para tabla Jugador
CREATE TRIGGER [dbo].[TR_Jugador_Bitacora]
ON [dbo].[Jugador]
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    DECLARE @usuario NVARCHAR(255) = SYSTEM_USER;
    DECLARE @operacion NVARCHAR(50);
    
    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @operacion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @operacion = 'INSERT';
    ELSE
        SET @operacion = 'DELETE';
    
    -- Para operaciones INSERT y UPDATE
    IF @operacion IN ('INSERT', 'UPDATE')
    BEGIN
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], 
            [nombre_tabla], 
            [transaccion],
            [valores_nuevos]
        )
        SELECT 
            @usuario,
            'Jugador',
            @operacion,
            (SELECT * FROM inserted FOR JSON PATH)
        FROM inserted;
    END
    
    -- Para operaciones UPDATE y DELETE
    IF @operacion IN ('UPDATE', 'DELETE')
    BEGIN
        INSERT INTO [dbo].[Bitacora] (
            [usuario_sistema], 
            [nombre_tabla], 
            [transaccion],
            [valores_anteriores]
        )
        SELECT 
            @usuario,
            'Jugador',
            @operacion,
            (SELECT * FROM deleted FOR JSON PATH)
        FROM deleted;
    END
END
GO