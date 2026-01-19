# EMPC Theme

Tema WordPress híbrido con React para empc.es.

## Desarrollo Local

```bash
npm install
npm run dev
```

## Producción

```bash
npm run build
git push origin main  # Auto-deploy a Raiola
```

## Estructura

```
empc-theme/
├── style.css           # WordPress theme metadata
├── functions.php       # WordPress + React integration
├── index.php           # Main template
├── src/                # React source code
│   ├── main.tsx
│   ├── App.tsx
│   ├── index.css
│   └── components/
├── react-app/          # Built React app (generated)
└── .github/workflows/  # GitHub Actions CI/CD
```
