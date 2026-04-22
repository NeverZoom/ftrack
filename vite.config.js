import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    css: {
        preprocessorOptions: {
        scss: {
            additionalData: 
            `
            @import "`+fileURLToPath(new URL('./resources', import.meta.url))+`/assets/styles/_mixins.scss"; 
            @import "`+fileURLToPath(new URL('./resources', import.meta.url))+`/assets/styles/_variables.scss";
            `
        }
        }
    },
});
