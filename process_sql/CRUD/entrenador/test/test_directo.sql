-- 1. Limpiar datos anteriores (opcional para entorno de pruebas)
/*
DELETE FROM [dbo].[Bitacora];
DELETE FROM [dbo].[Observaciones_Jugador];
DELETE FROM [dbo].[Rubric_Score_player];
DELETE FROM [dbo].[Category_players];
DELETE FROM [dbo].[Jugador];
DELETE FROM [dbo].[Rubric_fields];
DELETE FROM [dbo].[Category_sport];
DELETE FROM [dbo].[Entrenador];
DELETE FROM [dbo].[Deporte];
*/

-- 2. Crear deporte
INSERT INTO [dbo].[Deporte] ([nombre]) 
VALUES ('Fútbol');
DECLARE @deporte_id INT = SCOPE_IDENTITY();

-- 3. Crear entrenador
INSERT INTO [dbo].[Entrenador] (
    [email], [contraseña], [nombres], [fechaNacimiento], [id_sport]
)
VALUES (
    'entrenador.futbol@prodraft.com', 'EntrenadorPass123!', 'Carlos', '1980-05-15', @deporte_id
);
DECLARE @entrenador_id INT = SCOPE_IDENTITY();

-- 4. Crear jugador con requisitos aprobados
INSERT INTO [dbo].[Jugador] (
    [email], [contraseña], [nombres], [apellidos], 
    [fechaNacimiento], [codigo], [grado], [seccion],
    [status_img_academic], [status_img_conduct], [status_sport]
)
VALUES (
    'jugador1@prodraft.com', 'JugadorPass123!', 'Juan', 'Pérez',
    '2008-03-20', 1001, '3ro', 'A',
    'aprobado', 'aprobado', 'aprobado'
);
DECLARE @jugador1_id INT = SCOPE_IDENTITY();

-- 5. Crear jugador con requisitos pendientes
INSERT INTO [dbo].[Jugador] (
    [email], [contraseña], [nombres], [apellidos], 
    [fechaNacimiento], [codigo], [grado], [seccion],
    [status_img_academic], [status_img_conduct], [status_sport]
)
VALUES (
    'jugador2@prodraft.com', 'JugadorPass456!', 'Ana', 'Gómez',
    '2009-04-12', 1002, '4to', 'B',
    'pendiente', 'aprobado', 'pendiente'
);
DECLARE @jugador2_id INT = SCOPE_IDENTITY();