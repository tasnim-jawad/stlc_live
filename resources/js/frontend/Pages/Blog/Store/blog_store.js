import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("blog_main_store", {
  state: () => ({
    blogs: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 10,
    },
    blog_category_id: null,
    blog_categories: [],
    random_blogs: [],
    single_blog: null,
    searched_blogs: [],
    loading: false,
    error: null,
  }),

  actions: {
    set_blog_category_id(id) {
      this.blog_category_id = id;
      console.log("id", this.blog_category_id);
      if (
        this.blog_category_id === "all" ||
        this.blog_category_id === null ||
        this.blog_category_id === undefined ||
        this.blog_category_id === ""
      ) {
        this.blog_category_id = null;
        this.fetch_blogs({ page: 1 });
      } else {
        this.fetch_blogs({ page: 1 });
      }
    },

    async fetch_blogs({ page = 1, search = null } = {}) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          limit: 10,
          blog_category_id: this.blog_category_id,
        };

        if (search) {
          params.search = search;
          params.limit = 100;
        }

        const response = await axios.get("/blogs", { params });
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

        this.blogs = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async fetch_blog_categories() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("blog-categories", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });

        this.blog_categories = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async fetch_random_blogs() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("blogs", {
          params: {
            random_data: 1,
            limit: 5,
          },
        });

        this.random_blogs = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async fetch_single_blog(slug) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`blogs/${slug}`);
        this.single_blog = response?.data?.data;
        console.log("single blog", this.single_blog);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async search_blogs(searchTerm) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          search: searchTerm,
          limit: 100,
          fields:  ['title', 'slug', 'created_at', 'writer'],
        };

        

        const response = await axios.get("/blogs", { params });
        console.log("clicked frof s", response.data);

        let result = response?.data?.data;

        

        this.searched_blogs = result;
        console.log("searched blogs", this.searched_blogs);
        
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
  },
});
