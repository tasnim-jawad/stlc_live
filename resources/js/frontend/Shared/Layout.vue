<template>
    <div id="container">

        <!-- header -->
        <Header />
        <!-- / end tag #header -->
        <!-- content holder -->
        <slot />
        <!-- / end div .content_holder -->
    </div>
    <Footer />
    <!-- <div>
        
        <div class="main-wrapper">
            
        </div>
        
    </div> -->
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
