USE prodraftdb;
GO

IF OBJECT_ID('dbo.Bitacora', 'U') IS NOT NULL
    DROP TABLE dbo.Bitacora;
GO

CREATE TABLE dbo.Bitacora (
    Id_reg               INT IDENTITY(1,1) PRIMARY KEY,
    Usuario_sistema      NVARCHAR(255) NOT NULL,
    Fecha_hora_sistema   DATETIME      NOT NULL DEFAULT GETDATE(),
    Nombre_tabla         NVARCHAR(255) NOT NULL,
    Tipo_transaccion     NVARCHAR(50)  NOT NULL,
    Clave_afectada       NVARCHAR(255) NULL,    -- guarda el id del registro afectado
    Datos_antiguos       NVARCHAR(MAX) NULL,    -- para los UPDATE
    Datos_nuevos         NVARCHAR(MAX) NULL     -- para los INSERT/UPDATE
);
GO
