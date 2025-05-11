USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Delete_Admin', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Delete_Admin;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Delete_Admin
ON dbo.Admin
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos)
    SELECT
        SYSTEM_USER,
        'Admin',
        'DELETE',
        CAST(d.id AS NVARCHAR(255)),
        CONCAT(
            'nombre=',    d.nombre,    '; ',
            'apellidos=', d.apellidos, '; ',
            'email=',     d.email
        )
    FROM deleted AS d;
END;
GO
