-- 1. Limpiar base de datos (opcional, solo para entorno de pruebas)
/*
DELETE FROM [dbo].[Bitacora];
DELETE FROM [dbo].[Observaciones_Jugador];
DELETE FROM [dbo].[Rubric_Score_player];
DELETE FROM [dbo].[Category_players];
DELETE FROM [dbo].[Jugador];
DELETE FROM [dbo].[Entrenador];
DELETE FROM [dbo].[Category_sport];
DELETE FROM [dbo].[Rubric_fields];
DELETE FROM [dbo].[Admin];
DELETE FROM [dbo].[Deporte];
*/

-- 2. Insertar datos básicos para pruebas
INSERT INTO [dbo].[Deporte] ([nombre]) VALUES ('Fútbol');
DECLARE @futbol_id INT = SCOPE_IDENTITY();

INSERT INTO [dbo].[Admin] ([nombre], [apellidos], [email], [contraseña])
VALUES ('Admin', 'Principal', 'admin@prodraft.com', 'AdminPass123!');
DECLARE @admin_id INT = SCOPE_IDENTITY();

INSERT INTO [dbo].[Entrenador] (
    [email], [contraseña], [nombres], [fechaNacimiento], [id_sport]
)
VALUES (
    'entrenador@prodraft.com', 'EntrenadorPass123!', 'Carlos', '1980-01-01', @futbol_id
);
DECLARE @entrenador_id INT = SCOPE_IDENTITY();