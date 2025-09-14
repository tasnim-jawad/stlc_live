<template>
  <div class="widget widget_search">
    <h3 class="widget_title">search</h3>
    <form class="search-form" @submit.prevent="handleSearch">
      <input type="text" v-model="searchTerm" placeholder="Enter Keyword" />
      <button type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>
    <div
      class="search-results"
      v-if="blogStore.blogs.data.length && searchTerm"
    >
      <div class="results-header">
        <h4 class="results-title">Search Results</h4>
        <span class="results-count"
          >{{ blogStore.blogs.data.length }} found</span
        >
      </div>
      <div class="results-list">
        <div
          v-for="blog in blogStore.blogs.data"
          :key="blog.id"
          class="search-result-item"
        >
          <div class="result-content">
            <Link :href="`/blog/details?slug=${blog.slug}`" class="result-link">
              <h5 class="result-title">{{ blog.title }}</h5>
              <p class="result-excerpt" v-if="blog.excerpt">
                {{ blog.excerpt }}
              </p>
              <div class="result-meta">
                <span class="result-date" v-if="blog.created_at">
                  <i class="fa fa-calendar"></i>
                  {{ formatDate(blog.created_at) }}
                </span>
                <span class="result-author" v-if="blog.author">
                  <i class="fa fa-user"></i>
                  {{ blog.author }}
                </span>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { store } from "../Store/blog_store.js";
import { Link } from "@inertiajs/vue3";

function debounce(func, delay) {
  let timeoutId;
  return function (...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => func.apply(this, args), delay);
  };
}

export default {
  data() {
    return {
      searchTerm: "",
    };
  },
  computed: {
    blogStore() {
      return store();
    },
  },
  methods: {
    handleSearch() {
      const blogStore = store();
      if (!this.searchTerm.trim()) {
        blogStore.fetch_blogs({ page: 1 });
      } else {
        blogStore.fetch_blogs({ page: 1, search: this.searchTerm });
      }
    },
    debouncedSearch: debounce(function () {
      this.handleSearch();
    }, 500),
    formatDate(dateString) {
      if (!dateString) return "";
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
      });
    },
  },
  watch: {
    searchTerm: "debouncedSearch",
  },
};
</script>

<style lang="scss" scoped>
.widget_search {
  .search-form {
    position: relative;
    margin-bottom: 1.5rem;

    input {
      width: 100%;
      padding: 12px 50px 12px 15px;
      border: 2px solid var(--gray-color2);
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;

      &:focus {
        outline: none;
        border-color: var(--theme-color);
        box-shadow: 0 0 0 3px rgba(255, 65, 54, 0.1);
      }
    }

    button {
      position: absolute;
      right: 5px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--theme-color);
      color: var(--white-color);
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;

      &:hover {
        background: var(--theme-color2);
        transform: translateY(-50%) scale(1.05);
      }
    }
  }

  .search-results {
    background: var(--smoke-color);
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    animation: slideIn 0.3s ease-out;

    .results-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--gray-color2);

      .results-title {
        color: var(--title-color);
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        text-transform: capitalize;
        font-family: var(--title-font);
      }

      .results-count {
        background: var(--theme-color);
        color: var(--white-color);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
      }
    }

    .results-list {
      max-height: 400px;
      overflow-y: auto;
      padding-top: 2px;

      &::-webkit-scrollbar {
        width: 6px;
      }

      &::-webkit-scrollbar-track {
        background: var(--smoke-color2);
        border-radius: 3px;
      }

      &::-webkit-scrollbar-thumb {
        background: var(--light-color);
        border-radius: 3px;

        &:hover {
          background: var(--body-color);
        }
      }
    }

    .search-result-item {
      margin-bottom: 15px;

      &:last-child {
        margin-bottom: 0;
      }

      .result-content {
        background: var(--white-color);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid var(--gray-color2);

        &:hover {
          transform: translateY(-2px);
          box-shadow: 0 4px 15px rgba(255, 65, 54, 0.15);
          border-color: var(--theme-color);
        }

        .result-link {
          display: block;
          padding: 15px;
          text-decoration: none;
          color: inherit;

          .result-title {
            color: var(--title-color);
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 8px 0;
            line-height: 1.3;
            transition: color 0.3s ease;
            font-family: var(--title-font);

            &:hover {
              color: var(--theme-color);
            }
          }

          .result-excerpt {
            color: var(--body-color);
            font-size: 14px;
            line-height: 1.5;
            margin: 0 0 10px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: var(--body-font);
          }

          .result-meta {
            display: flex;
            gap: 15px;

            .result-date,
            .result-author {
              color: var(--body-color);
              font-size: 12px;
              display: flex;
              align-items: center;
              gap: 5px;
              font-family: var(--body-font);

              i {
                font-size: 11px;
                color: var(--theme-color);
              }
            }
          }
        }
      }
    }
  }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

// Responsive design
@media (max-width: 768px) {
  .widget_search {
    .search-results {
      padding: 15px;

      .results-header {
        .results-title {
          font-size: 16px;
        }

        .results-count {
          font-size: 11px;
          padding: 3px 10px;
        }
      }

      .search-result-item {
        .result-content {
          .result-link {
            padding: 12px;

            .result-title {
              font-size: 15px;
            }

            .result-excerpt {
              font-size: 13px;
            }

            .result-meta {
              flex-direction: column;
              gap: 5px;
            }
          }
        }
      }
    }
  }
}
</style>
