USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Delete_Entrenador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Delete_Entrenador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Delete_Entrenador
ON dbo.Entrenador
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos)
    SELECT
        SYSTEM_USER,
        'Entrenador',
        'DELETE',
        CAST(d.id AS NVARCHAR(255)),
        CONCAT(
            'nombres=',        d.nombres,        '; ',
            'email=',          d.email,          '; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), d.fechaNacimiento, 23), '; ',
            'id_sport=',       d.id_sport
        )
    FROM deleted AS d;
END;
GO
