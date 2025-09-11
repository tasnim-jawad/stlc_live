<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Our Board of Directory</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>Our Board of Directory</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="team-area-1 space">
    <div class="container">
      <div class="row gy-30 justify-content-center">
        <template v-for="member in team.data" :key="`team-member-${member.id}`">
          <team-single-item :member="member" />
        </template>
        <div class="col-xxl-12">
          <Pagination
            :currentPage="team.current_page || 1"
            :totalPages="team.last_page || 1"
            @prev="goToPage(team.current_page - 1)"
            @next="goToPage(team.current_page + 1)"
            @change="goToPage"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import TeamSingleItem from "./components/TeamSingleItem.vue";
import { store as team_store } from "./Store/team_store.js";
import { mapState, mapActions } from "pinia";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";

export default {
  components: {
    Link,
    TeamSingleItem,
    Pagination,
  },
  created: function () {
    this.fetch_team({ page: 1 });
  },
  methods: {
    ...mapActions(team_store, ["fetch_team"]),
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.team.last_page || 1)) return;
      this.fetch_team({ page });
    },
  },
  computed: {
    ...mapState(team_store, ["team"]),
  },
};
</script>

