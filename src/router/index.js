import { createRouter, createWebHashHistory } from 'vue-router'
import ProductList from '../views/ProductList.vue'
import AddProducts from '../views/AddProducts.vue'

const router = createRouter({
  history: createWebHashHistory(),
  mode: "hash",
  routes: [
    {
      path: '/',
      name: 'ProductList',
      component: ProductList
    },
    {
      path: '/addProducts',
      name: 'AddProducts',
      component: AddProducts
    }
  ]
})

export default router
