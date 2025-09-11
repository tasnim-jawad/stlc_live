<template>
  <div
    class="counter-sec1 space overflow-hidden mt-5"
    data-bg-src="assets/img/bg/counter-1-bg.jpg"
  >
    <div class="container">
      <div class="counter-card-wrap">
        <template v-for="(item , index) in at_a_glances" :key="item.id">
          <AtAGlanceSingleItem :item="item" />
          <template v-if="index < at_a_glances.length - 1">
            <div class="divider"></div>
          </template>
        </template>

        <!-- <div class="counter-card fadeinup wow">
          <div class="box-icon">
            <img src="assets/frontend/img/icon/counter_1_1.svg" alt="Icon" />
          </div>
          <div class="media-body">
            <h4 class="box-number">
              <span class="counter-number">1950</span
              ><span class="plus-simple">+</span>
            </h4>
            <p class="box-text">Project Handover</p>
          </div>
        </div>
        <div class="divider"></div>
        <div class="counter-card fadeinup wow">
          <div class="box-icon">
            <img src="assets/frontend/img/icon/counter_1_1.svg" alt="Icon" />
          </div>
          <div class="media-body">
            <h4 class="box-number">
              <span class="counter-number">2 </span
              ><span class="plus-simple">m</span>
            </h4>
            <p class="box-text">Monthly Visitors</p>
          </div>
        </div>
        <div class="divider"></div>
        <div class="counter-card fadeinup wow">
          <div class="box-icon">
            <img src="assets/frontend/img/icon/counter_1_1.svg" alt="Icon" />
          </div>
          <div class="media-body">
            <h4 class="box-number">
              <span class="counter-number">850 </span
              ><span class="plus-simple">+</span>
            </h4>
            <p class="box-text">Property Ready</p>
          </div>
        </div>
        <div class="divider"></div>
        <div class="counter-card fadeinup wow">
          <div class="box-icon">
            <img src="assets/frontend/img/icon/counter_1_1.svg" alt="Icon" />
          </div>
          <div class="media-body">
            <h4 class="box-number">
              <span class="counter-number">98 </span
              ><span class="plus-simple">%</span>
            </h4>
            <p class="box-text">Happy Customers</p>
          </div>
        </div> -->
        <!-- <div class="divider"></div> -->
      </div>
    </div>
  </div>
</template>

<script>
import { store as at_a_glance } from "./Store/at_a_glance.js";
import { mapState, mapActions } from "pinia";
import AtAGlanceSingleItem from "./components/AtAGlanceSingleItem.vue";
export default {
  components: { AtAGlanceSingleItem },
  name: "AtAGlance",
  created: function () {
    this.fetch_at_a_glance();
  },
  methods: {
    ...mapActions(at_a_glance, ["fetch_at_a_glance"]),
  },
  computed: {
    ...mapState(at_a_glance, ["at_a_glances"]),
  },
};

</script>

<style scoped></style>
