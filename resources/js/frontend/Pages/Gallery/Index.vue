<template>
  <div class="gallery-wrapper">
    <!-- Hero Section -->
    <section class="gallery-hero">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <div class="container">
          <h1 class="hero-title">Our Gallery</h1>
          <p class="hero-subtitle">
            Explore our completed projects through images and videos
          </p>
          <div class="hero-stats">
            <div class="stat-item">
              <span class="stat-number">500+</span>
              <span class="stat-label">Project Photos</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">50+</span>
              <span class="stat-label">Project Videos</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">22+</span>
              <span class="stat-label">Years Experience</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Image Gallery Section -->
    <section class="gallery-section image-gallery">
      <div class="container">
        <div class="section-header">
          <div class="section-title-wrapper">
            <span class="section-icon">
              <i class="icon-picture"></i>
            </span>
            <h2 class="section-title">Image Gallery</h2>
            <p class="section-subtitle">
              Explore our construction projects through stunning visuals
            </p>
          </div>
          <Link href="/gallery/images" class="see-more-btn">
            <span>See All Images</span>
            <i class="icon-right-open"></i>
          </Link>
        </div>

        <div class="gallery-grid">
          <div
            class="gallery-item"
            v-for="(image, index) in featuredImages"
            :key="index"
          >
            <div class="gallery-item-wrapper">
              <img :src="image.src" :alt="image.title" class="gallery-image" />
              <div class="gallery-overlay">
                <div class="gallery-content">
                  <h3 class="gallery-title">{{ image.title }}</h3>
                  <p class="gallery-category">{{ image.category }}</p>
                  <button class="view-btn" @click="openLightbox(image)">
                    <i class="icon-zoom-in"></i>
                    View
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Video Gallery Section -->
    <section class="gallery-section video-gallery">
      <div class="container">
        <div class="section-header">
          <div class="section-title-wrapper">
            <span class="section-icon">
              <i class="icon-play"></i>
            </span>
            <h2 class="section-title">Video Gallery</h2>
            <p class="section-subtitle">
              Watch our construction projects come to life
            </p>
          </div>
          <Link href="/gallery/videos" class="see-more-btn">
            <span>See All Videos</span>
            <i class="icon-right-open"></i>
          </Link>
        </div>

        <div class="video-grid">
          <div
            class="video-item"
            v-for="(video, index) in featuredVideos"
            :key="index"
          >
            <div class="video-wrapper">
              <div class="video-thumbnail">
                <img
                  :src="video.thumbnail"
                  :alt="video.title"
                  class="thumbnail-image"
                />
                <div class="play-overlay">
                  <button class="play-btn" @click="openVideo(video)">
                    <i class="icon-play"></i>
                  </button>
                </div>
              </div>
              <div class="video-info">
                <h3 class="video-title">{{ video.title }}</h3>
                <!-- <p class="video-description">{{ video.description }}</p> -->
                <div class="video-meta">
                  <span class="video-duration">{{ video.duration }}</span>
                  <span class="video-category">{{ video.category }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Project Categories Section -->
    <section class="categories-section">
      <div class="container">
        <div class="section-header centered">
          <h2 class="section-title">Project Categories</h2>
          <p class="section-subtitle">Browse our work by project type</p>
        </div>

        <div class="categories-grid">
          <div
            class="category-item"
            v-for="(category, index) in projectCategories"
            :key="index"
          >
            <div class="category-wrapper">
              <div class="category-image">
                <img :src="category.image" :alt="category.name" />
                <div class="category-overlay">
                  <div class="category-content">
                    <i :class="category.icon" class="category-icon"></i>
                    <h3 class="category-name">{{ category.name }}</h3>
                    <p class="category-count">
                      {{ category.projectCount }} Projects
                    </p>
                    <Link :href="category.link" class="category-btn">
                      View Projects
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Lightbox Modal -->
    <div v-if="lightboxVisible" class="lightbox-overlay" @click="closeLightbox">
      <div class="lightbox-content" @click.stop>
        <button class="lightbox-close" @click="closeLightbox">
          <i class="icon-cancel"></i>
        </button>
        <img
          v-if="selectedMedia.type === 'image'"
          :src="selectedMedia.src"
          :alt="selectedMedia.title"
          class="lightbox-image"
        />
        <video
          v-if="selectedMedia.type === 'video'"
          :src="selectedMedia.src"
          controls
          class="lightbox-video"
        >
          Your browser does not support the video tag.
        </video>
        <div class="lightbox-info">
          <h3 class="lightbox-title">{{ selectedMedia.title }}</h3>
          <p class="lightbox-description">{{ selectedMedia.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

export default {
  components: {
    Link,
  },
  setup() {
    const lightboxVisible = ref(false);
    const selectedMedia = ref({});

    // Featured Images Data
    const featuredImages = ref([
      {
        src: "/assets/frontend/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1-480x270.jpg",
        title: "Residential Apartments Building",
        category: "Residential Projects",
        description: "Modern residential complex with premium amenities",
      },
      {
        src: "/assets/frontend/wp-content/uploads/2018/09/DSC_0578-480x319.jpg",
        title: "Commercial Complex",
        category: "Commercial Projects",
        description: "State-of-the-art commercial development",
      },
      {
        src: "/assets/frontend/wp-content/uploads/2017/01/DSC_4841_Easy-Resize.com_-480x319.jpg",
        title: "Educational Institution",
        category: "Educational Projects",
        description: "Modern school building with advanced facilities",
      },
      {
        src: "/assets/frontend/wp-content/uploads/2017/01/DSC_4964_Easy-Resize.com_-e1485699642693-480x380.jpg",
        title: "Mixed-Use Development",
        category: "Mixed Development",
        description: "Residential and commercial mixed-use project",
      },
      {
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3891-1700x800.jpg",
        title: "Luxury Villa Project",
        category: "Residential Projects",
        description: "Premium villa construction with modern design",
      },
      {
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3329-1700x800.jpg",
        title: "Office Complex",
        category: "Commercial Projects",
        description: "Professional office building with modern amenities",
      },
    ]);

    // Featured Videos Data
    const featuredVideos = ref([
      {
        thumbnail: "/assets/frontend/wp-content/uploads/2018/10/01_Banner.jpg",
        title: "Construction Progress - Residential Complex",
        description:
          "Time-lapse video showing the construction progress of our latest residential project",
        duration: "3:45",
        category: "Residential",
        src: "/videos/residential-progress.mp4",
        type: "video",
      },
      {
        thumbnail: "/assets/frontend/wp-content/uploads/2015/02/02_1.jpg",
        title: "Commercial Building Walkthrough",
        description:
          "Virtual tour of our completed commercial building project",
        duration: "5:20",
        category: "Commercial",
        src: "/videos/commercial-walkthrough.mp4",
        type: "video",
      },
      {
        thumbnail: "/assets/frontend/wp-content/uploads/2015/02/03_1.jpg",
        title: "Safety Training Video",
        description: "Our commitment to safety - training and procedures",
        duration: "2:15",
        category: "Safety",
        src: "/videos/safety-training.mp4",
        type: "video",
      },
      {
        thumbnail: "/assets/frontend/wp-content/uploads/2015/02/04_1.jpg",
        title: "Modern Construction Techniques",
        description: "Showcasing advanced construction methods and technology",
        duration: "4:30",
        category: "Technology",
        src: "/videos/construction-techniques.mp4",
        type: "video",
      },
    ]);

    // Project Categories Data
    const projectCategories = ref([
      {
        name: "Residential Projects",
        image: "/assets/frontend/wp-content/uploads/2015/02/03_2-480x400.jpg",
        icon: "icon-home",
        projectCount: 25,
        link: "/portfolio?category=residential",
      },
      {
        name: "Commercial Buildings",
        image:
          "/assets/frontend/wp-content/uploads/2015/04/DSC_4654-480x480.jpg",
        icon: "icon-briefcase",
        projectCount: 18,
        link: "/portfolio?category=commercial",
      },
      {
        name: "Educational Institutions",
        image:
          "/assets/frontend/wp-content/uploads/2015/02/DSC3009-480x480.jpg",
        icon: "icon-graduation-cap",
        projectCount: 12,
        link: "/portfolio?category=educational",
      },
      {
        name: "Mixed Development",
        image:
          "/assets/frontend/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1-480x270.jpg",
        icon: "icon-building",
        projectCount: 8,
        link: "/portfolio?category=mixed",
      },
    ]);

    // Methods
    const openLightbox = (media) => {
      selectedMedia.value = { ...media, type: "image" };
      lightboxVisible.value = true;
      document.body.style.overflow = "hidden";
    };

    const openVideo = (video) => {
      selectedMedia.value = video;
      lightboxVisible.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeLightbox = () => {
      lightboxVisible.value = false;
      selectedMedia.value = {};
      document.body.style.overflow = "";
    };

    // Handle escape key
    const handleKeydown = (event) => {
      if (event.key === "Escape" && lightboxVisible.value) {
        closeLightbox();
      }
    };

    onMounted(() => {
      document.addEventListener("keydown", handleKeydown);
    });

    return {
      featuredImages,
      featuredVideos,
      projectCategories,
      lightboxVisible,
      selectedMedia,
      openLightbox,
      openVideo,
      closeLightbox,
    };
  },
};
</script>

<style scoped>
/* Direct CSS Variables - Not using :root for scoped styles */

/* Gallery Wrapper */
.gallery-wrapper {
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

/* Hero Section */
.gallery-hero {
  position: relative;
  height: 60vh;
  min-height: 500px;
  background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}


.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("/uploads/property_dark/property_dark_15.jpeg") center center no-repeat;
  background-size: cover;
  opacity: 0.3;
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  width: 100%;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  background: #fff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  color: #fff;
}

.hero-subtitle {
  text-align: center;
  font-size: 1.25rem;
  color: #fff;
  margin-bottom: 3rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.hero-stats {
  display: flex;
  justify-content: center;
  gap: 3rem;
  flex-wrap: wrap;
}

.stat-item {
  text-align: center;
  padding: 1.5rem;
  background: rgba(26, 26, 26, 0.8);
  backdrop-filter: blur(20px);
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  min-width: 150px;
  transition: all 0.3s ease;
}

.stat-item:hover {
  transform: translateY(-5px);
  background: rgba(59, 130, 246, 0.1);
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
}

.stat-number {
  display: block;
  font-size: 2rem;
  font-weight: 700;
  color: #fbbf24;
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 0.9rem;
  color: #b0b0b0;
}

/* Gallery Sections */
.gallery-section {
  padding: 4rem 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.image-gallery {
  background: #1a1a1a;
}

.video-gallery {
  background: #0a0a0a;
}

.categories-section {
  background: #1a1a1a;
  border-bottom: none;
}

/* Section Headers */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 3rem;
  flex-wrap: wrap;
  gap: 2rem;
}

.section-header.centered {
  justify-content: center;
  text-align: center;
  flex-direction: column;
}

.section-title-wrapper {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.section-icon {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: white;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin: 0;
  background: #fff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.section-subtitle {
  color: #fff;
  margin: 0.5rem 0 0 0;
  font-size: 1.1rem;
}

/* See More Button */
.see-more-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  text-decoration: none;
  border-radius: 25px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.see-more-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
}

/* Gallery Grid */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 2rem;
}

.gallery-item {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  background: #2a2a2a;
  transition: all 0.3s ease;
}

.gallery-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.gallery-item-wrapper {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
  transform: scale(1.1);
}

.gallery-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
  display: flex;
  align-items: flex-end;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
  opacity: 1;
}

.gallery-content {
  padding: 1.5rem;
  width: 100%;
}

.gallery-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: white;
}

.gallery-category {
  color: #fbbf24;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.view-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  border: none;
  border-radius: 20px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.view-btn:hover {
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
  transform: scale(1.05);
}

/* Video Grid */
.video-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 2rem;
}

.video-item {
  background: #2a2a2a;
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.video-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
  border-color: #3b82f6;
}

.video-wrapper {
  display: flex;
  flex-direction: column;
  height: 100%;
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
  transition: background 0.3s ease;
}

.video-item:hover .play-overlay {
  background: rgba(0, 0, 0, 0.5);
}

.play-btn {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 2rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.play-btn:hover {
  transform: scale(1.1);
  background: linear-gradient(135deg, #fbbf24, #f59e0b);
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
}

.video-info {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.video-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.video-description {
  color: #b0b0b0;
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1rem;
  flex: 1;
}

.video-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.video-duration {
  color: #fbbf24;
  font-weight: 500;
  font-size: 0.9rem;
}

.video-category {
  color: #6b7280;
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Categories Grid */
.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

.category-item {
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.category-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.category-wrapper {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
}

.category-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.category-item:hover .category-image img {
  transform: scale(1.1);
}

.category-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg,
    rgba(59, 130, 246, 0.8),
    rgba(29, 78, 216, 0.8)
  );
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.category-item:hover .category-overlay {
  opacity: 1;
}

.category-content {
  text-align: center;
  padding: 2rem;
}

.category-icon {
  font-size: 3rem;
  color: white;
  margin-bottom: 1rem;
  display: block;
}

.category-name {
  font-size: 1.5rem;
  font-weight: 600;
  color: white;
  margin-bottom: 0.5rem;
}

.category-count {
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 1.5rem;
  font-size: 0.9rem;
}

.category-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: white;
  color: #3b82f6;
  text-decoration: none;
  border-radius: 25px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.category-btn:hover {
  background: #fbbf24;
  color: white;
  transform: scale(1.05);
}

/* Lightbox */
.lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.9);
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
  width: 40px;
  height: 40px;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  z-index: 1001;
  transition: all 0.3s ease;
}

.lightbox-close:hover {
  background: #3b82f6;
  transform: scale(1.1);
}

.lightbox-image,
.lightbox-video {
  max-width: 100%;
  max-height: 70vh;
  object-fit: contain;
  display: block;
}

.lightbox-info {
  padding: 1.5rem;
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
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .hero-stats {
    gap: 1.5rem;
  }

  .stat-item {
    min-width: 120px;
    padding: 1rem;
  }

  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .section-title {
    font-size: 2rem;
  }

  .gallery-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .video-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .categories-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .container {
    padding: 0 0.75rem;
  }

  .gallery-section {
    padding: 3rem 0;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }

  .gallery-grid {
    grid-template-columns: 1fr;
  }

  .video-grid {
    grid-template-columns: 1fr;
  }

  .play-btn {
    width: 60px;
    height: 60px;
    font-size: 1.5rem;
  }

  .lightbox-overlay {
    padding: 1rem;
  }
}

/* Animation Classes */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.gallery-item,
.video-item,
.category-item {
  animation: fadeInUp 0.6s ease-out;
}

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}
</style>
