<template>
  <aside class="sidebar-area">
    <WidgetSearch />
    
    <Widget />

    <SidebarContactForm />

    <!-- <WidgetBanner /> -->

  </aside>
</template>

<script>
import WidgetSearch from "./WidgetSearch.vue";
import Widget from "./Widget.vue";
import SidebarContactForm from "./SidebarContactForm.vue";
import WidgetBanner from "./WidgetBanner.vue";

export default {
  components: {
    WidgetSearch,
    Widget,
    SidebarContactForm,
    WidgetBanner,
  },
};
</script>

<style lang="scss" scoped></style>
