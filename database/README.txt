La instalación se realiza desde /install.php. Si prefieres phpMyAdmin, importa schema.sql y luego crea los usuarios desde la interfaz de administración.

Para Docker, schema.sql se monta como script de inicialización del contenedor MySQL. Las credenciales se proporcionan mediante variables de entorno y no deben escribirse en este archivo.
