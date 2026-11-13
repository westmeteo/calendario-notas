# Calendario de Notas

Aplicación de calendario personal en un único archivo HTML. Se abre en el navegador, no necesita conexión ni instalación.

## Uso
Abre `calendario_notas.html` con doble clic (se abre en tu navegador por defecto).

## Funciones principales
- Calendario semanal (lunes a domingo) que empieza en la semana actual. Botones "+ Semana" y "+ Mes" abajo a la derecha.
- Escritura en celdas: clic simple coloca texto libre en el punto donde pinchas; doble clic edita la nota normal de la celda; icono ⛶ para ampliar el día.
- Opciones por día (icono ⚙): color de fondo, tamaño de letra, copiar/pegar formato, y tipo de día (Festivo, ½ Festivo, Vacaciones, ½ Vacaciones, Rolltag, ½ Rolltag, WS).
- Herramientas (barra izquierda): Escribir, Dibujar, Formas, Texto flotante, Stickers, Borrar.
- Contadores de vacaciones (H) y rolltags (R) por año, editables con el lápiz ✎.
- Búsqueda con la lupa 🔍. Deshacer con Ctrl+Z. Seleccionar objeto y borrar con la × o la tecla Supr. Esc sale del modo activo.

## Guardado y copias de seguridad
Las notas y dibujos se guardan automáticamente en el navegador (localStorage), asociados a la ubicación del archivo y al navegador usado.

- Para una copia de seguridad o pasar los datos a otro equipo/navegador, usa "Exportar" (descarga un `.json`) e "Importar".
- IMPORTANTE: si mueves o renombras el archivo, el navegador puede dejar de ver los datos guardados antes (cambia el origen). Antes de mover, exporta; después de mover, importa.

## Sincronización PC + móvil (Hostinger)
Para ver los mismos datos en el ordenador y en el móvil, se alojan el HTML y un pequeño `sync.php` en tu Hostinger. La app guarda tu información en tu propio hosting y la refresca sola cada pocos segundos.

### Puesta en marcha (una vez)
1. Entra en el **Administrador de archivos** de Hostinger (o por FTP) y sube a `public_html` (o a una subcarpeta) estos dos archivos:
   - `calendario_notas.html`
   - `sync.php`
2. Abre en el navegador la URL de tu HTML, por ejemplo `https://tudominio.com/calendario_notas.html`.
3. Pulsa el botón **☁** (arriba a la derecha).
4. Rellena:
   - **URL de sync.php**: la ruta a ese archivo, p. ej. `https://tudominio.com/sync.php`
   - **Clave de espacio**: una contraseña inventada (6–64 caracteres: letras, números, `_` o `-`). Actúa como la "cerradura" de tus datos.
5. Pulsa **Activar**. El botón ☁ se pone verde cuando está sincronizando.
6. Repite los pasos 2–5 en el móvil (abre la misma URL), con **la misma URL de sync.php y la misma clave**.

A partir de ahí, lo que escribas en un dispositivo aparece en el otro en pocos segundos. Si no hay conexión, la app sigue funcionando con la copia local y vuelve a sincronizar al recuperar red.

### Notas de seguridad
- La clave de espacio es la única protección: usa una larga y no la compartas.
- Los datos se guardan en `public_html/cal_data/<clave>.json`, con un `.htaccess` que impide el acceso directo por web (solo el `sync.php` los lee).
- Sigue existiendo Exportar/Importar como copia de seguridad manual.

