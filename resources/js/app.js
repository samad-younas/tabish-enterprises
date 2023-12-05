// import './bootstrap';

import { createApp } from 'vue';
import CurrencyIndex from '/resources/js/Components/CurrencyComponent.vue';
import SaleIndex from '/resources/js/Components/SaleComponent.vue';
import PurchaseIndex from '/resources/js/Components/PurchaseComponent.vue';

const app = createApp({});

app.component('currency-index', CurrencyIndex);
app.component('sale-index', SaleIndex);
app.component('purchase-index', PurchaseIndex);

app.mount('#app');
