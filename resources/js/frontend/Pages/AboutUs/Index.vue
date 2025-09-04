<template>
  <div class="about-wrapper">
    <!-- Hero Section -->
    <header class="about-hero">
      <div class="hero-overlay"></div>
      <div class="container">
        <div class="hero-content">
          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <Link href="/" class="breadcrumb-link">Home</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">About Us</span>
          </nav>

          <h1 class="hero-title">{{ aboutData.title }}</h1>
          <blockquote class="hero-quote">
            <i class="fas fa-quote-left quote-icon"></i>
            <p>{{ aboutData.quotation }}</p>
          </blockquote>
        </div>
      </div>
    </header>

    <!-- Section 1: About Us -->
    <section class="about-section">
      <div class="container">
        <div class="about-content">
          <h3 class="features-title">AboutUs Us</h3>
          <!-- Video and Images Section -->
          <div class="media-section">
            <div class="primary-media">
              <div v-if="aboutData.video_url" class="video_container">
                <a
                  :href="aboutData.video_url"
                  class="video-popup-link"
                  :data-poster="aboutData.primary_image"
                >
                  <img
                    :src="aboutData.primary_image"
                    :alt="aboutData.title"
                    class="video-thumbnail"
                  />
                  <div class="video-overlay">
                    <i class="fas fa-play play-icon"></i>
                  </div>
                </a>
              </div>
              <div v-else class="image-container">
                <img
                  :src="aboutData.primary_image"
                  :alt="aboutData.title"
                  class="primary-image"
                />
              </div>
            </div>

            <div class="secondary-media">
              <img
                :src="aboutData.secondary_image"
                :alt="aboutData.title"
                class="secondary-image"
              />
            </div>
          </div>

          <!-- Description Section -->
          <div class="description-section">
            <div class="description-content">
              <p class="description-text">{{ aboutData.description }}</p>
            </div>
          </div>

          <!-- Features Section -->
          <div class="features-section">
            <h3 class="features-title">Why Choose Us</h3>
            <div class="features-grid">
              <div
                v-for="(feature, index) in aboutData.features"
                :key="index"
                class="feature-card"
              >
                <div class="feature-icon">
                  <i :class="feature.icon"></i>
                </div>
                <h4 class="feature-title">{{ feature.title }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: Our Mission -->
    <section class="mission-section">
      <div class="container">
        <div class="mission-content">
          <div class="mission-image">
            <img
              :src="missionData.primary_image"
              :alt="missionData.title"
              class="section-image"
            />
          </div>
          <div class="mission-text">
            <h2 class="section-title">{{ missionData.title }}</h2>
            <p class="section-description">{{ missionData.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 3: Our Vision -->
    <section class="vision-section">
      <div class="container">
        <div class="vision-content">
          <div class="vision-text">
            <h2 class="section-title">{{ visionData.title }}</h2>
            <p class="section-description">{{ visionData.description }}</p>
          </div>
          <div class="vision-image">
            <img
              :src="visionData.primary_image"
              :alt="visionData.title"
              class="section-image"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- At a Glance Section -->
    <section class="stats-section">
      <div class="container">
        <h2 class="stats-title">At a Glance</h2>
        <div class="stats-grid">
          <div
            v-for="(stat, index) in statsData"
            :key="index"
            class="stat-card"
          >
            <div class="stat-icon">
              <i :class="stat.icon"></i>
            </div>
            <div class="stat-number" ref="statNumbers">{{ stat.number }}</div>
            <div class="stat-label">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Team Section -->
    <section class="team-section">
      <div class="container">
        <h2 class="team-title">Our Team</h2>
        <div class="team-grid">
          <div
            v-for="(member, index) in teamData"
            :key="index"
            class="team-card"
          >
            <div class="team-image">
              <img
                :src="member.photo"
                :alt="member.name"
                class="member-photo"
              />
            </div>
            <div class="team-info">
              <h4 class="member-name">{{ member.name }}</h4>
              <p class="member-position">{{ member.position }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
      <div class="container">
        <h2 class="testimonials-title">What Our Clients Say</h2>
        <div class="testimonials-slider">
          <div
            v-for="(testimonial, index) in testimonialsData"
            :key="index"
            :class="[
              'testimonial-card',
              { active: currentTestimonial === index },
            ]"
          >
            <div class="testimonial-content">
              <div class="testimonial-quote">
                <i class="fas fa-quote-left"></i>
                <p>{{ testimonial.content }}</p>
              </div>
              <div class="testimonial-author">
                <img
                  :src="testimonial.photo"
                  :alt="testimonial.name"
                  class="author-photo"
                />
                <div class="author-info">
                  <h5 class="author-name">{{ testimonial.name }}</h5>
                  <p class="author-position">{{ testimonial.position }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonials-navigation">
          <button @click="previousTestimonial" class="nav-btn prev-btn">
            <i class="fas fa-chevron-left"></i>
          </button>
          <div class="testimonials-dots">
            <button
              v-for="(testimonial, index) in testimonialsData"
              :key="index"
              @click="currentTestimonial = index"
              :class="['dot', { active: currentTestimonial === index }]"
            ></button>
          </div>
          <button @click="nextTestimonial" class="nav-btn next-btn">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from "vue";
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
    const currentTestimonial = ref(0);

    // Section 1: About Us Data
    const aboutData = ref({
      title: "About Unique Construction & Contracting LLC",
      quotation:
        "Building Excellence, Creating Trust - Your Vision, Our Expertise",
      video_url: "https://www.youtube.com/watch?v=Npz0Nk9PkEs", // YouTube URL
      primary_image: "/uploads/stc_image/image_1.jpeg",
      secondary_image: "/uploads/stc_image/image_2.jpeg",
      description:
        "Unique Contracting Company LLC is a limited liability company based in Sultanate of Oman. We are a privately held firm registered in Muscat under the leadership of Mr. Manilal H. Limbani as the Managing Director, who has been in construction business for more than 25 years. Unique is an 'EXCELLENT' grade construction company, proud of our strong leadership and innovation over a period of time.",
      features: [
        { icon: "fas fa-star", title: "Unique in Its Own Way" },
        { icon: "fas fa-award", title: "Quality Builds Unique" },
        { icon: "fas fa-thumbs-up", title: "Exceeding Client Expectations" },
        { icon: "fas fa-handshake", title: "Long Term Relationships" },
        { icon: "fas fa-shield-alt", title: "Built on Trust" },
        { icon: "fas fa-users", title: "Expert Team" },
      ],
    });

    // Section 2: Mission Data
    const missionData = ref({
      title: "Our Mission",
      primary_image: "/uploads/stc_image/image_4.jpeg",
      description:
        "To provide exceptional construction services that exceed client expectations while maintaining the highest standards of quality, safety, and integrity. We are committed to building long-term relationships with our clients through innovative solutions, reliable delivery, and uncompromising dedication to excellence in every project we undertake.",
    });

    // Section 3: Vision Data
    const visionData = ref({
      title: "Our Vision",
      primary_image: "/uploads/stc_image/image_3.jpeg",
      description:
        "To be the leading construction company in Oman, recognized for our unwavering commitment to quality, innovation, and client satisfaction. We envision a future where Unique Construction sets the benchmark for excellence in the construction industry, contributing to the development and growth of the Sultanate of Oman.",
    });

    // At a Glance Stats
    const statsData = ref([
      { icon: "fas fa-calendar-alt", number: "25+", label: "Years Experience" },
      {
        icon: "fas fa-project-diagram",
        number: "500+",
        label: "Projects Completed",
      },
      { icon: "fas fa-users", number: "60%", label: "Repeat Clients" },
      { icon: "fas fa-medal", number: "100%", label: "Excellence Grade" },
    ]);

    // Team Data
    const teamData = ref([
      {
        name: "Manilal H. Limbani",
        position: "Managing Director",
        photo: "/uploads/avatars/avatar-1.png",
      },
      {
        name: "Ahmed Al-Rashid",
        position: "Project Manager",
        photo: "/uploads/avatars/avatar-2.png",
      },
      {
        name: "Sarah Johnson",
        position: "Chief Engineer",
        photo: "/uploads/avatars/avatar-3.png",
      },
      {
        name: "Mohammed Al-Balushi",
        position: "Operations Head",
        photo: "/uploads/avatars/avatar-4.png",
      },
    ]);

    // Testimonials Data
    const testimonialsData = ref([
      {
        content:
          "Unique Construction has been our trusted partner for multiple projects. Their attention to detail and commitment to quality is unmatched in the industry.",
        name: "Abdullah Al-Hinai",
        position: "CEO, Al-Hinai Group",
        photo: "/uploads/avatars/avatar-5.png",
      },
      {
        content:
          "Working with Unique Construction was a seamless experience. They delivered our project on time and exceeded our expectations in every aspect.",
        name: "Maria Rodriguez",
        position: "Project Director, International Holdings",
        photo: "/uploads/avatars/avatar-6.png",
      },
      {
        content:
          "The professionalism and expertise of Unique Construction's team is remarkable. They transformed our vision into reality with precision and care.",
        name: "Dr. Khalid Al-Lawati",
        position: "Chairman, Muscat Development Board",
        photo: "/uploads/avatars/avatar-7.png",
      },
    ]);

    // Methods
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

    const nextTestimonial = () => {
      currentTestimonial.value =
        (currentTestimonial.value + 1) % testimonialsData.value.length;
    };

    const previousTestimonial = () => {
      currentTestimonial.value =
        currentTestimonial.value === 0
          ? testimonialsData.value.length - 1
          : currentTestimonial.value - 1;
    };

    // Auto-slide testimonials and initialize video popup
    let testimonialInterval;
    onMounted(() => {
      testimonialInterval = setInterval(() => {
        nextTestimonial();
      }, 5000);

      // Initialize video popup
      initVideoPopup();
    });

    onUnmounted(() => {
      if (testimonialInterval) {
        clearInterval(testimonialInterval);
      }
    });

    return {
      aboutData,
      missionData,
      visionData,
      statsData,
      teamData,
      testimonialsData,
      currentTestimonial,
      initVideoPopup,
      nextTestimonial,
      previousTestimonial,
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

.about-wrapper {
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
.about-hero {
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
  background: url("/uploads/property_dark/property_dark_15.jpeg") center center no-repeat;
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
  color: #3b82f6;
  text-decoration: none;
  transition: color 0.3s ease;
}

.breadcrumb-link:hover {
  color: #60a5fa;
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
  margin-bottom: 2rem;
  background: #fff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
}

.hero-quote {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  background: rgba(59, 130, 246, 0.1);
  padding: 2rem;
  border-radius: 16px;
  border-left: 4px solid #3b82f6;
}

.quote-icon {
  font-size: 2rem;
  color: #3b82f6;
  margin-bottom: 1rem;
}

.hero-quote p {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #e5e7eb;
  font-style: italic;
}

/* About Section */
.about-section {
  padding: 80px 0;
  background: #1a1a1a;
}

.about-content {
  display: grid;
  gap: 4rem;
}

/* Media Section */
.media-section {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 2rem;
  margin-bottom: 3rem;
}

.primary-media {
  position: relative;
}
.primary-media a img{
  height: 100%;
}

.video_container {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  height: 100%;
}

.video-popup-link {
  position: relative;
  display: block;
  text-decoration: none;
  height: 100%;
}

.video-thumbnail {
  width: 100%;
  height: 400px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.about-video {
  width: 100%;
  height: 400px;
  object-fit: cover;
}

.video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.video-overlay:hover {
  background: rgba(0, 0, 0, 0.5);
}

.play-icon {
  font-size: 4rem;
  color: #ffffff;
  transition: transform 0.3s ease;
}

.video-overlay:hover .play-icon {
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

.image-container,
.secondary-media {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}
.secondary-media img{
  height: 100%;
}

.primary-image,
.secondary-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.secondary-image {
  height: 400px;
}

.image-container:hover .primary-image,
.secondary-media:hover .secondary-image,
.video-popup-link:hover .video-thumbnail {
  transform: scale(1.05);
}

/* Description Section */
.description-section {
  margin: 3rem 0;
}

.description-content {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}

.description-text {
  font-size: 1.2rem;
  line-height: 1.8;
  color: #d1d5db;
}

/* Features Section */
.features-section {
  margin: 4rem 0;
}

.features-title {
  font-size: 2.5rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 3rem;
  color: #fff;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.feature-card {
  background: #2d2d2d;
  padding: 2rem;
  border-radius: 16px;
  text-align: center;
  transition: all 0.3s ease;
  border: 1px solid #404040;
}

.feature-card:hover {
  transform: translateY(-8px);
  background: #3d3d3d;
  border-color: #3b82f6;
  box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
}

.feature-icon {
  font-size: 3rem;
  color: #3b82f6;
  margin-bottom: 1rem;
}

.feature-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #ffffff;
}

/* Mission Section */
.mission-section {
  padding: 80px 0;
  background: #0a0a0a;
}

.mission-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.mission-image,
.vision-image {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}
.mission-image img,
.vision-image img{
  height: 100%;
  display: block;
  min-height: 400px;
}

.section-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.mission-image:hover .section-image,
.vision-image:hover .section-image {
  transform: scale(1.05);
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  color: #fff;
}

.section-description {
  font-size: 1.1rem;
  line-height: 1.8;
  color: #d1d5db;
}

/* Vision Section */
.vision-section {
  padding: 80px 0;
  background: #1a1a1a;
}

.vision-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

/* Stats Section */
.stats-section {
  padding: 80px 0;
  background: #0a0a0a;
  text-align: center;
}

.stats-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 3rem;
  color: #fff;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
}

.stat-card {
  background: #1a1a1a;
  padding: 2rem;
  border-radius: 16px;
  transition: all 0.3s ease;
  border: 1px solid #2d2d2d;
}

.stat-card:hover {
  transform: translateY(-8px);
  border-color: #3b82f6;
  box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
}

.stat-icon {
  font-size: 3rem;
  color: #3b82f6;
  margin-bottom: 1rem;
}

.stat-number {
  font-size: 3rem;
  font-weight: 800;
  color: #ffffff;
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 1rem;
  color: #d1d5db;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

/* Team Section */
.team-section {
  padding: 80px 0;
  background: #1a1a1a;
  text-align: center;
}

.team-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 3rem;
  color: #fff;
}

.team-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.team-card {
  background: #2d2d2d;
  padding: 2rem;
  border-radius: 16px;
  transition: all 0.3s ease;
  border: 1px solid #404040;
}

.team-card:hover {
  transform: translateY(-8px);
  background: #3d3d3d;
  border-color: #3b82f6;
  box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
}

.team-image {
  margin-bottom: 1.5rem;
}

.member-photo {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid #3b82f6;
  margin: 0 auto;
}

.member-name {
  font-size: 1.25rem;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 0.5rem;
}

.member-position {
  color: #d1d5db;
  font-size: 1rem;
  text-align: center;
}

/* Testimonials Section */
.testimonials-section {
  padding: 80px 0;
  background: #0a0a0a;
  text-align: center;
}

.testimonials-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 3rem;
  color: #fff;
}

.testimonials-slider {
  position: relative;
  max-width: 800px;
  margin: 0 auto 2rem;
  height: 300px;
  overflow: hidden;
}

.testimonial-card {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  opacity: 0;
  transform: translateX(100%);
  transition: all 0.5s ease;
}

.testimonial-card.active {
  opacity: 1;
  transform: translateX(0);
}

.testimonial-content {
  background: #1a1a1a;
  padding: 2rem;
  border-radius: 16px;
  border: 1px solid #2d2d2d;
}

.testimonial-quote {
  margin-bottom: 2rem;
}

.testimonial-quote i {
  font-size: 2rem;
  color: #3b82f6;
  margin-bottom: 1rem;
}

.testimonial-quote p {
  font-size: 1.2rem;
  line-height: 1.6;
  color: #d1d5db;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.author-photo {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #3b82f6;
}

.author-info {
  text-align: left;
}

.author-name {
  font-size: 1.1rem;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 0.25rem;
}

.author-position {
  font-size: 0.9rem;
  color: #d1d5db;
}

.testimonials-navigation {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 2rem;
}

.nav-btn {
  background: #2d2d2d;
  border: none;
  color: #ffffff;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.nav-btn:hover {
  background: #3b82f6;
  transform: scale(1.1);
}

.testimonials-dots {
  display: flex;
  gap: 0.5rem;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: none;
  background: #404040;
  cursor: pointer;
  transition: all 0.3s ease;
}

.dot.active {
  background: #3b82f6;
  transform: scale(1.2);
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .hero-quote {
    padding: 1.5rem;
  }

  .hero-quote p {
    font-size: 1.1rem;
  }

  .media-section {
    grid-template-columns: 1fr;
  }

  .mission-content,
  .vision-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .about-video,
  .primary-image,
  .secondary-image,
  .section-image {
    height: 250px;
  }

  .features-grid {
    grid-template-columns: 1fr;
  }

  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .team-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .testimonials-navigation {
    flex-direction: column;
    gap: 1rem;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }

  .section-title {
    font-size: 2rem;
  }

  .features-title,
  .stats-title,
  .team-title,
  .testimonials-title {
    font-size: 2rem;
  }

  .stats-grid,
  .team-grid {
    grid-template-columns: 1fr;
  }

  .testimonial-author {
    flex-direction: column;
    text-align: center;
  }

  .author-info {
    text-align: center;
  }
}
</style>
