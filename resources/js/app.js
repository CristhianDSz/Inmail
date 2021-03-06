/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

// window.Vue = require('vue')
import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2'
import VeeValidate, { Validator } from 'vee-validate'
import es from 'vee-validate/dist/locale/es'
import Multiselect from 'vue-multiselect'

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
}

Vue.component('multiselect', Multiselect)
Vue.use(VueSweetalert2, options)
Validator.localize({ es: es })
Vue.use(VeeValidate, { locale: 'es', fieldsBagName: 'vvFields' })


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import DependencyMain from './components/dependencies/DependencyMain.vue'
import EmployeeMain from './components/employees/EmployeeMain.vue'
import ThirdPartyMain from './components/third_parties/ThirdPartyMain.vue'
import RecordMain from './components/records/RecordMain.vue'
import Notification from './components/utils/Notification.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**EventEmitters -Buses */
window.modalEmitter = new Vue()
window.dependenciesEmitter = new Vue()

const app = new Vue({
    el: '#app',
    components: {
        DependencyMain,
        EmployeeMain,
        ThirdPartyMain,
        RecordMain,
        Notification,
        Multiselect
    }
})
