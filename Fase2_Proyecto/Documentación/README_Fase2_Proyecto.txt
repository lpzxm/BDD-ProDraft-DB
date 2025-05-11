
# Fase2_Proyecto

## Descripción
Este repositorio contiene la Fase 2 del proyecto de Base de Datos para la Universidad Don Bosco, Escuela de Computación. Incluye:

- Scripts SQL para creación de tablas y relaciones.
- Datos de prueba.
- Procedimientos almacenados CRUD con validaciones completas.
- Procedimientos de negocio con lógica avanzada (`CASE`, `CTE`, `WHILE`).
- Triggers de trazabilidad para todas las tablas clave.
- Documentación interna de cada script.

---

## Estructura de carpetas

```
Fase2_Proyecto/
├── Bitacora/
│   └── Bitacora.sql
│   └── Datos_prueba.sql
├── Diagramas/
│   ├── Documentation/
│   │   ├── README_Fase2_Proyecto.txt
│   │   └── Código/
│   │       ├── AnotacionesInternas_Fase2_Proyecto.txt
│   │       └── CasosPrueba_Fase2_Proyecto.txt
│   └── ProcedimientosNegocio/
│       ├── actualizarEstadoDeporte.sql
│       └── marcarRevision.sql
├── Scripts_SQL/
│   ├── ProcedimientosCRUD/
│   │   ├── SP_CreateJugador.sql
│   │   ├── SP_DeleteJugador.sql
│   │   ├── SP_ReadJugador.sql
│   │   └── SP_UpdateJugador.sql
│   └── Triggers/
│       ├── TGR_TEST.sql
│       ├── TRG_Bitacora_Delete_Admin.sql
│       ├── TRG_Bitacora_Delete_Entrencador.sql
│       ├── TRG_Bitacora_Delete_Jugador.sql
│       ├── TRG_Bitacora_Insert_Admin.sql
│       ├── TRG_Bitacora_Insert_Entrencador.sql
│       ├── TRG_Bitacora_Insert_Jugador.sql
│       └── TRG_Bitacora_Update_Admin.sql
└── README.md

---

## Guía de ejecución

1. **Crear la base de datos y tablas**:
   ```sql
   USE master;
   GO
   CREATE DATABASE prodraftdb;
   USE prodraftdb;
   GO
   :r 02_Scripts_SQL/01_Tablas.sql
   ```
2. **Cargar datos de prueba**:
   ```sql
   :r 02_Scripts_SQL/02_DatosPrueba.sql
   ```
3. **Crear tabla de bitácora**:
   ```sql
   :r 02_Scripts_SQL/06_Bitacora.sql
   ```
4. **Crear triggers**:
   ```sql
   :r 02_Scripts_SQL/05_Triggers/*.sql
   ```
5. **Procedimientos CRUD**:
   ```sql
   :r 02_Scripts_SQL/03_ProcedimientosCRUD/*.sql
   ```
6. **Procedimientos de negocio**:
   ```sql
   :r 02_Scripts_SQL/04_ProcedimientosNegocio/*.sql
   ```
7. **Pruebas**:
   - Ejecutar ejemplos en `CasosPrueba.md`.
   - Verificar `dbo.Bitacora` para trazabilidad.

---

## Casos de prueba
Consulta `00_Documentación/CasosPrueba.md` para flujos normales y excepciones.

---

## Responsables
- Equipo DB (Revisión de modelos y scripts)
