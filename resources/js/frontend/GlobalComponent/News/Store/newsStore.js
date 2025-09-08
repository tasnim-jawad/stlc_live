import { defineStore } from "pinia";
import axios from "axios";

export const useNewsStore = defineStore("news", {
  state: () => ({
    news: [],
    loading: false,
    error: null,
    pagination: {
      current_page: 1,
      total: 0,
      per_page: 6,
      last_page: 1,
    },
    categories: [],
    selectedCategory: "all",
  }),

  actions: {
    async fetchNews(page = 1) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          per_page: this.pagination.per_page,
          category:
            this.selectedCategory !== "all" ? this.selectedCategory : "",
        };

        const response = await axios.get("/api/news", { params });

        this.news = response.data.data || response.data;

        if (response.data.meta) {
          this.pagination = {
            ...this.pagination,
            ...response.data.meta,
          };
        }

        console.log("News fetched successfully:", this.news);
        return { success: true, data: this.news };
      } catch (error) {
        this.error = "Failed to fetch news";
        console.error("Error fetching news:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetchLatestNews(limit = 3) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`/api/news/latest?limit=${limit}`);
        this.news = response.data.data || response.data;

        console.log("Latest news fetched successfully:", this.news);
        return { success: true, data: this.news };
      } catch (error) {
        this.error = "Failed to fetch latest news";
        console.error("Error fetching latest news:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetchNewsCategories() {
      try {
        const response = await axios.get("/api/news/categories");
        this.categories = response.data.data || response.data;

        console.log("News categories fetched successfully:", this.categories);
        return { success: true, data: this.categories };
      } catch (error) {
        console.error("Error fetching news categories:", error);
        return { success: false, error };
      }
    },

    setCategory(category) {
      this.selectedCategory = category;
    },

    clearError() {
      this.error = null;
    },

    setPage(page) {
      this.pagination.current_page = page;
    },
  },

  getters: {
    getNewsById: (state) => (id) => {
      return state.news.find((article) => article.id === id);
    },

    hasNews: (state) => state.news.length > 0,

    newsCount: (state) => state.news.length,

    hasNextPage: (state) =>
      state.pagination.current_page < state.pagination.last_page,

    hasPrevPage: (state) => state.pagination.current_page > 1,

    getCategoryName: (state) => (slug) => {
      const category = state.categories.find((cat) => cat.slug === slug);
      return category ? category.name : slug;
    },
  },
});
