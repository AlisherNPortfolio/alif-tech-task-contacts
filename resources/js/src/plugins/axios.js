import Vue from 'vue'
import axios from 'axios';

const URL_BASE = 'http://localhost:8084/api/'
const instance = axios.create({
    baseURL: URL_BASE,
    headers: {
        common: {
            'X-Requested-With': 'XMLHttpRequest'
        },
    },
});

Vue.prototype.$api = instance;
