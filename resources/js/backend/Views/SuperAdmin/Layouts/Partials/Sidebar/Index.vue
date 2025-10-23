<template>
  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper">
    <div class="brand-logo">
      <router-link
        :to="{ name: `adminDashboard` }"
        class="d-flex align-items-center"
      >
        <img
          :src="`${get_setting_value('header_logo') ?? 'avatar.png'} `"
          class="logo-icon"
          alt="logo icon"
        />
        <h5 class="logo-text">Super Admin Panel</h5>
      </router-link>
      <div class="close-btn">
        <i class="zmdi zmdi-close" @click="toggle_menu"></i>
      </div>
    </div>

    <div class="text-center mt-3">
      <img
        class="rounded-circle p-1"
        height="70"
        width="70"
        :src="`${auth_info.image ?? 'avatar.png'}`"
        alt=""
      />
      <p class="mt-2">Mr. {{ auth_info.name }}</p>
    </div>
    <hr />
    <ul class="metismenu" id="menu">
      <!-- <li class="menu-label">Management</li> -->
      <li>
        <router-link
          :to="{ name: `adminDashboard` }"
          class="border"
          href="javascript:void();"
        >
          <div class="parent-icon">
            <i class="zmdi zmdi-view-dashboard"></i>
          </div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li>
      <!-- Management start -->
      <!-- <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`User Management`"
        :menus="[
          {
            route_name: `AllUser`,
            title: `User`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      /> -->

      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Page Content`"
        :menus="[
          {
            route_name: `AllBanner`,
            title: `Banner`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllAboutUs`,
            title: `About Us`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllAtAGlance`,
            title: `At A Glance`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllOurTeam`,
            title: `Our Team`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },

          {
            route_name: `AllOurService`,
            title: `Our Service`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllTestimonial`,
            title: `Testimonial`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },

          {
            route_name: `AllNewsletter`,
            title: `Newsletter`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllContact`,
            title: `Contact`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllWhyChooseUs`,
            title: `Why Choose Us`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllCustomPage`,
            title: `Custom Page`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />

      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Blog Management`"
        :menus="[
          {
            route_name: `AllBlogCategory`,
            title: `BlogCategory`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllBlog`,
            title: `Blog`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />

      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Property Management`"
        :menus="[
          // {
          //   route_name: `AllPropertyGroup`,
          //   title: `Property Group`,
          //   icon: `zmdi zmdi-dot-circle-alt`,
          // },
          {
            route_name: `AllPropertyCategory`,
            title: `Property Category`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllProperty`,
            title: `Property `,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />
      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Gallery Management`"
        :menus="[
          {
            route_name: `AllGalleryCategory`,
            title: `Gallery Category`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllImageGallery`,
            title: `Image Gallery`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AllVideoGallery`,
            title: `Video Gallery `,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />

      <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Website Settings`"
        :menus="[
          {
            route_name: `AdminSiteSettings`,
            title: `Website Settings`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
          {
            route_name: `AdminProfileSettings`,
            title: `Admin Profile Settings`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      />

      <!-- <side-bar-single-menu
        :icon="`fa fa-plus`"
        :menu_title="`SectionHeading`"
        :route_name="`AllSectionHeading`"
      /> -->
      <!-- <side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`Section Headings`"
        :menus="[
          {
            route_name: `HomePageSectionHeading`,
            title: `Section Heading`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
        ]"
      /> -->
      <!-- Management end -->
    </ul>
  </div>
</template>

<script>
//auth_store
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { site_settings_store } from "../../../../../GlobalStore/site_settings_store";
import { mapState, mapActions } from "pinia";
//components
import SideBarDropDownMenus from "./SideBarDropDownMenus.vue";
import SideBarSingleMenu from "./SideBarSingleMenu.vue";
export default {
  components: { SideBarDropDownMenus, SideBarSingleMenu },
  methods: {
    ...mapActions(site_settings_store, {
      get_setting_value: "get_setting_value",
    }),

    logout_submit: function () {
      let confirm = window.confirm("logout");
      if (confirm) {
        this.log_out();
      }
    },
    toggle_menu: function () {
      document.getElementById("wrapper").classList.toggle("toggled");
    },
  },
  computed: {
    ...mapState(auth_store, {
      auth_info: "auth_info",
    }),
  },
};
</script>

<style></style>
