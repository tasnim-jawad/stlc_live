import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("gallery_main_store", {
  state: () => ({
    images: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 10,
    },
    image_category_id: null,
    image_categories: [],

    videos: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 10,
    },
    video_category_id: null,
    video_categories: [],
    random_images: [],
    random_videos: [],
    loading: false,
    error: null,
  }),

  actions: {
    set_image_category_id(id) {
      this.image_category_id = id;
      console.log("id", this.image_category_id);
      if (
        this.image_category_id === "all" ||
        this.image_category_id === null ||
        this.image_category_id === undefined ||
        this.image_category_id === ""
      ) {
        this.image_category_id = null;
        this.fetch_images({ page: 1 });
      } else {
        this.fetch_images({ page: 1 });
      }
    },


    async fetch_images({ page = 1 } = {}) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          limit: 20,
          image_category_id: this.image_category_id,
        };

        const response = await axios.get("image-galleries", { params });
        console.log("clicked", response.data);

        let result = response?.data?.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(response.data) ? response.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(response.data) ? response.data.length : 0,
            per_page: 6,
          };
        }
        this.images = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async fetch_image_categories() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("gallery-categories", {
          params: {
            type: "image",
            limit: 1000,
          },
        });

        this.image_categories = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },



    set_video_category_id(id) {
      this.video_category_id = id;
      console.log("id", this.video_category_id);
      if (
        this.video_category_id === "all" ||
        this.video_category_id === null ||
        this.video_category_id === undefined ||
        this.video_category_id === ""
      ) {
        this.video_category_id = null;
        this.fetch_videos({ page: 1 });
      } else {
        this.fetch_videos({ page: 1 });
      }
    },

    async fetch_videos({ page = 1 } = {}) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          limit: 20,
          video_category_id: this.video_category_id,
        };

        const response = await axios.get("video-galleries", { params });
        console.log("clicked", response.data);

        let result = response?.data?.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(response.data) ? response.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(response.data) ? response.data.length : 0,
            per_page: 6,
          };
        }
        this.videos = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    async fetch_video_categories() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("gallery-categories", {
          params: {
            type: "video",
            limit: 1000,
          },
        });

        this.video_categories = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },


    // async fetch_random_images() {
    //   this.loading = true;
    //   this.error = null;

    //   try {
    //     const response = await axios.get("properties", {
    //       params: {
    //         random_data: 1,
    //         limit: 5,
    //       },
    //     });

    //     this.random_properties = response?.data;
    //   } catch (error) {
    //     this.error = error;
    //   } finally {
    //     this.loading = false;
    //   }
    // },
  },
});
