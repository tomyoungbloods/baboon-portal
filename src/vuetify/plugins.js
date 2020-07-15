import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const vuetify = new Vuetify({
    theme: {
      themes: {
        light: {
            primary: '#2F484E',
            secondary: '#D6E74D',
            accent: '#D6E74D',
            error: '#b71c1c',
        },
      },
    },
  })

export default new Vuetify(vuetify)