USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Delete_Jugador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Delete_Jugador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Delete_Jugador
ON dbo.Jugador
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos)
    SELECT
        SYSTEM_USER,
        'Jugador',
        'DELETE',
        CAST(d.id AS NVARCHAR(255)),
        CONCAT(
            'email=',    d.email,    '; ',
            'nombres=',  d.nombres,  '; ',
            'apellidos=',d.apellidos,'; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), d.fechaNacimiento, 23), '; ',
            'codigo=',   d.codigo,   '; ',
            'grado=',    d.grado,    '; ',
            'seccion=',  d.seccion
        )
    FROM deleted AS d;
END;
GO
