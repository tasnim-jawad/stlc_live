<template>
  <div class="widget widget_search">
    <h3 class="widget_title">search</h3>
    <form class="search-form" @submit.prevent="handleSearch">
      <input type="text" v-model="searchTerm" placeholder="Enter Keyword" />
      <button type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
</template>

<script>
import { store } from "../Store/propertiesStore";

function debounce(func, delay) {
  let timeoutId;
  return function (...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => func.apply(this, args), delay);
  };
}

export default {
  data() {
    return {
      searchTerm: "",
    };
  },
  methods: {
    handleSearch() {
      const propertiesStore = store();
      if (!this.searchTerm.trim()) {
        propertiesStore.fetch_properties({ page: 1 });
      } else {
        propertiesStore.fetch_properties({ page: 1, search: this.searchTerm });
      }
    },
    debouncedSearch: debounce(function () {
      this.handleSearch();
    }, 500),
  },
  watch: {
    searchTerm: "debouncedSearch",
  },
};
</script>

<style lang="scss" scoped></style>
