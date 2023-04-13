import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { useFormStore } from './stores/form'

import App from './App.vue'
import router from './router'

import './assets/reset.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

export const formStore = useFormStore()
