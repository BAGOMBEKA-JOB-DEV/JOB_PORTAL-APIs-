<template>
  <div class="main-layout">
    <navbar-component /> <!-- Sidebar on the left -->
    <div class="content">
      <router-view /> <!-- Routed components will appear here -->
    </div>
  </div>
</template>

<script>
// Import the NavbarComponent here
import NavbarComponent from './NavbarComponent.vue'; 

export default {
  name: "MainComponent",
  components: {
    NavbarComponent // Register the navbar component locally
  },
};
</script>

<style >
/* Flexbox layout to position sidebar on the left and content on the right */
.main-layout {
  display: flex;
  height: 100vh; /* Full viewport height */
  
}

/* Sidebar (navbar) styling */
navbar-component {
  width: 250px; /* Adjust the width of the sidebar */
  flex-shrink: 0; /* Prevent the sidebar from shrinking */
  background-color: #f8f9fa; /* Background color for the sidebar */
}

/* Main content area styling */
.content {
  flex-grow:1; /* Take up remaining space on the right */
  padding: 20px; /* Add padding inside the content area */
  overflow-y: auto; /* Allow vertical scrolling if content overflows */
}
</style>
