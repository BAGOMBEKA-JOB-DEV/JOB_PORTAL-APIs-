
import { createRouter, createWebHashHistory } from 'vue-router';
import FormComponent from '../components/FormComponent.vue';



const routes = [
  {
    path: '/',
    // You do not need to include NavbarComponent here
    component: FormComponent, // Or whatever main component you want to show
  }

];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
