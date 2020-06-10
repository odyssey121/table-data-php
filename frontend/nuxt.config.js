
export default {
  mode: 'spa',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || 'table-distance',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/icon?family=Material+Icons"
      },
    ]
  },
  axios: {
    baseURL: 'http://web:8080/',
    browserBaseURL: 'http://localhost:8080/',
    headers: {
      common: {
        "Content-Type": "application/json",
        'Access-Control-Allow-Origin': '*',
      }
    }
  },

  /*
  ** Customize the progress-bar color
  */
  loading: false,
  /*
  ** Global CSS
  */
  css: ["assets/style/main.css"],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: ['~plugins/ui-components.js'],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    "@nuxtjs/axios",
    "nuxt-quasar",
  ],

  // quasar css components
  quasar: {
    framework: {
      iconSet: "fontawesome-v5",
      components: [
        'QSelect',
        "QList",
        "QItem",
        "QForm",
        "QInput",
        "QIcon",
        "QBtn",
        "QBtnToggle",
        "QItemSection"
      ],
      cssAddon: true
    },
    supportIE: true,
    htmlVariables: {}
  },

  router: {
    linkActiveClass: 'active'
  },


  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {
    }
  }
}
