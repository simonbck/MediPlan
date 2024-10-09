import "./bootstrap";
import { createApp } from "vue";
import { i18nVue } from "laravel-vue-i18n"
import {Vuetable} from "vue3-vuetable";
import { flashToast } from '@alamtheinnov/flashtoast';
import MedicationPlan from "./VueComponents/MedicationPlan.vue";
import DeleteMedicament from "./VueComponents/DeleteMedicament.vue";
import Overview from "./VueComponents/Overview.vue";

const app = createApp({});

app.use(i18nVue, {
    resolve: lang => import(`../../lang/php_${lang}.json`),
});

app.use(flashToast);
app.use(Vuetable);
app.component('medication-plan', MedicationPlan);
app.component('vuetable-field-delete', DeleteMedicament);
app.component('overview', Overview);
app.mount("#app");
