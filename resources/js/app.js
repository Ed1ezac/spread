/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue').default;
import { createApp } from 'vue';
import Sidebar from './components/sidebar.vue';
import MyNavbar from './components/navbar.vue';
import DraftSms from './components/draft-sms.vue';
import SmsWizard from './components/sms-wizard.vue';
import SmsSummary from './components/sms-summary.vue';
import ErrorBanner from './components/error-banner.vue';
import ScheduledSms from './components/scheduled-sms.vue';
import PasswordField from './components/password-field.vue';
import RecipientsList from './components/recipients-list.vue';
import NotificationBanner from './components/notif-banner.vue';
//import CountDownTimer from './components/count-down-timer.vue';
import FileUploadField from './components/file-upload-field.vue';
import SmsRolloutProgress from './components/sms-rollout-progress.vue';

const app = createApp({
    components:{
        MyNavbar,
        Sidebar,
        DraftSms,
        SmsWizard,
        SmsSummary,
        ErrorBanner,
        ScheduledSms,
        PasswordField,
        //CountDownTimer,
        RecipientsList,
        FileUploadField,
        NotificationBanner,
        SmsRolloutProgress
    }
})

app.mount("#app");