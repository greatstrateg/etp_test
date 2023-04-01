/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import {ref, toRaw, isRef} from "vue";
import axios from 'axios';

import SumGoodsComponent from "./components/SumGoodsComponent.vue";
import ListGoodsComponent from "./components/ListGoodsComponent.vue";
import XmlGoodsComponent from "./components/XmlGoodsComponent.vue";
import AuthComponent from "./components/AuthComponent.vue";

const app = createApp({
    data() {
        return {
            'arr_goods': [["Шкафы", "12", "1230000"], ["Ноутбуки", "100", "9900000"], ["Смартфоны", "500", "51000000"]],
        }
    }
});
app.component('sum-goods-vue', SumGoodsComponent);
app.component('list-goods-vue', ListGoodsComponent);
app.component('xml-goods-vue', XmlGoodsComponent );
app.component('auth-vue', AuthComponent);
app.mount('#app');




