# EMPC Theme - Arquitectura Híbrida (WordPress + React)

Este proyecto implementa una **Arquitectura de Islas** que combina la robustez SEO de WordPress con la interactividad de React.

## 🏗️ Arquitectura Técnica

### 1. WordPress (Backend & Estructura)
- **Tema Base**: Estructura clásica (`header.php`, `footer.php`, `index.php`).
- **Renderizado Híbrido**:
  - `functions.php`: carga los assets compilados del tema y monta las islas React cuando la ruta lo necesita.
  - **Local**: la URL y el servidor dependen de la instalación WordPress local activa; no se debe asumir Docker ni una URL fija.
  - **Producción**: carga los assets compilados de `/react-app/assets/`.
- **Mount Points (Islas)**:
  - `#root`: Contenedor principal (actualmente renderiza la Home completa).
  - `#react-whatsapp-bubble`: Widget flotante independiente.
  - `#react-contact-root`: Reservado para futuros formularios.

### 2. React (Frontend & UI)
- **Stack**: React 18 + TypeScript + Vite.
- **Estilos**: TailwindCSS 3 + PostCSS.
- **Entry Point**: `src/main.tsx` que busca los IDs en el DOM y monta componentes condicionalmente via `ReactDOM.createRoot`.

### 3. Workflow de Desarrollo

#### Entorno Local
1. Identificar la instalación WordPress local activa, su URL y el árbol de tema que realmente sirve.
2. Editar PHP o `src/` según el alcance del cambio.
3. Ejecutar `npm run build` cuando se modifique React, TypeScript, Tailwind o los assets compilados.
4. Verificar con `curl`/HTML las rutas afectadas.

#### Despliegue (CI/CD)
Gestionado por GitHub Actions (`.github/workflows/deploy.yml`):
- Solo un `push` a `main` o una ejecución manual activa el workflow.
- El runner ejecuta `npm ci` y `npm run build`.
- Después sube el tema por FTP al directorio remoto configurado en el workflow.
- WordPress, la base de datos, plugins y contenido editorial quedan fuera de este despliegue.
- La publicación no se considera verificada hasta comprobar el HTML público de `https://empc.es/`.

La guía completa para agentes y otros equipos está en [`GITHUB_WORKFLOW.md`](GITHUB_WORKFLOW.md).

## 🚀 Roadmap de Componentes

### "Must Have" (Prioridad alta)
- [x] **Arquitectura Base**: Configuración híbrida y Docker.
- [x] **Widget WhatsApp**: Componente React flotante sustituyendo plugin.
- [ ] **Formulario Multi-step**: React Island para mejorar conversión en contacto.
- [ ] **Limpieza**: Eliminación de plugins duplicados (plugins de WhatsApp, Elementor).

### "Should Have"
- [ ] **Calculadora de Presupuesto**: Herramienta interactiva para cualificación de leads.
- [ ] **Portfolio Interactivo**: Filtrado instantáneo de proyectos.

## 📂 Estructura de Carpetas

```
empc-theme/
├── .github/            # Workflows CI/CD
├── react-app/          # Output del build (assets compilados)
├── src/                # Código fuente React
│   ├── components/     # Componentes (Islands)
│   ├── styles/         # CSS global / Tailwind
│   └── main.tsx        # Punto de entrada / Montaje de islas
├── functions.php       # Lógica de encolado condicional
├── index.php           # Template con mount points
├── header.php          # Cabecera estándar WP
└── footer.php          # Pie estándar WP
```
