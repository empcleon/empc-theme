# Flujo EMPC: Local → GitHub → producción

Esta guía describe el flujo real de este repositorio `empc-theme` para que una persona o un agente pueda trabajar sin confundir el entorno local, GitHub y `https://empc.es/`.

## 0. Qué publica realmente este repositorio

- El repositorio GitHub oficial es `https://github.com/empcleon/empc-theme.git`.
- El repositorio contiene un tema WordPress híbrido: PHP/WordPress para el HTML y React/Vite para las islas interactivas.
- `src/` contiene el código fuente React/TypeScript.
- `react-app/assets/` contiene los assets compilados que utiliza el tema en producción.
- `.github/workflows/deploy.yml` es el workflow de publicación.
- La publicación de producción no hace `git pull` en el servidor: GitHub Actions compila el proyecto y sube el tema por FTP.
- WordPress, la base de datos, plugins, páginas y contenidos editoriales no se actualizan con este workflow. El workflow solo despliega archivos del tema.

## 1. Antes de tocar nada: identificar el estado

Ejecuta desde la raíz del repositorio:

```bash
git status --short --branch
git branch --show-current
git remote -v
git log -1 --oneline
```

Reglas para el agente:

1. Lee primero los archivos y la configuración relacionados con la tarea.
2. No borres ni restaures cambios que ya existan.
3. No leas, imprimas ni subas secretos, `.env`, contraseñas, dumps SQL o credenciales.
4. No declares que producción está actualizada solo porque el commit o el workflow haya terminado: hay que comprobar `https://empc.es/` después.
5. No hagas cambios de base de datos, plugins, WordPress o contenido editorial como parte de un despliegue de tema salvo autorización separada.

## 2. Trabajo local

El entorno local debe ser una instalación WordPress funcional. La URL, el servidor y la forma de arrancarlo dependen de la instalación disponible; no se debe asumir Docker ni inventar una URL. Antes de probar, identifica el `wp-config.php`, la URL local y el árbol de tema activo.

Instala dependencias solo si hace falta y usa el lockfile:

```bash
npm ci
```

Durante el desarrollo:

- PHP y los templates (`*.php`) generan la estructura y el contenido SSR.
- `src/` contiene React/TypeScript.
- `npm run build` recompila `react-app/assets/app.js` y `react-app/assets/main.css`.
- La compilación local no publica nada por sí sola.

Comprobaciones mínimas antes de preparar un cambio:

```bash
npm run build
php -l functions.php
# Repetir php -l en cada archivo PHP modificado
```

Después, prueba las rutas locales afectadas con `curl` o la herramienta local disponible. Comprueba como mínimo el estado HTTP, el H1, los metadatos relevantes, los enlaces/CTA y que no aparezcan warnings o fatals PHP.

## 3. Preparar el cambio en Git

Mantén el alcance aislado y revisable:

```bash
git diff --check
git diff --stat
git diff -- <archivos-afectados>
git status --short
```

No incluyas en el commit:

- `node_modules/`;
- `.env*`, contraseñas o tokens;
- bases de datos, dumps o backups;
- archivos operativos temporales;
- cambios no relacionados con la tarea.

Si el cambio es correcto y las verificaciones pasan:

```bash
git add <archivos-intencionados>
git commit -m "tipo(scope): descripción breve"
```

Usa mensajes Conventional Commits (`feat`, `fix`, `docs`, `test`, `ci`, `refactor`, `chore`). No hagas `git reset --hard`, `push --force` ni reescritura de historial para resolver un problema normal.

## 4. De la rama local a GitHub

Primero confirma qué rama activa el despliegue. El workflow actual se dispara cuando hay un `push` a `main` o mediante `workflow_dispatch` en GitHub Actions. Un push a una rama de trabajo no publica producción.

Flujo recomendado para una rama de trabajo:

```bash
git fetch origin
git push -u origin HEAD
```

Después se revisa el diff y se integra el cambio aprobado en `main` mediante el procedimiento del repositorio (normalmente una Pull Request). Solo el commit que llegue a `main` activa el despliegue automático.

En este checkout puede existir un `push URL` deshabilitado como medida de seguridad. Compruébalo antes de cualquier publicación:

```bash
git remote get-url origin
git remote get-url --push origin
```

Si el push URL está deshabilitado, no lo cambies ni publiques sin autorización explícita. Si se autoriza temporalmente un push, debe restaurarse el sentinel inmediatamente después, tanto si el push termina bien como si falla.

## 5. Qué hace `.github/workflows/deploy.yml`

Al recibir un `push` a `main`, o al ejecutarse manualmente con `workflow_dispatch`, GitHub Actions:

1. usa `ubuntu-latest`;
2. descarga el commit exacto con `actions/checkout@v4`;
3. instala Node.js 20 con `actions/setup-node@v4` y caché de npm;
4. ejecuta `npm ci`;
5. ejecuta `npm run build`;
6. usa `SamKirkland/FTP-Deploy-Action@v4.3.5`;
7. sube el contenido del repositorio al directorio `/wp-content/themes/empc-theme/` del servidor FTP;
8. excluye `.git`, `.github`, `node_modules`, `src`, Markdown, configuraciones de desarrollo, secretos, dumps y archivos operativos indicados en el workflow.

El workflow utiliza estos secretos de GitHub Actions:

- `FTP_SERVER`;
- `FTP_USER`;
- `FTP_PASS`;
- `FTP_PORT` opcional; si no existe, usa el puerto `21`.

El directorio remoto está definido actualmente en el propio workflow como `/wp-content/themes/empc-theme/`. No inventes `FTP_USERNAME`, `FTP_PASSWORD` ni `FTP_SERVER_DIR`: esos nombres no son los que usa el workflow actual.

Existe además un paso excepcional de limpieza FTP. Solo se ejecuta si el mensaje del commit comienza exactamente por:

```text
fix(deploy): retirar archivos operativos del tema publicado
```

Ese paso comprueba el directorio remoto y elimina únicamente los nombres incluidos en su lista cerrada. No debe activarse para un despliegue normal.

## 6. Cómo verificar GitHub Actions

Después de que el commit llegue a `main`, verifica la ejecución asociada al SHA exacto. Con GitHub CLI:

```bash
gh run list --workflow deploy.yml --limit 5
gh run view <RUN_ID> --log-failed
gh run view <RUN_ID>
```

El resultado necesario es `success`. Si falla:

1. lee el log del paso que falló;
2. corrige la causa localmente;
3. ejecuta de nuevo las comprobaciones locales;
4. crea un commit de corrección pequeño;
5. vuelve a comprobar el nuevo run.

No confundas `build` correcto con publicación correcta: el build solo demuestra que los assets se pueden generar.

## 7. Verificar producción en `empc.es`

Cuando el workflow termine correctamente, comprueba la web pública. Como mínimo:

```bash
curl -I https://empc.es/
curl -fsSL https://empc.es/ -o /tmp/empc-home.html
```

Para cada ruta afectada, comprueba la URL normal y, si hay caché, una variante con query string de cache-busting. Verifica el HTML servido, no solo el log de FTP:

- estado HTTP y ausencia de redirecciones inesperadas;
- título, descripción, canonical y robots cuando formen parte del cambio;
- exactamente el H1 esperado;
- contenido SSR y mount points/islas previstos;
- enlaces y parámetros CTA exactos;
- ausencia de `Warning`, `Fatal error`, `Parse error` o URLs locales;
- assets compilados cargados desde producción;
- JSON-LD parseable y con los tipos/nodos requeridos cuando el cambio afecte schema;
- rutas hermanas sin regresiones.

Si la página pública no coincide con el commit desplegado, deja el estado como **no verificado** e investiga caché, ruta, tema activo o el artefacto subido. Un workflow verde no basta para cerrar la incidencia.

## 8. Rollback y límites

- Un rollback del tema consiste en restaurar un commit/artefacto conocido y volver a desplegarlo por el mismo flujo autorizado.
- No restaures una base de datos desde este workflow.
- No cambies plugins, ajustes de WordPress, páginas ni contenido editorial para resolver un fallo de FTP.
- Si el problema afecta a WordPress o a la base de datos, abre una tarea separada con snapshot y autorización explícita.

## Resumen operativo

```text
editar en Local
  → probar PHP/HTML y ejecutar npm run build
  → revisar diff y commit selectivo
  → push de la rama / Pull Request
  → integrar el commit aprobado en main
  → GitHub Actions: checkout → npm ci → npm run build → FTP
  → verificar el run por SHA
  → verificar el HTML público de empc.es
```

La frase corta correcta es: **Local no publica directamente; `main` activa GitHub Actions; GitHub Actions construye el tema y lo sube por FTP; la publicación solo se da por terminada después de comprobar `empc.es`.**
