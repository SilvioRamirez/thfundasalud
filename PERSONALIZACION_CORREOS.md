# Personalización del Sistema de Correos - FUNDASALUD Trujillo

## Resumen de Cambios Realizados

### 1. **Notificación Personalizada**
- ✅ Creada: `app/Notifications/CustomResetPasswordNotification.php`
- Personaliza el mensaje de recuperación de contraseña con:
  - Saludo personalizado con el nombre del usuario
  - Emojis para mayor claridad visual
  - Información sobre expiración del enlace
  - Mensaje de seguridad

### 2. **Modelo User Actualizado**
- ✅ Modificado: `app/Models/User.php`
- Agregado método `sendPasswordResetNotification()` para usar la notificación personalizada

### 3. **Plantillas de Correo Personalizadas**
- ✅ Publicadas plantillas base de Laravel
- ✅ Personalizado CSS: `resources/views/vendor/mail/html/themes/default.css`
  - Colores actualizados:
    - **Rojo**: #dc2626 (branding/header)
    - **Verde**: #16a34a (botones principales)
    - **Grises modernos**: Para textos y fondos
  - Bordes redondeados (12px)
  - Sombras elegantes
  - Gradientes en botones

- ✅ Personalizado header: `resources/views/vendor/mail/html/header.blade.php`
  - Logo de FUNDASALUD en el encabezado
  - Fondo con gradiente rojo

### 4. **Características del Diseño**

#### Colores Principales:
- **Header**: Gradiente rojo (#dc2626 → #ef4444 → #f87171)
- **Botón Principal**: Gradiente verde (#16a34a → #22c55e)
- **Botón Error**: Gradiente rojo (#dc2626 → #ef4444)
- **Fondo**: #f9fafb
- **Texto**: #374151
- **Enlaces**: #16a34a

#### Tipografía:
- Fuente: Segoe UI, Tahoma, Geneva, Verdana, sans-serif
- Tamaños: 24px (h1), 15px (párrafos)
- Line-height: 1.6

#### Elementos Visuales:
- Border-radius: 12px
- Box-shadow en tarjetas
- Botones con sombra y gradiente
- Paneles con borde verde a la izquierda

## Cómo Probar

### Método 1: Probar desde la aplicación
1. Ve a la página de login
2. Haz clic en "¿Olvidaste tu contraseña?"
3. Ingresa tu correo electrónico
4. Revisa tu bandeja de entrada

### Método 2: Probar con Tinker
```bash
php artisan tinker

# Enviar correo de prueba
$user = App\Models\User::first();
$token = Password::createToken($user);
$user->sendPasswordResetNotification($token);
```

### Método 3: Ver en el log (si MAIL_MAILER=log)
```bash
# El correo se guardará en:
tail -f storage/logs/laravel.log
```

## Configuración de Correo

### Variables de entorno (.env):
```env
MAIL_MAILER=smtp  # o 'log' para desarrollo
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-correo@gmail.com
MAIL_PASSWORD=tu-contraseña-de-aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@fundasalud.com
MAIL_FROM_NAME="FUNDASALUD Trujillo"
```

### Para Gmail:
1. Activa la verificación en 2 pasos
2. Genera una "Contraseña de aplicación"
3. Usa esa contraseña en MAIL_PASSWORD

## Estructura de Archivos

```
app/
├── Models/
│   └── User.php (modificado)
└── Notifications/
    └── CustomResetPasswordNotification.php (nuevo)

resources/views/
├── vendor/
│   ├── mail/
│   │   └── html/
│   │       ├── themes/
│   │       │   └── default.css (personalizado)
│   │       ├── header.blade.php (personalizado)
│   │       ├── footer.blade.php
│   │       ├── button.blade.php
│   │       └── layout.blade.php
│   └── notifications/
│       └── email.blade.php
└── auth/
    └── passwords/
        ├── email.blade.php (personalizado)
        ├── reset.blade.php (personalizado)
        └── confirm.blade.php (personalizado)
```

## Vista Previa del Correo

El correo incluye:
- 📧 Header con logo de FUNDASALUD en fondo rojo gradiente
- 👋 Saludo personalizado: "¡Hola [Nombre]!"
- 📝 Mensaje explicativo claro
- 🔑 Botón verde grande: "Restablecer Contraseña"
- ⏱️ Información sobre expiración (60 minutos)
- 🔒 Mensaje de seguridad
- 📱 Footer con información de la institución

## Personalización Adicional

Si deseas personalizar más:

### Cambiar textos:
Edita: `app/Notifications/CustomResetPasswordNotification.php`

### Cambiar colores:
Edita: `resources/views/vendor/mail/html/themes/default.css`

### Cambiar logo:
1. Reemplaza: `public/storage/img/fundasalud.png`
2. O edita: `resources/views/vendor/mail/html/header.blade.php`

### Agregar más información al footer:
Edita: `resources/views/vendor/mail/html/footer.blade.php`

## Comandos Útiles

```bash
# Limpiar caché de vistas
php artisan view:clear

# Limpiar caché de configuración
php artisan config:clear

# Probar envío de correo
php artisan tinker

# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

## Notas Importantes

1. ✅ Los correos usan el mismo diseño que las páginas de login
2. ✅ Compatible con clientes de correo modernos
3. ✅ Responsive y optimizado para móviles
4. ✅ Emojis para mejor experiencia visual
5. ✅ Mensajes de seguridad claros

## Soporte

Para más personalizaciones, consulta:
- [Documentación de Laravel Mail](https://laravel.com/docs/mail)
- [Documentación de Laravel Notifications](https://laravel.com/docs/notifications)
