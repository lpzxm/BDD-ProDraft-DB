USE prodraftdb;
GO

IF OBJECT_ID('dbo.TRG_Bitacora_Insert_Jugador', 'TR') IS NOT NULL
    DROP TRIGGER dbo.TRG_Bitacora_Insert_Jugador;
GO

CREATE TRIGGER dbo.TRG_Bitacora_Insert_Jugador
ON dbo.Jugador
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO dbo.Bitacora
        (Usuario_sistema, Nombre_tabla, Tipo_transaccion, Clave_afectada, Datos_nuevos)
    SELECT
        SYSTEM_USER,
        'Jugador',
        'INSERT',
        CAST(i.id AS NVARCHAR(255)),
        CONCAT(
            'email=',    i.email,    '; ',
            'nombres=',  i.nombres,  '; ',
            'apellidos=',i.apellidos,'; ',
            'fechaNacimiento=', CONVERT(NVARCHAR(10), i.fechaNacimiento, 23), '; ',
            'codigo=',   i.codigo,   '; ',
            'grado=',    i.grado,    '; ',
            'seccion=',  i.seccion
        )
    FROM inserted AS i;
END;
GO
