USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Insert_Entrenador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Insert_Entrenador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Insert_Entrenador
ON dbo.Entrenador
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Entrenador',
        'INSERT',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'nombres=',        i.nombres,        '; ',
            'email=',          i.email,          '; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), i.fechaNacimiento, 23), '; ',
            'id_sport=',       i.id_sport
        )
    FROM inserted AS i;
END;
GO
