<template>
  <footer class="footer-wrapper footer-layout1">
    <div
      class="footer-top-shape animation-infinite"
      data-bg-src="/assets/frontend/img/icon/footer-top-shape.png"
    ></div>
    <div class="widget-area">
      <div class="container">
        <div class="footer-all-widget-wrapper">
          <div class="footer-all-widget-item">
            <div class="widget footer-widget">
              <h3 class="widget_title">About HTC</h3>
              <div class="th-widget-about">
                <p class="about-text">
                  {{ getFirstSettingValueByTitle("short_intro") }}
                </p>
                <div class="footer-info-wrap">
                  <div class="footer-info">
                    <i class="fas fa-phone"></i>
                    <p class="info-box_link">
                      <a href="javascript:void(0)">{{
                        getFirstSettingValueByTitle("phone_numbers") ||
                        "0000-000-00"
                      }}</a>
                    </p>
                  </div>
                  <div class="footer-info">
                    <i class="fas fa-envelope"></i>
                    <p class="info-box_link">
                      <a href="javascript:void(0);">{{
                        getFirstSettingValueByTitle("emails") ||
                        "demo@yourmail.com"
                      }}</a>
                    </p>
                  </div>
                  <div class="footer-info">
                    <i class="fas fa-location-dot"></i>
                    <p class="info-box_link">
                      <span>{{
                        getFirstSettingValueByTitle("address") ||
                        "1234 Street Name Demo, City, Demo"
                      }}</span>
                    </p>
                  </div>
                </div>
                <div class="about-logo">
                  <a href="index.html"
                    ><img
                      :src="'/' + getFirstSettingValueByTitle('footer_logo')"
                      style="width: 100px; height: auto"
                      alt="Piller-html"
                  /></a>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-all-widget-item">
            <div class="footer-right-wrap">
              <div class="footer-item-wrap">
                <div class="footer-item">
                  <div class="widget widget_nav_menu footer-widget">
                    <h3 class="widget_title">Featured Houses</h3>
                    <div class="menu-all-pages-container">
                      <ul class="menu">
                        <li><a href="service.html">#Villa</a></li>
                        <li><a href="service.html">#Commercial</a></li>
                        <li><a href="service.html">#Farm Houses</a></li>
                        <li><a href="service.html">#Apartments</a></li>
                        <li><a href="service.html">#Apartments</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer-item">
                  <div class="widget widget_nav_menu footer-widget">
                    <h3 class="widget_title">Quick Links</h3>
                    <div class="menu-all-pages-container">
                      <ul class="menu">
                        <li><a href="service.html">Strategy Services</a></li>
                        <li><a href="service.html">Management</a></li>
                        <li><a href="service.html">Privacy & Policy</a></li>
                        <li><a href="service.html">Sitemap</a></li>
                        <li><a href="service.html">Term & Conditions</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer-item">
                  <div class="widget widget_nav_menu footer-widget">
                    <h3 class="widget_title">Support</h3>
                    <div class="menu-all-pages-container">
                      <ul class="menu">
                        <li><Link href="/about-us">About Us</Link></li>
                        <li><Link href="/team">Our Team</Link></li>
                        <li><Link href="/contact">Contact Us</Link></li>
                        <li><Link href="/service">Our Services</Link></li>
                        <li><Link href="/portfolio">Properties</Link></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer-item">
                  <div class="widget widget_banner footer-widget">
                    <h3 class="widget_title">Location</h3>
                    <div class="widget-map">
                      <iframe
                        :src="
                          firstAddressMapLink() != ''
                            ? firstAddressMapLink()
                            : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3746527.452679472!2d90.3443647!3d23.506657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adaaed80e18ba7%3A0xf2d28e0c4e1fc6b!2sBangladesh!5e0!3m2!1sen!2sbd!4v1758005870458!5m2!1sen!2sbd'
                        "
                      ></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <!-- --------------------------------------------------------------------
              ---------------------------GalleryImage-----------------------------
              -------------------------------------------------------------------- -->
              <GalleryImage />
              <!-- --------------------------------------------------------------------
              ---------------------------GalleryImage-----------------------------
              -------------------------------------------------------------------- -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-wrap">
      <div
        class="footer-bottom-top-shape animation-infinite"
        data-bg-src="/assets/frontend/img/icon/footer-bottom-top-shape.png"
      ></div>
      <div class="container">
        <div
          class="row gy-3 justify-content-lg-between justify-content-center align-items-center"
        >
          <div class="col-lg-7">
            <p class="copyright-text">
              Copyright © {{ getFirstSettingValueByTitle("copy_right") }}. All
              Rights Reserved .
            </p>
          </div>
          <div class="col-auto">
            <div class="footer-default-copy-right">
              <p>Social Media:</p>
              <div class="th-social">
                <a :href="getFirstSettingValueByTitle('whatsapp')"
                  ><i class="fab fa-whatsapp"></i
                ></a>
                <a
                  :href="getFirstSettingValueByTitle('facebook')"
                  target="_blank"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  :href="getFirstSettingValueByTitle('twitter')"
                  target="_blank"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  :href="getFirstSettingValueByTitle('linkedin')"
                  target="_blank"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
                <a
                  :href="getFirstSettingValueByTitle('youtube')"
                  target="_blank"
                  ><i class="fab fa-youtube"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div class="scroll-top">
    <svg
      class="progress-circle svg-content"
      width="100%"
      height="100%"
      viewBox="-1 -1 102 102"
    >
      <path
        d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
        style="
          transition: stroke-dashoffset 10ms linear 0s;
          stroke-dasharray: 307.919, 307.919;
          stroke-dashoffset: 307.919;
        "
      ></path>
    </svg>
  </div>
</template>

<script>
import { store as footer_store } from "./Store/footer_store.js";
import { mapActions, mapState } from "pinia";
import LocationMap from "../GlobalComponent/LocationMap/LocationMap.vue";
import GalleryImage from "./components/GalleryImage.vue";

export default {
  components: {
    LocationMap,
    GalleryImage,
  },
  computed: {
    ...mapState(footer_store, ["website_settings", "addresses", "images"]),
  },
  methods: {
    ...mapActions(footer_store, [
      "fetch_website_settings",
      "fetch_addresses",
      "getSettingValuesByTitle",
      "getFirstSettingValueByTitle",
      "firstAddressMapLink",
      "fetch_images",
    ]),
  },
  created() {
    this.fetch_website_settings();
    this.fetch_addresses();
    this.fetch_images();
  },
};
</script>

<style scoped>
.footer-widget.widget_meta a::before,
.footer-widget.widget_pages a::before,
.footer-widget.widget_archive a::before,
.footer-widget.widget_categories a::before,
.footer-widget.widget_nav_menu a::before {
  content: "\f192";
  position: absolute;
  font-weight: 400;
  font-family: var(--icon-font);
  left: 0;
  top: 0;
  opacity: 1;
  -webkit-transform: translateY(0);
  -ms-transform: translateY(0);
  transform: translateY(0);
  font-size: 16px;
  background-color: transparent;
  border: none;
  color: #99a4a3;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  color: var(--theme-color);
}
</style>
