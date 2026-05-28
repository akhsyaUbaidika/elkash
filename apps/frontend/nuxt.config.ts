export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',

  devtools: {
    enabled: true,
  },

  modules: [
    '@pinia/nuxt',
    '@vueuse/nuxt',
    '@nuxtjs/tailwindcss',
  ],

  css: [
    '~/assets/css/main.css',
  ],

  imports: {
    dirs: [
      'services/**',
      'stores/**',
    ],
  },

  components: [
    {
      path: '~/components',
      pathPrefix: false,
      extensions: ['.vue'],
    },
  ],

  runtimeConfig: {
    public: {
      apiBaseUrl: '',
    },
  },
})