use prodraftdb;
GO

CREATE TABLE Bitacora_Auditoria (
    id INT IDENTITY(1,1) PRIMARY KEY,
    usuario VARCHAR(255),
    fecha DATETIME DEFAULT GETDATE(),
    tabla_afectada VARCHAR(100),
    tipo_operacion VARCHAR(10)
);
GO

/*
Procedimientos almacenados para cada una de las tablas
*/

--Insertar un nuevo deporte
CREATE PROCEDURE sp_InsertarDeporte
    @nombre NVARCHAR(255),
    @cloudinary_id NVARCHAR(255) = '',
    @url NVARCHAR(255) = ''
AS
BEGIN
    SET NOCOUNT ON;

    IF EXISTS (SELECT 1 FROM Deporte WHERE nombre = @nombre)
    BEGIN
        RAISERROR('Ya existe un deporte con ese nombre.', 16, 1);
        RETURN;
    END

    INSERT INTO Deporte (nombre, cloudinary_id, url)
    VALUES (@nombre, @cloudinary_id, @url);
END;
GO

--Consultar deportes
CREATE PROCEDURE sp_ObtenerDeportes
AS
BEGIN
    SELECT * FROM Deporte;
END;
GO

--Actualizar deportes
CREATE PROCEDURE sp_ActualizarDeporte
    @id INT,
    @nombre NVARCHAR(255),
    @cloudinary_id NVARCHAR(255),
    @url NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Deporte WHERE id = @id)
    BEGIN
        RAISERROR('El deporte con el ID especificado no existe.', 16, 1);
        RETURN;
    END

    IF EXISTS (SELECT 1 FROM Deporte WHERE nombre = @nombre AND id <> @id)
    BEGIN
        RAISERROR('Ya existe otro deporte con ese nombre.', 16, 1);
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
CREATE PROCEDURE sp_EliminarDeporte
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

--Trigger de auditoria para tabla deporte
CREATE TRIGGER trg_Auditoria_Deporte
ON Deporte
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
    VALUES (SYSTEM_USER, 'Deporte', @accion);
END;
GO

--Insertar nuevo admin
CREATE PROCEDURE sp_InsertarAdmin
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    IF EXISTS (SELECT 1 FROM Admin WHERE email = @email)
    BEGIN
        RAISERROR('El correo ya está registrado.', 16, 1);
        RETURN;
    END

    IF EXISTS (SELECT 1 FROM Admin WHERE contraseña = @contraseña)
    BEGIN
        RAISERROR('La contraseña ya está en uso (debe ser única).', 16, 1);
        RETURN;
    END

    INSERT INTO Admin (nombre, apellidos, email, contraseña)
    VALUES (@nombre, @apellidos, @email, @contraseña);
END;
GO

--Actualizar admin
CREATE PROCEDURE sp_ActualizarAdmin
    @id INT,
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id)
    BEGIN
        RAISERROR('El administrador con ese ID no existe.', 16, 1);
        RETURN;
    END

    IF EXISTS (SELECT 1 FROM Admin WHERE email = @email AND id <> @id)
    BEGIN
        RAISERROR('Otro administrador ya usa este correo.', 16, 1);
        RETURN;
    END

    IF EXISTS (SELECT 1 FROM Admin WHERE contraseña = @contraseña AND id <> @id)
    BEGIN
        RAISERROR('La contraseña ya está siendo usada por otro administrador.', 16, 1);
        RETURN;
    END

    UPDATE Admin
    SET nombre = @nombre,
        apellidos = @apellidos,
        email = @email,
        contraseña = @contraseña
    WHERE id = @id;
END;
GO

--Eliminar admin
CREATE PROCEDURE sp_EliminarAdmin
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Admin WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un administrador con ese ID.', 16, 1);
        RETURN;
    END

    DELETE FROM Admin
    WHERE id = @id;
END;
GO

--Obtener admins
CREATE PROCEDURE sp_ObtenerAdmins
AS
BEGIN
    SELECT * FROM Admin;
END;
GO


--Trigger de auditoria para tabla admin
CREATE TRIGGER trg_Auditoria_Admin
ON Admin
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
    VALUES (SYSTEM_USER, 'Admin', @accion);
END;
GO

--Insertar nuevo jugador
CREATE PROCEDURE sp_InsertarJugador
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @sexo CHAR(1),
    @fecha_nacimiento DATE,
    @dui NVARCHAR(10),
    @email NVARCHAR(255),
    @telefono NVARCHAR(10),
    @direccion NVARCHAR(255),
    @id_categoria INT,
    @cloudinary_id NVARCHAR(255) = '',
    @url NVARCHAR(255) = ''
AS
BEGIN
    SET NOCOUNT ON;

    IF EXISTS (SELECT 1 FROM Jugador WHERE dui = @dui)
    BEGIN
        RAISERROR('Ya existe un jugador con ese DUI.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Category_players WHERE id = @id_categoria)
    BEGIN
        RAISERROR('La categoría seleccionada no existe.', 16, 1);
        RETURN;
    END

    INSERT INTO Jugador (nombre, apellidos, sexo, fecha_nacimiento, dui, email, telefono, direccion, id_categoria, cloudinary_id, url)
    VALUES (@nombre, @apellidos, @sexo, @fecha_nacimiento, @dui, @email, @telefono, @direccion, @id_categoria, @cloudinary_id, @url);
END;
GO

--Actualizar jugador
CREATE PROCEDURE sp_ActualizarJugador
    @id INT,
    @nombre NVARCHAR(255),
    @apellidos NVARCHAR(255),
    @sexo CHAR(1),
    @fecha_nacimiento DATE,
    @dui NVARCHAR(10),
    @email NVARCHAR(255),
    @telefono NVARCHAR(10),
    @direccion NVARCHAR(255),
    @id_categoria INT,
    @cloudinary_id NVARCHAR(255),
    @url NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id)
    BEGIN
        RAISERROR('El jugador con ese ID no existe.', 16, 1);
        RETURN;
    END

    IF EXISTS (SELECT 1 FROM Jugador WHERE dui = @dui AND id <> @id)
    BEGIN
        RAISERROR('Ya existe otro jugador con ese DUI.', 16, 1);
        RETURN;
    END

    IF NOT EXISTS (SELECT 1 FROM Category_players WHERE id = @id_categoria)
    BEGIN
        RAISERROR('La categoría seleccionada no existe.', 16, 1);
        RETURN;
    END

    UPDATE Jugador
    SET nombre = @nombre,
        apellidos = @apellidos,
        sexo = @sexo,
        fecha_nacimiento = @fecha_nacimiento,
        dui = @dui,
        email = @email,
        telefono = @telefono,
        direccion = @direccion,
        id_categoria = @id_categoria,
        cloudinary_id = @cloudinary_id,
        url = @url
    WHERE id = @id;
END;
GO

--Eliminar jugador
CREATE PROCEDURE sp_EliminarJugador
    @id INT
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM Jugador WHERE id = @id)
    BEGIN
        RAISERROR('No se encontró un jugador con ese ID.', 16, 1);
        RETURN;
    END

    DELETE FROM Jugador
    WHERE id = @id;
END;
GO

--Obtener jugadores
CREATE PROCEDURE sp_ObtenerJugadores
AS
BEGIN
    SELECT * FROM Jugador;
END;







