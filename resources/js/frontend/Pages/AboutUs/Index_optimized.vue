<template>
  <!-- Breadcrumb Section -->
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/common/2.jpeg"
    style="background-image: url('assets/frontend/img/common/2.jpeg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">About Us</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>About Us</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- AboutUs Component -->
  <AboutUs />
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AboutUs from "../../GlobalComponent/AboutUs/AboutUs.vue";

export default {
  name: "AboutUsPage",
  components: {
    Link,
    AboutUs,
  },
};
</script>

<style scoped>
/* Page-specific styles if needed */
.breadcumb-wrapper {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 100px 0;
  position: relative;
}

.breadcumb-wrapper::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  z-index: 1;
}

.breadcumb-content {
  position: relative;
  z-index: 2;
  text-align: center;
  color: white;
}

.breadcumb-title {
  font-size: 3rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

.breadcumb-menu {
  list-style: none;
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin: 0;
  padding: 0;
}

.breadcumb-menu li {
  position: relative;
}

.breadcumb-menu li:not(:last-child)::after {
  content: "/";
  margin-left: 1rem;
  color: rgba(255, 255, 255, 0.7);
}

.breadcumb-menu a {
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcumb-menu a:hover {
  color: white;
}

@media (max-width: 768px) {
  .breadcumb-title {
    font-size: 2rem;
  }

  .breadcumb-wrapper {
    padding: 60px 0;
  }
}
</style>
