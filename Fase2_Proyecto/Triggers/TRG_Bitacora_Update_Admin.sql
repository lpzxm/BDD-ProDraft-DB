USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Update_Admin', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Update_Admin;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Update_Admin
ON dbo.Admin
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Admin',
        'UPDATE',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'nombre=',    d.nombre,    '; ',
            'apellidos=', d.apellidos, '; ',
            'email=',     d.email
        ),
        CONCAT(
            'nombre=',    i.nombre,    '; ',
            'apellidos=', i.apellidos, '; ',
            'email=',     i.email
        )
    FROM inserted AS i
    INNER JOIN deleted AS d
      ON i.id = d.id;
END;
GO
