# EMPC Theme — trabajar desde otro PC y desplegar con GitHub

Este flujo deja el theme preparado para editarlo desde cualquier equipo y publicar los cambios en la web al hacer `push` a `main`.

## 1) Clonar el repositorio en el nuevo PC

```bash
git clone https://github.com/empcleon/empc-theme.git
cd empc-theme
```

Si vas a usar HTTPS con token:

```bash
git config --global credential.helper store
```

Si prefieres GitHub CLI:

```bash
gh auth login
```

## 2) Instalar dependencias y compilar

```bash
npm install
npm run build
```

El build genera los assets de producción dentro de `react-app/assets/`.

## 3) Trabajar en local

Archivos habituales:

- `functions.php` — lógica de carga del theme
- `header.php` / `footer.php` — estructura global
- `page-*.php`, `single.php`, `home.php` — plantillas
- `src/` — código React/Vite
- `react-app/assets/` — salida compilada que se publica

## 4) Subir cambios

```bash
git status
git add -A
git commit -m "feat: describe el cambio"
git push origin main
```

## 5) Qué hace el workflow

Cuando GitHub recibe un `push` a `main`:

1. instala Node.js;
2. ejecuta `npm ci`;
3. lanza `npm run build`;
4. sube el theme al servidor por FTP.

## 6) Secretos necesarios en GitHub

Configura estos secretos en el repositorio:

- `FTP_SERVER`
- `FTP_USERNAME`
- `FTP_PASSWORD`
- `FTP_SERVER_DIR`

Opcional:

- `FTP_PORT` — si el servidor usa un puerto distinto de 21

## 7) Recomendación de uso

- No subir `wp-config.php`
- No subir bases de datos
- No subir `node_modules/`
- No subir credenciales ni logs
- Editar en un PC, hacer commit, push y dejar que GitHub despliegue

## 8) Flujo resumido

```text
editar -> build -> commit -> push -> GitHub Actions -> web actualizada
```
