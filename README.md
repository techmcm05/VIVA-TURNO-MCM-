# VIVA TURNOS

Sistema de gestión de turnos por localidad, desarrollado en PHP y MySQL.

## Configuración segura

1. Copia `.env.example` como `.env`.
2. Sustituye todos los valores `YOUR_...` por la configuración real de tu entorno.
3. No publiques `.env` ni `config/config.local.php`.

Para servidores sin variables de entorno puedes copiar `config/config.local.php.example` como `config/config.local.php` y completar sus valores.

## Docker

Requisitos: Docker Desktop y Docker Compose.

```bash
cp .env.example .env
docker compose up -d --build
```

La aplicación estará disponible en `http://localhost:8080`.

La base de datos utiliza el volumen persistente `viva_db_data` para conservar la información entre reinicios del contenedor.

## Instalación inicial

`install.php` requiere `INITIAL_USER_PASSWORD` para crear los usuarios iniciales. No existe una contraseña predeterminada dentro del código fuente.

## Seguridad para GitHub

Antes del primer push revisa que `.env`, `config/config.local.php`, claves privadas y la carpeta `secrets/` no estén incluidos. Si una credencial fue utilizada anteriormente en este proyecto, debe rotarse aunque ya haya sido eliminada del código actual.
