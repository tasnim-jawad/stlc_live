<template>
  <div class="th-comment-form blog-comment-wrap">
    <div class="form-title mb-25">
      <h3 class="blog-inner-title h4">Leave a Reply</h3>
      <p class="form-text">
        Your email address will not be published. Required fields are marked
      </p>
    </div>

    <!-- Display general error -->
    <div v-if="error" class="alert alert-danger" role="alert">
      {{ error }}
    </div>

    <!-- Success message -->
    <div v-if="successMessage" class="alert alert-success" role="alert">
      {{ successMessage }}
    </div>

    <form @submit.prevent="handleSubmitComment">
      <div class="row">
        <div class="col-md-6 form-group style-border">
          <i class="fa-regular fa-user"></i>
          <input
            id="name"
            v-model="form.name"
            name="name"
            type="text"
            placeholder="Your name*"
            class="form-control"
            :class="{ 'is-invalid': validationErrors.name }"
          />
          <!-- <div v-if="validationErrors.name" class="invalid-feedback">
            {{ validationErrors.name[0] }}
          </div> -->
        </div>
        <div class="col-md-6 form-group style-border">
          <i class="fa-regular fa-envelope"></i>
          <input
            id="email"
            v-model="form.email"
            name="email"
            type="email"
            placeholder="Your email*"
            class="form-control"
            :class="{ 'is-invalid': validationErrors.email }"
          />
          <!-- <div v-if="validationErrors.email" class="invalid-feedback">
            {{ validationErrors.email[0] }}
          </div> -->
        </div>
        <div class="col-12 form-group style-border">
          <i class="fa-solid fa-globe"></i>
          <input
            id="website"
            v-model="form.website"
            name="website"
            type="url"
            placeholder="Website"
            class="form-control"
            :class="{ 'is-invalid': validationErrors.website }"
          />
          <!-- <div v-if="validationErrors.website" class="invalid-feedback">
            {{ validationErrors.website[0] }}
          </div> -->
        </div>
        <div class="col-12 form-group style-border">
          <i class="fa fa-pen"></i>
          <textarea
            v-model="form.comment"
            placeholder="Comment*"
            class="form-control"
            :class="{ 'is-invalid': validationErrors.comment }"
            rows="5"
          ></textarea>
          <div v-if="validationErrors.comment" class="invalid-feedback">
            {{ validationErrors.comment[0] }}
          </div>
        </div>
        <div class="col-12 form-group">
          <input
            id="reviewcheck"
            v-model="form.rememberMe"
            name="reviewcheck"
            type="checkbox"
          />
          <label for="reviewcheck"
            >Save my name, email, and website in this browser for the next time
            I comment.<span class="checkmark"></span
          ></label>
        </div>
        <div class="col-12 form-group style-border mb-0">
          <button type="submit" class="th-btn radius" :disabled="submitting">
            <span v-if="submitting">Sending...</span>
            <span v-else>Send Message</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { store as blog_comments_store } from "../Store/blog_comments_store.js";
import { mapState, mapActions } from "pinia";

export default {
  props: {
    blogId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        website: "",
        comment: "",
        rememberMe: false,
      },
      successMessage: "",
    };
  },
  computed: {
    ...mapState(blog_comments_store, [
      "validationErrors",
      "error",
      "submitting",
    ]),
  },
  methods: {
    ...mapActions(blog_comments_store, [
      "submitComment",
      "clearValidationErrors",
    ]),

    async handleSubmitComment() {
      this.clearValidationErrors();
      this.successMessage = "";

      const result = await this.submitComment(this.blogId, this.form);

      if (result.success) {
        this.successMessage = "Comment submitted successfully!";
        this.resetForm();
        setTimeout(() => {
          this.successMessage = "";
        }, 5000);
      }
    },

    resetForm() {
      if (!this.form.rememberMe) {
        this.form.name = "";
        this.form.email = "";
        this.form.website = "";
      }
      this.form.comment = "";
    },
  },
};
</script>

<style lang="scss" scoped></style>
