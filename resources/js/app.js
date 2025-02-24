// Import the Vue.js library
import { createApp } from 'vue';
// Import Bootstrap's CSS and JavaScript
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
// Import your main application component and router
import App from './components/FormComponent.vue'; // Your main component that includes the navbar

import router from './router'; // Import the router configuration

// Create a new Vue application instance
const app = createApp(App);

// Register the router
app.use(router);

// Mount the application to the HTML element with id 'app'
app.mount('#app');



