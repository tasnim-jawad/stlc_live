<template>
  <div
    v-for="(item, index) in videos"
    :key="index"
    :class="`col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item fadeinup wow animated`"
  >
    <div class="video-card">
      <div class="video-wrapper">
        <iframe
          v-if="item.video"
          :src="item.video + '?autoplay=0&mute=0&controls=1'"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen
          width="100%"
          height="250"
          loading="lazy"
          class="video-iframe"
        ></iframe>
        <div v-else class="no-video">
          <i class="fa-solid fa-video-slash"></i>
          <p>No video available</p>
        </div>
      </div>
      <div class="video-info">
        <h5 class="video-title">{{ item.title }}</h5>
        <div class="video-meta">
          <span class="video-date">
            <i class="fa-regular fa-calendar"></i>
            {{ formatDate(item.created_at) }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    videos: {
      type: Array,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
      });
    },
  },
  mounted() {
    // No magnific-popup needed since videos are embedded
  },
  created: function () {
    console.log("Videos in gallery videos:", this.videos);
  },
};
</script>

<style lang="scss" scoped>
.video-card {
  background: var(--white-color);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  margin-bottom: 30px;

  &:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
  }
}

.video-wrapper {
  position: relative;
  overflow: hidden;
  border-radius: 16px 16px 0 0;
  background: linear-gradient(
    135deg,
    var(--theme-color) 0%,
    var(--theme-color2) 100%
  );

  .video-iframe {
    border-radius: 16px 16px 0 0;
    transition: transform 0.3s ease;

    &:hover {
      transform: scale(1.02);
    }
  }

  .no-video {
    height: 250px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--white-color);

    i {
      font-size: 48px;
      margin-bottom: 16px;
      opacity: 0.7;
    }

    p {
      font-size: 18px;
      margin: 0;
      font-weight: 500;
    }
  }
}

.video-info {
  padding: 20px;
}

.video-title {
  font-size: 18px;
  font-weight: 600;
  color: var(--title-color);
  margin: 0 0 12px 0;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  font-family: var(--title-font);

  &:hover {
    color: var(--theme-color);
  }
}

.video-meta {
  display: flex;
  align-items: center;
  gap: 16px;
}

.video-date {
  display: flex;
  align-items: center;
  gap: 6px;
  color: var(--body-color);
  font-size: 14px;
  font-weight: 500;
  font-family: var(--body-font);

  i {
    color: var(--theme-color);
  }
}

// Responsive design
@media (max-width: 768px) {
  .video-card {
    margin-bottom: 20px;
  }

  .video-wrapper {
    .video-iframe,
    .no-video {
      height: 200px;
    }
  }

  .video-info {
    padding: 16px;
  }

  .video-title {
    font-size: 16px;
  }
}

@media (max-width: 576px) {
  .video-wrapper {
    .video-iframe,
    .no-video {
      height: 180px;
    }
  }

  .video-title {
    font-size: 15px;
  }
}
</style>
