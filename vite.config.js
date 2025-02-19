import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/jsvectormap/dist/css/jsvectormap.min.css',
                'resources/css/icons.css',
                'resources/js/pages/dashboard.js',
            ],
            refresh: true,
        }),
    ],
});
