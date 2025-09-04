<template>
  <div class="videos-gallery-wrapper">
    <!-- Header Section -->
    <header class="gallery-header">
      <div class="header-overlay"></div>
      <div class="container">
        <div class="header-content">
          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <Link href="/" class="breadcrumb-link">Home</Link>
            <span class="breadcrumb-separator">/</span>
            <Link href="/gallery" class="breadcrumb-link">Gallery</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Videos</span>
          </nav>

          <h1 class="page-title">Video Gallery</h1>
          <p class="page-subtitle">
            Explore our video portfolio showcasing construction projects,
            equipment demonstrations, and behind-the-scenes content
          </p>

          <div class="header-stats">
            <div class="stat-badge">
              <span class="stat-number">{{ videos.length }}</span>
              <span class="stat-label">Total Videos</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{ uniqueCategories.length }}</span>
              <span class="stat-label">Categories</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{
                Math.ceil(filteredVideos.length / itemsPerPage)
              }}</span>
              <span class="stat-label">Pages</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Filter Section -->
    <section class="filter-section">
      <div class="container">
        <div class="filter-wrapper">
          <div class="filter-title">
            <h3>Filter by Category</h3>
          </div>

          <div class="filter-tabs">
            <button
              @click="activeFilter = 'all'"
              :class="['filter-btn', { active: activeFilter === 'all' }]"
            >
              All Videos
            </button>
            <button
              v-for="category in uniqueCategories"
              :key="category"
              @click="activeFilter = category"
              :class="['filter-btn', { active: activeFilter === category }]"
            >
              {{ category }}
            </button>
          </div>

          <div class="view-toggle">
            <button
              @click="viewMode = 'grid'"
              :class="['view-btn', { active: viewMode === 'grid' }]"
              title="Grid View"
            >
              ⊞
            </button>
            <button
              @click="viewMode = 'list'"
              :class="['view-btn', { active: viewMode === 'list' }]"
              title="List View"
            >
              ☰
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Videos Section -->
    <section class="videos-section">
      <div class="container">
        <!-- Videos Grid -->
        <div :class="['videos-grid', viewMode]">
          <div
            v-for="video in paginatedVideos"
            :key="video.id"
            class="video-item"
            @click="openLightbox(video)"
          >
            <div class="video-wrapper">
              <div class="video-thumbnail">
                <img
                  :src="video.thumbnail"
                  :alt="video.title"
                  class="thumbnail-image"
                />
                <div class="play-overlay">
                  <div class="play-button">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                    >
                      <path d="M8 5v14l11-7z" />
                    </svg>
                  </div>
                </div>
                <div class="video-duration">{{ video.duration }}</div>
              </div>

              <div class="video-overlay">
                <div class="video-content">
                  <h3 class="video-title">{{ video.title }}</h3>
                  <span class="video-category">{{ video.category }}</span>
                  <p class="video-description">{{ video.description }}</p>

                  <div class="video-actions">
                    <button
                      @click.stop="playVideo(video)"
                      class="action-btn"
                      title="Play Video"
                    >
                      ▶
                    </button>
                    <button
                      @click.stop="openInfo(video)"
                      class="action-btn"
                      title="Video Info"
                    >
                      ⓘ
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
          <div class="pagination">
            <button
              @click="goToPage(currentPage - 1)"
              :disabled="currentPage === 1"
              class="pagination-btn"
            >
              ← Previous
            </button>

            <div class="pagination-numbers">
              <button
                v-for="page in visiblePages"
                :key="page"
                @click="goToPage(page)"
                :class="['pagination-number', { active: currentPage === page }]"
              >
                {{ page }}
              </button>
            </div>

            <button
              @click="goToPage(currentPage + 1)"
              :disabled="currentPage === totalPages"
              class="pagination-btn"
            >
              Next →
            </button>
          </div>

          <div class="pagination-info">
            Showing {{ startIndex + 1 }}-{{
              Math.min(endIndex, filteredVideos.length)
            }}
            of {{ filteredVideos.length }} videos
          </div>
        </div>
      </div>
    </section>

    <!-- Video Lightbox -->
    <div v-if="showLightbox" class="lightbox-overlay" @click="closeLightbox">
      <div class="lightbox-content" @click.stop>
        <button @click="closeLightbox" class="lightbox-close">×</button>

        <!-- Navigation -->
        <div class="lightbox-navigation">
          <button
            @click="previousVideo"
            :disabled="currentVideoIndex === 0"
            class="nav-btn"
          >
            ←
          </button>
          <button
            @click="nextVideo"
            :disabled="currentVideoIndex === filteredVideos.length - 1"
            class="nav-btn"
          >
            →
          </button>
        </div>

        <!-- Video Player -->
        <div class="video-player">
          <video
            ref="videoPlayer"
            :src="selectedVideo?.url"
            :poster="selectedVideo?.thumbnail"
            controls
            class="lightbox-video"
            @loadstart="onVideoLoad"
          >
            Your browser does not support the video tag.
          </video>
        </div>

        <!-- Video Info -->
        <div class="lightbox-info">
          <h2 class="lightbox-title">{{ selectedVideo?.title }}</h2>
          <p class="lightbox-description">{{ selectedVideo?.description }}</p>
          <div class="lightbox-meta">
            <span class="lightbox-category">{{ selectedVideo?.category }}</span>
            <span class="lightbox-date">{{ selectedVideo?.date }}</span>
            <span class="lightbox-duration">{{ selectedVideo?.duration }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Info Modal -->
    <div v-if="showInfoModal" class="info-modal-overlay" @click="closeInfo">
      <div class="info-modal-content" @click.stop>
        <button @click="closeInfo" class="modal-close">×</button>

        <div class="info-modal-body">
          <h2 class="info-title">{{ selectedInfoVideo?.title }}</h2>

          <div class="info-details">
            <div class="info-item">
              <span class="info-label">Category:</span>
              <span class="info-value">{{ selectedInfoVideo?.category }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Duration:</span>
              <span class="info-value">{{ selectedInfoVideo?.duration }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Date:</span>
              <span class="info-value">{{ selectedInfoVideo?.date }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Quality:</span>
              <span class="info-value">{{ selectedInfoVideo?.quality }}</span>
            </div>
          </div>

          <p class="info-description">{{ selectedInfoVideo?.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    Link,
  },
  setup() {
    // Reactive data
    const videos = ref([
      {
        id: 1,
        title: "Construction Site Overview",
        description:
          "Complete walkthrough of our latest commercial construction project showcasing modern building techniques.",
        category: "Commercial",
        thumbnail: "/uploads/video-thumbnails/construction-overview.jpg",
        url: "/uploads/videos/construction-overview.mp4",
        duration: "5:42",
        date: "December 2024",
        quality: "1080p HD",
      },
      {
        id: 2,
        title: "Heavy Equipment Operation",
        description:
          "Professional demonstration of excavator and crane operations on construction site.",
        category: "Equipment",
        thumbnail: "/uploads/video-thumbnails/heavy-equipment.jpg",
        url: "/uploads/videos/heavy-equipment.mp4",
        duration: "3:28",
        date: "November 2024",
        quality: "4K UHD",
      },
      {
        id: 3,
        title: "Residential Foundation Pour",
        description:
          "Time-lapse video of concrete foundation pouring for luxury residential development.",
        category: "Residential",
        thumbnail: "/uploads/video-thumbnails/foundation-pour.jpg",
        url: "/uploads/videos/foundation-pour.mp4",
        duration: "2:15",
        date: "November 2024",
        quality: "1080p HD",
      },
      {
        id: 4,
        title: "Safety Training Session",
        description:
          "Comprehensive safety training video covering construction site protocols and procedures.",
        category: "Training",
        thumbnail: "/uploads/video-thumbnails/safety-training.jpg",
        url: "/uploads/videos/safety-training.mp4",
        duration: "12:34",
        date: "October 2024",
        quality: "1080p HD",
      },
      {
        id: 5,
        title: "Office Building Progress",
        description:
          "Monthly progress update on downtown office building construction project.",
        category: "Commercial",
        thumbnail: "/uploads/video-thumbnails/office-progress.jpg",
        url: "/uploads/videos/office-progress.mp4",
        duration: "4:56",
        date: "October 2024",
        quality: "1080p HD",
      },
      {
        id: 6,
        title: "Crane Installation Process",
        description:
          "Step-by-step process of tower crane installation and setup on construction site.",
        category: "Equipment",
        thumbnail: "/uploads/video-thumbnails/crane-installation.jpg",
        url: "/uploads/videos/crane-installation.mp4",
        duration: "8:19",
        date: "September 2024",
        quality: "4K UHD",
      },
      {
        id: 7,
        title: "Home Renovation Timelapse",
        description:
          "Complete home renovation project from demolition to final touches in fast-forward.",
        category: "Residential",
        thumbnail: "/uploads/video-thumbnails/home-renovation.jpg",
        url: "/uploads/videos/home-renovation.mp4",
        duration: "6:42",
        date: "September 2024",
        quality: "1080p HD",
      },
      {
        id: 8,
        title: "Concrete Mixing Techniques",
        description:
          "Professional concrete mixing and pouring techniques for optimal structural integrity.",
        category: "Training",
        thumbnail: "/uploads/video-thumbnails/concrete-mixing.jpg",
        url: "/uploads/videos/concrete-mixing.mp4",
        duration: "7:23",
        date: "August 2024",
        quality: "1080p HD",
      },
      {
        id: 9,
        title: "Shopping Mall Construction",
        description:
          "Behind-the-scenes look at large-scale shopping mall construction project.",
        category: "Commercial",
        thumbnail: "/uploads/video-thumbnails/mall-construction.jpg",
        url: "/uploads/videos/mall-construction.mp4",
        duration: "9:15",
        date: "August 2024",
        quality: "4K UHD",
      },
      {
        id: 10,
        title: "Bulldozer Operations",
        description:
          "Professional bulldozer operation for site preparation and earth moving.",
        category: "Equipment",
        thumbnail: "/uploads/video-thumbnails/bulldozer-ops.jpg",
        url: "/uploads/videos/bulldozer-ops.mp4",
        duration: "4:33",
        date: "July 2024",
        quality: "1080p HD",
      },
      {
        id: 11,
        title: "Kitchen Remodeling Guide",
        description:
          "Complete kitchen remodeling process from design to final installation.",
        category: "Residential",
        thumbnail: "/uploads/video-thumbnails/kitchen-remodel.jpg",
        url: "/uploads/videos/kitchen-remodel.mp4",
        duration: "11:28",
        date: "July 2024",
        quality: "1080p HD",
      },
      {
        id: 12,
        title: "Electrical Safety Protocols",
        description:
          "Essential electrical safety protocols and procedures for construction workers.",
        category: "Training",
        thumbnail: "/uploads/video-thumbnails/electrical-safety.jpg",
        url: "/uploads/videos/electrical-safety.mp4",
        duration: "8:45",
        date: "June 2024",
        quality: "1080p HD",
      },
    ]);

    const activeFilter = ref("all");
    const viewMode = ref("grid");
    const currentPage = ref(1);
    const itemsPerPage = ref(8);
    const showLightbox = ref(false);
    const showInfoModal = ref(false);
    const selectedVideo = ref(null);
    const selectedInfoVideo = ref(null);
    const currentVideoIndex = ref(0);
    const videoPlayer = ref(null);

    // Computed properties
    const uniqueCategories = computed(() => {
      return [...new Set(videos.value.map((video) => video.category))].sort();
    });

    const filteredVideos = computed(() => {
      if (activeFilter.value === "all") {
        return videos.value;
      }
      return videos.value.filter(
        (video) => video.category === activeFilter.value
      );
    });

    const totalPages = computed(() => {
      return Math.ceil(filteredVideos.value.length / itemsPerPage.value);
    });

    const startIndex = computed(() => {
      return (currentPage.value - 1) * itemsPerPage.value;
    });

    const endIndex = computed(() => {
      return startIndex.value + itemsPerPage.value;
    });

    const paginatedVideos = computed(() => {
      return filteredVideos.value.slice(startIndex.value, endIndex.value);
    });

    const visiblePages = computed(() => {
      const pages = [];
      const start = Math.max(1, currentPage.value - 2);
      const end = Math.min(totalPages.value, currentPage.value + 2);

      for (let i = start; i <= end; i++) {
        pages.push(i);
      }

      return pages;
    });

    // Methods
    const goToPage = (page) => {
      if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        // Scroll to top of videos section
        document
          .querySelector(".videos-section")
          .scrollIntoView({ behavior: "smooth" });
      }
    };

    const openLightbox = (video) => {
      selectedVideo.value = video;
      currentVideoIndex.value = filteredVideos.value.findIndex(
        (v) => v.id === video.id
      );
      showLightbox.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeLightbox = () => {
      showLightbox.value = false;
      selectedVideo.value = null;
      document.body.style.overflow = "auto";

      // Pause video if playing
      if (videoPlayer.value) {
        videoPlayer.value.pause();
      }
    };

    const previousVideo = () => {
      if (currentVideoIndex.value > 0) {
        currentVideoIndex.value--;
        selectedVideo.value = filteredVideos.value[currentVideoIndex.value];
      }
    };

    const nextVideo = () => {
      if (currentVideoIndex.value < filteredVideos.value.length - 1) {
        currentVideoIndex.value++;
        selectedVideo.value = filteredVideos.value[currentVideoIndex.value];
      }
    };

    const playVideo = (video) => {
      openLightbox(video);
      // Auto-play when lightbox opens
      setTimeout(() => {
        if (videoPlayer.value) {
          videoPlayer.value.play();
        }
      }, 100);
    };

    const onVideoLoad = () => {
      // Video loaded, can add additional logic here
      console.log("Video loaded successfully");
    };

    const openInfo = (video) => {
      selectedInfoVideo.value = video;
      showInfoModal.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeInfo = () => {
      showInfoModal.value = false;
      selectedInfoVideo.value = null;
      document.body.style.overflow = "auto";
    };

    // Keyboard navigation
    const handleKeydown = (event) => {
      if (showLightbox.value) {
        switch (event.key) {
          case "Escape":
            closeLightbox();
            break;
          case "ArrowLeft":
            previousVideo();
            break;
          case "ArrowRight":
            nextVideo();
            break;
        }
      }

      if (showInfoModal.value && event.key === "Escape") {
        closeInfo();
      }
    };

    // Reset pagination when filter changes
    const resetPagination = () => {
      currentPage.value = 1;
    };

    // Watch for filter changes
    const updateFilter = (category) => {
      activeFilter.value = category;
      resetPagination();
    };

    // Lifecycle hooks
    onMounted(() => {
      document.addEventListener("keydown", handleKeydown);
    });

    onUnmounted(() => {
      document.removeEventListener("keydown", handleKeydown);
      document.body.style.overflow = "auto";
    });

    return {
      // Data
      videos,
      activeFilter,
      viewMode,
      currentPage,
      itemsPerPage,
      showLightbox,
      showInfoModal,
      selectedVideo,
      selectedInfoVideo,
      currentVideoIndex,
      videoPlayer,

      // Computed
      uniqueCategories,
      filteredVideos,
      totalPages,
      startIndex,
      endIndex,
      paginatedVideos,
      visiblePages,

      // Methods
      goToPage,
      openLightbox,
      closeLightbox,
      previousVideo,
      nextVideo,
      playVideo,
      onVideoLoad,
      openInfo,
      closeInfo,
      updateFilter,
      resetPagination,
    };
  },
};
</script>

<style scoped>
/* Videos Gallery Wrapper */
.videos-gallery-wrapper {
  background: #0a0a0a;
  min-height: 100vh;
  color: #ffffff;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

/* Header Section */
.gallery-header {
  position: relative;
  height: 50vh;
  min-height: 400px;
  background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.header-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("/uploads/property_dark/property_dark_12.jpeg") center center no-repeat;
  background-size: cover;
  opacity: 0.3;
  z-index: 1;
}

.header-content {
  position: relative;
  z-index: 2;
  text-align: center;
  width: 100%;
}

/* Breadcrumb */
.breadcrumb {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 2rem;
  gap: 0.5rem;
}

.breadcrumb-link {
  color: #b0b0b0;
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcrumb-link:hover {
  color: #a855f7;
}

.breadcrumb-separator {
  color: #6b7280;
}

.breadcrumb-current {
  color: #fbbf24;
  font-weight: 500;
}

.page-title {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
  background: #fff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.page-subtitle {
    text-align: center;
  font-size: 1.2rem;
  color: #fff;
  margin-bottom: 2rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.header-stats {
  display: flex;
  justify-content: center;
  gap: 2rem;
}

.stat-badge {
  text-align: center;
  padding: 1rem 1.5rem;
  background: rgba(26, 26, 26, 0.8);
  backdrop-filter: blur(20px);
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-number {
  display: block;
  font-size: 1.5rem;
  font-weight: 700;
  color: #fbbf24;
  margin-bottom: 0.25rem;
}

.stat-label {
  font-size: 0.9rem;
  color: #b0b0b0;
}

/* Filter Section */
.filter-section {
  background: #1a1a1a;
  padding: 2rem 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.filter-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 2rem;
}

.filter-title h3 {
  color: #ffffff;
  margin: 0;
  font-size: 1.2rem;
  font-weight: 600;
}

.filter-tabs {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.filter-btn {
  padding: 0.75rem 1.5rem;
  background: #2a2a2a;
  color: #b0b0b0;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
}

.filter-btn:hover,
.filter-btn.active {
  background: linear-gradient(135deg, #a855f7, #8b5cf6);
  color: white;
  border-color: transparent;
}

.view-toggle {
  display: flex;
  gap: 0.5rem;
}

.view-btn {
  width: 40px;
  height: 40px;
  background: #2a2a2a;
  color: #b0b0b0;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.view-btn:hover,
.view-btn.active {
  background: #a855f7;
  color: white;
  border-color: transparent;
}

/* Videos Section */
.videos-section {
  padding: 4rem 0;
  background: #0a0a0a;
}

.videos-grid {
  display: grid;
  gap: 2rem;
  margin-bottom: 4rem;
}

.videos-grid.grid {
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
}

.videos-grid.list {
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

.video-item {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  background: #2a2a2a;
  transition: all 0.3s ease;
  cursor: pointer;
}

.video-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.video-wrapper {
  position: relative;
  width: 100%;
}

.video-thumbnail {
  position: relative;
  aspect-ratio: 16/9;
  overflow: hidden;
}

.thumbnail-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.video-item:hover .thumbnail-image {
  transform: scale(1.05);
}

.play-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
}

.play-button {
  width: 60px;
  height: 60px;
  background: rgba(168, 85, 247, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transition: all 0.3s ease;
  transform: scale(0.8);
}

.video-item:hover .play-button {
  transform: scale(1);
  background: #a855f7;
}

.video-duration {
  position: absolute;
  bottom: 0.5rem;
  right: 0.5rem;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: 500;
}

.video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
  display: flex;
  align-items: flex-end;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.video-item:hover .video-overlay {
  opacity: 1;
}

.video-content {
  padding: 1.5rem;
  width: 100%;
}

.video-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: white;
}

.video-category {
  color: #fbbf24;
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
  display: block;
}

.video-description {
  color: #b0b0b0;
  font-size: 0.9rem;
  line-height: 1.4;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.video-actions {
  display: flex;
  gap: 0.5rem;
}

.action-btn {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border: none;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.action-btn:hover {
  background: #a855f7;
  transform: scale(1.1);
}

/* List View Specific Styles */
.videos-grid.list .video-item {
  display: flex;
  flex-direction: row;
  height: 200px;
}

.videos-grid.list .video-thumbnail {
  width: 350px;
  flex-shrink: 0;
}

.videos-grid.list .video-overlay {
  position: relative;
  opacity: 1;
  background: #2a2a2a;
  flex: 1;
  display: flex;
  align-items: center;
}

.videos-grid.list .video-content {
  padding: 2rem;
}

.videos-grid.list .video-description {
  -webkit-line-clamp: 3;
  line-clamp: 3;
}

/* Pagination */
.pagination-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.pagination {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.pagination-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: #2a2a2a;
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
}

.pagination-btn:hover:not(:disabled) {
  background: #a855f7;
  border-color: transparent;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-numbers {
  display: flex;
  gap: 0.5rem;
}

.pagination-number {
  width: 40px;
  height: 40px;
  background: #2a2a2a;
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 500;
}

.pagination-number:hover,
.pagination-number.active {
  background: #a855f7;
  border-color: transparent;
}

.pagination-info {
  color: #b0b0b0;
  font-size: 0.9rem;
}

/* Lightbox */
.lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.95);
  backdrop-filter: blur(10px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 2rem;
}

.lightbox-content {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
  background: #1a1a1a;
  border-radius: 15px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.lightbox-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 45px;
  height: 45px;
  background: rgba(0, 0, 0, 0.7);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  z-index: 1001;
  transition: all 0.3s ease;
}

.lightbox-close:hover {
  background: #a855f7;
}

.lightbox-navigation {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  padding: 0 1rem;
  z-index: 1001;
}

.nav-btn {
  width: 50px;
  height: 50px;
  background: rgba(0, 0, 0, 0.7);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.nav-btn:hover:not(:disabled) {
  background: #a855f7;
}

.nav-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.video-player {
  position: relative;
  background: #000;
}

.lightbox-video {
  max-width: 100%;
  max-height: 70vh;
  width: 100%;
  display: block;
}

.lightbox-info {
  padding: 2rem;
  text-align: center;
}

.lightbox-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.lightbox-description {
  color: #b0b0b0;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.lightbox-meta {
  display: flex;
  justify-content: center;
  gap: 2rem;
  font-size: 0.9rem;
}

.lightbox-category {
  color: #fbbf24;
  font-weight: 500;
}

.lightbox-date {
  color: #6b7280;
}

.lightbox-duration {
  color: #a855f7;
  font-weight: 500;
}

/* Info Modal */
.info-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(5px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 2rem;
}

.info-modal-content {
  position: relative;
  max-width: 500px;
  width: 100%;
  background: #1a1a1a;
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 35px;
  height: 35px;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.modal-close:hover {
  background: #a855f7;
}

.info-modal-body {
  padding: 2rem;
}

.info-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  color: #ffffff;
}

.info-details {
  margin-bottom: 1.5rem;
}

.info-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.75rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.info-label {
  color: #b0b0b0;
  font-weight: 500;
}

.info-value {
  color: #ffffff;
}

.info-description {
  color: #b0b0b0;
  line-height: 1.6;
  margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
  .page-title {
    font-size: 2rem;
  }

  .filter-wrapper {
    flex-direction: column;
    align-items: stretch;
  }

  .filter-tabs {
    justify-content: center;
  }

  .videos-grid.grid {
    grid-template-columns: 1fr;
  }

  .videos-grid.list {
    grid-template-columns: 1fr;
  }

  .videos-grid.list .video-item {
    flex-direction: column;
    height: auto;
  }

  .videos-grid.list .video-thumbnail {
    width: 100%;
  }

  .header-stats {
    flex-direction: column;
    gap: 1rem;
  }

  .pagination {
    flex-wrap: wrap;
    justify-content: center;
  }

  .pagination-numbers {
    order: -1;
  }

  .lightbox-overlay {
    padding: 1rem;
  }

  .lightbox-navigation {
    padding: 0 0.5rem;
  }

  .lightbox-meta {
    flex-direction: column;
    gap: 0.5rem;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 0.75rem;
  }

  .page-title {
    font-size: 1.8rem;
  }

  .filter-btn {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }

  .nav-btn {
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
  }

  .videos-grid.grid {
    grid-template-columns: 1fr;
  }

  .video-content {
    padding: 1rem;
  }
}
</style>
