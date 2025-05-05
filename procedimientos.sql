use prodraftdb;
GO

CREATE TABLE Bitacora_Auditoria (
    id_auditoria INT IDENTITY(1,1) PRIMARY KEY,
    fecha DATETIME DEFAULT GETDATE(),
    usuario NVARCHAR(255) DEFAULT SYSTEM_USER,
    tabla_afectada NVARCHAR(255) NOT NULL,
    tipo_operacion NVARCHAR(10) NOT NULL, -- 'INSERT', 'UPDATE', 'DELETE'
    registro_afectado NVARCHAR(MAX) NULL -- Detalles del registro afectado
);
GO

--Insertar un deporte
CREATE or ALTER PROCEDURE sp_InsertarDeporte
    @nombre NVARCHAR(255),
    @cloudinary_id NVARCHAR(255) = '',
    @url NVARCHAR(255) = ''
AS
BEGIN
    SET NOCOUNT ON;

    IF EXISTS (SELECT 1 FROM Deporte WHERE nombre = @nombre)
    BEGIN
        RAISERROR('Ya existe un deporte con el mismo nombre.', 16, 1);
        RETURN;
    END

    INSERT INTO Deporte (nombre, cloudinary_id, url)
    VALUES (@nombre, @cloudinary_id, @url);
END;
GO

--Actualizar un deporte
CREATE OR ALTER PROCEDURE sp_ActualizarDeporte
    @id INT,
    @nombre NVARCHAR(255),
    @cloudinary_id NVARCHAR(255),
    @url NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un deporte con el ID especificado.', 16, 1);
        RETURN;
    END

    UPDATE Deporte
    SET nombre = @nombre,
        cloudinary_id = @cloudinary_id,
        url = @url
    WHERE id = @id;
END;
GO

--Eliminar un deporte
CREATE OR ALTER PROCEDURE sp_EliminarDeporte
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un deporte con el ID especificado.', 16, 1);
        RETURN;
    END

    DELETE FROM Deporte
    WHERE id = @id;
END;
GO

--Trigger de tabla auditoria para tabla deporte
CREATE TRIGGER trg_Auditoria_Deporte
ON Deporte
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Obtener detalles del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT_WS(': ', COLUMN_NAME, COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (SELECT * FROM inserted UNION ALL SELECT * FROM deleted) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Deporte', @accion, @registro_afectado);
END;
GO

---
--Insertar un nuevo administrador
CREATE OR ALTER PROCEDURE sp_InsertarAdmin
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar duplicidad de email o contraseña
    IF EXISTS (SELECT 1 FROM Admin WHERE email = @email)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Admin WHERE contraseña = @contraseña)
    BEGIN
        RAISERROR('La contraseña ya está en uso.', 16, 1);
        RETURN;
    END

    -- Insertar el nuevo administrador
    INSERT INTO Admin (nombre, apellidos, email, contraseña)
    VALUES (@nombre, @apellidos, @email, @contraseña);
END;
GO

--Actualizar un administrador
CREATE OR ALTER PROCEDURE sp_ActualizarAdmin
    @id INT,
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del administrador
    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un administrador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar duplicidad de email o contraseña en otros registros
    IF EXISTS (SELECT 1 FROM Admin WHERE email = @email AND id <> @id)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso por otro administrador.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Admin WHERE contraseña = @contraseña AND id <> @id)
    BEGIN
        RAISERROR('La contraseña ya está en uso por otro administrador.', 16, 1);
        RETURN;
    END

    -- Actualizar el administrador
    UPDATE Admin
    SET nombre = @nombre,
        apellidos = @apellidos,
        email = @email,
        contraseña = @contraseña
    WHERE id = @id;
END;
GO

--Eliminar un administrador
CREATE OR ALTER PROCEDURE sp_EliminarAdmin
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del administrador
    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un administrador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el administrador
    DELETE FROM Admin
    WHERE id = @id;
END;
GO


--Trigger de auditoria para tabla administrador
CREATE TRIGGER trg_Auditoria_Admin
ON Admin
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'nombre', COLUMN_VALUE = nombre FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'apellidos', COLUMN_VALUE = apellidos FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'email', COLUMN_VALUE = email FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Admin', @accion, @registro_afectado);
END;
GO

--
--Insertar un nuevo jugador
CREATE OR ALTER PROCEDURE sp_InsertarJugador
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @fechaNacimiento DATE,
    @codigo INT,
    @grado NVARCHAR(50),
    @seccion NVARCHAR(50),
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar duplicidad de email, contraseña y código
    IF EXISTS (SELECT 1 FROM Jugador WHERE email = @email)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Jugador WHERE contraseña = @contraseña)
    BEGIN
        RAISERROR('La contraseña ya está en uso.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Jugador WHERE codigo = @codigo)
    BEGIN
        RAISERROR('El código ya está en uso.', 16, 1);
        RETURN;
    END

    -- Insertar el nuevo jugador
    INSERT INTO Jugador (email, contraseña, nombres, apellidos, fechaNacimiento, codigo, grado, seccion, status_img_academic, status_img_conduct, status_sport)
    VALUES (@email, @contraseña, @nombres, @apellidos, @fechaNacimiento, @codigo, @grado, @seccion, @status_img_academic, @status_img_conduct, @status_sport);
END;
GO

--Actualizar un jugador
CREATE OR ALTER PROCEDURE sp_ActualizarJugador
    @id INT,
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @fechaNacimiento DATE,
    @codigo INT,
    @grado NVARCHAR(50),
    @seccion NVARCHAR(50),
    @status_img_academic NVARCHAR(255) = NULL,
    @status_img_conduct NVARCHAR(255) = NULL,
    @status_sport NVARCHAR(255) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un jugador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar duplicidad de email, contraseña y código en otros registros
    IF EXISTS (SELECT 1 FROM Jugador WHERE email = @email AND id <> @id)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso por otro jugador.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Jugador WHERE contraseña = @contraseña AND id <> @id)
    BEGIN
        RAISERROR('La contraseña ya está en uso por otro jugador.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Jugador WHERE codigo = @codigo AND id <> @id)
    BEGIN
        RAISERROR('El código ya está en uso por otro jugador.', 16, 1);
        RETURN;
    END

    -- Actualizar el jugador
    UPDATE Jugador
    SET email = @email,
        contraseña = @contraseña,
        nombres = @nombres,
        apellidos = @apellidos,
        fechaNacimiento = @fechaNacimiento,
        codigo = @codigo,
        grado = @grado,
        seccion = @seccion,
        status_img_academic = @status_img_academic,
        status_img_conduct = @status_img_conduct,
        status_sport = @status_sport
    WHERE id = @id;
END;
GO

--Eliminar un jugador
CREATE OR ALTER PROCEDURE sp_EliminarJugador
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un jugador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el jugador
    DELETE FROM Jugador
    WHERE id = @id;
END;
GO

--Trigger de auditoria de tabla jugador
CREATE TRIGGER trg_Auditoria_Jugador
ON Jugador
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'email', COLUMN_VALUE = email FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'nombres', COLUMN_VALUE = nombres FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'apellidos', COLUMN_VALUE = apellidos FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Jugador', @accion, @registro_afectado);
END;
GO

--
--Insertar un nuevo entrenador
CREATE OR ALTER PROCEDURE sp_InsertarEntrenador
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @fechaNacimiento DATE,
    @id_sport INT,
    @descripcion NVARCHAR(MAX) = '',
    @cloudinary_id NVARCHAR(255) = '',
    @url NVARCHAR(255) = ''
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar duplicidad de email y contraseña
    IF EXISTS (SELECT 1 FROM Entrenador WHERE email = @email)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Entrenador WHERE contraseña = @contraseña)
    BEGIN
        RAISERROR('La contraseña ya está en uso.', 16, 1);
        RETURN;
    END

    -- Validar existencia del deporte asociado
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Insertar el nuevo entrenador
    INSERT INTO Entrenador (email, contraseña, nombres, fechaNacimiento, id_sport, descripcion, cloudinary_id, url)
    VALUES (@email, @contraseña, @nombres, @fechaNacimiento, @id_sport, @descripcion, @cloudinary_id, @url);
END;
GO

--Actualizar un entrenador
CREATE OR ALTER PROCEDURE sp_ActualizarEntrenador
    @id INT,
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255),
    @nombres NVARCHAR(255),
    @fechaNacimiento DATE,
    @id_sport INT,
    @descripcion NVARCHAR(MAX) = '',
    @cloudinary_id NVARCHAR(255) = '',
    @url NVARCHAR(255) = ''
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del entrenador
    IF NOT EXISTS (SELECT 1 FROM Entrenador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un entrenador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar duplicidad de email y contraseña en otros registros
    IF EXISTS (SELECT 1 FROM Entrenador WHERE email = @email AND id <> @id)
    BEGIN
        RAISERROR('El correo electrónico ya está en uso por otro entrenador.', 16, 1);
        RETURN;
    END
    IF EXISTS (SELECT 1 FROM Entrenador WHERE contraseña = @contraseña AND id <> @id)
    BEGIN
        RAISERROR('La contraseña ya está en uso por otro entrenador.', 16, 1);
        RETURN;
    END

    -- Validar existencia del deporte asociado
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Actualizar el entrenador
    UPDATE Entrenador
    SET email = @email,
        contraseña = @contraseña,
        nombres = @nombres,
        fechaNacimiento = @fechaNacimiento,
        id_sport = @id_sport,
        descripcion = @descripcion,
        cloudinary_id = @cloudinary_id,
        url = @url
    WHERE id = @id;
END;
GO

--Eliminar entrenador
CREATE OR ALTER PROCEDURE sp_EliminarEntrenador
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del entrenador
    IF NOT EXISTS (SELECT 1 FROM Entrenador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un entrenador con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el entrenador
    DELETE FROM Entrenador
    WHERE id = @id;
END;
GO

--Trigger de auditoria de tabla entrenador
CREATE TRIGGER trg_Auditoria_Entrenador
ON Entrenador
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'email', COLUMN_VALUE = email FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'nombres', COLUMN_VALUE = nombres FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_sport', COLUMN_VALUE = CAST(id_sport AS NVARCHAR) FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Entrenador', @accion, @registro_afectado);
END;
GO

--
--Insertar categoria de deporte
CREATE OR ALTER PROCEDURE sp_InsertarCategorySport
    @id_sport INT,
    @img NVARCHAR(255),
    @nombre NVARCHAR(255),
    @reglas NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del deporte asociado
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Insertar la nueva categoría de deporte
    INSERT INTO Category_sport (id_sport, img, nombre, reglas)
    VALUES (@id_sport, @img, @nombre, @reglas);
END;
GO

--Actualizar categoria de deporte
CREATE OR ALTER PROCEDURE sp_ActualizarCategorySport
    @id INT,
    @id_sport INT,
    @img NVARCHAR(255),
    @nombre NVARCHAR(255),
    @reglas NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia de la categoría de deporte
    IF NOT EXISTS (SELECT 1 FROM Category_sport WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró una categoría de deporte con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar existencia del deporte asociado
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Actualizar la categoría de deporte
    UPDATE Category_sport
    SET id_sport = @id_sport,
        img = @img,
        nombre = @nombre,
        reglas = @reglas
    WHERE id = @id;
END;
GO

--Eliminar una categoria de deporte
CREATE OR ALTER PROCEDURE sp_EliminarCategorySport
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia de la categoría de deporte
    IF NOT EXISTS (SELECT 1 FROM Category_sport WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró una categoría de deporte con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar la categoría de deporte
    DELETE FROM Category_sport
    WHERE id = @id;
END;
GO

--Trigger de tabla auditoria de tabla categoria de deporte
CREATE TRIGGER trg_Auditoria_Category_sport
ON Category_sport
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_sport', COLUMN_VALUE = CAST(id_sport AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'nombre', COLUMN_VALUE = nombre FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Category_sport', @accion, @registro_afectado);
END;
GO

--
--Insertar un jugador dentro de una categoria
CREATE OR ALTER PROCEDURE sp_InsertarCategoryPlayer
    @id_player INT,
    @id_category INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_player)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar existencia de la categoría
    IF NOT EXISTS (SELECT 1 FROM Category_sport WHERE id = @id_category)
    BEGIN
        RAISERROR('La categoría especificada no existe.', 16, 1);
        RETURN;
    END

    -- Validar si ya existe la relación
    IF EXISTS (SELECT 1 FROM Category_players WHERE id_player = @id_player AND id_category = @id_category)
    BEGIN
        RAISERROR('El jugador ya está asignado a esta categoría.', 16, 1);
        RETURN;
    END

    -- Insertar la relación
    INSERT INTO Category_players (id_player, id_category)
    VALUES (@id_player, @id_category);
END;
GO

--Actualizar la categoria de un jugador
CREATE OR ALTER PROCEDURE sp_ActualizarCategoryPlayer
    @id INT,
    @id_player INT,
    @id_category INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del registro en Category_players
    IF NOT EXISTS (SELECT 1 FROM Category_players WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró una relación jugador-categoría con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_player)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar existencia de la categoría
    IF NOT EXISTS (SELECT 1 FROM Category_sport WHERE id = @id_category)
    BEGIN
        RAISERROR('La categoría especificada no existe.', 16, 1);
        RETURN;
    END

    -- Validar si ya existe la relación con los nuevos valores
    IF EXISTS (SELECT 1 FROM Category_players WHERE id_player = @id_player AND id_category = @id_category AND id <> @id)
    BEGIN
        RAISERROR('El jugador ya está asignado a esta categoría con otro registro.', 16, 1);
        RETURN;
    END

    -- Actualizar la relación
    UPDATE Category_players
    SET id_player = @id_player,
        id_category = @id_category
    WHERE id = @id;
END;
GO

--Eliminar el dato de jugador-categoria
CREATE OR ALTER PROCEDURE sp_EliminarCategoryPlayer
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del registro en Category_players
    IF NOT EXISTS (SELECT 1 FROM Category_players WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró una relación jugador-categoría con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el registro
    DELETE FROM Category_players
    WHERE id = @id;
END;
GO

--Trigger de auditoria para tabla category_players
CREATE TRIGGER trg_Auditoria_Category_players
ON Category_players
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_player', COLUMN_VALUE = CAST(id_player AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_category', COLUMN_VALUE = CAST(id_category AS NVARCHAR) FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Category_players', @accion, @registro_afectado);
END;
GO

--
--Insertar un nuevo campo de rubrica
CREATE OR ALTER PROCEDURE sp_InsertarRubricField
    @description NVARCHAR(MAX),
    @max_puntaje INT,
    @nombre NVARCHAR(255),
    @id_sport INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar que el deporte asociado existe
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Insertar el campo de rúbrica
    INSERT INTO Rubric_fields (description, max_puntaje, nombre, id_sport)
    VALUES (@description, @max_puntaje, @nombre, @id_sport);
END;
GO

--Actualizar un nuevo campo de rubrica
CREATE OR ALTER PROCEDURE sp_ActualizarRubricField
    @id INT,
    @description NVARCHAR(MAX),
    @max_puntaje INT,
    @nombre NVARCHAR(255),
    @id_sport INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar que el campo de rúbrica existe
    IF NOT EXISTS (SELECT 1 FROM Rubric_fields WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un campo de rúbrica con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar que el deporte asociado existe
    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id_sport)
    BEGIN
        RAISERROR('El deporte especificado no existe.', 16, 1);
        RETURN;
    END

    -- Actualizar el campo de rúbrica
    UPDATE Rubric_fields
    SET description = @description,
        max_puntaje = @max_puntaje,
        nombre = @nombre,
        id_sport = @id_sport
    WHERE id = @id;
END;
GO

--Eliminar un campo de rubrica
CREATE OR ALTER PROCEDURE sp_EliminarRubricField
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar que el campo de rúbrica existe
    IF NOT EXISTS (SELECT 1 FROM Rubric_fields WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un campo de rúbrica con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el campo de rúbrica
    DELETE FROM Rubric_fields
    WHERE id = @id;
END;
GO

--Trigger de auditoria para tabla de campos de rubrica
CREATE TRIGGER trg_Auditoria_Rubric_fields
ON Rubric_fields
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'description', COLUMN_VALUE = description FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'max_puntaje', COLUMN_VALUE = CAST(max_puntaje AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'nombre', COLUMN_VALUE = nombre FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_sport', COLUMN_VALUE = CAST(id_sport AS NVARCHAR) FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Rubric_fields', @accion, @registro_afectado);
END;
GO

--
--Insertar una puntuacion para un jugador
CREATE OR ALTER PROCEDURE sp_InsertarRubricScorePlayer
    @puntaje INT,
    @id_player INT,
    @id_rubric_field INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_player)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar existencia del campo de rúbrica
    IF NOT EXISTS (SELECT 1 FROM Rubric_fields WHERE id = @id_rubric_field)
    BEGIN
        RAISERROR('El campo de rúbrica especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar el rango del puntaje
    DECLARE @max_puntaje INT;
    SELECT @max_puntaje = max_puntaje FROM Rubric_fields WHERE id = @id_rubric_field;

    IF @puntaje < 0 OR @puntaje > @max_puntaje
    BEGIN
        RAISERROR('El puntaje debe estar entre 0 y el valor máximo del campo de rúbrica.', 16, 1);
        RETURN;
    END

    -- Insertar la puntuación
    INSERT INTO Rubric_Score_player (puntaje, id_player, id_rubric_field)
    VALUES (@puntaje, @id_player, @id_rubric_field);
END;
GO

--Actualizar una puntuacion colocada a un jugador
CREATE OR ALTER PROCEDURE sp_ActualizarRubricScorePlayer
    @id INT,
    @puntaje INT,
    @id_player INT,
    @id_rubric_field INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del registro en Rubric_Score_player
    IF NOT EXISTS (SELECT 1 FROM Rubric_Score_player WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un registro de puntuación con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Validar existencia del jugador
    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_player)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar existencia del campo de rúbrica
    IF NOT EXISTS (SELECT 1 FROM Rubric_fields WHERE id = @id_rubric_field)
    BEGIN
        RAISERROR('El campo de rúbrica especificado no existe.', 16, 1);
        RETURN;
    END

    -- Validar el rango del puntaje
    DECLARE @max_puntaje INT;
    SELECT @max_puntaje = max_puntaje FROM Rubric_fields WHERE id = @id_rubric_field;

    IF @puntaje < 0 OR @puntaje > @max_puntaje
    BEGIN
        RAISERROR('El puntaje debe estar entre 0 y el valor máximo del campo de rúbrica.', 16, 1);
        RETURN;
    END

    -- Actualizar la puntuación
    UPDATE Rubric_Score_player
    SET puntaje = @puntaje,
        id_player = @id_player,
        id_rubric_field = @id_rubric_field
    WHERE id = @id;
END;
GO

--Eliminar una puntuacion
CREATE OR ALTER PROCEDURE sp_EliminarRubricScorePlayer
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Validar existencia del registro en Rubric_Score_player
    IF NOT EXISTS (SELECT 1 FROM Rubric_Score_player WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un registro de puntuación con el ID especificado.', 16, 1);
        RETURN;
    END

    -- Eliminar el registro
    DELETE FROM Rubric_Score_player
    WHERE id = @id;
END;
GO

--Trigger de auditoria para tabla de puntajes a jugadores
CREATE TRIGGER trg_Auditoria_Rubric_Score_player
ON Rubric_Score_player
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion NVARCHAR(10);
    DECLARE @registro_afectado NVARCHAR(MAX);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    -- Construir un detalle del registro afectado
    SET @registro_afectado = (
        SELECT STRING_AGG(CONCAT(COLUMN_NAME, ': ', COLUMN_VALUE), ', ')
        FROM (
            SELECT COLUMN_NAME = COLUMN_NAME, COLUMN_VALUE = CONVERT(NVARCHAR(MAX), COLUMN_VALUE)
            FROM (
                SELECT COLUMN_NAME = 'id', COLUMN_VALUE = CAST(id AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'puntaje', COLUMN_VALUE = CAST(puntaje AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_player', COLUMN_VALUE = CAST(id_player AS NVARCHAR) FROM inserted
                UNION ALL
                SELECT COLUMN_NAME = 'id_rubric_field', COLUMN_VALUE = CAST(id_rubric_field AS NVARCHAR) FROM inserted
            ) AS Changes
        ) AS Details
    );

    -- Insertar en la tabla de auditoría general
    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion, registro_afectado)
    VALUES (SYSTEM_USER, 'Rubric_Score_player', @accion, @registro_afectado);
END;
GO

--
--Insertar nueva observacion a un jugador
CREATE OR ALTER PROCEDURE sp_InsertarObservacionJugador
    @id_atleta INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_atleta)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    INSERT INTO Observaciones_Jugador (id_atleta, observacion)
    VALUES (@id_atleta, @observacion);
END;
GO

--Actualizar una nueva observacion a un jugador
CREATE OR ALTER PROCEDURE sp_ActualizarObservacionJugador
    @id INT,
    @id_atleta INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Observaciones_Jugador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró la observación con ese ID.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id_atleta)
    BEGIN
        RAISERROR('El jugador especificado no existe.', 16, 1);
        RETURN;
    END

    UPDATE Observaciones_Jugador
    SET id_atleta = @id_atleta,
        observacion = @observacion
    WHERE id = @id;
END;
GO

--Eliminar una observacion a un jugador
CREATE OR ALTER PROCEDURE sp_EliminarObservacionJugador
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Observaciones_Jugador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró la observación con ese ID.', 16, 1);
        RETURN;
    END

    DELETE FROM Observaciones_Jugador
    WHERE id = @id;
END;
GO

--Obtener todas las observaciones de los jugadores
CREATE OR ALTER PROCEDURE sp_ObtenerObservacionesJugador
AS
BEGIN
    SET NOCOUNT ON;
    SELECT * FROM Observaciones_Jugador;
END;
GO

--Trigger de auditoria para tabla de observaciones a jugador
CREATE TRIGGER trg_Auditoria_ObservacionesJugador
ON Observaciones_Jugador
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion VARCHAR(10);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion)
    VALUES (SYSTEM_USER, 'Observaciones_Jugador', @accion);
END;
GO

--
--Insertar nueva observacion a entrenador
CREATE OR ALTER PROCEDURE sp_InsertarObservacionEntrenador
    @id_admin INT,
    @id_entrenador INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id_admin)
    BEGIN
        RAISERROR('El administrador especificado no existe.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Entrenador WHERE id = @id_entrenador)
    BEGIN
        RAISERROR('El entrenador especificado no existe.', 16, 1);
        RETURN;
    END

    INSERT INTO Observaciones_Entrenador (id_admin, id_entrenador, observacion)
    VALUES (@id_admin, @id_entrenador, @observacion);
END;
GO

--Actualizar observacion a entrenador
CREATE OR ALTER PROCEDURE sp_ActualizarObservacionEntrenador
    @id INT,
    @id_admin INT,
    @id_entrenador INT,
    @observacion NVARCHAR(MAX)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Observaciones_Entrenador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró la observación con ese ID.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id_admin)
    BEGIN
        RAISERROR('El administrador especificado no existe.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Entrenador WHERE id = @id_entrenador)
    BEGIN
        RAISERROR('El entrenador especificado no existe.', 16, 1);
        RETURN;
    END

    UPDATE Observaciones_Entrenador
    SET id_admin = @id_admin,
        id_entrenador = @id_entrenador,
        observacion = @observacion
    WHERE id = @id;
END;
GO

--Eliminar observacion a entrenador
CREATE OR ALTER PROCEDURE sp_EliminarObservacionEntrenador
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Observaciones_Entrenador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró la observación con ese ID.', 16, 1);
        RETURN;
    END

    DELETE FROM Observaciones_Entrenador
    WHERE id = @id;
END;
GO

--Obtener observaicones de entrenador
CREATE OR ALTER PROCEDURE sp_ObtenerObservacionesEntrenador
AS
BEGIN
    SET NOCOUNT ON;
    SELECT * FROM Observaciones_Entrenador;
END;
GO

--Trigger de auditoria para tabla de observaciones a entrenador
CREATE TRIGGER trg_Auditoria_ObservacionesEntrenador
ON Observaciones_Entrenador
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    SET NOCOUNT ON;

    DECLARE @accion VARCHAR(10);

    IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted)
        SET @accion = 'UPDATE';
    ELSE IF EXISTS (SELECT * FROM inserted)
        SET @accion = 'INSERT';
    ELSE IF EXISTS (SELECT * FROM deleted)
        SET @accion = 'DELETE';

    INSERT INTO Bitacora_Auditoria (usuario, tabla_afectada, tipo_operacion)
    VALUES (SYSTEM_USER, 'Observaciones_Entrenador', @accion);
END;

INSERT INTO Entrenador (
    email, 
    contraseña, 
    nombres, 
    fechaNacimiento, 
    id_sport, 
    descripcion, 
    cloudinary_id, 
    url
)
VALUES (
    'juanperez@example.com', 
    'hashed_password_aqui', 
    'Juan Pérez', 
    '1990-06-15', 
    1, 
    'Entrenador con experiencia en fútbol juvenil.', 
    'cloudinary12345', 
    'https://res.cloudinary.com/demo/image/upload/v123456/juan.jpg'
);

INSERT INTO DeporDeporte(
    email, 
    contraseña, 
    nombres, 
    fechaNacimiento, 
    id_sport, 
    descripcion, 
    cloudinary_id, 
    url
)
VALUES (
    'juanperez@example.com', 
    'hashed_password_aqui', 
    'Juan Pérez', 
    '1990-06-15', 
    1, 
    'Entrenador con experiencia en fútbol juvenil.', 
    'cloudinary12345', 
    'https://res.cloudinary.com/demo/image/upload/v123456/juan.jpg'
);

