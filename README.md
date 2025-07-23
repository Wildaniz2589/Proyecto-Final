# 🌿 Proyecto Final: Sistema de Gestión de Vivero

Este proyecto es un sistema web desarrollado como parte del curso de **Programación Web Avanzada**, que permite gestionar la venta y administración de plantas en un vivero.

## 📁 Contenido del proyecto

- `views/`: Vistas del sistema (listar plantas, usuarios, ventas, etc.)
- `controllers/`: Lógica del servidor (agregar, editar, eliminar)
- `config/db.php`: Conexión a la base de datos MySQL
- `assets/`: Archivos estáticos (CSS y JS)
- `vivero.sql`: Script de la base de datos con tablas y datos
- `index.php`: Página principal del sistema

## 👥 Roles de usuario

El sistema cuenta con tres tipos de usuarios:

- **Administrador**: Accede a todas las funciones (CRUD completo en todas las secciones).
- **Encargado**: Puede visualizar, agregar, editar y eliminar plantas.
- **Vendedor**: Solo puede visualizar las plantas y registrar ventas.

## 📦 Funcionalidades

✅ Registro de usuarios  
✅ Gestión de roles  
✅ Registro y venta de plantas  
✅ Control de acceso según rol  
✅ Base de datos estructurada con claves foráneas  

## 🛠️ Tecnologías utilizadas

- PHP 8+
- MySQL / HeidiSQL
- HTML5, CSS3 y JavaScript
- Laragon (entorno local)

## ⚙️ Instalación

1. Clonar o descargar este repositorio.
2. Importar el archivo `vivero.sql` en tu gestor MySQL (HeidiSQL, phpMyAdmin, etc.).
3. Asegúrate de que tu servidor local esté configurado (por ejemplo, con **Laragon**).
4. Abrir `index.php` desde `http://localhost/proyecto_final`.



## 👨‍💻 Autor

Desarrollado por **[Wilmer Zuñiga]**  
Estudiante de **Programación Web Avanzada**
