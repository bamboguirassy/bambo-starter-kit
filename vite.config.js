import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import Components from 'unplugin-vue-components/vite';
import { AntDesignVueResolver } from 'unplugin-vue-components/resolvers';


export default defineConfig({
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-browser',
            // vue: 'vue/dist/vue.esm-bundler',
        }
    },
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        Components({
            resolvers: [AntDesignVueResolver()],
          }),
    ],
});
