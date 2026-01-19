import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [react()],

    // Ruta base para WordPress en producción
    base: '/wp-content/themes/empc-theme/react-app/',

    build: {
        manifest: true,
        outDir: 'react-app',
        emptyOutDir: true,
        rollupOptions: {
            input: 'src/main.tsx',
            output: {
                entryFileNames: 'assets/app.js',
                chunkFileNames: 'assets/[name].js',
                assetFileNames: 'assets/styles.[ext]'
            }
        },
    },

    server: {
        port: 5173,
        // Para desarrollo local, servimos desde raíz
        origin: 'http://localhost:5173'
    }
});
