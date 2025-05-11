USE [prodraftdb];
GO

-- 1. Deportes
INSERT INTO dbo.Deporte (nombre, cloudinary_id, url) VALUES
('Fútbol',      'sport_foot',   'https://cdn.example.com/foot.png'),
('Baloncesto',  'sport_bask',   'https://cdn.example.com/bask.png'),
('Voleibol',    'sport_volley', 'https://cdn.example.com/volley.png');
GO

-- 2. Admins
INSERT INTO dbo.Admin (nombre, apellidos, email, contraseña) VALUES
('Ana',    'García',     'ana.garcia@colegio.edu',    'PassAdm123'),
('Carlos', 'Rodríguez',  'carlos.rodriguez@colegio.edu','SecretAdm456');
GO

-- 3. Jugadores
INSERT INTO dbo.Jugador (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion) VALUES
('juan.perez@colegio.edu', 'JP@2025', 'Juan',   'Pérez',    '2008-03-15', 1001, '3°', 'A'),
('maría.lopez@colegio.edu','ML@2025', 'María',  'López',    '2007-07-22', 1002, '4°', 'B'),
('diego.ramirez@colegio.edu','DR@2025','Diego',  'Ramírez',  '2008-11-05', 1003, '3°', 'A'),
('sofia.martinez@colegio.edu','SM@2025','Sofía',  'Martínez', '2009-01-30', 1004, '2°', 'C');
GO

-- 4. Entrenadores
INSERT INTO dbo.Entrenador (email, contraseña, nombres, fechaNacimiento, id_sport, descripcion, cloudinary_id, url) VALUES
('miguel.gomez@colegio.edu','MG@2025','Miguel Gómez','1980-05-10', 1, 'Especialista en tácticas ofensivas', 'coach_foot', 'https://cdn.example.com/coach1.png'),
('laura.sanchez@colegio.edu','LS@2025','Laura Sánchez','1985-09-18', 2, 'Entrenadora de habilidades básicas', 'coach_bask','https://cdn.example.com/coach2.png'),
('roberto.torres@colegio.edu','RT@2025','Roberto Torres','1978-12-02', 3, 'Enfocado en recepción y defensa', 'coach_volley','https://cdn.example.com/coach3.png');
GO

-- 5. Categorías de deporte
INSERT INTO dbo.Category_sport (id_sport, img, nombre, reglas) VALUES
(1, 'cat_foot_attack.png', 'Delantero',    'Encargado de anotar goles.'),
(1, 'cat_foot_defense.png','Defensa',      'Protege la portería.'),
(2, 'cat_bask_guard.png',  'Base',         'Organiza el juego y pasa el balón.'),
(2, 'cat_bask_center.png', 'Pívot/Centro', 'Juega cerca del aro.'),
(3, 'cat_volley_spiker.png','Rematador',   'Ataque en la red.');
GO

-- 6. Asignación jugador–categoría
INSERT INTO dbo.Category_players (id_player, id_category) VALUES
(1, 1),  -- Juan como Delantero
(2, 3),  -- María como Base
(3, 5),  -- Diego como Rematador
(4, 2);  -- Sofía como Defensa
GO

-- 7. Campos de rúbrica
INSERT INTO dbo.Rubric_fields (description, max_puntaje, nombre, id_sport) VALUES
('Control de balón',           10, 'Control',      1),
('Finalización de jugadas',    15, 'Finalización', 1),
('Dribbling y velocidad',      20, 'Dribbling',    2),
('Tiros a canasta',            15, 'Tiro',         2),
('Recepción y colocación',     20, 'Recepción',    3);
GO

-- 8. Puntuaciones de jugadores
INSERT INTO dbo.Rubric_Score_player (puntaje, id_player, id_rubric_field) VALUES
(8,  1, 1),  -- Juan: Control
(12, 1, 2),  -- Juan: Finalización
(18, 2, 3),  -- María: Dribbling
(10, 2, 4),  -- María: Tiro
(16, 3, 5),  -- Diego: Recepción
(14, 4, 1);  -- Sofía: Control
GO

-- 9. Observaciones de Jugador
INSERT INTO dbo.Observaciones_Jugador (id_atleta, observacion) VALUES
(1, 'Buena coordinación, mejorar definición.'),
(2, 'Excelente velocidad, necesita pulir lanzamientos.'),
(3, 'Destaca en recepción, trabajar colocación.'),
(4, 'Fuerte en defensa, reforzar anticipación.');
GO

-- 10. Observaciones de Entrenador
INSERT INTO dbo.Observaciones_Entrenador (id_admin, id_entrenador, observacion) VALUES
(1, 1, 'Revisar plan de entrenamiento ofensivo.'),
(2, 2, 'Solicitar más ejercicios de manejo de balón.'),
(1, 3, 'Agregar prácticas de bloqueo y defensa.');
GO
