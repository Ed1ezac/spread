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
import DraftSms from './components/sms/draft-sms.vue';
import SmsWizard from './components/sms/sms-wizard.vue';
import SmsSummary from './components/sms/sms-summary.vue';
import ErrorBanner from './components/error-banner.vue';
import ScheduledSms from './components/sms/scheduled-sms.vue';
import FundsPurchase from './components/funds-purchase.vue';
import PasswordField from './components/password-field.vue';
import RecipientsList from './components/recipients-list.vue';
import RolesDropDown from './components/admin/roles-drop-down';
import NotificationBanner from './components/notif-banner.vue';
import AdminSidebar from './components/admin/admin-sidebar.vue';
import FileUploadField from './components/file-upload-field.vue';
//import SenderNamePicker from './components/sms/sender-name-picker.vue';
import FilesTableOptions from './components/admin/files-table-options.vue';
import UsersTableOptions from './components/admin/users-table-options.vue';
import SmsRolloutProgress from './components/sms/sms-rollout-progress.vue';

const app = createApp({
    components:{
        MyNavbar,
        Sidebar,
        DraftSms,
        SmsWizard,
        SmsSummary,
        ErrorBanner,
        AdminSidebar,
        ScheduledSms,
        FundsPurchase,
        PasswordField,
        RolesDropDown,
        RecipientsList,
        FileUploadField,
        FilesTableOptions,
        UsersTableOptions,
        NotificationBanner,
        SmsRolloutProgress
    }
})

app.mount("#app");