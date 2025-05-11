USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Update_Jugador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Update_Jugador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Update_Jugador
ON dbo.Jugador
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_antiguos, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Jugador',
        'UPDATE',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'email=',    d.email,    '; ',
            'nombres=',  d.nombres,  '; ',
            'apellidos=',d.apellidos,'; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), d.fechaNacimiento, 23), '; ',
            'codigo=',   d.codigo,   '; ',
            'grado=',    d.grado,    '; ',
            'seccion=',  d.seccion
        ),
        CONCAT(
            'email=',    i.email,    '; ',
            'nombres=',  i.nombres,  '; ',
            'apellidos=',i.apellidos,'; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), i.fechaNacimiento, 23), '; ',
            'codigo=',   i.codigo,   '; ',
            'grado=',    i.grado,    '; ',
            'seccion=',  i.seccion
        )
    FROM inserted AS i
    INNER JOIN deleted AS d
      ON i.id = d.id;
END;
GO
