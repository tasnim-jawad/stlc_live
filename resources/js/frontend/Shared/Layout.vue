<template>
  <body class="">
    <!-- header -->
    <Header />
    <!-- / end tag #header -->

    <!-- content holder -->
    <slot />
    <!-- / end div .content_holder -->

    <!-- footer -->
    <Footer />
    <!-- / end tag #footer -->
  </body>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
export default {
  name: "Layout",
  components: { Header, Footer },
};
</script>

<style></style>
