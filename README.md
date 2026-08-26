# EMPC Theme - Arquitectura Híbrida (WordPress + React)

Este proyecto implementa una **Arquitectura de Islas** que combina la robustez SEO de WordPress con la interactividad de React.

## 🏗️ Arquitectura Técnica

### 1. WordPress (Backend & Estructura)
- **Tema Base**: Estructura clásica (`header.php`, `footer.php`, `index.php`).
- **Renderizado Híbrido**:
  - `functions.php`: Detecta entorno (Local vs Producción).
  - **Local (Docker)**: Carga Vite Client (puerto 5173). *[Actualmente en modo Build por estabilidad]*
  - **Producción**: Carga assets compilados de `/react-app/assets/`.
- **Mount Points (Islas)**:
  - `#root`: Contenedor principal (actualmente renderiza la Home completa).
  - `#react-whatsapp-bubble`: Widget flotante independiente.
  - `#react-contact-root`: Reservado para futuros formularios.

### 2. React (Frontend & UI)
- **Stack**: React 18 + TypeScript + Vite.
- **Estilos**: TailwindCSS 3 + PostCSS.
- **Entry Point**: `src/main.tsx` que busca los IDs en el DOM y monta componentes condicionalmente via `ReactDOM.createRoot`.

### 3. Workflow de Desarrollo

#### Entorno Local (Docker)
1. **Arrancar WordPress**:
   ```bash
   sudo docker-compose up -d
   ```
   Acceso: `http://localhost:8080`

2. **Desarrollar en React**:
   Editar archivos en `src/`.
   Para ver cambios:
   ```bash
   npm run build
   ```
   *(Recargar navegador)*

#### Despliegue (CI/CD)
Gestionado por GitHub Actions (`.github/workflows/deploy.yml`):
- Push a `main` -> `npm ci` -> `npm run build` -> FTP Upload al servidor.
- Guía de trabajo remoto: `GITHUB_WORKFLOW.md`

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
