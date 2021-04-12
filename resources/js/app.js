/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

//window.Vue = require('vue').default;
import { createApp } from 'vue';
import Sidebar from './components/sidebar.vue';
import MyNavbar from './components/navbar.vue';
import SmsWizard from './components/sms-wizard.vue';
import MessagingList from './components/messaging-list.vue';
import PasswordField from './components/password-field.vue';
import FileUploadField from './components/file-upload-field.vue';

const app = createApp({
    components:{
        MyNavbar,
        Sidebar,
        SmsWizard,
        MessagingList,
        PasswordField,
        FileUploadField
    }
})

app.mount("#app");
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 

Vue.component('sidebar', require('./components/sidebar.vue').default);
Vue.component('sms-wizard', require('./components/sms-wizard.vue').default);

Vue.component('error-banner', require('./components/error-banner.vue').default);
Vue.component('notification-banner', require('./components/notif-banner.vue').default);
 */