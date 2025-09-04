<template>
  <div class="footer-wrapper">
    <!-- Footer Section -->
    <footer class="footer-section">
      <div class="container">
        <div class="footer-content">
          <div class="footer-column">
            <div class="footer-logo">
              <img src="/logo.png" alt="STC Building & Properties" />
              <h3>STC Building & Properties</h3>
            </div>
            <p class="footer-description">
              Building Bangladesh's future with quality construction solutions
              since 2017. Your trusted partner for residential, commercial, and
              industrial projects.
            </p>
            <div class="social-links">
              <a href="#" class="social-link" aria-label="Facebook">
                <i class="icon-facebook"></i>
              </a>
              <a href="#" class="social-link" aria-label="Twitter">
                <i class="icon-twitter"></i>
              </a>
              <a href="#" class="social-link" aria-label="LinkedIn">
                <i class="icon-linkedin"></i>
              </a>
              <a href="#" class="social-link" aria-label="Instagram">
                <i class="icon-instagram"></i>
              </a>
            </div>
          </div>
          <div class="footer-column">
            <h4 class="footer-title">Quick Links</h4>
            <ul class="footer-links">
              <li><a href="#about">About Us</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#portfolio">Portfolio</a></li>
              <li><a href="#testimonials">Reviews</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h4 class="footer-title">Services</h4>
            <ul class="footer-links">
              <li><a href="#">Residential Construction</a></li>
              <li><a href="#">Commercial Building</a></li>
              <li><a href="#">Industrial Projects</a></li>
              <li><a href="#">Renovation & Remodeling</a></li>
              <li><a href="#">Project Management</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h4 class="footer-title">Contact Info</h4>
            <div class="contact-info">
              <div class="contact-item">
                <i class="icon-location"></i>
                <span>Dhaka, Bangladesh</span>
              </div>
              <div class="contact-item">
                <i class="icon-phone"></i>
                <span>+880 1234-567890</span>
              </div>
              <div class="contact-item">
                <i class="icon-mail"></i>
                <span>info@stcbuilding.com</span>
              </div>
              <div class="contact-item">
                <i class="icon-clock"></i>
                <span>Mon - Sat: 8:00 AM - 6:00 PM</span>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="footer-copyright">
            <p>&copy; 2024 STC Building & Properties. All rights reserved.</p>
          </div>
          <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Sitemap</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {};
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

.footer-wrapper {
  width: 100%;
  background: var(--primary-darker);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Footer Section */
.footer-section {
  padding: 80px 0 30px;
  background: var(--primary-darker);
  border-top: 1px solid var(--border-dark);
  color: var(--text-light);
  font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.footer-content {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1.5fr;
  gap: 50px;
  margin-bottom: 50px;
}

.footer-column {
  display: flex;
  flex-direction: column;
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 25px;
}

.footer-logo img {
  width: 50px;
  height: 50px;
  object-fit: contain;
  border-radius: 8px;
}

.footer-logo h3 {
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--text-light);
  margin: 0;
  line-height: 1.2;
}

.footer-description {
  color: var(--text-gray);
  line-height: 1.7;
  margin-bottom: 30px;
  font-size: 1rem;
  max-width: 350px;
}

.social-links {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

.social-link {
  width: 45px;
  height: 45px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--text-gray);
  text-decoration: none;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  font-size: 1.1rem;
}

.social-link:hover {
  background: var(--accent-yellow);
  color: var(--primary-dark);
  border-color: var(--accent-yellow);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

.footer-title {
  font-size: 1.3rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 25px;
  position: relative;
  padding-bottom: 10px;
}

.footer-title::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 30px;
  height: 2px;
  background: linear-gradient(
    90deg,
    var(--accent-yellow),
    var(--accent-orange)
  );
  border-radius: 1px;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: 12px;
}

.footer-links a {
  color: var(--text-gray);
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 0.95rem;
  display: inline-block;
  position: relative;
  padding: 2px 0;
}

.footer-links a::before {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--accent-yellow);
  transition: width 0.3s ease;
}

.footer-links a:hover {
  color: var(--accent-yellow);
  transform: translateX(5px);
}

.footer-links a:hover::before {
  width: 100%;
}

.contact-info {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 12px;
  color: var(--text-gray);
  font-size: 0.95rem;
  transition: color 0.3s ease;
}

.contact-item:hover {
  color: var(--text-light);
}

.contact-item i {
  color: var(--accent-yellow);
  width: 20px;
  font-size: 1.1rem;
  text-align: center;
}

.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 30px;
  border-top: 1px solid var(--border-dark);
  flex-wrap: wrap;
  gap: 20px;
}

.footer-copyright {
  color: var(--text-muted);
  font-size: 0.9rem;
}

.footer-copyright p {
  margin: 0;
}

.footer-legal {
  display: flex;
  gap: 25px;
  flex-wrap: wrap;
}

.footer-legal a {
  color: var(--text-muted);
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 0.9rem;
  position: relative;
}

.footer-legal a::after {
  content: "";
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--accent-yellow);
  transition: width 0.3s ease;
}

.footer-legal a:hover {
  color: var(--accent-yellow);
}

.footer-legal a:hover::after {
  width: 100%;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .footer-content {
    grid-template-columns: 1fr 1fr;
    gap: 40px;
  }
}

@media (max-width: 768px) {
  .footer-section {
    padding: 60px 0 20px;
  }

  .footer-content {
    grid-template-columns: 1fr;
    gap: 40px;
    text-align: center;
  }

  .footer-logo {
    justify-content: center;
  }

  .footer-description {
    max-width: none;
    margin: 0 auto 30px;
  }

  .social-links {
    justify-content: center;
  }

  .footer-title::after {
    left: 50%;
    transform: translateX(-50%);
  }

  .footer-bottom {
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }

  .footer-legal {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 15px;
  }

  .footer-section {
    padding: 50px 0 20px;
  }

  .footer-content {
    gap: 30px;
  }

  .footer-logo h3 {
    font-size: 1.2rem;
  }

  .footer-description {
    font-size: 0.9rem;
  }

  .social-link {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }

  .footer-title {
    font-size: 1.1rem;
  }

  .footer-links a,
  .contact-item {
    font-size: 0.9rem;
  }

  .footer-legal {
    gap: 15px;
  }

  .footer-legal a {
    font-size: 0.8rem;
  }
}
</style>
