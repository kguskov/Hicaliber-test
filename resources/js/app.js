import './bootstrap';
import { createApp } from 'vue';

import App from "./App.vue";
import Property from "./Pages/Property.vue";

const app = createApp({});
app.component('App', App);
app.component('Property', Property);

app.mount("#app");
