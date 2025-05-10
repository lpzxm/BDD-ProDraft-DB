CREATE OR ALTER PROCEDURE [dbo].[Admin_Login]
    @email NVARCHAR(255),
    @contraseña NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;
    
    BEGIN TRY
        SELECT 
            [id],
            [nombre],
            [apellidos],
            [email]
        FROM [dbo].[Admin]
        WHERE [email] = @email AND [contraseña] = @contraseña;
        
        IF @@ROWCOUNT = 0
            RAISERROR('Credenciales incorrectas', 16, 1);
    END TRY
    BEGIN CATCH
        THROW;
    END CATCH
END
GO