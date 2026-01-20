import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig(({ command }) => ({
    plugins: [react()],

    // Ruta base fija para que funcione dentro de WordPress
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
                assetFileNames: 'assets/[name].[ext]',
                inlineDynamicImports: true, // Force everything into single bundle
            }
        },
    },

    server: {
        port: 5173,
        origin: 'http://localhost:5173'
    }
}));
