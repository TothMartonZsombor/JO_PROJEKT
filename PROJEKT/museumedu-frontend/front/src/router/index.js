
import { createRouter, createWebHistory } from 'vue-router'
import ThemeSelect from '../components/ThemeSelect.vue'
import ItemList from '../components/ItemList.vue'
import AdminForm from '../components/AdminForm.vue'

const routes = [
  {
    path: '/',
    component: ThemeSelect
  },
  {
    path: '/theme/:theme',
    component: ItemList
  },
  {
    path: '/admin',
    component: AdminForm
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
