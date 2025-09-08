<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/blog/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Properties</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>Properties</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="th-blog-wrapper space-top space-extra-bottom">
    <div class="container">
      <div class="th-sort-bar property-style">
        <div class="row justify-content-between align-items-center">
          <div class="col-md">
            <h4
              class="box-title text-start fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
              style="
                visibility: visible;
                animation-duration: 1.5s;
                animation-delay: 0.1s;
                animation-name: fadeinup;
              "
            >
              Property Listing
            </h4>
          </div>
          <div class="col-md-auto">
            <div
              class="sorting-filter-wrap fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
              style="
                visibility: visible;
                animation-duration: 1.5s;
                animation-delay: 0.3s;
                animation-name: fadeinup;
              "
            >
              <div class="nav" role="tablist">
                <a
                  class="active"
                  href="#"
                  id="tab-shop-list"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-list"
                  role="tab"
                  aria-controls="tab-grid"
                  aria-selected="false"
                  ><i class="fa-solid fa-list"></i
                ></a>
                <a
                  href="#"
                  id="tab-shop-grid"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-grid"
                  role="tab"
                  aria-controls="tab-grid"
                  aria-selected="true"
                  ><i class="fa-light fa-grid-2"></i
                ></a>
              </div>
              <form class="woocommerce-ordering" method="get">
                <select name="orderby" class="orderby" aria-label="Shop order">
                  <option value="menu_order" selected="selected">
                    Default Sorting
                  </option>
                  <option value="popularity">Sort by popularity</option>
                  <option value="rating">Sort by average rating</option>
                  <option value="date">Sort by latest</option>
                  <option value="price">Sort by price: low to high</option>
                  <option value="price-desc">Sort by price: high to low</option>
                </select>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="nav-tabContent">
        <div
          class="tab-pane fade"
          id="tab-grid"
          role="tabpanel"
          aria-labelledby="tab-shop-grid"
        >
          <div class="row gy-40">
            <template v-for="n in 10" :key="n">
              <PropertySingleItemGrid />
            </template>
            
            <Pagination />
          </div>
        </div>
        <div
          class="tab-pane fade active show"
          id="tab-list"
          role="tabpanel"
          aria-labelledby="tab-shop-list"
        >
          <div class="row gy-40 justify-content-center">
            <div class="col-xl-8 col-lg-12">
              <div class="row gy-30">
                <template v-for="n in 10" :key="n">
                  <PropertySingleItemList />
                </template>

                <Pagination />
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <SidebarArea />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";

import PropertySingleItemGrid from "./components/PropertySingleItemGrid.vue";
import PropertySingleItemList from "./components/PropertySingleItemList.vue";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";
import SidebarArea from "./components/SidebarArea.vue";

import $ from "jquery";
import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

export default {
  components: {
    Link,
    PropertySingleItemGrid,
    PropertySingleItemList,
    Pagination,
    SidebarArea,
  },
  setup() {
    // Reactive data
    const properties = ref([
      {
        id: 1,
        name: "Luxury Residential Complex",
        category: "Residential",
        address: "Al Khuwair, Muscat, Oman",
        map_location_url: "https://maps.google.com/maps?q=Al+Khuwair+Muscat",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_1.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-home",
            title: "50 Units",
            description: "Modern apartments with contemporary design",
          },
          {
            icon: "fas fa-car",
            title: "Parking",
            description: "Dedicated parking spaces for all residents",
          },
          {
            icon: "fas fa-shield-alt",
            title: "Security",
            description: "24/7 security and surveillance system",
          },
        ],
        amenities: [
          { title: "Swimming Pool", available: true },
          { title: "Gym", available: true },
          { title: "Children's Play Area", available: true },
          { title: "Rooftop Garden", available: false },
        ],
      },
      {
        id: 2,
        name: "Modern Office Tower",
        category: "Commercial",
        address: "Ruwi, Muscat, Oman",
        map_location_url: "https://maps.google.com/maps?q=Ruwi+Muscat",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_3.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-building",
            title: "15 Floors",
            description: "State-of-the-art office spaces",
          },
          {
            icon: "fas fa-elevator",
            title: "High-Speed Elevators",
            description: "Modern elevator systems for efficiency",
          },
          {
            icon: "fas fa-wifi",
            title: "Smart Building",
            description: "Integrated smart building technology",
          },
        ],
        amenities: [
          { title: "Conference Rooms", available: true },
          { title: "Cafeteria", available: true },
          { title: "Parking Garage", available: true },
          { title: "Helipad", available: false },
        ],
      },
      {
        id: 3,
        name: "Industrial Warehouse Complex",
        category: "Industrial",
        address: "Rusayl Industrial Estate, Oman",
        map_location_url:
          "https://maps.google.com/maps?q=Rusayl+Industrial+Estate",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_6.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_4.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-warehouse",
            title: "10,000 sqm",
            description: "Large storage and manufacturing space",
          },
          {
            icon: "fas fa-truck",
            title: "Loading Docks",
            description: "Multiple loading and unloading facilities",
          },
          {
            icon: "fas fa-tools",
            title: "Heavy Equipment",
            description: "Support for heavy machinery operations",
          },
        ],
        amenities: [
          { title: "Office Space", available: true },
          { title: "Security Systems", available: true },
          { title: "Fire Safety", available: true },
          { title: "Cold Storage", available: false },
        ],
      },
      {
        id: 4,
        name: "Premium Villa Development",
        category: "Residential",
        address: "Bausher, Muscat, Oman",
        map_location_url: "https://maps.google.com/maps?q=Bausher+Muscat",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_10.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_6.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-home",
            title: "12 Villas",
            description: "Luxury standalone villas with modern amenities",
          },
          {
            icon: "fas fa-swimming-pool",
            title: "Private Pools",
            description: "Individual swimming pools for each villa",
          },
          {
            icon: "fas fa-tree",
            title: "Landscaping",
            description: "Professional landscaping and gardens",
          },
        ],
        amenities: [
          { title: "Private Garden", available: true },
          { title: "Maid's Room", available: true },
          { title: "Study Room", available: true },
          { title: "Guest House", available: false },
        ],
      },
      {
        id: 5,
        name: "Shopping Mall Complex",
        category: "Commercial",
        address: "Qurum, Muscat, Oman",
        map_location_url: "https://maps.google.com/maps?q=Qurum+Muscat",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_9.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_7.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-store",
            title: "200+ Stores",
            description: "Wide variety of retail and dining options",
          },
          {
            icon: "fas fa-film",
            title: "Cinema Complex",
            description: "Multi-screen cinema entertainment",
          },
          {
            icon: "fas fa-utensils",
            title: "Food Court",
            description: "International cuisine and local favorites",
          },
        ],
        amenities: [
          { title: "Food Court", available: true },
          { title: "Entertainment Zone", available: true },
          { title: "Hypermarket", available: true },
          { title: "Hotel", available: false },
        ],
      },
      {
        id: 6,
        name: "Educational Campus",
        category: "Educational",
        address: "Al Seeb, Muscat, Oman",
        map_location_url: "https://maps.google.com/maps?q=Al+Seeb+Muscat",
        video_url: "https://www.youtube.com/watch?v=uXdiJfAH6kk",
        video_thumbnail: "/uploads/property/banner_image/2025/06/image_5.jpg",
        banner_image: [
          "/uploads/property/banner_image/2025/06/image_8.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
        ],
        gallery: [
          "/uploads/property/banner_image/2025/06/image_1.jpg",
          "/uploads/property/banner_image/2025/06/image_2.jpg",
          "/uploads/property/banner_image/2025/06/image_3.jpg",
          "/uploads/property/banner_image/2025/06/image_4.jpg",
        ],
        facts_features: [
          {
            icon: "fas fa-graduation-cap",
            title: "Modern Classrooms",
            description: "State-of-the-art learning environments",
          },
          {
            icon: "fas fa-microscope",
            title: "Science Labs",
            description: "Fully equipped laboratories for practical learning",
          },
          {
            icon: "fas fa-book",
            title: "Library",
            description: "Comprehensive library and study spaces",
          },
        ],
        amenities: [
          { title: "Sports Facilities", available: true },
          { title: "Auditorium", available: true },
          { title: "Cafeteria", available: true },
          { title: "Dormitory", available: false },
        ],
      },
    ]);

    const activeFilter = ref("all");
    const viewMode = ref("grid");
    const currentPage = ref(1);
    const itemsPerPage = ref(6);
    const showPropertyModal = ref(false);
    const showGalleryLightbox = ref(false);
    const showVideoModal = ref(false);
    const selectedProperty = ref(null);
    const selectedVideoProperty = ref(null);
    const currentImageIndex = ref(0);
    const currentGalleryIndex = ref(0);
    const videoPlayer = ref(null);

    // Computed properties
    const uniqueCategories = computed(() => {
      return [
        ...new Set(properties.value.map((property) => property.category)),
      ].sort();
    });

    const filteredProperties = computed(() => {
      if (activeFilter.value === "all") {
        return properties.value;
      }
      return properties.value.filter(
        (property) => property.category === activeFilter.value
      );
    });

    const totalPages = computed(() => {
      return Math.ceil(filteredProperties.value.length / itemsPerPage.value);
    });

    const startIndex = computed(() => {
      return (currentPage.value - 1) * itemsPerPage.value;
    });

    const endIndex = computed(() => {
      return startIndex.value + itemsPerPage.value;
    });

    const paginatedProperties = computed(() => {
      return filteredProperties.value.slice(startIndex.value, endIndex.value);
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
        document
          .querySelector(".portfolio-section")
          .scrollIntoView({ behavior: "smooth" });
      }
    };

    const openPropertyModal = (property) => {
      selectedProperty.value = property;
      currentImageIndex.value = 0;
      showPropertyModal.value = true;
      document.body.style.overflow = "hidden";
    };

    const closePropertyModal = () => {
      showPropertyModal.value = false;
      selectedProperty.value = null;
      currentImageIndex.value = 0;
      document.body.style.overflow = "auto";
    };

    const previousImage = () => {
      if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
      } else {
        currentImageIndex.value =
          selectedProperty.value.banner_image.length - 1;
      }
    };

    const nextImage = () => {
      if (
        currentImageIndex.value <
        selectedProperty.value.banner_image.length - 1
      ) {
        currentImageIndex.value++;
      } else {
        currentImageIndex.value = 0;
      }
    };

    const openGalleryLightbox = (index) => {
      currentGalleryIndex.value = index;
      showGalleryLightbox.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeGalleryLightbox = () => {
      showGalleryLightbox.value = false;
      currentGalleryIndex.value = 0;
      document.body.style.overflow = "auto";
    };

    const previousGalleryImage = () => {
      if (currentGalleryIndex.value > 0) {
        currentGalleryIndex.value--;
      } else {
        currentGalleryIndex.value = selectedProperty.value.gallery.length - 1;
      }
    };

    const nextGalleryImage = () => {
      if (
        currentGalleryIndex.value <
        selectedProperty.value.gallery.length - 1
      ) {
        currentGalleryIndex.value++;
      } else {
        currentGalleryIndex.value = 0;
      }
    };

    const initVideoPopup = () => {
      $(".video-popup-link").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        iframe: {
          markup:
            '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
            "</div>",
          patterns: {
            youtube: {
              index: "youtube.com/",
              id: "v=",
              src: "https://www.youtube.com/embed/%id%?autoplay=1",
            },
          },
          srcAction: "iframe_src",
        },
      });
    };

    const playVideo = (property) => {
      selectedVideoProperty.value = property;
      showVideoModal.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeVideoModal = () => {
      showVideoModal.value = false;
      selectedVideoProperty.value = null;
      document.body.style.overflow = "auto";

      if (videoPlayer.value) {
        videoPlayer.value.pause();
      }
    };

    // Reset pagination when filter changes
    const resetPagination = () => {
      currentPage.value = 1;
    };

    // Keyboard navigation
    const handleKeydown = (event) => {
      if (showPropertyModal.value && event.key === "Escape") {
        closePropertyModal();
      }
      if (showGalleryLightbox.value) {
        switch (event.key) {
          case "Escape":
            closeGalleryLightbox();
            break;
          case "ArrowLeft":
            previousGalleryImage();
            break;
          case "ArrowRight":
            nextGalleryImage();
            break;
        }
      }
      if (showVideoModal.value && event.key === "Escape") {
        closeVideoModal();
      }
    };

    // Lifecycle hooks
    onMounted(() => {
      document.addEventListener("keydown", handleKeydown);
      // Initialize video popup
      initVideoPopup();
    });

    onUnmounted(() => {
      document.removeEventListener("keydown", handleKeydown);
      document.body.style.overflow = "auto";
    });

    return {
      // Data
      properties,
      activeFilter,
      viewMode,
      currentPage,
      itemsPerPage,
      showPropertyModal,
      showGalleryLightbox,
      showVideoModal,
      selectedProperty,
      selectedVideoProperty,
      currentImageIndex,
      currentGalleryIndex,
      videoPlayer,

      // Computed
      uniqueCategories,
      filteredProperties,
      totalPages,
      startIndex,
      endIndex,
      paginatedProperties,
      visiblePages,

      // Methods
      goToPage,
      openPropertyModal,
      closePropertyModal,
      previousImage,
      nextImage,
      openGalleryLightbox,
      closeGalleryLightbox,
      previousGalleryImage,
      nextGalleryImage,
      initVideoPopup,
      playVideo,
      closeVideoModal,
      resetPagination,
    };
  },
};
</script>

<style scoped>
/* Reset and base styles */
* {
  box-sizing: border-box;
}

.portfolio-wrapper {
  background: #0a0a0a;
  min-height: 100vh;
  color: #ffffff;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Header Section */
.portfolio-header {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
  color: #ffffff;
  padding: 120px 0 80px;
  text-align: center;
  position: relative;
  border-bottom: 1px solid #2d2d2d;
}

.header-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("/uploads/property_dark/property_dark_16.jpeg") top center
    no-repeat;
  background-size: contain;
  opacity: 0.3;
  z-index: 1;
  background-size: cover;
}

.header-content {
  position: relative;
  z-index: 2;
}

/* Breadcrumb */
.breadcrumb {
  margin-bottom: 2rem;
  font-size: 0.9rem;
}

.breadcrumb-link {
  color: #f97316;
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcrumb-link:hover {
  color: #fb923c;
}

.breadcrumb-separator {
  margin: 0 0.5rem;
  color: #6b7280;
}

.breadcrumb-current {
  color: #d1d5db;
}

/* Page Title */
.page-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  background: #fff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
}

.page-subtitle {
  text-align: center;
  font-size: 1.2rem;
  color: #fff;
  max-width: 600px;
  margin: 0 auto 2rem;
  line-height: 1.6;
}

/* Header Stats */
.header-stats {
  display: flex;
  justify-content: center;
  gap: 3rem;
  margin-top: 2rem;
}

.stat-badge {
  text-align: center;
}

.stat-number {
  display: block;
  font-size: 2.5rem;
  font-weight: 800;
  color: #f97316;
  margin-bottom: 0.5rem;
  line-height: 1;
}

.stat-label {
  font-size: 0.9rem;
  color: #d1d5db;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  font-weight: 600;
}

/* Filter Section */
.filter-section {
  background: #1a1a1a;
  padding: 40px 0;
  border-bottom: 1px solid #2d2d2d;
}

.filter-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1.5rem;
}

.filter-title h3 {
  color: #ffffff;
  font-size: 1.2rem;
  font-weight: 600;
  margin: 0;
}

.filter-tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.filter-btn {
  padding: 0.75rem 1.5rem;
  background: #2d2d2d;
  color: #ffffff;
  border: 2px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  text-transform: capitalize;
  font-size: 0.95rem;
}

.filter-btn:hover {
  background: #f97316;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
}

.filter-btn.active {
  background: #f97316;
  border-color: #fb923c;
  transform: translateY(-2px);
}

.view-toggle {
  display: flex;
  gap: 0.5rem;
}

.view-btn {
  padding: 0.75rem;
  background: #2d2d2d;
  color: #ffffff;
  border: 2px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
}

.view-btn:hover {
  background: #f97316;
  transform: translateY(-2px);
}

.view-btn.active {
  background: #f97316;
  border-color: #fb923c;
}
/* Portfolio Section */
.portfolio-section {
  background: #0a0a0a;
  padding: 60px 0;
  min-height: 70vh;
}

/* Portfolio Grid */
.portfolio-grid {
  display: grid;
  gap: 2rem;
  margin-bottom: 3rem;
}

.portfolio-grid.grid {
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
}

.portfolio-grid.list {
  grid-template-columns: 1fr;
}

/* Portfolio Cards */
.portfolio-card {
  background: #1a1a1a;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #2d2d2d;
  transition: all 0.3s ease;
  cursor: pointer;
  display: flex;
  flex-direction: column;
}

.portfolio-grid.list .portfolio-card {
  flex-direction: row;
  max-height: 300px;
}

.portfolio-card:hover {
  transform: translateY(-8px);
  border-color: #f97316;
  box-shadow: 0 20px 40px rgba(249, 115, 22, 0.15);
}

/* Card Image */
.card-image {
  position: relative;
  height: 250px;
  overflow: hidden;
}

.portfolio-grid.list .card-image {
  width: 350px;
  height: 100%;
  flex-shrink: 0;
}

.property-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.portfolio-card:hover .property-image {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    to bottom,
    rgba(0, 0, 0, 0.2) 0%,
    rgba(0, 0, 0, 0.7) 100%
  );
  opacity: 0;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.portfolio-card:hover .image-overlay {
  opacity: 1;
}

.overlay-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.property-category {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: rgba(249, 115, 22, 0.9);
  color: #ffffff;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  z-index: 3;
}

.play-video-btn {
  background: rgba(249, 115, 22, 0.9);
  color: #ffffff;
  border: none;
  padding: 1rem;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  z-index: 3;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
}

.play-video-btn:hover {
  background: #f97316;
  transform: scale(1.1);
  color: #ffffff;
}

/* Card Content */
.card-content {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.property-name {
  font-size: 1.5rem;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 0.75rem;
  line-height: 1.3;
}

.property-address {
  color: #d1d5db;
  margin-bottom: 1rem;
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.property-address i {
  color: #f97316;
  font-size: 0.9rem;
}

.property-features {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.feature-tag {
  background: rgba(249, 115, 22, 0.1);
  color: #f97316;
  padding: 0.4rem 0.8rem;
  border-radius: 12px;
  font-size: 0.875rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.4rem;
}

.feature-tag i {
  font-size: 0.8rem;
}

.card-actions {
  display: flex;
  gap: 0.75rem;
  margin-top: auto;
}

.view-details-btn {
  flex: 1;
  padding: 0.75rem 1.5rem;
  background: #f97316;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.view-details-btn:hover {
  background: #ea580c;
  transform: translateY(-2px);
}

.map-btn {
  padding: 0.75rem;
  background: transparent;
  color: #f97316;
  border: 2px solid #f97316;
  border-radius: 8px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 45px;
  height: 45px;
}

.map-btn:hover {
  background: #f97316;
  color: #ffffff;
  transform: translateY(-2px);
}

/* Pagination */
.pagination-wrapper {
  margin-top: 3rem;
  text-align: center;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.pagination-btn {
  padding: 0.75rem 1.5rem;
  background: #2d2d2d;
  color: #ffffff;
  border: 2px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  font-size: 0.95rem;
}

.pagination-btn:hover:not(:disabled) {
  background: #f97316;
  transform: translateY(-2px);
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
  padding: 0.75rem 1rem;
  background: #2d2d2d;
  color: #ffffff;
  border: 2px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  min-width: 45px;
  text-align: center;
}

.pagination-number:hover {
  background: #f97316;
  transform: translateY(-2px);
}

.pagination-number.active {
  background: #f97316;
  border-color: #fb923c;
  transform: translateY(-2px);
}

.pagination-info {
  color: #d1d5db;
  font-size: 0.9rem;
  margin-top: 1rem;
}

/* Modals */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 20px;
  backdrop-filter: blur(4px);
}

.modal-content {
  background: #1a1a1a;
  border-radius: 16px;
  max-width: 1000px;
  width: 100%;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  border: 1px solid #2d2d2d;
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  color: #ffffff;
  font-size: 1.5rem;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 50%;
  transition: all 0.3s ease;
  z-index: 10;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-close:hover {
  background: #f97316;
}

.modal-body {
  padding: 2rem;
}

/* Modal Gallery */
.modal-gallery {
  margin-bottom: 2rem;
}

.main-image {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 1rem;
}

.gallery-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
}

.gallery-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 1rem;
  pointer-events: none;
}

.nav-btn {
  background: rgba(0, 0, 0, 0.5);
  color: #ffffff;
  border: none;
  padding: 0.75rem;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;
  pointer-events: all;
  font-size: 1.2rem;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.nav-btn:hover {
  background: #f97316;
}

.thumbnail-strip {
  display: flex;
  gap: 0.5rem;
  overflow-x: auto;
  padding: 0.5rem 0;
}

.thumbnail {
  width: 80px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  flex-shrink: 0;
}

.thumbnail:hover {
  border-color: #f97316;
}

.thumbnail.active {
  border-color: #f97316;
}

/* Modal Info */
.modal-info {
  color: #ffffff;
}

.property-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1.5rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.property-title {
  font-size: 2rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0;
  line-height: 1.3;
}

.property-category-badge {
  background: #f97316;
  color: #ffffff;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.property-location {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 2rem;
  padding: 1rem;
  background: #2d2d2d;
  border-radius: 8px;
}

.property-location i {
  color: #f97316;
  font-size: 1.1rem;
}

.location-link {
  color: #f97316;
  text-decoration: none;
  font-weight: 600;
  margin-left: auto;
  transition: color 0.3s ease;
}

.location-link:hover {
  color: #fb923c;
}

/* Video Section */
.video-section {
  margin: 2rem 0;
}

.video-section h4 {
  color: #f97316;
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.video-player {
  border-radius: 12px;
  overflow: hidden;
  position: relative;
}

.modal-video-link {
  position: relative;
  display: block;
  text-decoration: none;
}

.video-thumbnail-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.video-play-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.modal-video-link:hover .video-play-overlay {
  background: rgba(0, 0, 0, 0.5);
}

.play-icon-large {
  font-size: 4rem;
  color: #ffffff;
  transition: transform 0.3s ease;
}

.modal-video-link:hover .play-icon-large {
  transform: scale(1.1);
}

/* Magnific Popup Custom Styles */
.mfp-fade.mfp-bg {
  opacity: 0;
  transition: all 0.15s ease-out;
}

.mfp-fade.mfp-bg.mfp-ready {
  opacity: 0.8;
}

.mfp-fade.mfp-bg.mfp-removing {
  opacity: 0;
}

.mfp-fade.mfp-wrap .mfp-content {
  opacity: 0;
  transition: all 0.15s ease-out;
}

.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
  opacity: 1;
}

.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
  opacity: 0;
}

.mfp-iframe-holder .mfp-content {
  line-height: 0;
  width: 100%;
  max-width: 900px;
}

.mfp-iframe-scaler {
  width: 100%;
  height: 0;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 aspect ratio */
}

.mfp-iframe-scaler iframe {
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
  background: #000;
}

.property-video {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

/* Facts Section */
.facts-section {
  margin: 2rem 0;
}

.facts-section h4 {
  color: #f97316;
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.facts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.fact-item {
  background: #2d2d2d;
  padding: 1.5rem;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.fact-item:hover {
  background: #3d3d3d;
  transform: translateY(-2px);
}

.fact-icon {
  color: #f97316;
  font-size: 2rem;
  margin-bottom: 1rem;
}

.fact-content h5 {
  color: #ffffff;
  font-size: 1.1rem;
  font-weight: 600;
  margin: 0 0 0.5rem 0;
}

.fact-content p {
  color: #d1d5db;
  font-size: 0.9rem;
  line-height: 1.4;
  margin: 0;
}

/* Amenities Section */
.amenities-section {
  margin: 2rem 0;
}

.amenities-section h4 {
  color: #f97316;
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.amenities-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.amenity-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  background: #2d2d2d;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.amenity-item.available {
  border-left: 4px solid #10b981;
}

.amenity-item:not(.available) {
  border-left: 4px solid #ef4444;
  opacity: 0.6;
}

.amenity-item i {
  color: #10b981;
  font-size: 1.1rem;
}

.amenity-item:not(.available) i {
  color: #ef4444;
}

.amenity-item span {
  color: #ffffff;
  font-weight: 500;
}

/* Gallery Section */
.gallery-section {
  margin: 2rem 0;
}

.gallery-section h4 {
  color: #f97316;
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1rem;
}

.gallery-thumb {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.gallery-thumb:hover {
  transform: scale(1.05);
  border-color: #f97316;
}

/* Lightbox */
.lightbox-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1001;
  padding: 20px;
}

.lightbox-content {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
}

.lightbox-close {
  position: absolute;
  top: -50px;
  right: 0;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  color: #ffffff;
  font-size: 1.5rem;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 50%;
  transition: all 0.3s ease;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.lightbox-close:hover {
  background: #f97316;
}

.lightbox-navigation {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  display: flex;
  justify-content: space-between;
  padding: 0 -60px;
  pointer-events: none;
}

.lightbox-navigation .nav-btn {
  pointer-events: all;
  position: relative;
}

.lightbox-image {
  max-width: 100%;
  max-height: 90vh;
  object-fit: contain;
  border-radius: 8px;
}

/* Video Modal */
.video-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1001;
  padding: 20px;
}

.video-modal-content {
  position: relative;
  max-width: 800px;
  width: 100%;
  background: #1a1a1a;
  border-radius: 16px;
  overflow: hidden;
}

.modal-video {
  width: 100%;
  height: 450px;
  object-fit: cover;
}

/* Responsive Design */
@media (max-width: 768px) {
  .portfolio-header {
    padding: 80px 0 60px;
  }

  .page-title {
    font-size: 2.5rem;
  }

  .page-subtitle {
    font-size: 1rem;
    padding: 0 1rem;
  }

  .header-stats {
    flex-direction: column;
    gap: 1.5rem;
  }

  .filter-wrapper {
    flex-direction: column;
    align-items: stretch;
    text-align: center;
  }

  .filter-tabs {
    justify-content: center;
  }

  .view-toggle {
    justify-content: center;
  }

  .portfolio-grid.grid {
    grid-template-columns: 1fr;
  }

  .portfolio-grid.list .portfolio-card {
    flex-direction: column;
    max-height: none;
  }

  .portfolio-grid.list .card-image {
    width: 100%;
    height: 200px;
  }

  .facts-grid {
    grid-template-columns: 1fr;
  }

  .amenities-grid {
    grid-template-columns: 1fr;
  }

  .gallery-grid {
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  }

  .modal-content {
    margin: 10px;
    max-height: calc(100vh - 20px);
  }

  .gallery-image {
    height: 250px;
  }

  .property-video,
  .video-thumbnail-image {
    height: 200px;
  }

  .property-header {
    flex-direction: column;
    align-items: stretch;
  }

  .property-title {
    font-size: 1.5rem;
  }

  .pagination {
    flex-wrap: wrap;
    gap: 0.25rem;
  }

  .pagination-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }

  .pagination-number {
    padding: 0.5rem 0.75rem;
    min-width: 40px;
  }
}

@media (max-width: 480px) {
  .portfolio-header {
    padding: 60px 0 40px;
  }

  .page-title {
    font-size: 2rem;
  }

  .header-stats {
    gap: 1rem;
  }

  .stat-number {
    font-size: 2rem;
  }

  .filter-tabs {
    gap: 0.5rem;
  }

  .filter-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }

  .card-actions {
    flex-direction: column;
  }

  .property-features {
    flex-direction: column;
  }

  .modal-body {
    padding: 1rem;
  }

  .thumbnail-strip {
    gap: 0.25rem;
  }

  .thumbnail {
    width: 60px;
    height: 45px;
  }
}
</style>
