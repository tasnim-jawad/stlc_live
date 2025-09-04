<template>
  <div class="team-wrapper">
    <!-- Header Section -->
    <header class="team-header">
      <div class="header-overlay"></div>
      <div class="container">
        <div class="header-content">
          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <Link href="/" class="breadcrumb-link">Home</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Our Team</span>
          </nav>

          <h1 class="page-title">Meet Our Team</h1>
          <p class="page-subtitle">
            Dedicated professionals committed to delivering excellence in
            construction and building solutions
          </p>

          <div class="header-stats">
            <div class="stat-badge">
              <span class="stat-number">{{ teamMembers.length }}</span>
              <span class="stat-label">Team Members</span>
            </div>
            <div class="stat-badge">
              <span class="stat-number">{{ experienceYears }}</span>
              <span class="stat-label">Years Experience</span>
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
            <h3>View Options</h3>
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

    <!-- Team Section -->
    <section class="team-section">
      <div class="container">
        <!-- Team Grid -->
        <div :class="['team-grid', viewMode]">
          <div
            v-for="member in paginatedTeam"
            :key="member.id"
            class="team-card"
            @click="openMemberModal(member)"
          >
            <div class="card-image">
              <img
                :src="member.image"
                :alt="member.name"
                class="member-image"
              />
              <div class="image-overlay">
                <div class="social-links">
                  <a
                    v-for="(link, platform) in member.social_link"
                    :key="platform"
                    :href="link"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-link"
                    @click.stop
                    :title="platform"
                  >
                    <i :class="getSocialIcon(platform)"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="card-content">
              <h3 class="member-name">{{ member.name }}</h3>
              <p class="member-designation">{{ member.designation }}</p>

              <button
                class="view-profile-btn"
                @click.stop="openMemberModal(member)"
              >
                View Profile
              </button>
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
              Math.min(endIndex, teamMembers.length)
            }}
            of {{ teamMembers.length }} team members
          </div>
        </div>
      </div>
    </section>

    <!-- Member Modal -->
    <div v-if="showMemberModal" class="modal-overlay" @click="closeMemberModal">
      <div class="modal-content" @click.stop>
        <button @click="closeMemberModal" class="modal-close">×</button>

        <div class="modal-body">
          <div class="modal-header">
            <div class="modal-image">
              <img
                :src="selectedMember?.image"
                :alt="selectedMember?.name"
                class="profile-image"
              />
            </div>
            <div class="modal-info">
              <h2 class="profile-name">{{ selectedMember?.name }}</h2>
              <p class="profile-designation">
                {{ selectedMember?.designation }}
              </p>

              <div class="modal-social-links">
                <a
                  v-for="(link, platform) in selectedMember?.social_link"
                  :key="platform"
                  :href="link"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="modal-social-link"
                  :title="platform"
                >
                  <i :class="getSocialIcon(platform)"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="modal-details">
            <div class="detail-section">
              <h4>Contact Information</h4>
              <div class="contact-links">
                <a
                  v-for="(link, platform) in selectedMember?.social_link"
                  :key="platform"
                  :href="link"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="contact-link"
                >
                  <i :class="getSocialIcon(platform)"></i>
                  <span>{{ formatPlatformName(platform) }}</span>
                </a>
              </div>
            </div>
          </div>
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
    const teamMembers = ref([
      {
        id: 1,
        name: "Michael Johnson",
        designation: "Chief Executive Officer",
        image: "/uploads/avatars/avatar-1.png",
        social_link: {
          linkedin: "https://linkedin.com/in/michael-johnson",
          twitter: "https://twitter.com/michaeljohnson",
          email: "mailto:michael.johnson@securetrade.com",
        },
      },
      {
        id: 2,
        name: "Sarah Davis",
        designation: "Project Manager",
        image: "/uploads/avatars/avatar-2.png",
        social_link: {
          linkedin: "https://linkedin.com/in/sarah-davis",
          email: "mailto:sarah.davis@securetrade.com",
        },
      },
      {
        id: 3,
        name: "Robert Wilson",
        designation: "Senior Architect",
        image: "/uploads/avatars/avatar-3.png",
        social_link: {
          linkedin: "https://linkedin.com/in/robert-wilson",
          instagram: "https://instagram.com/robertwilsonarchitect",
          email: "mailto:robert.wilson@securetrade.com",
        },
      },
      {
        id: 4,
        name: "Emily Thompson",
        designation: "Civil Engineer",
        image: "/uploads/avatars/avatar-4.png",
        social_link: {
          linkedin: "https://linkedin.com/in/emily-thompson",
          twitter: "https://twitter.com/emilythompson",
          email: "mailto:emily.thompson@securetrade.com",
        },
      },
      {
        id: 5,
        name: "David Martinez",
        designation: "Construction Supervisor",
        image: "/uploads/avatars/avatar-5.png",
        social_link: {
          linkedin: "https://linkedin.com/in/david-martinez",
          email: "mailto:david.martinez@securetrade.com",
        },
      },
      {
        id: 6,
        name: "Lisa Anderson",
        designation: "Interior Designer",
        image: "/uploads/avatars/avatar-6.png",
        social_link: {
          linkedin: "https://linkedin.com/in/lisa-anderson",
          instagram: "https://instagram.com/lisaandersondesign",
          pinterest: "https://pinterest.com/lisaandersondesign",
          email: "mailto:lisa.anderson@securetrade.com",
        },
      },
      {
        id: 7,
        name: "James Brown",
        designation: "Safety Manager",
        image: "/uploads/avatars/avatar-7.png",
        social_link: {
          linkedin: "https://linkedin.com/in/james-brown",
          email: "mailto:james.brown@securetrade.com",
        },
      },
      {
        id: 8,
        name: "Maria Garcia",
        designation: "Financial Controller",
        image: "/uploads/avatars/avatar-8.png",
        social_link: {
          linkedin: "https://linkedin.com/in/maria-garcia",
          email: "mailto:maria.garcia@securetrade.com",
        },
      },
      {
        id: 9,
        name: "Kevin Lee",
        designation: "Equipment Manager",
        image: "/uploads/avatars/avatar-9.png",
        social_link: {
          linkedin: "https://linkedin.com/in/kevin-lee",
          email: "mailto:kevin.lee@securetrade.com",
        },
      },
      {
        id: 10,
        name: "Jennifer White",
        designation: "Marketing Director",
        image: "/uploads/avatars/avatar-10.png",
        social_link: {
          linkedin: "https://linkedin.com/in/jennifer-white",
          twitter: "https://twitter.com/jenniferwhite",
          instagram: "https://instagram.com/jenniferwhitemarketing",
          email: "mailto:jennifer.white@securetrade.com",
        },
      },
      {
        id: 11,
        name: "Thomas Clark",
        designation: "Quality Assurance Manager",
        image: "/uploads/avatars/avatar-11.png",
        social_link: {
          linkedin: "https://linkedin.com/in/thomas-clark",
          email: "mailto:thomas.clark@securetrade.com",
        },
      },
      {
        id: 12,
        name: "Amanda Rodriguez",
        designation: "Human Resources Manager",
        image: "/uploads/avatars/avatar-12.png",
        social_link: {
          linkedin: "https://linkedin.com/in/amanda-rodriguez",
          email: "mailto:amanda.rodriguez@securetrade.com",
        },
      },
    ]);

    const activeFilter = ref("all");
    const viewMode = ref("grid");
    const currentPage = ref(1);
    const itemsPerPage = ref(9);
    const showMemberModal = ref(false);
    const selectedMember = ref(null);
    const experienceYears = ref(15);

    // Computed properties
    const totalPages = computed(() => {
      return Math.ceil(teamMembers.value.length / itemsPerPage.value);
    });

    const startIndex = computed(() => {
      return (currentPage.value - 1) * itemsPerPage.value;
    });

    const endIndex = computed(() => {
      return startIndex.value + itemsPerPage.value;
    });

    const paginatedTeam = computed(() => {
      return teamMembers.value.slice(startIndex.value, endIndex.value);
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
        // Scroll to top of team section
        document
          .querySelector(".team-section")
          .scrollIntoView({ behavior: "smooth" });
      }
    };

    const openMemberModal = (member) => {
      selectedMember.value = member;
      showMemberModal.value = true;
      document.body.style.overflow = "hidden";
    };

    const closeMemberModal = () => {
      showMemberModal.value = false;
      selectedMember.value = null;
      document.body.style.overflow = "auto";
    };

    const getSocialIcon = (platform) => {
      const icons = {
        linkedin: "fab fa-linkedin-in",
        twitter: "fab fa-twitter",
        instagram: "fab fa-instagram",
        facebook: "fab fa-facebook-f",
        pinterest: "fab fa-pinterest-p",
        email: "fas fa-envelope",
        github: "fab fa-github",
        website: "fas fa-globe",
      };
      return icons[platform] || "fas fa-link";
    };

    const formatPlatformName = (platform) => {
      const names = {
        linkedin: "LinkedIn",
        twitter: "Twitter",
        instagram: "Instagram",
        facebook: "Facebook",
        pinterest: "Pinterest",
        email: "Email",
        github: "GitHub",
        website: "Website",
      };
      return (
        names[platform] || platform.charAt(0).toUpperCase() + platform.slice(1)
      );
    };

    // Reset pagination when filter changes
    const resetPagination = () => {
      currentPage.value = 1;
    };

    // Keyboard navigation
    const handleKeydown = (event) => {
      if (showMemberModal.value && event.key === "Escape") {
        closeMemberModal();
      }
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
      teamMembers,
      activeFilter,
      viewMode,
      currentPage,
      itemsPerPage,
      showMemberModal,
      selectedMember,
      experienceYears,

      // Computed
      totalPages,
      startIndex,
      endIndex,
      paginatedTeam,
      visiblePages,

      // Methods
      goToPage,
      openMemberModal,
      closeMemberModal,
      getSocialIcon,
      formatPlatformName,
      resetPagination,
    };
  },
};
</script>

<style scoped>
/* Team Wrapper */
.team-wrapper {
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
.team-header {
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
  background: url("/uploads/property_dark/property_dark_6.jpeg") center center no-repeat;
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
  color: #22c55e;
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
  background: linear-gradient(135deg, #22c55e, #16a34a);
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
  background: #22c55e;
  color: white;
  border-color: transparent;
}

/* Team Section */
.team-section {
  padding: 4rem 0;
  background: #0a0a0a;
}

.team-grid {
  display: grid;
  gap: 2rem;
  margin-bottom: 4rem;
}

.team-grid.grid {
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
}

.team-grid.list {
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

/* Team Card */
.team-card {
  background: #1a1a1a;
  border-radius: 15px;
  overflow: hidden;
  transition: all 0.3s ease;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.team-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
  border-color: #22c55e;
}

.card-image {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
}

.member-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.team-card:hover .member-image {
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
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  padding: 1rem;
}

.team-card:hover .image-overlay {
  opacity: 1;
}

.social-links {
  display: flex;
  gap: 0.5rem;
}

.social-link {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 50%;
  color: white;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.social-link:hover {
  background: #22c55e;
  transform: scale(1.1);
}

.card-content {
  padding: 1.5rem;
}

.member-name {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.member-designation {
  color: #22c55e;
  font-weight: 500;
  margin-bottom: 1rem;
}

.view-profile-btn {
  width: 100%;
  padding: 0.75rem;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.view-profile-btn:hover {
  background: linear-gradient(135deg, #16a34a, #15803d);
  transform: translateY(-2px);
}

/* List View Specific Styles */
.team-grid.list .team-card {
  display: flex;
  flex-direction: row;
  height: 200px;
}

.team-grid.list .card-image {
  width: 300px;
  flex-shrink: 0;
}

.team-grid.list .card-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 2rem;
}

.team-grid.list .member-designation {
  margin-bottom: 1.5rem;
}

.team-grid.list .view-profile-btn {
  width: auto;
  padding: 0.5rem 1.5rem;
  align-self: flex-start;
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
  background: #22c55e;
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
  background: #22c55e;
  border-color: transparent;
}

.pagination-info {
  color: #b0b0b0;
  font-size: 0.9rem;
}

/* Modal */
.modal-overlay {
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
  overflow-y: auto;
}

.modal-content {
  position: relative;
  max-width: 800px;
  width: 100%;
  background: #1a1a1a;
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  max-height: 90vh;
  overflow-y: auto;
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 40px;
  height: 40px;
  background: rgba(0, 0, 0, 0.7);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  z-index: 1001;
  transition: all 0.3s ease;
}

.modal-close:hover {
  background: #22c55e;
}

.modal-body {
  padding: 2rem;
}

.modal-header {
  display: flex;
  gap: 2rem;
  margin-bottom: 2rem;
  align-items: center;
}

.modal-image {
  flex-shrink: 0;
}

.profile-image {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #22c55e;
}

.modal-info {
  flex: 1;
}

.profile-name {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: #ffffff;
}

.profile-designation {
  color: #22c55e;
  font-size: 1.2rem;
  font-weight: 500;
  margin-bottom: 1.5rem;
}

.modal-social-links {
  display: flex;
  gap: 1rem;
}

.modal-social-link {
  width: 45px;
  height: 45px;
  background: #2a2a2a;
  border-radius: 50%;
  color: #b0b0b0;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-social-link:hover {
  background: #22c55e;
  color: white;
  border-color: transparent;
}

.modal-details {
  display: grid;
  gap: 2rem;
}

.detail-section h4 {
  color: #22c55e;
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding-bottom: 0.5rem;
}

.detail-section p {
  color: #b0b0b0;
  line-height: 1.6;
  margin: 0;
}

.contact-links {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.contact-link {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: #2a2a2a;
  border-radius: 8px;
  color: #b0b0b0;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-link:hover {
  background: #22c55e;
  color: white;
  border-color: transparent;
  transform: translateX(5px);
}

.contact-link i {
  width: 20px;
  font-size: 1.1rem;
}

.contact-link span {
  font-weight: 500;
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

  .team-grid.grid {
    grid-template-columns: 1fr;
  }

  .team-grid.list {
    grid-template-columns: 1fr;
  }

  .team-grid.list .team-card {
    flex-direction: column;
    height: auto;
  }

  .team-grid.list .card-image {
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

  .modal-header {
    flex-direction: column;
    text-align: center;
  }

  .modal-social-links {
    justify-content: center;
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

  .team-grid.grid {
    grid-template-columns: 1fr;
  }

  .card-content {
    padding: 1rem;
  }

  .modal-overlay {
    padding: 1rem;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .profile-image {
    width: 120px;
    height: 120px;
  }

  .profile-name {
    font-size: 1.5rem;
  }
}
</style>
