<template>
  <!-- <div class="preloader">
    <button class="th-btn preloaderCls">Cancel Preloader</button>
    <div id="preloader" class="preloader-inner">
      <div class="txt-loading">
        <span data-text-preloader="S" class="letters-loading">S </span
        ><span data-text-preloader="T" class="letters-loading">T </span
        ><span data-text-preloader="L" class="letters-loading">L </span
        ><span data-text-preloader="C" class="letters-loading">C </span>
      </div>
    </div>
  </div> -->
  <!-- <div class="color-scheme">
    <button class="switchIcon"><i class="fa-solid fa-palette"></i></button>
    <h4 class="color-scheme-title">
      <i class="far fa-palette"></i> Color Switcher
    </h4>
    <p class="color-scheme-text">Check template with your color</p>
    <div class="color-switch-btns">
      <button data-color="#6240CF">
        <i class="fa-solid fa-droplet"></i>
      </button>
      <button data-color="#068FFF">
        <i class="fa-solid fa-droplet"></i>
      </button>
      <button data-color="#044DBC">
        <i class="fa-solid fa-droplet"></i>
      </button>
      <button data-color="#FFAF00">
        <i class="fa-solid fa-droplet"></i>
      </button>
      <button data-color="#F80000">
        <i class="fa-solid fa-droplet"></i>
      </button>
      <button data-color="#231E7A">
        <i class="fa-solid fa-droplet"></i>
      </button>
    </div>
    <p class="color-scheme-text">Or custom color..</p>
    <input type="color" id="thcolorpicker" value="#068FFF" />
  </div> -->
  <div class="sidemenu-wrapper sidemenu-cart d-none d-lg-block">
    <div class="sidemenu-content">
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
    </div>
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
  >
    <div class="th-menu-area text-center">
      <button class="th-menu-toggle" @click="toggleSidebarMenu">
        <i class="fa fa-times"></i>
      </button>
      <div class="mobile-logo">
        <a href="index.html"
          ><img
            src="/assets/frontend/img/logo.jpeg"
            alt="logo"
        /></a>
      </div>
      <div class="th-mobile-menu">
        <ul>
          <li class="active">
            <Link href="/">Home</Link>
          </li>
          <li><Link href="/about-us">About Us</Link></li>
          <li><Link href="/team">Our Team</Link></li>
          <li><Link href="/service">Our Services</Link></li>
          <li><Link href="/portfolio"> Portfolio</Link></li>
          <li class="menu-item-has-children">
            <a href="#"> Gallery </a>
            <ul class="sub-menu">
              <li><Link href="/gallery/images">Images</Link></li>
              <li><Link href="/gallery/videos">Videos</Link></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#"> Pages </a>
            <ul class="sub-menu">
              <li v-for="page in custom_pages" :key="page.id">
                <Link :href="`/pages/${page.page_permalink}`">{{ page.title }}</Link>
              </li>
            </ul>
          </li>
          <li><Link href="/blog"> Blog</Link></li>
          <li><Link href="/contact"> Contact</Link></li>
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
                    src="/assets/frontend/img/logo.jpeg"
                    alt="logo"
                /></Link>
              </div>
            </div>
            <div class="col-auto">
              <nav class="main-menu d-none d-lg-inline-block">
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
                    <a href="#">Gallery </a>
                    <ul class="sub-menu">
                      <li><Link href="/gallery/images">Images</Link></li>
                      <li><Link href="/gallery/videos">Videos</Link></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#"> Pages </a>
                    <ul class="sub-menu">
                      <li v-for="page in custom_pages" :key="page.id">
                        <Link :href="`/pages/${page.page_permalink}`">{{ page.title }}</Link>
                      </li>
                    </ul>
                  </li>
                  <li><Link href="/blog">STC Blog</Link></li>
                  <li><Link href="/contact">Contact Us</Link></li>
                </ul>
              </nav>
              <button
                type="button"
                class="th-menu-toggle d-block d-lg-none"
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
  }),
  methods: {
    toggleSidebarMenu() {
      this.isSideBarMenuOpen = !this.isSideBarMenuOpen;
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

<style scoped></style>
