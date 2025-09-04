<template>
  <div class="images-gallery-wrapper">
    <!-- Header Section -->
    <section class="gallery-header">
      <div class="header-overlay"></div>
      <div class="header-content">
        <div class="container">
          <nav class="breadcrumb">
            <Link href="/" class="breadcrumb-link">Home</Link>
            <span class="breadcrumb-separator">/</span>
            <Link href="/gallery" class="breadcrumb-link">Gallery</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Images</span>
          </nav>
          <h1 class="page-title">Image Gallery</h1>
          <p class="page-subtitle">
            Explore our construction projects through stunning visuals
          </p>
          <div class="header-stats">
            <div class="stat-badge">
              <span class="stat-number">{{ totalImages }}</span>
              <span class="stat-label">Total Images</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{ filteredImages.length }}</span>
              <span class="stat-label">Showing</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
      <div class="container">
        <div class="filter-wrapper">
          <div class="filter-title">
            <h3>Filter by Category</h3>
          </div>
          <div class="filter-tabs">
            <button
              class="filter-btn"
              :class="{ active: selectedCategory === 'all' }"
              @click="filterImages('all')"
            >
              All Images
            </button>
            <button
              v-for="category in categories"
              :key="category"
              class="filter-btn"
              :class="{ active: selectedCategory === category }"
              @click="filterImages(category)"
            >
              {{ category }}
            </button>
          </div>
          <div class="view-toggle">
            <button
              class="view-btn"
              :class="{ active: gridView === 'grid' }"
              @click="setGridView('grid')"
              title="Grid View"
            >
              <i class="icon-th"></i>
            </button>
            <button
              class="view-btn"
              :class="{ active: gridView === 'masonry' }"
              @click="setGridView('masonry')"
              title="Masonry View"
            >
              <i class="icon-th-large"></i>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Images Grid -->
    <section class="images-section">
      <div class="container">
        <div class="images-grid" :class="gridView">
          <div
            v-for="(image, index) in paginatedImages"
            :key="image.id"
            class="image-item"
            @click="openLightbox(image, index)"
          >
            <div class="image-wrapper">
              <img
                :src="image.src"
                :alt="image.title"
                class="gallery-image"
                loading="lazy"
              />
              <div class="image-overlay">
                <div class="image-content">
                  <h3 class="image-title">{{ image.title }}</h3>
                  <p class="image-category">{{ image.category }}</p>
                  <div class="image-actions">
                    <button class="action-btn zoom-btn">
                      <i class="icon-zoom-in"></i>
                    </button>
                    <button
                      class="action-btn info-btn"
                      @click.stop="showImageInfo(image)"
                    >
                      <i class="icon-info"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="pagination-wrapper">
          <div class="pagination">
            <button
              class="pagination-btn prev-btn"
              :disabled="currentPage === 1"
              @click="changePage(currentPage - 1)"
            >
              <i class="icon-left-open"></i>
              Previous
            </button>

            <div class="pagination-numbers">
              <button
                v-for="page in visiblePages"
                :key="page"
                class="pagination-number"
                :class="{ active: page === currentPage }"
                @click="changePage(page)"
              >
                {{ page }}
              </button>
            </div>

            <button
              class="pagination-btn next-btn"
              :disabled="currentPage === totalPages"
              @click="changePage(currentPage + 1)"
            >
              Next
              <i class="icon-right-open"></i>
            </button>
          </div>

          <div class="pagination-info">
            Showing {{ startIndex + 1 }}-{{ endIndex }} of
            {{ filteredImages.length }} images
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
        <div class="lightbox-navigation">
          <button
            class="nav-btn prev-nav"
            :disabled="currentImageIndex === 0"
            @click="navigateImage(-1)"
          >
            <i class="icon-left-open"></i>
          </button>
          <button
            class="nav-btn next-nav"
            :disabled="currentImageIndex === filteredImages.length - 1"
            @click="navigateImage(1)"
          >
            <i class="icon-right-open"></i>
          </button>
        </div>
        <img
          :src="selectedImage.src"
          :alt="selectedImage.title"
          class="lightbox-image"
        />
        <div class="lightbox-info">
          <h3 class="lightbox-title">{{ selectedImage.title }}</h3>
          <p class="lightbox-description">{{ selectedImage.description }}</p>
          <div class="lightbox-meta">
            <span class="lightbox-category">{{ selectedImage.category }}</span>
            <span class="lightbox-date">{{ selectedImage.date }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Image Info Modal -->
    <div
      v-if="infoModalVisible"
      class="info-modal-overlay"
      @click="closeInfoModal"
    >
      <div class="info-modal-content" @click.stop>
        <button class="modal-close" @click="closeInfoModal">
          <i class="icon-cancel"></i>
        </button>
        <div class="info-modal-body">
          <h3 class="info-title">{{ infoImage.title }}</h3>
          <div class="info-details">
            <div class="info-item">
              <span class="info-label">Category:</span>
              <span class="info-value">{{ infoImage.category }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Project:</span>
              <span class="info-value">{{ infoImage.project }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Date:</span>
              <span class="info-value">{{ infoImage.date }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Location:</span>
              <span class="info-value">{{ infoImage.location }}</span>
            </div>
          </div>
          <p class="info-description">{{ infoImage.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { ref, computed, onMounted } from "vue";

export default {
  components: {
    Link,
  },
  setup() {
    // Reactive data
    const selectedCategory = ref("all");
    const gridView = ref("grid");
    const currentPage = ref(1);
    const itemsPerPage = ref(12);
    const lightboxVisible = ref(false);
    const infoModalVisible = ref(false);
    const selectedImage = ref({});
    const infoImage = ref({});
    const currentImageIndex = ref(0);

    // Sample images data - replace with actual data from API
    const allImages = ref([
      {
        id: 1,
        src: "/assets/frontend/wp-content/uploads/2018/09/J-257-INMA-Ghubrah-Residential-View-1-480x270.jpg",
        title: "Residential Apartments Building - Main View",
        category: "Residential",
        description:
          "Modern residential complex with premium amenities and contemporary design",
        project: "INMA Residential Complex",
        date: "2023-09-15",
        location: "Al Gubrah, Muscat",
      },
      {
        id: 2,
        src: "/assets/frontend/wp-content/uploads/2018/09/DSC_0578-480x319.jpg",
        title: "Commercial Complex - Exterior View",
        category: "Commercial",
        description:
          "State-of-the-art commercial development with modern architecture",
        project: "BADR Commercial Complex",
        date: "2023-08-20",
        location: "Muscat, Oman",
      },
      {
        id: 3,
        src: "/assets/frontend/wp-content/uploads/2017/01/DSC_4841_Easy-Resize.com_-480x319.jpg",
        title: "Educational Institution - Main Building",
        category: "Educational",
        description:
          "Modern school building with advanced facilities and learning spaces",
        project: "Indian School Wadi Kabir",
        date: "2023-07-10",
        location: "Wadi Kabir, Muscat",
      },
      {
        id: 4,
        src: "/assets/frontend/wp-content/uploads/2017/01/DSC_4964_Easy-Resize.com_-e1485699642693-480x380.jpg",
        title: "Mixed-Use Development - Street View",
        category: "Mixed Development",
        description:
          "Residential and commercial mixed-use project with integrated design",
        project: "Shatti Al Qurum Complex",
        date: "2023-06-25",
        location: "Shatti Al Qurum, Muscat",
      },
      {
        id: 5,
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3891-1700x800.jpg",
        title: "Luxury Villa Project - Facade",
        category: "Residential",
        description:
          "Premium villa construction with modern design and luxury finishes",
        project: "Premium Villas Development",
        date: "2023-05-15",
        location: "Al Mouj, Muscat",
      },
      {
        id: 6,
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3329-1700x800.jpg",
        title: "Office Complex - Interior View",
        category: "Commercial",
        description:
          "Professional office building with modern amenities and workspace design",
        project: "Corporate Office Tower",
        date: "2023-04-30",
        location: "CBD, Muscat",
      },
      {
        id: 7,
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3193-1700x800.jpg",
        title: "Construction Progress - Phase 1",
        category: "Industrial",
        description:
          "Industrial facility construction showing structural progress",
        project: "Manufacturing Facility",
        date: "2023-03-20",
        location: "Sohar Industrial Zone",
      },
      {
        id: 8,
        src: "/assets/frontend/wp-content/uploads/2015/02/03_2-480x400.jpg",
        title: "Residential Complex - Aerial View",
        category: "Residential",
        description:
          "Comprehensive residential development with community facilities",
        project: "Garden City Residences",
        date: "2023-02-10",
        location: "Bausher, Muscat",
      },
      // Add more images to demonstrate pagination...
      {
        id: 9,
        src: "/assets/frontend/wp-content/uploads/2015/04/DSC_4654-480x480.jpg",
        title: "Hospital Construction - Main Wing",
        category: "Healthcare",
        description:
          "Modern healthcare facility with advanced medical infrastructure",
        project: "Regional Medical Center",
        date: "2023-01-15",
        location: "Nizwa, Oman",
      },
      {
        id: 10,
        src: "/assets/frontend/wp-content/uploads/2015/02/DSC3009-480x480.jpg",
        title: "Educational Campus - Library Building",
        category: "Educational",
        description:
          "University library with modern learning resources and study spaces",
        project: "Higher Education Campus",
        date: "2022-12-20",
        location: "Seeb, Muscat",
      },
      {
        id: 11,
        src: "/assets/frontend/wp-content/uploads/2018/10/01_Banner.jpg",
        title: "Shopping Mall - Grand Entrance",
        category: "Commercial",
        description:
          "Large retail complex with entertainment and dining facilities",
        project: "Grand Mall Project",
        date: "2022-11-25",
        location: "Qurum, Muscat",
      },
      {
        id: 12,
        src: "/assets/frontend/wp-content/uploads/2015/02/02_1.jpg",
        title: "Warehouse Complex - Loading Bay",
        category: "Industrial",
        description:
          "Logistics and storage facility with modern warehouse technology",
        project: "Logistics Hub",
        date: "2022-10-30",
        location: "Barka Industrial Area",
      },
      {
        id: 13,
        src: "/assets/frontend/wp-content/uploads/2015/02/03_1.jpg",
        title: "Hotel Construction - Tower View",
        category: "Commercial",
        description: "Luxury hotel development with panoramic city views",
        project: "Grand Hotel & Suites",
        date: "2022-09-15",
        location: "Muttrah, Muscat",
      },
      {
        id: 14,
        src: "/assets/frontend/wp-content/uploads/2015/02/04_1.jpg",
        title: "Residential Towers - Construction Phase",
        category: "Residential",
        description: "High-rise residential towers with modern living spaces",
        project: "Sky Towers Residence",
        date: "2022-08-20",
        location: "Al Khuwair, Muscat",
      },
      {
        id: 15,
        src: "/assets/frontend/wp-content/uploads/2021/03/Unique-1040x592.jpg",
        title: "Safety Training Facility",
        category: "Industrial",
        description:
          "Specialized training center for construction safety protocols",
        project: "HSE Training Center",
        date: "2022-07-10",
        location: "Muscat Industrial Estate",
      },
    ]);

    // Computed properties
    const categories = computed(() => {
      const cats = [...new Set(allImages.value.map((img) => img.category))];
      return cats.sort();
    });

    const filteredImages = computed(() => {
      if (selectedCategory.value === "all") {
        return allImages.value;
      }
      return allImages.value.filter(
        (img) => img.category === selectedCategory.value
      );
    });

    const totalImages = computed(() => allImages.value.length);

    const totalPages = computed(() => {
      return Math.ceil(filteredImages.value.length / itemsPerPage.value);
    });

    const startIndex = computed(() => {
      return (currentPage.value - 1) * itemsPerPage.value;
    });

    const endIndex = computed(() => {
      return Math.min(
        startIndex.value + itemsPerPage.value,
        filteredImages.value.length
      );
    });

    const paginatedImages = computed(() => {
      return filteredImages.value.slice(startIndex.value, endIndex.value);
    });

    const visiblePages = computed(() => {
      const pages = [];
      const maxVisible = 5;
      let start = Math.max(1, currentPage.value - Math.floor(maxVisible / 2));
      let end = Math.min(totalPages.value, start + maxVisible - 1);

      if (end - start + 1 < maxVisible) {
        start = Math.max(1, end - maxVisible + 1);
      }

      for (let i = start; i <= end; i++) {
        pages.push(i);
      }

      return pages;
    });

    // Methods
    const filterImages = (category) => {
      selectedCategory.value = category;
      currentPage.value = 1; // Reset to first page when filtering
    };

    const setGridView = (view) => {
      gridView.value = view;
    };

    const changePage = (page) => {
      if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        // Scroll to top of images section
        document.querySelector(".images-section").scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    };

    const openLightbox = (image, index) => {
      selectedImage.value = image;
      currentImageIndex.value = filteredImages.value.findIndex(
        (img) => img.id === image.id
      );
      lightboxVisible.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeLightbox = () => {
      lightboxVisible.value = false;
      selectedImage.value = {};
      document.body.style.overflow = "";
    };

    const navigateImage = (direction) => {
      const newIndex = currentImageIndex.value + direction;
      if (newIndex >= 0 && newIndex < filteredImages.value.length) {
        currentImageIndex.value = newIndex;
        selectedImage.value = filteredImages.value[newIndex];
      }
    };

    const showImageInfo = (image) => {
      infoImage.value = image;
      infoModalVisible.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeInfoModal = () => {
      infoModalVisible.value = false;
      infoImage.value = {};
      document.body.style.overflow = "";
    };

    // Handle keyboard navigation
    const handleKeydown = (event) => {
      if (lightboxVisible.value) {
        switch (event.key) {
          case "Escape":
            closeLightbox();
            break;
          case "ArrowLeft":
            navigateImage(-1);
            break;
          case "ArrowRight":
            navigateImage(1);
            break;
        }
      }
      if (infoModalVisible.value && event.key === "Escape") {
        closeInfoModal();
      }
    };

    onMounted(() => {
      document.addEventListener("keydown", handleKeydown);
    });

    return {
      selectedCategory,
      gridView,
      currentPage,
      itemsPerPage,
      lightboxVisible,
      infoModalVisible,
      selectedImage,
      infoImage,
      currentImageIndex,
      allImages,
      categories,
      filteredImages,
      totalImages,
      totalPages,
      startIndex,
      endIndex,
      paginatedImages,
      visiblePages,
      filterImages,
      setGridView,
      changePage,
      openLightbox,
      closeLightbox,
      navigateImage,
      showImageInfo,
      closeInfoModal,
    };
  },
};
</script>

<style scoped>
/* Images Gallery Wrapper */
.images-gallery-wrapper {
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
  background: url("/uploads/property_dark/property_dark_4.jpeg") center center no-repeat;
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
  color: #3b82f6;
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
  color: #b0b0b0;
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
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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
  background: #3b82f6;
  color: white;
  border-color: transparent;
}

/* Images Section */
.images-section {
  padding: 4rem 0;
  background: #0a0a0a;
}

.images-grid {
  display: grid;
  gap: 2rem;
  margin-bottom: 4rem;
}

.images-grid.grid {
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}

.images-grid.masonry {
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-auto-rows: 10px;
}

.image-item {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  background: #2a2a2a;
  transition: all 0.3s ease;
  cursor: pointer;
}

.image-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.image-wrapper {
  position: relative;
  width: 100%;
}

.grid .image-wrapper {
  aspect-ratio: 4/3;
}

.masonry .image-wrapper {
  aspect-ratio: auto;
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.image-item:hover .gallery-image {
  transform: scale(1.05);
}

.image-overlay {
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

.image-item:hover .image-overlay {
  opacity: 1;
}

.image-content {
  padding: 1.5rem;
  width: 100%;
}

.image-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: white;
}

.image-category {
  color: #fbbf24;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.image-actions {
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
  background: #3b82f6;
  transform: scale(1.1);
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
  background: #3b82f6;
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
  background: #3b82f6;
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
  background: #3b82f6;
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
  background: #3b82f6;
}

.nav-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.lightbox-image {
  max-width: 100%;
  max-height: 70vh;
  object-fit: contain;
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
  background: #3b82f6;
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

  .images-grid.grid {
    grid-template-columns: 1fr;
  }

  .images-grid.masonry {
    grid-template-columns: 1fr;
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
}
</style>
