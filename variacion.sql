-- Creación de la base de datos
USE [master]
GO
CREATE DATABASE [prodraftdb]
GO

-- Usar la base de datos creada
USE [prodraftdb]
GO

-- Tabla Deporte
CREATE TABLE [dbo].[Deporte](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [nombre] [nvarchar](255) NOT NULL,
    [cloudinary_id] [nvarchar](255) DEFAULT '',
    [url] [nvarchar](255) DEFAULT ''
)
GO

-- Tabla Admin
CREATE TABLE [dbo].[Admin](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [nombre] [nvarchar](255) NOT NULL,
    [apellidos] [nvarchar](255) NOT NULL,
    [email] [nvarchar](255) UNIQUE NOT NULL,
    [contraseña] [nvarchar](255) UNIQUE NOT NULL
)
GO

-- Tabla Jugador
CREATE TABLE [dbo].[Jugador](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [email] [nvarchar](255) UNIQUE NOT NULL,
    [contraseña] [nvarchar](255) UNIQUE NOT NULL,
    [nombres] [nvarchar](255) NOT NULL,
    [apellidos] [nvarchar](255) NOT NULL,
    [fechaNacimiento] [date] NOT NULL,
    [codigo] [int] UNIQUE NOT NULL,
    [grado] [nvarchar](50) NOT NULL,
    [seccion] [nvarchar](50) NOT NULL,
    [createdAt] [datetime] DEFAULT GETDATE(),
    [status_img_academic] [nvarchar](255),
    [status_img_conduct] [nvarchar](255),
    [status_sport] [nvarchar](255)
)
GO

-- Tabla Entrenador
CREATE TABLE [dbo].[Entrenador](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [email] [nvarchar](255) UNIQUE NOT NULL,
    [contraseña] [nvarchar](255) UNIQUE NOT NULL,
    [nombres] [nvarchar](255) NOT NULL,
    [fechaNacimiento] [date] NOT NULL,
    [id_sport] [int] NOT NULL FOREIGN KEY REFERENCES Deporte(id),
    [descripcion] [nvarchar](max) DEFAULT '',
    [cloudinary_id] [nvarchar](255) DEFAULT '',
    [url] [nvarchar](255) DEFAULT ''
)
GO

-- Tabla Category_sport
CREATE TABLE [dbo].[Category_sport](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [id_sport] [int] NOT NULL FOREIGN KEY REFERENCES Deporte(id),
    [img] [nvarchar](255) NOT NULL,
    [nombre] [nvarchar](255) NOT NULL,
    [reglas] [nvarchar](max) NOT NULL
)
GO

-- Tabla Category_players
CREATE TABLE [dbo].[Category_players](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [id_player] [int] NOT NULL FOREIGN KEY REFERENCES Jugador(id),
    [id_category] [int] NOT NULL FOREIGN KEY REFERENCES Category_sport(id)
)
GO

-- Tabla Rubric_fields
CREATE TABLE [dbo].[Rubric_fields](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [description] [nvarchar](max) NOT NULL,
    [max_puntaje] [int] NOT NULL,
    [nombre] [nvarchar](255) NOT NULL,
    [id_sport] [int] NOT NULL FOREIGN KEY REFERENCES Deporte(id)
)
GO

-- Tabla Rubric_Score_player
CREATE TABLE [dbo].[Rubric_Score_player](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [puntaje] [int] NOT NULL,
    [id_player] [int] NOT NULL FOREIGN KEY REFERENCES Jugador(id),
    [id_rubric_field] [int] NOT NULL FOREIGN KEY REFERENCES Rubric_fields(id)
)
GO

-- Tabla Observaciones_Jugador
CREATE TABLE [dbo].[Observaciones_Jugador](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [id_atleta] [int] NOT NULL FOREIGN KEY REFERENCES Jugador(id),
    [observacion] [nvarchar](max) NOT NULL
)
GO

-- Tabla Observaciones_Entrenador
CREATE TABLE [dbo].[Observaciones_Entrenador](
    [id] [int] IDENTITY(1,1) PRIMARY KEY,
    [id_admin] [int] NOT NULL FOREIGN KEY REFERENCES Admin(id),
    [id_entrenador] [int] NOT NULL FOREIGN KEY REFERENCES Entrenador(id),
    [observacion] [nvarchar](max) NOT NULL
)
GO


-- Relación entre Entrenador y Deporte
ALTER TABLE [dbo].[Entrenador] 
ADD CONSTRAINT [FK_Entrenador_Deporte] 
FOREIGN KEY([id_sport]) REFERENCES [dbo].[Deporte] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Category_sport y Deporte
ALTER TABLE [dbo].[Category_sport] 
ADD CONSTRAINT [FK_Category_sport_Deporte] 
FOREIGN KEY([id_sport]) REFERENCES [dbo].[Deporte] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Category_players y Jugador
ALTER TABLE [dbo].[Category_players] 
ADD CONSTRAINT [FK_Category_players_Jugador] 
FOREIGN KEY([id_player]) REFERENCES [dbo].[Jugador] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Category_players y Category_sport
ALTER TABLE [dbo].[Category_players] 
ADD CONSTRAINT [FK_Category_players_Category_sport] 
FOREIGN KEY([id_category]) REFERENCES [dbo].[Category_sport] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Rubric_fields y Deporte
ALTER TABLE [dbo].[Rubric_fields] 
ADD CONSTRAINT [FK_Rubric_fields_Deporte] 
FOREIGN KEY([id_sport]) REFERENCES [dbo].[Deporte] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Rubric_Score_player y Jugador
ALTER TABLE [dbo].[Rubric_Score_player] 
ADD CONSTRAINT [FK_Rubric_Score_player_Jugador] 
FOREIGN KEY([id_player]) REFERENCES [dbo].[Jugador] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Rubric_Score_player y Rubric_fields
ALTER TABLE [dbo].[Rubric_Score_player] 
ADD CONSTRAINT [FK_Rubric_Score_player_Rubric_fields] 
FOREIGN KEY([id_rubric_field]) REFERENCES [dbo].[Rubric_fields] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Observaciones_Jugador y Jugador
ALTER TABLE [dbo].[Observaciones_Jugador] 
ADD CONSTRAINT [FK_Observaciones_Jugador_Jugador] 
FOREIGN KEY([id_atleta]) REFERENCES [dbo].[Jugador] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Observaciones_Entrenador y Admin
ALTER TABLE [dbo].[Observaciones_Entrenador] 
ADD CONSTRAINT [FK_Observaciones_Entrenador_Admin] 
FOREIGN KEY([id_admin]) REFERENCES [dbo].[Admin] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO

-- Relación entre Observaciones_Entrenador y Entrenador
ALTER TABLE [dbo].[Observaciones_Entrenador] 
ADD CONSTRAINT [FK_Observaciones_Entrenador_Entrenador] 
FOREIGN KEY([id_entrenador]) REFERENCES [dbo].[Entrenador] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE;
GO