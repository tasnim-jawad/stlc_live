<template>
  <div class="blog-wrapper">
    <!-- Hero Section -->
    <header class="blog-hero">
      <div class="hero-overlay"></div>
      <div class="container">
        <div class="hero-content">
          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <Link href="/" class="breadcrumb-link">Home</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Blog</span>
          </nav>

          <h1 class="hero-title">Latest Blog Posts & Updates</h1>
          <p class="hero-subtitle">
            Stay informed with our latest construction insights, project
            updates, and industry news
          </p>

          <div class="hero-stats">
            <div class="stat-badge">
              <span class="stat-number">{{ filteredBlogs.length }}</span>
              <span class="stat-label">Articles</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{ uniqueCategories.length }}</span>
              <span class="stat-label">Categories</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{ totalPages }}</span>
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
              @click="
                activeFilter = 'all';
                resetPagination();
              "
              :class="['filter-btn', { active: activeFilter === 'all' }]"
            >
              All Posts
            </button>
            <button
              v-for="category in uniqueCategories"
              :key="category.id"
              @click="
                activeFilter = category.id;
                resetPagination();
              "
              :class="['filter-btn', { active: activeFilter === category.id }]"
            >
              {{ category.name }}
            </button>
          </div>

          <div class="view-toggle">
            <button
              @click="viewMode = 'grid'"
              :class="['view-btn', { active: viewMode === 'grid' }]"
              title="Grid View"
            >
              <i class="fas fa-th"></i>
            </button>
            <button
              @click="viewMode = 'list'"
              :class="['view-btn', { active: viewMode === 'list' }]"
              title="List View"
            >
              <i class="fas fa-list"></i>
            </button>
          </div>
        </div>

        <!-- Search Section -->
        <div class="search-section">
          <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search articles..."
              class="search-input"
            />
            <button
              v-if="searchQuery"
              @click="searchQuery = ''"
              class="clear-search"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
      <div class="container">
        <!-- Featured Article -->
        <div v-if="featuredBlog" class="featured-article">
          <h2 class="featured-title">Featured Article</h2>
          <Link :href="`/blog/${featuredBlog.id}`" class="featured-card">
            <div class="featured-image">
              <img
                v-if="featuredBlog.image"
                :src="featuredBlog.image"
                :alt="featuredBlog.title"
                class="blog-image"
              />
              <div v-else-if="featuredBlog.url" class="video-thumbnail">
                <img
                  :src="featuredBlog.thumbnail_image"
                  :alt="featuredBlog.title"
                  class="blog-image"
                />
                <button
                  class="play-overlay"
                  @click.stop.prevent="openVideo(featuredBlog.url)"
                  aria-label="Play video"
                >
                  <i class="fas fa-play"></i>
                </button>
              </div>
              <div class="featured-badge">Featured</div>
            </div>
            <div class="featured-content">
              <div class="blog-meta">
                <span class="blog-category">{{
                  getCategoryName(featuredBlog.blog_category_id)
                }}</span>
                <span class="blog-date">{{
                  formatDate(featuredBlog.publish_date)
                }}</span>
              </div>
              <h3 class="blog-title">{{ featuredBlog.title }}</h3>
              <p class="blog-excerpt">
                {{ getExcerpt(featuredBlog.description) }}
              </p>
              <div class="blog-tags">
                <span
                  v-for="tag in getTags(featuredBlog.tags)"
                  :key="tag"
                  class="tag"
                >
                  {{ tag }}
                </span>
              </div>
              <div class="blog-author">
                <i class="fas fa-user"></i>
                <span>{{ featuredBlog.writer }}</span>
              </div>
            </div>
          </Link>
        </div>

        <!-- Blog Grid/List -->
        <div class="blog-content">
          <div :class="['blog-grid', viewMode]">
            <Link
              v-for="blog in paginatedBlogs"
              :key="blog.id"
              :href="`/blog/${blog.id}`"
              class="blog-card"
            >
              <div class="card-image">
                <img
                  v-if="blog.image"
                  :src="blog.image"
                  :alt="blog.title"
                  class="blog-image"
                />
                <div v-else-if="blog.url" class="video-thumbnail">
                  <img
                    :src="blog.thumbnail_image"
                    :alt="blog.title"
                    class="blog-image"
                  />
                  <button
                    class="play-overlay"
                    @click.stop.prevent="openVideo(blog.url)"
                    aria-label="Play video"
                  >
                    <i class="fas fa-play"></i>
                  </button>
                </div>
                <div v-else class="no-image">
                  <i class="fas fa-file-alt"></i>
                </div>

                <div class="image-overlay">
                  <div class="overlay-content">
                    <i class="fas fa-eye"></i>
                    <span>Read More</span>
                  </div>
                </div>
              </div>

              <div class="card-content">
                <div class="blog-meta">
                  <span class="blog-category">{{
                    getCategoryName(blog.blog_category_id)
                  }}</span>
                  <span class="blog-date">{{
                    formatDate(blog.publish_date)
                  }}</span>
                </div>

                <h3 class="blog-title">{{ blog.title }}</h3>
                <p class="blog-excerpt">{{ getExcerpt(blog.description) }}</p>

                <div class="blog-tags">
                  <span
                    v-for="tag in getTags(blog.tags)"
                    :key="tag"
                    class="tag"
                  >
                    {{ tag }}
                  </span>
                </div>

                <div class="card-footer">
                  <div class="blog-author">
                    <i class="fas fa-user"></i>
                    <span>{{ blog.writer }}</span>
                  </div>
                  <Link
                    :href="`/blog/${blog.id}`"
                    class="read-more-link text-decoration-none"
                  >
                    <div class="read-more-btn">
                      <span>Read More</span>
                      <i class="fas fa-arrow-right"></i>
                    </div>
                  </Link>
                </div>
              </div>
            </Link>
          </div>

          <!-- Empty State -->
          <div v-if="paginatedBlogs.length === 0" class="empty-state">
            <i class="fas fa-search"></i>
            <h3>No articles found</h3>
            <p>Try adjusting your search or filter criteria</p>
          </div>

          <!-- Pagination -->
          <div v-if="totalPages > 1" class="pagination-wrapper">
            <div class="pagination">
              <button
                @click="goToPage(currentPage - 1)"
                :disabled="currentPage === 1"
                class="pagination-btn"
              >
                <i class="fas fa-chevron-left"></i>
              </button>

              <div class="pagination-numbers">
                <button
                  v-for="page in visiblePages"
                  :key="page"
                  @click="goToPage(page)"
                  :class="['pagination-btn', { active: page === currentPage }]"
                >
                  {{ page }}
                </button>
              </div>

              <button
                @click="goToPage(currentPage + 1)"
                :disabled="currentPage === totalPages"
                class="pagination-btn"
              >
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>

            <div class="pagination-info">
              Showing {{ startIndex + 1 }}-{{
                Math.min(endIndex, filteredBlogs.length)
              }}
              of {{ filteredBlogs.length }} articles
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import $ from "jquery";
import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

export default {
  components: {
    Link,
  },
  setup() {
    // Reactive data
    const blogs = ref([
      {
        id: 1,
        blog_category_id: 1,
        title: "Safety First: New HSE Protocols in Construction",
        description: `<p>Safety remains our top priority at Unique Construction. We have implemented comprehensive Health, Safety, and Environment (HSE) protocols that exceed industry standards.</p>
        <p>Our new protocols include enhanced personal protective equipment (PPE) requirements, regular safety training sessions, and advanced monitoring systems across all construction sites.</p>
        <p>These measures ensure that every worker returns home safely while maintaining the highest quality standards in our projects.</p>`,
        tags: "safety, hse, protocols, construction, training",
        publish_date: "2024-03-15",
        writer: "Ahmed Al-Rashid",
        meta_description:
          "Learn about our comprehensive HSE protocols and safety measures in construction",
        meta_keywords: "safety, construction, hse, protocols, training",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_1.jpg",
        image: "/uploads/blog/thumbnail_image/2025/06/image_1.jpg",
        url: null,
        created_at: "2024-03-15T10:00:00Z",
        updated_at: "2024-03-15T10:00:00Z",
      },
      {
        id: 2,
        blog_category_id: 2,
        title: "Sustainable Building Practices in Oman",
        description: `<p>As environmental consciousness grows, Unique Construction is leading the way in sustainable building practices throughout Oman.</p>
        <p>We incorporate eco-friendly materials, energy-efficient systems, and water conservation techniques in all our projects.</p>
        <p>Our commitment to sustainability extends beyond construction to include waste reduction, renewable energy integration, and green building certifications.</p>`,
        tags: "sustainability, green building, eco-friendly, energy efficiency",
        publish_date: "2024-03-10",
        writer: "Sarah Johnson",
        meta_description:
          "Discover our sustainable building practices and green construction methods",
        meta_keywords:
          "sustainable, green building, eco-friendly, construction",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_2.jpg",
        image: "/uploads/blog/thumbnail_image/2025/06/image_2.jpg",
        url: null,
        created_at: "2024-03-10T14:30:00Z",
        updated_at: "2024-03-10T14:30:00Z",
      },
      {
        id: 3,
        blog_category_id: 3,
        title: "Modern Construction Technologies",
        description: `<p>The construction industry is evolving rapidly with new technologies transforming how we build.</p>
        <p>At Unique Construction, we embrace cutting-edge technologies including BIM (Building Information Modeling), drone surveying, and automated construction equipment.</p>
        <p>These technologies improve accuracy, reduce costs, and accelerate project timelines while maintaining superior quality standards.</p>`,
        tags: "technology, bim, automation, innovation, construction",
        publish_date: "2024-03-05",
        writer: "Dr. Mohammed Al-Balushi",
        meta_description:
          "Explore modern construction technologies and innovations in building",
        meta_keywords: "technology, bim, construction, innovation, automation",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_3.jpg",
        image: "/uploads/blog/thumbnail_image/2025/06/image_3.jpg",
        url: "/uploads/blog/construction-tech.mp4",
        created_at: "2024-03-05T09:15:00Z",
        updated_at: "2024-03-05T09:15:00Z",
      },
      {
        id: 4,
        blog_category_id: 1,
        title: "Project Management Excellence",
        description: `<p>Successful construction projects require meticulous planning, coordination, and execution.</p>
        <p>Our project management approach combines traditional methodologies with modern tools to ensure projects are delivered on time, within budget, and to the highest quality standards.</p>
        <p>We utilize advanced project management software, regular stakeholder communication, and proactive risk management strategies.</p>`,
        tags: "project management, planning, coordination, quality",
        publish_date: "2024-02-28",
        writer: "Manilal H. Limbani",
        meta_description:
          "Learn about our project management excellence and methodologies",
        meta_keywords: "project management, construction, planning, quality",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_4.jpg",
        image: "/uploads/blog/thumbnail_image/2025/06/image_4.jpg",
        url: null,
        created_at: "2024-02-28T11:20:00Z",
        updated_at: "2024-02-28T11:20:00Z",
      },
      {
        id: 5,
        blog_category_id: 4,
        title: "Quality Assurance in Construction",
        description: `<p>Quality is not an accident; it's the result of systematic processes, skilled craftsmanship, and continuous improvement.</p>
        <p>Our quality assurance program includes regular inspections, material testing, and adherence to international standards.</p>
        <p>Every project undergoes rigorous quality checks at multiple stages to ensure the final deliverable exceeds client expectations.</p>`,
        tags: "quality assurance, inspections, standards, craftsmanship",
        publish_date: "2024-02-20",
        writer: "Ahmad Al-Hinai",
        meta_description:
          "Understand our comprehensive quality assurance processes",
        meta_keywords:
          "quality assurance, construction, standards, inspections",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_4.jpg",
        image: "/uploads/blog/thumbnail_image/2025/06/image_1.jpg",
        url: null,
        created_at: "2024-02-20T16:45:00Z",
        updated_at: "2024-02-20T16:45:00Z",
      },
      {
        id: 6,
        blog_category_id: 2,
        title: "Client Partnership and Communication",
        description: `<p>Building strong relationships with our clients is fundamental to our success.</p>
        <p>We believe in transparent communication, regular updates, and collaborative decision-making throughout the project lifecycle.</p>
        <p>Our client-centric approach has resulted in over 60% repeat business, demonstrating the trust and satisfaction of our valued clients.</p>`,
        tags: "client partnership, communication, relationships, trust",
        publish_date: "2024-02-15",
        writer: "Maria Rodriguez",
        meta_description:
          "Discover our client partnership approach and communication strategies",
        meta_keywords:
          "client partnership, communication, construction, relationships",
        thumbnail_image: "/uploads/blog/thumbnail_image/2025/06/image_6.jpg",
        image: null,
        url: "https://www.youtube.com/watch?v=A5zLYDP0iG8",
        created_at: "2024-02-15T13:30:00Z",
        updated_at: "2024-02-15T13:30:00Z",
      },
    ]);

    const categories = ref([
      { id: 1, name: "Safety & HSE" },
      { id: 2, name: "Sustainability" },
      { id: 3, name: "Technology" },
      { id: 4, name: "Quality Assurance" },
    ]);

    const activeFilter = ref("all");
    const viewMode = ref("grid");
    const currentPage = ref(1);
    const itemsPerPage = ref(6);
    const searchQuery = ref("");

    // Computed properties
    const uniqueCategories = computed(() => {
      return categories.value;
    });

    const filteredBlogs = computed(() => {
      let filtered = blogs.value;

      // Filter by category
      if (activeFilter.value !== "all") {
        filtered = filtered.filter(
          (blog) => blog.blog_category_id === activeFilter.value
        );
      }

      // Filter by search query
      if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase().trim();
        filtered = filtered.filter(
          (blog) =>
            blog.title.toLowerCase().includes(query) ||
            blog.description.toLowerCase().includes(query) ||
            blog.writer.toLowerCase().includes(query) ||
            blog.tags.toLowerCase().includes(query)
        );
      }

      // Sort by publish date (newest first)
      return filtered.sort(
        (a, b) => new Date(b.publish_date) - new Date(a.publish_date)
      );
    });

    const featuredBlog = computed(() => {
      return filteredBlogs.value[0] || null;
    });

    const regularBlogs = computed(() => {
      return filteredBlogs.value.slice(1);
    });

    const totalPages = computed(() => {
      return Math.ceil(regularBlogs.value.length / itemsPerPage.value);
    });

    const startIndex = computed(() => {
      return (currentPage.value - 1) * itemsPerPage.value;
    });

    const endIndex = computed(() => {
      return startIndex.value + itemsPerPage.value;
    });

    const paginatedBlogs = computed(() => {
      return regularBlogs.value.slice(startIndex.value, endIndex.value);
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
          .querySelector(".blog-section")
          .scrollIntoView({ behavior: "smooth" });
      }
    };

    const resetPagination = () => {
      currentPage.value = 1;
    };

    // Open YouTube link in Magnific Popup iframe
    const openVideo = (url) => {
      if (!url) return;
      // initialize and open directly
      $.magnificPopup.open({
        items: {
          src: url,
        },
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        iframe: {
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

    const getCategoryName = (categoryId) => {
      const category = categories.value.find((cat) => cat.id === categoryId);
      return category ? category.name : "Uncategorized";
    };

    const formatDate = (dateString) => {
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    };

    const getExcerpt = (html, maxLength = 150) => {
      // Remove HTML tags and get plain text
      const text = html.replace(/<[^>]*>/g, "").replace(/&[^;]+;/g, " ");
      return text.length > maxLength
        ? text.substring(0, maxLength) + "..."
        : text;
    };

    const getTags = (tagsString) => {
      if (!tagsString) return [];
      return tagsString
        .split(",")
        .map((tag) => tag.trim())
        .filter((tag) => tag.length > 0);
    };

    return {
      // Data
      blogs,
      categories,
      activeFilter,
      viewMode,
      currentPage,
      itemsPerPage,
      searchQuery,

      // Computed
      uniqueCategories,
      filteredBlogs,
      featuredBlog,
      regularBlogs,
      totalPages,
      startIndex,
      endIndex,
      paginatedBlogs,
      visiblePages,

      // Methods
      goToPage,
      resetPagination,
      getCategoryName,
      formatDate,
      getExcerpt,
      getTags,
      openVideo, // expose to template
    };
  },
};
</script>

<style scoped>
/* Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.blog-wrapper {
  background: #0a0a0a;
  color: #ffffff;
  overflow-x: hidden;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Hero Section */
.blog-hero {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
  padding: 120px 0 80px;
  position: relative;
  text-align: center;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("/uploads/property_dark/property_dark_5.jpeg") center center
    no-repeat;
  background-size: cover;
  opacity: 0.3;
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
}

.breadcrumb {
  margin-bottom: 2rem;
  font-size: 0.9rem;
}

.breadcrumb-link {
  color: #10b981;
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcrumb-link:hover {
  color: #34d399;
}

.breadcrumb-separator {
  margin: 0 0.5rem;
  color: #6b7280;
}

.breadcrumb-current {
  color: #d1d5db;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  background: linear-gradient(45deg, #10b981, #34d399);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
}

.hero-subtitle {
  font-size: 1.2rem;
  color: #d1d5db;
  max-width: 600px;
  margin: 0 auto 2rem;
  line-height: 1.6;
}

.hero-stats {
  display: flex;
  justify-content: center;
  gap: 2rem;
  flex-wrap: wrap;
}

.stat-badge {
  background: rgba(16, 185, 129, 0.1);
  padding: 1rem 1.5rem;
  border-radius: 12px;
  border: 1px solid rgba(16, 185, 129, 0.3);
  text-align: center;
}

.stat-number {
  display: block;
  font-size: 2rem;
  font-weight: 800;
  color: #10b981;
  margin-bottom: 0.25rem;
}

.stat-label {
  font-size: 0.875rem;
  color: #d1d5db;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

/* Filter Section */
.filter-section {
  background: #1a1a1a;
  padding: 40px 0;
  border-top: 1px solid #2d2d2d;
}

.filter-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.filter-title h3 {
  color: #10b981;
  font-size: 1.25rem;
  font-weight: 600;
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
}

.filter-btn:hover {
  background: #10b981;
  transform: translateY(-2px);
}

.filter-btn.active {
  background: #10b981;
  border-color: #34d399;
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
}

.view-btn:hover {
  background: #10b981;
}

.view-btn.active {
  background: #10b981;
  border-color: #34d399;
}

/* Search Section */
.search-section {
  margin-top: 2rem;
  display: flex;
  justify-content: center;
}

.search-input-wrapper {
  position: relative;
  max-width: 400px;
  width: 100%;
}

.search-icon {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  color: #6b7280;
  font-size: 1rem;
}

.search-input {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 3rem;
  background: #2d2d2d;
  border: 2px solid #404040;
  border-radius: 12px;
  color: #ffffff;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  outline: none;
  border-color: #10b981;
  background: #3d3d3d;
}

.search-input::placeholder {
  color: #9ca3af;
}

.clear-search {
  position: absolute;
  right: 1rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #6b7280;
  cursor: pointer;
  padding: 0.25rem;
  transition: color 0.3s ease;
}

.clear-search:hover {
  color: #10b981;
}

/* Blog Section */
.blog-section {
  background: #0a0a0a;
  padding: 60px 0;
  min-height: 70vh;
}

/* Featured Article */
.featured-article {
  margin-bottom: 4rem;
}

.featured-title {
  font-size: 2rem;
  font-weight: 700;
  color: #10b981;
  margin-bottom: 2rem;
  text-align: center;
}

.featured-card {
  background: #1a1a1a;
  border-radius: 20px;
  overflow: hidden;
  border: 1px solid #2d2d2d;
  cursor: pointer;
  transition: all 0.3s ease;
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 400px;
  text-decoration: none;
  color: inherit;
}

.featured-card:hover {
  transform: translateY(-8px);
  border-color: #10b981;
  box-shadow: 0 25px 50px rgba(16, 185, 129, 0.1);
}

.featured-image {
  position: relative;
  overflow: hidden;
}

.featured-badge {
  position: absolute;
  top: 1rem;
  left: 1rem;
  background: #10b981;
  color: #ffffff;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  z-index: 2;
}

.featured-content {
  padding: 2rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Blog Grid */
.blog-content {
  margin-top: 2rem;
}

.blog-grid {
  display: grid;
  gap: 2rem;
  margin-bottom: 3rem;
}

.blog-grid.grid {
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
}

.blog-grid.list {
  grid-template-columns: 1fr;
}

.blog-grid.list .blog-card {
  display: flex;
  background: #1a1a1a;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #2d2d2d;
}

.blog-grid.list .card-image {
  width: 300px;
  height: 250px;
  flex-shrink: 0;
}

.blog-grid.list .card-content {
  flex: 1;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Blog Cards */
.blog-card {
  background: #1a1a1a;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #2d2d2d;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
  display: block;
}

.blog-card:hover {
  transform: translateY(-8px);
  border-color: #10b981;
  box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
}

.card-image {
  position: relative;
  height: 250px;
  overflow: hidden;
}

.blog-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.blog-card:hover .blog-image {
  transform: scale(1.05);
}

.video-thumbnail {
  position: relative;
  width: 100%;
  height: 100%;
}

.play-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(16, 185, 129, 0.9);
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  font-size: 1.5rem;
  transition: all 0.3s ease;
  z-index: 2;
}

.play-overlay:hover {
  background: #10b981;
  transform: translate(-50%, -50%) scale(1.1);
}

.no-image {
  width: 100%;
  height: 100%;
  background: #2d2d2d;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6b7280;
  font-size: 3rem;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.3s ease;
}

.blog-card:hover .image-overlay {
  opacity: 1;
}

.overlay-content {
  color: #ffffff;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.overlay-content i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
}

/* Card Content */
.card-content {
  padding: 1.5rem;
}

.blog-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.blog-category {
  background: rgba(16, 185, 129, 0.1);
  color: #10b981;
  padding: 0.25rem 0.75rem;
  border-radius: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.blog-date {
  color: #9ca3af;
}

.blog-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 0.75rem;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-excerpt {
  color: #d1d5db;
  line-height: 1.6;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.tag {
  background: #2d2d2d;
  color: #d1d5db;
  padding: 0.25rem 0.5rem;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}

.blog-author {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #9ca3af;
  font-size: 0.875rem;
}

.blog-author i {
  color: #10b981;
}
.read-more-link {
  text-decoration: none !important;
}
.read-more-btn {
  background: transparent;
  color: #10b981;
  border: 2px solid #10b981;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  text-decoration: none !important;
}

.read-more-btn:hover {
  background: #10b981;
  color: #ffffff;
  transform: translateX(4px);
  text-decoration: none !important;
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

.pagination-btn:hover:not(:disabled) {
  background: #10b981;
  transform: translateY(-2px);
}

.pagination-btn.active {
  background: #10b981;
  border-color: #34d399;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-info {
  color: #d1d5db;
  font-size: 0.9rem;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #d1d5db;
}

.empty-state i {
  font-size: 4rem;
  color: #10b981;
  margin-bottom: 1rem;
}

.empty-state h3 {
  color: #ffffff;
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .hero-subtitle {
    font-size: 1rem;
    padding: 0 1rem;
  }

  .hero-stats {
    gap: 1rem;
  }

  .filter-wrapper {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }

  .filter-tabs {
    justify-content: center;
  }

  .view-toggle {
    justify-content: center;
  }

  .featured-card {
    grid-template-columns: 1fr;
    min-height: auto;
  }

  .blog-grid.grid {
    grid-template-columns: 1fr;
  }

  .blog-grid.list .blog-card {
    flex-direction: column;
  }

  .blog-grid.list .card-image {
    width: 100%;
    height: 200px;
  }

  .article-title {
    font-size: 2rem;
  }

  .article-meta {
    flex-direction: column;
    gap: 0.5rem;
  }

  .article-image,
  .video-player {
    height: 250px;
  }

  .share-buttons {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }

  .hero-stats {
    flex-direction: column;
    align-items: center;
  }

  .filter-tabs {
    gap: 0.5rem;
    flex-direction: column;
  }

  .filter-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }

  .featured-title {
    font-size: 1.5rem;
  }

  .blog-title {
    font-size: 1.1rem;
  }

  .article-title {
    font-size: 1.75rem;
  }

  .pagination {
    flex-wrap: wrap;
    gap: 0.25rem;
  }

  .pagination-btn {
    padding: 0.5rem 0.75rem;
    min-width: 40px;
  }

  .modal-body {
    padding: 1rem;
  }
}
</style>
