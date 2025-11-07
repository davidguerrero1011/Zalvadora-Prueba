# Zalvaldora - Sistema de Gestión MVC

Aplicación web desarrollada con CodeIgniter 2 que implementa un sistema completo de gestión con autenticación por sesión y CRUD de Usuarios, Productos y Categorías.

## Características

- **Autenticación por sesión** con login/logout
- **Gestión de usuarios** (solo admin) con roles admin/user
- **Gestión de categorías** (solo admin)
- **Gestión de productos** con búsqueda, paginación y ordenamiento
- **Interfaz responsive** con Bootstrap 5
- **Seguridad**: CSRF protection, XSS filtering, validaciones
- **Base de datos MySQL** con Active Record

## Requisitos del Sistema

- PHP 5.3+
- MySQL 5.0+
- Apache con mod_rewrite
- Laragon, XAMPP o servidor web similar

## Instalación

### 1. Descargar el proyecto
```bash
https://github.com/bcit-ci/CodeIgniter/archive/refs/tags/2.2.6.zip
# o descargar y extraer el ZIP
```

### 2. Configurar la base de datos
1. Se puede crear una base de datos MySQL llamada `zalvaldora_db`
2. Se puede Importar el archivo `database.sql` en la base de datos:
3. Se puede ejecutar en consola el archivo `database.sql con: mysql -u root < database.sql
```sql
```

### 3. Configurar la aplicación
1. Editar `application/config/database.php` si es necesario:
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'zalvaldora_db';
```

2. Verificar la URL base en `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/Zalvaldora-Prueba/';
```

### 4. Configurar el servidor web
- Asegurar que mod_rewrite esté habilitado
- El archivo `.htaccess` ya está configurado para URLs amigables

## Uso

### Acceso al sistema
1. Navegar a: `http://localhost/Zalvaldora-Prueba/`
2. Usar las credenciales por defecto:
   - **Email**: admin@zalvaldora.com
   - **Contraseña**: password

### Funcionalidades principales

#### Autenticación
- Login con email/contraseña
- Logout que destruye la sesión
- Protección de rutas administrativas

#### Gestión de Usuarios (Solo Admin)
- Crear, editar, eliminar usuarios
- Asignar roles (admin/user)
- Validación de email único
- Hash seguro de contraseñas

#### Gestión de Categorías (Solo Admin)
- CRUD completo de categorías
- Validación de nombres únicos
- Protección contra eliminación si tiene productos asociados

#### Gestión de Productos
- CRUD completo de productos
- Búsqueda por nombre/SKU
- Paginación de resultados
- Ordenamiento por diferentes campos
- Validación de SKU único
- Relación con categorías

## Estructura del Proyecto

```
Zalvaldora-Prueba/
├── application/
│   ├── controllers/
│   │   ├── auth.php          # Autenticación
│   │   ├── admin.php         # Dashboard y usuarios
│   │   ├── categories.php    # Gestión de categorías
│   │   └── products.php      # Gestión de productos
│   ├── models/
│   │   ├── user_model.php
│   │   ├── category_model.php
│   │   └── product_model.php
│   ├── views/
│   │   ├── layout/           # Header y footer
│   │   ├── auth/             # Vistas de login
│   │   └── admin/            # Vistas administrativas
│   ├── core/
│   │   └── MY_Controller.php # Controlador base
│   └── config/               # Configuraciones
├── system/                   # Framework CodeIgniter
├── database.sql              # Script de base de datos
├── .htaccess                 # Configuración Apache
└── README.md
```

## Seguridad Implementada

- **CSRF Protection**: Habilitado en formularios
- **XSS Filtering**: Filtrado automático de entrada
- **Password Hashing**: Uso de password_hash/password_verify
- **Validación de sesiones**: Verificación en rutas protegidas
- **Validación de roles**: Control de acceso por rol de usuario
- **Sanitización**: Escape de datos en vistas

## Tecnologías Utilizadas

- **Backend**: CodeIgniter 2.2.6
- **Base de datos**: MySQL con Active Record
- **Frontend**: Bootstrap 5, Font Awesome
- **Seguridad**: CSRF, XSS Protection, Session Management

## Credenciales por Defecto

- **Administrador**:
  - Email: admin@zalvaldora.com
  - Contraseña: password

## Notas Importantes

- Esto es una prueba tecnica por tal razon se usa esta versión, CodeIgniter 2 que es una versión legacy, se recomienda migrar a versiones más recientes para proyectos en producción
- La aplicación incluye datos de ejemplo para facilitar las pruebas
- Todas las contraseñas están hasheadas con password_hash()
- Las sesiones se almacenan en base de datos para mayor seguridad
