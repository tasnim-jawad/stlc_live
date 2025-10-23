<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/common/2.jpeg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Our Board of Directory</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Our Board of Directory</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="team-area-1 space">
    <div class="container">
      <div class="row gy-30 justify-content-center">
        <!-- Skeleton loading state -->
        <template v-if="loading && (!team.data || team.data.length === 0)">
          <team-single-item
            v-for="n in 8"
            :key="`skeleton-${n}`"
            :isLoading="true"
          />
        </template>

        <!-- Actual team members -->
        <template v-else>
          <team-single-item
            v-for="member in team.data"
            :key="`team-member-${member.id}`"
            :member="member"
            :isLoading="false"
          />
        </template>
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
    console.log("Team page created, fetching team data...");
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
    ...mapState(team_store, ["team", "loading", "error"]),
  },
  watch: {
    loading(newVal, oldVal) {
      console.log("Team loading state changed from", oldVal, "to", newVal);
    },
    "team.data"(newVal, oldVal) {
      console.log("Team data changed:", newVal?.length || 0, "members");
    },
  },
};
</script>
