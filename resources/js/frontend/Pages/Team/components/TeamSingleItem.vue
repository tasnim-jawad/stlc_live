<template>
  <div
    class="col-xl-3 col-lg-4 col-md-6 fadeinup wow"
    style="visibility: visible; animation-name: fadeinup"
  >
    <div
      class="team-card style-2 background-image"
      :class="{ 'skeleton-team': isLoading }"
      style="
        background-image: url('assets/frontend/img/shape/team-2-bg-shape.png');
      "
    >
      <!-- Skeleton State -->
      <template v-if="isLoading">
        <div class="team-img">
          <div class="skeleton-element skeleton-team-image"></div>
        </div>
        <div class="team-content">
          <div class="left-contet">
            <div class="skeleton-element skeleton-team-name"></div>
            <div class="skeleton-element skeleton-team-designation"></div>
          </div>
          <div class="team-social">
            <div class="th-social">
              <div class="skeleton-element skeleton-social-icon"></div>
              <div class="skeleton-element skeleton-social-icon"></div>
              <div class="skeleton-element skeleton-social-icon"></div>
            </div>
          </div>
        </div>
      </template>

      <!-- Actual Content -->
      <template v-else>
        <div class="team-img">
          <img
            :src="
              member?.image ? '/' + member?.image : '/uploads/default_man.jpeg'
            "
            alt="Team"
            @error="handleImageError"
          />
        </div>
        <div class="team-content">
          <div class="left-contet">
            <h3 class="box-title">
              <a href="javascript:void(0)">{{ member?.name }}</a>
            </h3>
            <span class="team-desig">{{ member?.designation }}</span>
          </div>
          <div class="team-social">
            <div class="th-social">
              <a
                target="_blank"
                v-for="(social, i) in member?.social_link"
                :key="i"
                :href="social?.title"
              >
                <i :class="social?.icon"></i>
              </a>
            </div>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    member: {
      type: Object,
      required: false,
      default: null,
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    handleImageError(event) {
      event.target.src = "/uploads/default_man.jpeg";
    },
  },
};
</script>

<style lang="scss" scoped>
/* Team Skeleton Styles */
.skeleton-team {
  opacity: 0.9;
}

.skeleton-team .skeleton-element {
  background: linear-gradient(90deg, #f1f5f9 0%, #ffffff 50%, #f1f5f9 100%);
  background-size: 200% 100%;
  animation: shimmer 1.8s infinite;
  border-radius: 6px;
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

/* Skeleton element dimensions */
.skeleton-team-image {
  width: 100%;
  height: 280px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.skeleton-team-name {
  width: 80%;
  height: 24px;
  margin-bottom: 10px;
  border-radius: 4px;
}

.skeleton-team-designation {
  width: 60%;
  height: 18px;
  margin-bottom: 15px;
  border-radius: 4px;
}

.skeleton-social-icon {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  margin-right: 8px;
  display: inline-block;
}

.skeleton-social-icon:last-child {
  margin-right: 0;
}

/* Ensure skeleton maintains the same layout as original */
.skeleton-team .team-content {
  padding: 20px 25px 25px;
}

.skeleton-team .team-social {
  margin-top: 15px;
}

.skeleton-team .th-social {
  display: flex;
  gap: 8px;
}

/* Responsive skeleton adjustments */
@media (max-width: 991px) {
  .skeleton-team-image {
    height: 250px;
  }
}

@media (max-width: 767px) {
  .skeleton-team-image {
    height: 220px;
  }
}

/* Fade-in animation for loaded content */
.team-card:not(.skeleton-team) {
  animation: fadeInTeam 0.5s ease-out;
}

@keyframes fadeInTeam {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
