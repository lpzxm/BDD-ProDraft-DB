USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Insert_Admin', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Insert_Admin;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Insert_Admin
ON dbo.Admin
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Admin',
        'INSERT',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'nombre=',    i.nombre,    '; ',
            'apellidos=', i.apellidos, '; ',
            'email=',     i.email
        )
    FROM inserted AS i;
END;
GO
