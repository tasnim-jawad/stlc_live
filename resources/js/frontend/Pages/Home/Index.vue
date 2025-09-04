<template>
  <div class="homepage">
    <!-- Hero Section -->
    <section class="hero-section">
      <!-- Hero Slides -->
      <div class="hero-slider">
        <div
          v-for="(slide, index) in heroSlides"
          :key="index"
          class="hero-slide"
          :class="{ active: currentSlide === index }"
          :style="{ backgroundImage: `url(${slide.backgroundImage})` }"
        >
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <div class="container">
              <div class="hero-text">
                <div class="hero-badge">
                  <i :class="slide.badgeIcon"></i>
                  <span>{{ slide.badge }}</span>
                </div>
                <h1 class="hero-title">
                  {{ slide.title.main }}<br />
                  <span class="highlight">{{ slide.title.highlight }}</span>
                </h1>
                <p class="hero-subtitle">{{ slide.subtitle }}</p>
                <div class="hero-actions">
                  <button
                    class="btn-primary"
                    @click="handlePrimaryAction(slide.primaryAction)"
                  >
                    <i :class="slide.primaryAction.icon"></i>
                    {{ slide.primaryAction.text }}
                  </button>
                  <button
                    class="btn-secondary"
                    @click="handleSecondaryAction(slide.secondaryAction)"
                  >
                    <i :class="slide.secondaryAction.icon"></i>
                    {{ slide.secondaryAction.text }}
                  </button>
                </div>
              </div>
              <!-- <div class="hero-stats">
                <div
                  class="stat-item"
                  v-for="stat in slide.stats"
                  :key="stat.label"
                >
                  <div class="stat-number">{{ stat.number }}</div>
                  <div class="stat-label">{{ stat.label }}</div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Hero Navigation -->
      <div class="hero-navigation">
        <div class="container">
          <!-- Slide Indicators -->
          <div class="slide-indicators">
            <button
              v-for="(slide, index) in heroSlides"
              :key="index"
              class="slide-indicator"
              :class="{ active: currentSlide === index }"
              @click="changeSlide(index)"
              :aria-label="`Go to slide ${index + 1}`"
            >
              <span class="indicator-number">{{ index + 1 }}</span>
              <span class="indicator-label">{{ slide.navLabel }}</span>
            </button>
            <!-- Debug info -->
            <div class="debug-info" style="color: white; margin-left: 20px">
              Current: {{ currentSlide }}
            </div>
          </div>

          <!-- Navigation Arrows -->
          <div class="slide-arrows">
            <button
              class="arrow-btn prev"
              @click="previousSlide"
              aria-label="Previous slide"
            >
              <i class="icon-left-open"></i>
            </button>
            <button
              class="arrow-btn next"
              @click="nextSlide"
              aria-label="Next slide"
            >
              <i class="icon-right-open"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="hero-progress">
        <div class="progress-bar" :style="{ width: progressWidth + '%' }"></div>
      </div>
    </section>

    <!-- About Us Section -->
    <section class="about-section" id="about">
      <div class="container">
        <div class="about-content">
          <div class="about-text">
            <div class="section-header">
              <span class="section-tag">About STC</span>
              <h2 class="section-title">Building Bangladesh's Future</h2>
            </div>
            <p class="about-description">
              Since 2017, STC Building & Properties has been at the forefront of
              Bangladesh's construction industry. We specialize in residential,
              commercial, and industrial projects, delivering quality
              craftsmanship that exceeds expectations.
            </p>
            <div class="about-features">
              <div class="feature-item">
                <i class="icon-ok-circled"></i>
                <span>Licensed & Insured Contractors</span>
              </div>
              <div class="feature-item">
                <i class="icon-ok-circled"></i>
                <span>Quality Materials & Equipment</span>
              </div>
              <div class="feature-item">
                <i class="icon-ok-circled"></i>
                <span>On-Time Project Delivery</span>
              </div>
              <div class="feature-item">
                <i class="icon-ok-circled"></i>
                <span>24/7 Customer Support</span>
              </div>
            </div>
            <button class="btn-primary">Learn More About Us</button>
          </div>
          <div class="about-image">
            <div class="image-card">
              <img
                src="/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg"
                alt="STC Construction Team"
              />
              <div class="image-overlay">
                <div class="play-button">
                  <i class="icon-play"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Our Services</span>
          <h2 class="section-title">Complete Construction Solutions</h2>
          <p class="section-subtitle">
            From concept to completion, we handle every aspect of your
            construction project
          </p>
        </div>
        <div class="services-grid">
          <div
            class="service-card"
            v-for="service in services"
            :key="service.id"
          >
            <div class="service-icon">
              <i :class="service.icon"></i>
            </div>
            <h3 class="service-title">{{ service.title }}</h3>
            <p class="service-description">{{ service.description }}</p>
            <a href="#" class="service-link">
              Learn More <i class="icon-right-open"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Portfolio Section -->
    <section class="portfolio-section" id="portfolio">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Our Portfolio</span>
          <h2 class="section-title">Featured Projects</h2>
          <p class="section-subtitle">
            Showcasing our finest construction achievements
          </p>
        </div>
        <div class="portfolio-filter">
          <button class="filter-btn active" @click="filterProjects('all')">
            All Projects
          </button>
          <button class="filter-btn" @click="filterProjects('residential')">
            Residential
          </button>
          <button class="filter-btn" @click="filterProjects('commercial')">
            Commercial
          </button>
          <button class="filter-btn" @click="filterProjects('industrial')">
            Industrial
          </button>
        </div>
        <div class="portfolio-grid">
          <div
            class="portfolio-item"
            v-for="project in filteredProjects"
            :key="project.id"
          >
            <div class="project-image">
              <img :src="project.image" :alt="project.title" />
              <div class="project-overlay">
                <div class="project-info">
                  <h3 class="project-title">{{ project.title }}</h3>
                  <p class="project-category">{{ project.category }}</p>
                  <div class="project-actions">
                    <button class="btn-icon">
                      <i class="icon-search"></i>
                    </button>
                    <button class="btn-icon">
                      <i class="icon-link"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section">
      <div class="container">
        <div class="why-choose-content">
          <div class="why-choose-text">
            <div class="section-header">
              <span class="section-tag">Why Choose STC</span>
              <h2 class="section-title">Your Trusted Construction Partner</h2>
            </div>
            <div class="benefits-grid">
              <div
                class="benefit-item"
                v-for="benefit in benefits"
                :key="benefit.id"
              >
                <div class="benefit-icon">
                  <i :class="benefit.icon"></i>
                </div>
                <div class="benefit-content">
                  <h3 class="benefit-title">{{ benefit.title }}</h3>
                  <p class="benefit-description">{{ benefit.description }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="why-choose-stats">
            <div class="stats-card">
              <div class="stat-circle">
                <div class="stat-number">98%</div>
                <div class="stat-label">Customer Satisfaction</div>
              </div>
              <div class="stat-circle">
                <div class="stat-number">500+</div>
                <div class="stat-label">Completed Projects</div>
              </div>
              <div class="stat-circle">
                <div class="stat-number">7+</div>
                <div class="stat-label">Years in Business</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Client Reviews</span>
          <h2 class="section-title">What Our Clients Say</h2>
        </div>
        <div class="testimonials-slider">
          <div
            class="testimonial-card"
            v-for="testimonial in testimonials"
            :key="testimonial.id"
          >
            <div class="testimonial-content">
              <div class="quote-icon">
                <i class="icon-quote-left"></i>
              </div>
              <p class="testimonial-text">{{ testimonial.text }}</p>
              <div class="testimonial-author">
                <div class="author-avatar">
                  <img :src="testimonial.avatar" :alt="testimonial.name" />
                </div>
                <div class="author-info">
                  <h4 class="author-name">{{ testimonial.name }}</h4>
                  <p class="author-title">{{ testimonial.title }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Banner Section -->
    <section class="cta-section">
      <div class="container">
        <div class="cta-content">
          <div class="cta-text">
            <h2 class="cta-title">Ready to Start Your Construction Project?</h2>
            <p class="cta-subtitle">
              Get a free consultation and quote from our expert team today.
            </p>
          </div>
          <div class="cta-actions">
            <button class="btn-primary">
              <i class="icon-phone"></i>
              Call Now: +880 1234-567890
            </button>
            <button class="btn-secondary">
              <i class="icon-mail"></i>
              Get Free Quote
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "HomePage",
  data() {
    return {
      currentSlide: 0,
      autoSlideInterval: null,
      progressWidth: 0,
      activeFilter: "all",
      heroSlides: [
        {
          navLabel: "Residential",
          badge: "Premium Homes",
          badgeIcon: "icon-home",
          title: {
            main: "Building Dreams,",
            highlight: "Constructing Excellence",
          },
          subtitle:
            "With over 7 years of experience, STC Building & Properties delivers premium construction solutions that stand the test of time.",
          backgroundImage:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
          primaryAction: {
            text: "Get Free Quote",
            icon: "icon-phone",
            action: "contact",
          },
          secondaryAction: {
            text: "View Our Work",
            icon: "icon-play",
            action: "portfolio",
          },
          stats: [
            { number: "500+", label: "Projects Completed" },
            { number: "7+", label: "Years Experience" },
            { number: "100%", label: "Client Satisfaction" },
          ],
        },
        {
          navLabel: "Commercial",
          badge: "Business Solutions",
          badgeIcon: "icon-building",
          title: {
            main: "Commercial Excellence,",
            highlight: "Business Growth",
          },
          subtitle:
            "From office buildings to retail spaces, we create commercial environments that drive success and inspire productivity.",
          backgroundImage:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
          primaryAction: {
            text: "Discuss Project",
            icon: "icon-chat",
            action: "contact",
          },
          secondaryAction: {
            text: "Commercial Portfolio",
            icon: "icon-briefcase",
            action: "portfolio",
          },
          stats: [
            { number: "200+", label: "Commercial Projects" },
            { number: "50+", label: "Business Clients" },
            { number: "99%", label: "On-Time Delivery" },
          ],
        },
        {
          navLabel: "Industrial",
          badge: "Industrial Power",
          badgeIcon: "icon-industry",
          title: {
            main: "Industrial Innovation,",
            highlight: "Maximum Efficiency",
          },
          subtitle:
            "Specialized in warehouses, factories, and industrial facilities designed for operational excellence and future growth.",
          backgroundImage:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
          primaryAction: {
            text: "Plan Industrial Project",
            icon: "icon-cog",
            action: "contact",
          },
          secondaryAction: {
            text: "Industrial Cases",
            icon: "icon-industry",
            action: "portfolio",
          },
          stats: [
            { number: "150+", label: "Industrial Projects" },
            { number: "25+", label: "Factory Builds" },
            { number: "95%", label: "Efficiency Boost" },
          ],
        },
        {
          navLabel: "Renovation",
          badge: "Transform & Upgrade",
          badgeIcon: "icon-wrench",
          title: {
            main: "Renovation Mastery,",
            highlight: "Space Transformation",
          },
          subtitle:
            "Breathe new life into existing spaces with our expert renovation and remodeling services that exceed expectations.",
          backgroundImage:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
          primaryAction: {
            text: "Start Renovation",
            icon: "icon-hammer",
            action: "contact",
          },
          secondaryAction: {
            text: "Before & After",
            icon: "icon-picture",
            action: "portfolio",
          },
          stats: [
            { number: "300+", label: "Renovations Done" },
            { number: "90%", label: "Cost Savings" },
            { number: "100%", label: "Design Satisfaction" },
          ],
        },
      ],
      services: [
        {
          id: 1,
          icon: "icon-home",
          title: "Residential Construction",
          description:
            "Custom homes, apartments, and residential complexes built to your specifications.",
        },
        {
          id: 2,
          icon: "icon-building",
          title: "Commercial Building",
          description:
            "Office buildings, retail spaces, and commercial complexes for your business needs.",
        },
        {
          id: 3,
          icon: "icon-industry",
          title: "Industrial Projects",
          description:
            "Warehouses, factories, and industrial facilities designed for maximum efficiency.",
        },
        {
          id: 4,
          icon: "icon-wrench",
          title: "Renovation & Remodeling",
          description:
            "Transform existing spaces with our expert renovation and remodeling services.",
        },
        {
          id: 5,
          icon: "icon-chart-line",
          title: "Project Management",
          description:
            "Comprehensive project management from planning to completion.",
        },
        {
          id: 6,
          icon: "icon-cog",
          title: "Consulting Services",
          description:
            "Expert advice and consulting for all your construction needs.",
        },
      ],
      projects: [
        {
          id: 1,
          title: "Modern Residential Complex",
          category: "residential",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 2,
          title: "Corporate Office Building",
          category: "commercial",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 3,
          title: "Industrial Warehouse",
          category: "industrial",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 4,
          title: "Luxury Villa Project",
          category: "residential",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 5,
          title: "Shopping Mall Complex",
          category: "commercial",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 6,
          title: "Manufacturing Plant",
          category: "industrial",
          image:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
      ],
      benefits: [
        {
          id: 1,
          icon: "icon-award",
          title: "Quality Assurance",
          description:
            "We maintain the highest standards of quality in every project we undertake.",
        },
        {
          id: 2,
          icon: "icon-clock",
          title: "Timely Delivery",
          description:
            "We respect your time and ensure all projects are completed on schedule.",
        },
        {
          id: 3,
          icon: "icon-dollar",
          title: "Competitive Pricing",
          description:
            "Get the best value for your investment with our transparent pricing.",
        },
        {
          id: 4,
          icon: "icon-users",
          title: "Expert Team",
          description:
            "Our skilled professionals bring years of experience to every project.",
        },
      ],
      testimonials: [
        {
          id: 1,
          name: "Ahmed Rahman",
          title: "Homeowner",
          text: "STC Building & Properties exceeded our expectations in building our dream home. Their attention to detail and quality workmanship is outstanding.",
          avatar:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 2,
          name: "Sarah Khan",
          title: "Business Owner",
          text: "Our office building project was completed on time and within budget. The team was professional and delivered exactly what we envisioned.",
          avatar:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
        {
          id: 3,
          name: "Mohammad Ali",
          title: "Developer",
          text: "Working with STC has been a pleasure. Their expertise in commercial construction is evident in the quality of their work.",
          avatar:
            "/assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg",
        },
      ],
    };
  },
  computed: {
    filteredProjects() {
      if (this.activeFilter === "all") {
        return this.projects;
      }
      return this.projects.filter(
        (project) => project.category === this.activeFilter
      );
    },
  },
  mounted() {
    this.startAutoSlide();
  },
  beforeUnmount() {
    this.stopAutoSlide();
  },
  methods: {
    changeSlide(index) {
      console.log("Changing to slide:", index); // Debug log
      this.currentSlide = index;
      this.resetProgress();
    },
    nextSlide() {
      const nextIndex = (this.currentSlide + 1) % this.heroSlides.length;
      console.log("Next slide:", nextIndex); // Debug log
      this.currentSlide = nextIndex;
      this.resetProgress();
    },
    previousSlide() {
      const prevIndex =
        this.currentSlide === 0
          ? this.heroSlides.length - 1
          : this.currentSlide - 1;
      console.log("Previous slide:", prevIndex); // Debug log
      this.currentSlide = prevIndex;
      this.resetProgress();
    },
    startAutoSlide() {
      this.stopAutoSlide();
      this.progressWidth = 0;

      // Auto-advance slides every 6 seconds
      this.autoSlideInterval = setInterval(() => {
        this.nextSlide();
      }, 6000);

      // Progress bar animation
      this.progressInterval = setInterval(() => {
        this.progressWidth += 100 / 600; // 6 seconds = 600 intervals of 10ms
        if (this.progressWidth >= 100) {
          this.progressWidth = 0;
        }
      }, 10);
    },
    stopAutoSlide() {
      if (this.autoSlideInterval) {
        clearInterval(this.autoSlideInterval);
        this.autoSlideInterval = null;
      }
      if (this.progressInterval) {
        clearInterval(this.progressInterval);
        this.progressInterval = null;
      }
    },
    resetProgress() {
      this.progressWidth = 0;
      this.stopAutoSlide();
      // Restart auto-slide after a short delay
      setTimeout(() => {
        this.startAutoSlide();
      }, 100);
    },
    handlePrimaryAction(action) {
      switch (action.action) {
        case "contact":
          // Scroll to contact section or open contact form
          this.scrollToSection("#contact");
          break;
        case "portfolio":
          this.scrollToSection("#portfolio");
          break;
        default:
          console.log("Primary action:", action);
      }
    },
    handleSecondaryAction(action) {
      switch (action.action) {
        case "portfolio":
          this.scrollToSection("#portfolio");
          break;
        case "contact":
          this.scrollToSection("#contact");
          break;
        default:
          console.log("Secondary action:", action);
      }
    },
    scrollToSection(selector) {
      const element = document.querySelector(selector);
      if (element) {
        element.scrollIntoView({ behavior: "smooth" });
      }
    },
    filterProjects(category) {
      this.activeFilter = category;
      // Update active state for filter buttons
      document
        .querySelectorAll(".filter-btn")
        .forEach((btn) => btn.classList.remove("active"));
      event.target.classList.add("active");
    },
  },
};
</script>

<style scoped>
/* CSS Variables for consistent theming */
:root {
  --primary-dark: #1a1a1a;
  --primary-darker: #0a0a0a;
  --accent-yellow: #ffd700;
  --accent-orange: #ff8c00;
  --text-light: #ffffff;
  --text-gray: #cccccc;
  --text-muted: #888888;
  --border-dark: #333333;
  --glass-bg: rgba(255, 255, 255, 0.05);
  --glass-border: rgba(255, 255, 255, 0.1);
}

/* Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.homepage {
  background-color: var(--primary-darker);
  color: var(--text-light);
  font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Button Styles */
.btn-primary,
.btn-secondary {
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}

.btn-primary {
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  color: var(--primary-dark);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(255, 215, 0, 0.3);
}

.btn-secondary {
  background: transparent;
  color: var(--text-light);
  border: 2px solid var(--glass-border);
}

.btn-secondary:hover {
  background: var(--glass-bg);
  border-color: var(--accent-yellow);
}

/* Section Headers */
.section-header {
  margin-bottom: 50px;
}

.section-tag {
  display: inline-block;
  padding: 8px 20px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 20px;
  color: var(--accent-yellow);
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 15px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--text-light);
  margin-bottom: 20px;
  line-height: 1.2;
}

.section-subtitle {
  font-size: 1.1rem;
  color: var(--text-gray);
  max-width: 600px;
}

.text-center {
  text-align: center;
}

.text-center .section-subtitle {
  margin: 0 auto;
}

/* Hero Section */
.hero-section {
  min-height: 100vh;
  position: relative;
  overflow: hidden;
}

.hero-slider {
  position: relative;
  width: 100%;
  height: 100vh;
}

.hero-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0;
  visibility: hidden;
  transform: scale(1.1);
  transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  display: flex;
  align-items: center;
  z-index: 1;
}

.hero-slide.active {
  opacity: 1;
  visibility: visible;
  transform: scale(1);
  z-index: 2;
}

.hero-slide::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  z-index: 1;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg,
    rgba(26, 26, 26, 0.7) 0%,
    rgba(10, 10, 10, 0.5) 100%
  );
  z-index: 2;
}

.hero-content {
  position: relative;
  z-index: 3;
  width: 100%;
  padding: 100px 0 120px;
  opacity: 0;
  transform: translateY(30px);
  animation: slideContentIn 0.8s ease-out 0.4s forwards;
}

.hero-slide.active .hero-content {
  opacity: 1;
  transform: translateY(0);
  animation: slideContentIn 0.8s ease-out 0.2s forwards;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 20px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 25px;
  color: var(--accent-yellow);
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 25px;
  backdrop-filter: blur(10px);
  opacity: 0;
  transform: translateY(20px);
  animation: slideInUp 0.6s ease-out 0.3s forwards;
}

.hero-slide.active .hero-badge {
  animation: slideInUp 0.6s ease-out 0.1s forwards;
}

.hero-title {
  font-size: 4rem;
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 25px;
  opacity: 0;
  transform: translateY(30px);
  animation: slideInUp 0.8s ease-out 0.5s forwards;
}

.hero-slide.active .hero-title {
  animation: slideInUp 0.8s ease-out 0.2s forwards;
}

.hero-subtitle {
  font-size: 1.3rem;
  color: var(--text-gray);
  margin-bottom: 40px;
  line-height: 1.7;
  opacity: 0;
  transform: translateY(20px);
  animation: slideInUp 0.8s ease-out 0.7s forwards;
}

.hero-slide.active .hero-subtitle {
  animation: slideInUp 0.8s ease-out 0.3s forwards;
}

.hero-actions {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(20px);
  animation: slideInUp 0.8s ease-out 0.9s forwards;
}

.hero-slide.active .hero-actions {
  animation: slideInUp 0.8s ease-out 0.4s forwards;
}

.hero-stats {
  display: flex;
  gap: 50px;
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(30px);
  animation: slideInUp 0.8s ease-out 1.1s forwards;
}

.hero-badge i {
  font-size: 16px;
}

.hero-text {
  max-width: 700px;
  margin-bottom: 60px;
}

.highlight {
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  position: relative;
}

.highlight::after {
  content: "";
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  border-radius: 2px;
  animation: expandWidth 1s ease-out 1.3s both;
}

.stat-item {
  text-align: center;
  position: relative;
  padding: 20px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 15px;
  backdrop-filter: blur(10px);
  transition: transform 0.3s ease;
}

.stat-item:hover {
  transform: translateY(-5px);
  border-color: var(--accent-yellow);
}

.stat-number {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--accent-yellow);
  margin-bottom: 8px;
  position: relative;
}

.stat-label {
  font-size: 0.95rem;
  color: var(--text-gray);
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 500;
}

/* Hero Navigation */
.hero-navigation {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 4;
  background: linear-gradient(
    to top,
    rgba(10, 10, 10, 0.9) 0%,
    transparent 100%
  );
  backdrop-filter: blur(10px);
}

.slide-indicators {
  display: flex;
  justify-content: center;
  gap: 15px;
  padding: 30px 0;
  flex-wrap: wrap;
}

.slide-indicator {
  background: var(--glass-bg);
  border: 2px solid var(--glass-border);
  border-radius: 12px;
  padding: 15px 25px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 12px;
  backdrop-filter: blur(10px);
  position: relative;
  overflow: hidden;
}

.slide-indicator::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 215, 0, 0.1),
    transparent
  );
  transition: left 0.6s ease;
}

.slide-indicator:hover::before {
  left: 100%;
}

.slide-indicator:hover,
.slide-indicator.active {
  border-color: var(--accent-yellow);
  background: rgba(255, 215, 0, 0.1);
  transform: translateY(-2px);
}

.indicator-number {
  width: 25px;
  height: 25px;
  background: var(--accent-yellow);
  color: var(--primary-dark);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 14px;
}

.slide-indicator.active .indicator-number {
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  animation: pulse 2s infinite;
}

.indicator-label {
  color: var(--text-light);
  font-weight: 600;
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.slide-arrows {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  padding: 0 30px;
  pointer-events: none;
}

.arrow-btn {
  width: 60px;
  height: 60px;
  background: var(--glass-bg);
  border: 2px solid var(--glass-border);
  border-radius: 50%;
  color: var(--text-light);
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  backdrop-filter: blur(10px);
  pointer-events: auto;
}

.arrow-btn:hover {
  border-color: var(--accent-yellow);
  background: rgba(255, 215, 0, 0.1);
  transform: scale(1.1);
}

.arrow-btn:active {
  transform: scale(0.95);
}

/* Progress Bar */
.hero-progress {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: rgba(255, 255, 255, 0.1);
  z-index: 5;
}

.progress-bar {
  height: 100%;
  background: linear-gradient(
    90deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  transition: width 0.1s linear;
  box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
}

/* Animations */
@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideContentIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes expandWidth {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

@keyframes pulse {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

@keyframes fadeInScale {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* About Section */
.about-section {
  padding: 100px 0;
  background: var(--primary-dark);
}

.about-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.about-description {
  font-size: 1.1rem;
  color: var(--text-gray);
  margin-bottom: 30px;
  line-height: 1.8;
}

.about-features {
  margin-bottom: 40px;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
  font-size: 1rem;
  color: var(--text-gray);
}

.feature-item i {
  color: var(--accent-yellow);
  font-size: 1.2rem;
}

.about-image {
  position: relative;
}

.image-card {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.image-card img {
  width: 100%;
  height: 400px;
  object-fit: cover;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.image-card:hover .image-overlay {
  opacity: 1;
}

.play-button {
  width: 80px;
  height: 80px;
  background: var(--accent-yellow);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--primary-dark);
  font-size: 1.5rem;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.play-button:hover {
  transform: scale(1.1);
}

/* Services Section */
.services-section {
  padding: 100px 0;
  background: var(--primary-darker);
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
}

.service-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.service-card:hover {
  transform: translateY(-10px);
  border-color: var(--accent-yellow);
  box-shadow: 0 20px 40px rgba(255, 215, 0, 0.1);
}

.service-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
  color: var(--primary-dark);
  font-size: 2rem;
}

.service-title {
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 15px;
}

.service-description {
  color: var(--text-gray);
  margin-bottom: 25px;
  line-height: 1.6;
}

.service-link {
  color: var(--accent-yellow);
  text-decoration: none;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  transition: color 0.3s ease;
}

.service-link:hover {
  color: var(--accent-orange);
}

/* Portfolio Section */
.portfolio-section {
  padding: 100px 0;
  background: var(--primary-dark);
}

.portfolio-filter {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-bottom: 60px;
  flex-wrap: wrap;
}

.filter-btn {
  padding: 12px 25px;
  background: transparent;
  border: 2px solid var(--border-dark);
  border-radius: 25px;
  color: var(--text-gray);
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
}

.filter-btn:hover,
.filter-btn.active {
  background: var(--accent-yellow);
  border-color: var(--accent-yellow);
  color: var(--primary-dark);
}

.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
}

.portfolio-item {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.project-image {
  position: relative;
}

.project-image img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.portfolio-item:hover .project-image img {
  transform: scale(1.1);
}

.project-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
  display: flex;
  align-items: flex-end;
  padding: 30px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.portfolio-item:hover .project-overlay {
  opacity: 1;
}

.project-info {
  width: 100%;
}

.project-title {
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 5px;
}

.project-category {
  color: var(--accent-yellow);
  text-transform: uppercase;
  font-size: 0.9rem;
  letter-spacing: 1px;
  margin-bottom: 15px;
}

.project-actions {
  display: flex;
  gap: 10px;
}

.btn-icon {
  width: 40px;
  height: 40px;
  background: var(--accent-yellow);
  border: none;
  border-radius: 50%;
  color: var(--primary-dark);
  cursor: pointer;
  transition: transform 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-icon:hover {
  transform: scale(1.1);
}

/* Why Choose Us Section */
.why-choose-section {
  padding: 100px 0;
  background: var(--primary-darker);
}

.why-choose-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.benefits-grid {
  display: grid;
  gap: 30px;
}

.benefit-item {
  display: flex;
  gap: 20px;
  align-items: flex-start;
}

.benefit-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--primary-dark);
  font-size: 1.5rem;
  flex-shrink: 0;
}

.benefit-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 10px;
}

.benefit-description {
  color: var(--text-gray);
  line-height: 1.6;
}

.stats-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 20px;
  padding: 40px;
  backdrop-filter: blur(10px);
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.stat-circle {
  text-align: center;
  padding: 20px;
  border: 2px solid var(--accent-yellow);
  border-radius: 50%;
  aspect-ratio: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.stat-circle .stat-number {
  font-size: 2rem;
  font-weight: 800;
  color: var(--accent-yellow);
  margin-bottom: 5px;
}

.stat-circle .stat-label {
  font-size: 0.8rem;
  color: var(--text-gray);
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Testimonials Section */
.testimonials-section {
  padding: 100px 0;
  background: var(--primary-dark);
}

.testimonials-slider {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
}

.testimonial-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 20px;
  padding: 40px;
  backdrop-filter: blur(10px);
  transition: transform 0.3s ease;
}

.testimonial-card:hover {
  transform: translateY(-5px);
}

.quote-icon {
  font-size: 2.5rem;
  color: var(--accent-yellow);
  margin-bottom: 20px;
}

.testimonial-text {
  font-size: 1.1rem;
  color: var(--text-gray);
  line-height: 1.8;
  margin-bottom: 30px;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  align-items: center;
  gap: 15px;
}

.author-avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  overflow: hidden;
  border: 2px solid var(--accent-yellow);
}

.author-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.author-name {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 5px;
}

.author-title {
  font-size: 0.9rem;
  color: var(--text-muted);
}

/* CTA Section */
.cta-section {
  padding: 80px 0;
  background: linear-gradient(
    135deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
}

.cta-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 40px;
  flex-wrap: wrap;
}

.cta-title {
  font-size: 2.2rem;
  font-weight: 700;
  color: var(--primary-dark);
  margin-bottom: 15px;
}

.cta-subtitle {
  font-size: 1.1rem;
  color: var(--primary-dark);
  opacity: 0.8;
}

.cta-actions {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.cta-section .btn-primary {
  background: var(--primary-dark);
  color: var(--text-light);
}

.cta-section .btn-secondary {
  background: transparent;
  color: var(--primary-dark);
  border-color: var(--primary-dark);
}

.cta-section .btn-secondary:hover {
  background: var(--primary-dark);
  color: var(--text-light);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.8rem;
  }

  .hero-subtitle {
    font-size: 1.1rem;
  }

  .hero-stats {
    gap: 20px;
    justify-content: center;
  }

  .stat-item {
    padding: 15px;
    min-width: 120px;
  }

  .hero-badge {
    font-size: 12px;
    padding: 8px 16px;
  }

  .slide-indicators {
    gap: 10px;
    padding: 20px 0;
  }

  .slide-indicator {
    padding: 12px 20px;
    gap: 8px;
  }

  .indicator-number {
    width: 20px;
    height: 20px;
    font-size: 12px;
  }

  .indicator-label {
    font-size: 12px;
  }

  .arrow-btn {
    width: 50px;
    height: 50px;
    font-size: 1rem;
  }

  .slide-arrows {
    padding: 0 20px;
  }

  .section-title {
    font-size: 2rem;
  }

  .about-content,
  .why-choose-content {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .hero-actions,
  .cta-actions {
    flex-direction: column;
    align-items: stretch;
  }

  .cta-content {
    text-align: center;
    flex-direction: column;
  }

  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }

  .services-grid,
  .portfolio-grid,
  .testimonials-slider {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 15px;
  }

  .hero-title {
    font-size: 2.2rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .hero-content {
    padding: 80px 0 100px;
  }

  .hero-actions {
    gap: 15px;
  }

  .btn-primary,
  .btn-secondary {
    padding: 12px 24px;
    font-size: 14px;
  }

  .slide-indicators {
    flex-direction: column;
    align-items: center;
    gap: 8px;
  }

  .slide-indicator {
    width: 100%;
    max-width: 200px;
    justify-content: center;
  }

  .hero-stats {
    flex-direction: column;
    align-items: center;
    gap: 15px;
  }

  .stat-item {
    width: 100%;
    max-width: 200px;
  }

  .section-title {
    font-size: 1.8rem;
  }

  .service-card,
  .testimonial-card {
    padding: 30px 20px;
  }

  .portfolio-filter {
    gap: 10px;
  }

  .filter-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
}
</style>
