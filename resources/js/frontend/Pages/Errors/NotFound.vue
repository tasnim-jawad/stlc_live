<template>
<div class="breadcumb-wrapper" style="background-image: url('/assets/frontend/img/bg/breadcrumb-bg.jpg');">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title mt-5">Error Page</h1>
            <ul class="breadcumb-menu">
                <li><Link href="/">Home</Link></li>
                <li>Error Page</li>
            </ul>
        </div>
    </div>
</div>
<section
    class="bg-smoke space"
    style="background-image: url('/assets/frontend/img/shape/error-shape-bg.png');"
  >
    <div
      class="shape-mockup d-none d-xxl-block"
      data-bottom="0%"
      data-right="0%"
    >
      <!-- <img src="/assets/frontend/img/error/error-bottom.png" alt="img" /> -->
    </div>
    <div
      class="error-bg-img"
      data-mask-src="/assets/frontend/img/error/error-bg-shape.png"
    >
      <img src="/assets/frontend/img/error/error-bg.png" alt="img" />
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="error-content">
            <h2 class="error-title">Error 404</h2>
            <p class="error-text">
              Oops! The page you’re looking for doesn’t exist
            </p>
            <Link href="/" class="th-btn radius">Back To Home</Link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: "NotFound",
};
</script>

<style scoped></style>
