
import { createApp } from "vue"
import axios from "axios"
import VueAxios from 'vue-axios'
import router from './router'
import App from "../vue/Layout.vue"

//import Bootstrap
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'

//import Datatable
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'
import 'datatables.net-select-bs4'
import 'datatables.net-searchpanes-bs4'

const app  = createApp(App)
app.use(VueAxios, axios)
app.provide("axios", app.config.globalProperties.axios)
app.use(router)
app.mount('#app')

require("./bootstrap")
