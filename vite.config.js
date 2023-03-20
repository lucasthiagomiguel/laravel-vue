// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'


export default defineConfig({
    base: "/",
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
    // resolve:{
    //     alias:{
    //         "": Path2D.join(__dirname, "/node_modules")
    //     }
    // }
});