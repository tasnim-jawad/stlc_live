<template>
  <section class="team-area-1 space-top overflow-hidden">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span>Team Members
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Meet Our Team Members
            </h2>
          </div>
        </div>
      </div>
      <div
        class="slider-area mb-20"
        v-if="team_members && team_members.length > 0"
      >
        <div
          class="swiper th-slider has-shadow"
          id="teamSlider1"
          data-slider-options='{"autoplay":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}}, "autoHeight": "true"}'
        >
          <div class="swiper-wrapper">
            <template v-for="member in team_members" :key="member.id">
              <slider-item :member="member"></slider-item>
            </template>
          </div>
        </div>
        <button
          data-slider-prev="#teamSlider1"
          class="slider-arrow slider-prev"
        >
          <i class="fa-solid fa-arrow-left"></i>
        </button>
        <button
          data-slider-next="#teamSlider1"
          class="slider-arrow slider-next"
        >
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div class="row gy-40 justify-content-center">
        <div class="col-xl-8">
          <p class="chat-text-wrap text-center pe-xl-5 ps-xl-5 mb-0">
            Explore our team of property experts who are here to help with all
            your buying, renting, and selling goals. Find the home of your
            dreams with professionals you can trust.
            <a class="text-theme" href="/team"> Let’s chat</a>
          </p>
        </div>
        <div class="col-12">
          <div class="text-center">
            <Link class="th-btn pill bg-black" href="/team"
              >See More Team Member</Link
            >
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";
import { store as teamStore } from "./Store/teamStore";
import { mapActions, mapState } from "pinia";
import SliderItem from "./components/SliderItem.vue";

export default {
  components: {
    SliderItem,
  },
  setup() {
    const swiperInstance = ref(null);
    const initializationAttempts = ref(0);
    const maxAttempts = 10;

    const initializeTeamSlider = () => {
      const teamSlider = document.querySelector("#teamSlider1");

      // If slider already exists, don't reinitialize
      if (swiperInstance.value) {
        return;
      }

      if (!teamSlider) {
        console.warn("Team slider element not found");
        return;
      }

      if (!window.Swiper) {
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          // Wait for Swiper to load and try again
          setTimeout(() => initializeTeamSlider(), 200);
        } else {
          console.error("Swiper library not available after multiple attempts");
        }
        return;
      }

      try {
        // Parse data-slider-options if present
        let options = {};
        const optionsAttr = teamSlider.getAttribute("data-slider-options");
        if (optionsAttr) {
          options = JSON.parse(optionsAttr);
        }

        // Normalize string values to proper types
        const normalizeOptions = (obj) => {
          for (const key in obj) {
            if (typeof obj[key] === "string") {
              if (obj[key] === "true") obj[key] = true;
              else if (obj[key] === "false") obj[key] = false;
              else if (!isNaN(obj[key]) && obj[key] !== "")
                obj[key] = Number(obj[key]);
            } else if (typeof obj[key] === "object" && obj[key] !== null) {
              normalizeOptions(obj[key]);
            }
          }
        };
        normalizeOptions(options);

        // Add navigation
        const nextBtn = document.querySelector(
          '[data-slider-next="#teamSlider1"]'
        );
        const prevBtn = document.querySelector(
          '[data-slider-prev="#teamSlider1"]'
        );
        if (nextBtn && prevBtn) {
          options.navigation = {
            nextEl: nextBtn,
            prevEl: prevBtn,
          };
        }

        // Initialize slider with merged options
        swiperInstance.value = new window.Swiper(teamSlider, {
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
          },
          autoHeight: true,
          loop: false,
          spaceBetween: 20,
          ...options,
        });

        console.log("Team slider initialized successfully");
      } catch (error) {
        console.error("Error initializing team slider:", error);
        // Retry on error
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeTeamSlider(), 500);
        }
      }
    };

    const destroySlider = () => {
      if (
        swiperInstance.value &&
        typeof swiperInstance.value.destroy === "function"
      ) {
        swiperInstance.value.destroy(true, true);
        swiperInstance.value = null;
        console.log("Team slider destroyed");
      }
    };

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      // Multiple initialization attempts with different delays
      setTimeout(() => initializeTeamSlider(), 100);
      setTimeout(() => initializeTeamSlider(), 300);
      setTimeout(() => initializeTeamSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      if (!swiperInstance.value) {
        setTimeout(() => initializeTeamSlider(), 100);
      }
    });

    // Cleanup on unmount
    onBeforeUnmount(() => {
      destroySlider();
    });

    return {
      swiperInstance,
    };
  },
  created: function () {
    this.fetch_team_members();
  },
  methods: {
    ...mapActions(teamStore, ["fetch_team_members"]),
  },
  computed: {
    ...mapState(teamStore, ["team_members"]),
  },
};
</script>

<style lang="scss" scoped></style>
