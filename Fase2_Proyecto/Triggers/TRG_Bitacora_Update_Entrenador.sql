USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Update_Entrenador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Update_Entrenador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Update_Entrenador
ON dbo.Entrenador
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Entrenador',
        'UPDATE',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'nombres=',        d.nombres,        '; ',
            'email=',          d.email,          '; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), d.fechaNacimiento, 23), '; ',
            'id_sport=',       d.id_sport
        ),
        CONCAT(
            'nombres=',        i.nombres,        '; ',
            'email=',          i.email,          '; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), i.fechaNacimiento, 23), '; ',
            'id_sport=',       i.id_sport
        )
    FROM inserted AS i
    INNER JOIN deleted AS d
      ON i.id = d.id;
END;
GO
