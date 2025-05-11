USE prodraftdb;
GO

/* 1. INSERT de prueba */
PRINT '--- Prueba INSERT ---';
INSERT INTO dbo.Jugador
    (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion)
VALUES
    ('prueba.trigger@colegio.edu','TG@2025','Prueba','Trigger','2011-08-20',9001,'5°','Z');
GO

/* 2. UPDATE de prueba */
PRINT '--- Prueba UPDATE ---';
UPDATE dbo.Jugador
SET
    apellidos = 'TriggerModificado',
    grado     = '6°'
WHERE email = 'prueba.trigger@colegio.edu';
GO

/* 3. DELETE de prueba */
PRINT '--- Prueba DELETE ---';
DELETE FROM dbo.Jugador
WHERE email = 'prueba.trigger@colegio.edu';
GO

/* 4. Verificar registros en Bitacora */
PRINT '--- Contenido de Bitacora ---';
SELECT
    Id_reg,
    Usuario_sistema,
    Fecha_hora_sistema,
    Nombre_tabla,
    Tipo_transaccion,
    Clave_afectada,
    Datos_antiguos,
    Datos_nuevos
FROM dbo.Bitacora
WHERE Nombre_tabla = 'Jugador'
  AND Clave_afectada = '9001'
ORDER BY Fecha_hora_sistema;
GO


-- Probar
SELECT * FROM dbo.Bitacora ORDER BY Fecha_hora_sistema DESC;


--Visualizar los triggers
USE prodraftdb;
GO

SELECT 
    t.name AS TriggerName,
    OBJECT_NAME(parent_id) AS TableName,
    t.is_disabled
FROM sys.triggers t
WHERE OBJECT_NAME(parent_id) = 'Jugador';


--Admin y Entrenador
USE prodraftdb;
GO

PRINT '--- Prueba INSERT Admin ---';
INSERT INTO dbo.Admin (nombre, apellidos, email, contraseña)
VALUES ('Trigger', 'Admin', 'admin.trigger@colegio.edu', 'Adm@2025');
GO

PRINT '--- Prueba UPDATE Admin ---';
UPDATE dbo.Admin
SET apellidos = 'AdminMod'
WHERE email = 'admin.trigger@colegio.edu';
GO

PRINT '--- Prueba DELETE Admin ---';
DELETE FROM dbo.Admin
WHERE email = 'admin.trigger@colegio.edu';
GO

PRINT '--- Prueba INSERT Entrenador ---';
INSERT INTO dbo.Entrenador 
    (email, contraseña, nombres, fechaNacimiento, id_sport)
VALUES 
    ('coach.trigger@colegio.edu','C@2025','CoachTrigger','1970-01-01', 1);
GO

PRINT '--- Prueba UPDATE Entrenador ---';
UPDATE dbo.Entrenador
SET nombres = 'CoachMod'
WHERE email = 'coach.trigger@colegio.edu';
GO

PRINT '--- Prueba DELETE Entrenador ---';
DELETE FROM dbo.Entrenador
WHERE email = 'coach.trigger@colegio.edu';
GO

-- Verificar Bitacora
PRINT '--- Contenido de Bitacora (Admin y Entrenador) ---';
SELECT *
FROM dbo.Bitacora
WHERE Nombre_tabla IN ('Admin','Entrenador')
ORDER BY Fecha_hora_sistema DESC;
GO
