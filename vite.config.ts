import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import eslint from 'vite-plugin-eslint'
import Components from 'unplugin-vue-components/vite'
import AutoImport from 'unplugin-auto-import/vite'
import { PrimeVueResolver } from 'unplugin-vue-components/resolvers'

const isProd = process.env.NODE_ENV === 'production'
export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/ts/app.ts',
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

    Components({
      dts: 'resources/ts/types/components.d.ts',
      dirs: ['resources/ts/components/**'],
      resolvers: [PrimeVueResolver()],
    }),

    AutoImport({
      dts: 'resources/ts/types/auto-imports.d.ts',
      dirs: ['resources/ts/composables/**'],
      imports: [
        'vue',
        {
          '@inertiajs/vue3': [
            'usePage', 'useForm', 'router',
          ],
        },
      ],
      eslintrc: {
        enabled: true,
      },
    }),

    !isProd && eslint({
      include: 'resources/ts/**/*.{js,ts,vue}',
      fix: true,
    }),
  ],

  resolve: {
    alias: {
      '@': 'resources/ts',
    },
  },
})
