<template>
  <div class="sidemenu-wrapper sidemenu-cart d-none d-lg-block">
    <!-- <div class="sidemenu-content">
      <button class="closeButton sideMenuCls">
        <i class="far fa-times"></i>
      </button>
      <div class="widget woocommerce widget_shopping_cart">
        <h3 class="widget_title">Shopping cart</h3>
        <div class="widget_shopping_cart_content">
          <ul class="woocommerce-mini-cart cart_list product_list_widget">
            <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"
                ><i class="far fa-times"></i
              ></a>
              <a href="#"
                ><img
                  src="/assets/frontend/img/product/product_1_1.png"
                  alt="Cart Image"
                />Bosco Apple Fruit</a
              >
              <span class="quantity"
                >1 ×
                <span class="woocommerce-Price-amount amount"
                  ><span class="woocommerce-Price-currencySymbol">$</span
                  >940.00</span
                ></span
              >
            </li>
            <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"
                ><i class="far fa-times"></i
              ></a>
              <a href="#"
                ><img
                  src="/assets/frontend/img/product/product_1_2.png"
                  alt="Cart Image"
                />Green Cauliflower</a
              >
              <span class="quantity"
                >1 ×
                <span class="woocommerce-Price-amount amount"
                  ><span class="woocommerce-Price-currencySymbol">$</span
                  >899.00</span
                ></span
              >
            </li>
            <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"
                ><i class="far fa-times"></i
              ></a>
              <a href="#"
                ><img
                  src="/assets/frontend/img/product/product_1_3.png"
                  alt="Cart Image"
                />Mandarin orange</a
              >
              <span class="quantity"
                >1 ×
                <span class="woocommerce-Price-amount amount"
                  ><span class="woocommerce-Price-currencySymbol">$</span
                  >756.00</span
                ></span
              >
            </li>
            <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"
                ><i class="far fa-times"></i
              ></a>
              <a href="#"
                ><img
                  src="/assets/frontend/img/product/product_1_4.png"
                  alt="Cart Image"
                />Shallot Red onion</a
              >
              <span class="quantity"
                >1 ×
                <span class="woocommerce-Price-amount amount"
                  ><span class="woocommerce-Price-currencySymbol">$</span
                  >723.00</span
                ></span
              >
            </li>
            <li class="woocommerce-mini-cart-item mini_cart_item">
              <a href="#" class="remove remove_from_cart_button"
                ><i class="far fa-times"></i
              ></a>
              <a href="#"
                ><img
                  src="/assets/frontend/img/product/product_1_5.png"
                  alt="Cart Image"
                />Sour Red Cherry</a
              >
              <span class="quantity"
                >1 ×
                <span class="woocommerce-Price-amount amount"
                  ><span class="woocommerce-Price-currencySymbol">$</span
                  >1080.00</span
                ></span
              >
            </li>
          </ul>
          <p class="woocommerce-mini-cart__total total">
            <strong>Subtotal:</strong>
            <span class="woocommerce-Price-amount amount"
              ><span class="woocommerce-Price-currencySymbol">$</span
              >4398.00</span
            >
          </p>
          <p class="woocommerce-mini-cart__buttons buttons">
            <a href="cart.html" class="th-btn wc-forward">View cart</a>
            <a href="checkout.html" class="th-btn checkout wc-forward"
              >Checkout</a
            >
          </p>
        </div>
      </div>
    </div> -->
  </div>
  <div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="#">
      <input type="text" placeholder="What are you looking for?" />
      <button type="submit"><i class="fal fa-search"></i></button>
    </form>
  </div>
  <div
    class="th-menu-wrapper"
    :class="{ 'th-body-visible': isSideBarMenuOpen }"
    @click="toggleSidebarMenu"
  >
    <div class="th-menu-area text-center" @click.stop>
      <button class="th-menu-toggle" @click="toggleSidebarMenu">
        <i class="fa fa-times"></i>
      </button>
      <div class="mobile-logo">
        <Link href="/" @click="toggleSidebarMenu"
          ><img
            height="100"
            width="100"
            :src="
              '/' + getFirstSettingValueByTitle('header_logo') ??
              '/assets/frontend/img/logo.jpeg'
            "
            alt="logo"
        /></Link>
      </div>
      <div class="th-mobile-menu">
        <ul>
          <li class="active">
            <Link href="/" @click="toggleSidebarMenu">Home</Link>
          </li>
          <li>
            <Link href="/about-us" @click="toggleSidebarMenu">About Us</Link>
          </li>
          <li><Link href="/team" @click="toggleSidebarMenu">Our Team</Link></li>
          <li>
            <Link href="/service" @click="toggleSidebarMenu">Our Services</Link>
          </li>
          <li>
            <Link href="/portfolio" @click="toggleSidebarMenu">Property</Link>
          </li>
          <li class="menu-item-has-children">
            <a href="javascript:void(0)" @click="toggleGallery"> Gallery </a>
            <transition name="slide-fade">
              <ul class="sub-menu" v-show="isGalleryOpen">
                <li>
                  <Link href="/gallery/images" @click="toggleSidebarMenu"
                    >Images</Link
                  >
                </li>
                <li>
                  <Link href="/gallery/videos" @click="toggleSidebarMenu"
                    >Videos</Link
                  >
                </li>
              </ul>
            </transition>
          </li>

          <li><Link href="/blog" @click="toggleSidebarMenu"> Blog</Link></li>
          <li>
            <Link href="/contact" @click="toggleSidebarMenu"> Contact</Link>
          </li>
          <li class="menu-item-has-children">
            <a href="javascript:void(0)" @click="togglePages"> Pages </a>
            <transition name="slide-fade">
              <ul class="sub-menu" v-show="isPagesOpen">
                <li v-for="page in custom_pages" :key="page.id">
                  <Link
                    :href="`/pages/${page.page_permalink}`"
                    @click="toggleSidebarMenu"
                    >{{ page.title }}</Link
                  >
                </li>
              </ul>
            </transition>
          </li>
          <Link class="th-btn my-3" href="/login" @click="toggleSidebarMenu">
            Login</Link
          >
        </ul>
      </div>
    </div>
  </div>
  <header class="th-header header-default header-layout1">
    <div class="header-top">
      <div class="container">
        <div
          class="row justify-content-center justify-content-lg-between align-items-center gy-2"
        >
          <div class="col-auto d-none d-lg-block">
            <div class="header-links">
              <ul>
                <li>
                  <i class="fa-solid fa-envelope"></i>
                  <a href="javascript:void(0);">{{
                    getFirstSettingValueByTitle("emails")
                  }}</a>
                </li>
                <li>
                  <i class="fa-solid fa-phone"></i>
                  <a href="javascript:void(0);">{{
                    getFirstSettingValueByTitle("phone_numbers")
                  }}</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-auto">
            <div class="header-links">
              <ul>
                <li>
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
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sticky-wrapper">
      <div class="menu-area">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <div class="header-logo">
                <Link href="/"
                  ><img
                    :src="
                      '/' + getFirstSettingValueByTitle('header_logo') ??
                      '/assets/frontend/img/logo.jpeg'
                    "
                    alt="logo"
                /></Link>
              </div>
            </div>
            <div class="col-auto">
              <nav class="main-menu d-none d-xxl-inline-block">
                <ul>
                  <li class="active">
                    <Link href="/">Home</Link>
                  </li>
                  <li><Link href="/about-us">About Us</Link></li>
                  <li><Link href="/team">Our Team</Link></li>
                  <li><Link href="/service">Our Services</Link></li>
                  <li>
                    <Link href="/portfolio">Property</Link>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="javascript:void(0)">Gallery </a>
                    <ul class="sub-menu">
                      <li><Link href="/gallery/images">Images</Link></li>
                      <li><Link href="/gallery/videos">Videos</Link></li>
                    </ul>
                  </li>

                  <li><Link href="/blog">STC Blog</Link></li>
                  <li><Link href="/contact">Contact Us</Link></li>
                  <li class="menu-item-has-children">
                    <a href="javascript:void(0)"> Pages </a>
                    <ul class="sub-menu">
                      <li v-for="page in custom_pages" :key="page.id">
                        <Link :href="`/pages/${page.page_permalink}`">{{
                          page.title
                        }}</Link>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <Link href="/login">
                      <button class="btn btn-danger">Login</button></Link
                    >
                  </li>
                </ul>
              </nav>
              <button
                type="button"
                class="th-menu-toggle d-block d-xxl-none"
                @click="toggleSidebarMenu"
              >
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <!-- <div class="col-auto d-none d-xl-block">
              <div class="header-button">
                <a href="contact.html" class="th-btn outline pill text-white"
                  ><i class="fa fa-house-chimney me-2"></i> Add Listing </a
                ><button
                  type="button"
                  class="icon-btn searchBoxToggler text-white"
                >
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { store as header_store } from "./Store/header_store.js";
import { mapState, mapActions } from "pinia";

export default {
  data: () => ({
    is_home: true,
    search: "",
    isSideBarMenuOpen: false,
    isGalleryOpen: false,
    isPagesOpen: false,
  }),
  methods: {
    toggleSidebarMenu() {
      this.isSideBarMenuOpen = !this.isSideBarMenuOpen;
    },
    toggleGallery() {
      this.isGalleryOpen = !this.isGalleryOpen;
    },
    togglePages() {
      this.isPagesOpen = !this.isPagesOpen;
    },
    ...mapActions(header_store, [
      "fetch_website_settings",
      "getFirstSettingValueByTitle",
      "fetch_custom_pages",
    ]),
  },
  computed: {
    ...mapState(header_store, ["website_settings", "custom_pages"]),
  },
  created: function () {
    this.fetch_website_settings();
    this.fetch_custom_pages();
  },
};
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.4s ease;
  overflow: hidden;
}

.slide-fade-enter-active {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-fade-leave-active {
  transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  max-height: 0;
  opacity: 0;
  transform: translateY(-5px);
}

.slide-fade-enter-to,
.slide-fade-leave-from {
  max-height: 500px;
  opacity: 1;
  transform: translateY(0);
}
</style>
