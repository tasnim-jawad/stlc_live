<template>
  <div :class="row_col_class">
    <div class="form-group">
      <label for="">
        {{ label || name }}
      </label>

      <input
        @change="preview"
        class="form-control"
        type="file"
        ref="input_files"
        :accept="accept"
        :class="classNames"
        :name="name + '[]'"
        :multiple="true"
      />

      <div class="uploaded_image_preview my-2 d-flex gap-1 flex-wrap">
        <template v-for="(image, index) in component_images" :key="index">
          <div class="position-relative my-1" v-if="image">
            <img
              :src="getImageUrl(image)"
              :class="image != '' ? 'border' : ''"
              style="width: 200px; height: 80px; object-fit: contain"
              alt="image"
              target="_blank"
              class="mx-1"
            />
            <button
              class="btn btn-outline-warning btn-round btn-sm"
              :class="`index-${index}`"
              style="position: absolute; top: 3px; right: 7px"
              @click.prevent="remove({ field: name, index: index })"
            >
              X
            </button>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store } from "../../store";
export default {
  props: {
    name: {
      required: true,
      default: "[]",
    },
    classNames: {
      default: "form-control",
    },
    accept: {
      required: true,
    },
    images: {
      default: [],
      required: false,
    },
    row_col_class: {
      type: String,
      default: "col-6",
    },
  },
  data: () => ({
    component_images: [],
    value: null,
  }),
  watch: {
    images: {
      handler: function (v) {
        console.log("Images prop changed:", v);
        this.component_images = Array.isArray(v) ? [...v] : [];
        this.value = v;
      },
      immediate: true,
      deep: true,
    },
  },
  created() {
    this.component_images = Array.isArray(this.images) ? [...this.images] : [];
    this.value = this.images;
  },
  methods: {
    getImageUrl(image) {
      // Handle different image formats
      if (typeof image === "string") {
        // If it's a base64 string, return as is
        if (image.startsWith("data:")) {
          return image;
        }
        // If it's a path, construct the full URL
        return `/${image}`;
      }
      // If it's an object with url property
      if (image && image.url) {
        return image.url;
      }
      // Fallback
      return image;
    },

    preview: function () {
      let that = this;
      that.component_images = [...that.component_images];
      [...that.$refs.input_files.files].forEach((el) => {
        const reader = new FileReader();
        reader.onload = function (e) {
          const base64String = e.target.result;
          that.component_images.push(base64String);
          that.value = base64String;
        };
        reader.readAsDataURL(el);
      });
    },

    remove: async function (data) {
      const confirmed = await window.s_confirm();
      if (!confirmed) return;

      const parsedData = { field: this.name, index: data.index };

      // Check if item exists and has slug for server-side deletion
      if (this.item && this.item.slug) {
        try {
          const response = await axios.post(
            `about-uses/delete-multiple-images/${
              this.item.slug
            }?data=${JSON.stringify(parsedData)}`
          );
          if (response.data && response.data.message) {
            window.s_alert(response.data.message);
          }
        } catch (error) {
          console.error("Error deleting image:", error);
        }
      }

      // Remove from component_images array
      this.component_images.splice(data.index, 1);

      // Update file input if files exist
      if (
        this.$refs.input_files &&
        this.$refs.input_files.files &&
        this.$refs.input_files.files.length > 0
      ) {
        const dt = new DataTransfer();
        const input = this.$refs.input_files;

        [...input.files].forEach((file, idx) => {
          if (idx !== data.index) {
            dt.items.add(file);
          }
        });
        input.files = dt.files; // Assign the new FileList
      }
    },
  },
  computed: {
    ...mapState(store, {
      item: "item",
    }),
  },
};
</script>

<style></style>
