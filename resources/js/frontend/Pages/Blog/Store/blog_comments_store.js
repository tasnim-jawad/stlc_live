import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("blog_comments_store", {
  state: () => ({
    comments: [],
    displayedComments: [],
    showAllComments: false,
    commentsPerPage: 5,
    totalComments: 0,
    loading: false,
    error: null,
    submitting: false,
    validationErrors: {},
  }),

  actions: {
    async fetchComments(blogId) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`/blogs/comments/${blogId}`);
        this.comments = response.data.data.comments || [];
        this.totalComments = this.comments.length;
        this.updateDisplayedComments();
      } catch (error) {
        this.error =
          error.response?.data?.message || "Failed to fetch comments";
        console.error("Error fetching comments:", error);
      } finally {
        this.loading = false;
      }
    },

    async submitComment(blogId, commentData) {
      this.submitting = true;
      this.validationErrors = {};
      this.error = null;

      try {
        const response = await axios.post(
          `/blogs/comments/${blogId}`,
          commentData
        );

        // Add the new comment to the beginning of the list
        this.comments.unshift(response.data.data);
        this.totalComments = this.comments.length;
        this.updateDisplayedComments();

        return { success: true, comment: response.data.data };
      } catch (error) {
        if (error.response?.status === 422) {
          this.validationErrors = error.response.data.errors || {};
        } else {
          this.error =
            error.response?.data?.message || "Failed to submit comment";
        }
        return { success: false, errors: this.validationErrors };
      } finally {
        this.submitting = false;
      }
    },

    updateDisplayedComments() {
      if (this.showAllComments) {
        this.displayedComments = [...this.comments];
      } else {
        this.displayedComments = this.comments.slice(0, this.commentsPerPage);
      }
    },

    toggleShowAllComments() {
      this.showAllComments = !this.showAllComments;
      this.updateDisplayedComments();
    },

    clearValidationErrors() {
      this.validationErrors = {};
    },
  },

  getters: {
    hasMoreComments: (state) => {
      return (
        !state.showAllComments && state.comments.length > state.commentsPerPage
      );
    },

    commentsCount: (state) => {
      return state.totalComments;
    },
  },
});
