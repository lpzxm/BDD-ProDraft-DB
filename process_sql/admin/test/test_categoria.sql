EXEC [dbo].[Admin_CreateCategoria]
    @admin_email = 'admin@prodraft.com',
    @deporte_nombre = 'Fútbol',
    @categoria_nombre = 'Sub-15';
-- Debe retornar el ID de la nueva categoría

EXEC [dbo].[Admin_CreateCategoria]
    @admin_email = 'admin@prodraft.com',
    @deporte_nombre = 'Fútbol',
    @categoria_nombre = 'S'; -- Nombre muy corto
-- Debe fallar con "Nombre de categoría muy corto"

EXEC [dbo].[Admin_CreateCategoria]
    @admin_email = 'admin@prodraft.com',
    @deporte_nombre = 'DeporteInexistente',
    @categoria_nombre = 'Prueba';
-- Debe fallar con "Deporte no encontrado"

