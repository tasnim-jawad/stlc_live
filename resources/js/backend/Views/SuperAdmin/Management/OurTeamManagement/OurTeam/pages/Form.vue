<template>
  <div>
    <form @submit.prevent="submitHandler">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="text-capitalize">
            {{
              param_id
                ? `${setup.edit_page_title}`
                : `${setup.create_page_title}`
            }}
          </h5>
          <div>
            <router-link
              v-if="item.slug"
              class="btn btn-outline-info mr-2 btn-sm"
              :to="{
                name: `Details${setup.route_prefix}`,
                params: { id: item.slug },
              }"
            >
              {{ setup.details_page_title }}
            </router-link>
            <router-link
              class="btn btn-outline-warning btn-sm"
              :to="{ name: `All${setup.route_prefix}` }"
            >
              {{ setup.all_page_title }}
            </router-link>
          </div>
        </div>
        <div class="card-body card_body_fixed_height">
          <div class="row">
            <template
              v-for="(form_field, index) in form_fields"
              v-bind:key="index"
            >
              <common-input
                :label="form_field.label"
                :type="form_field.type"
                :name="form_field.name"
                :multiple="form_field.multiple"
                :value="form_field.value"
                :data_list="form_field.data_list"
                :is_visible="form_field.is_visible"
                :row_col_class="form_field.row_col_class"
              />
            </template>

            <div class="col-md-12 pt-3">
              <div
                class="d-flex justify-content-between align-items-center border-bottom pb-2"
              >
                <h5 class="m-0">Add social link</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_social_row"
                >
                  Add row
                </button>
              </div>
              <!-- <h5>Add feature</h5> -->
              <div
                class="row align-items-center"
                v-for="(social, index) in social_data"
                :key="index"
              >
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">icon</label>
                    <div class="mt-1 mb-3">
                      <select
                        class="form-control form-control-square mb-2"
                        :name="`social_link[${index}][icon]`"
                        v-model="social.icon"
                        :class="{
                          custom_error: errors[index] && errors[index].icon,
                        }"
                      >
                        <option value="">-- select --</option>
                        <option
                          v-for="(icon, i) in icons"
                          :key="i"
                          :value="icon.class"
                        >
                          {{ icon.title }}
                        </option>
                      </select>
                      <div
                        v-if="errors[index] && errors[index].icon"
                        class="text-danger small"
                      >
                        {{ errors[index].icon }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Link</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`social_link[${index}][title]`"
                        v-model="social.title"
                        id="title"
                        :class="{
                          custom_error: errors[index] && errors[index].title,
                        }"
                      />
                    </div>
                    <div
                      v-if="errors[index] && errors[index].title"
                      class="text-danger small"
                    >
                      {{ errors[index].title }}
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-2 d-flex align-items-center justify-content-center"
                >
                  <button
                    class="btn btn-sm btn-outline-danger"
                    :style="{
                      width: '100%',
                      marginTop:
                        !errors[index]?.icon && !errors[index]?.title
                          ? '30px'
                          : '0',
                    }"
                    @click.prevent="delete_social_row(index)"
                  >
                    delete <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-light btn-square px-5">
            <i class="icon-lock"></i>
            Submit
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store } from "../store";
import setup from "../setup";
import form_fields from "../setup/form_fields";

export default {
  data: () => ({
    setup,
    form_fields,
    param_id: null,

    social_data_object: {
      icon: "",
      link: "",
    },

    social_data: [
      {
        icon: "",
        link: "",
      },
    ],
    errors: [],

    icons: [
      { class: "fa-brands fa-facebook", title: "Facebook" },
      { class: "fa-brands fa-twitter", title: "Twitter" },
      { class: "vfa-instagram", title: "Instagram" },
      { class: "fa-brands fa-linkedin", title: "LinkedIn" },
      { class: "fa-brands fa-youtube", title: "YouTube" },
      { class: "fa-brands fa-pinterest", title: "Pinterest" },
      { class: "fa-brands fa-github", title: "GitHub" },
      { class: "fa-brands fa-tiktok", title: "TikTok" },
      { class: "fa-brands fa-reddit", title: "Reddit" },
      { class: "fa-brands fa-whatsapp", title: "WhatsApp" },
    ],
  }),
  created: async function () {
    let id = (this.param_id = this.$route.params.id);
    this.reset_fields();
    if (id) {
      this.set_fields(id);
    }
  },
  methods: {
    ...mapActions(store, {
      create: "create",
      update: "update",
      details: "details",
      get_all: "get_all",
      set_only_latest_data: "set_only_latest_data",
    }),
    reset_fields: function () {
      this.form_fields.forEach((item) => {
        item.value = "";
      });
    },
    set_fields: async function (id) {
      this.param_id = id;
      await this.details(id);
      if (this.item) {
        console.log("this.item", this.item.social_link);

        this.form_fields.forEach((field, index) => {
          Object.entries(this.item).forEach((value) => {
            if (field.name == value[0]) {
              this.form_fields[index].value = value[1];
            }
          });
        });

        this.social_data = [];
        let social_link = this.item.social_link;
        // Parse if it's a JSON string
        if (typeof social_link === "string") {
          try {
            social_link = JSON.parse(social_link);
          } catch (e) {
            social_link = [];
          }
        }
        (social_link || []).forEach((element) => {
          this.social_data.push({
            icon: element.icon,
            title: element.title,
          });
        });
      }
    },

    submitHandler: async function ($event) {
      if (!this.validate_data()) {
        return; // Stop submission if validation fails
      }
      this.set_only_latest_data(true);
      if (this.param_id) {
        let response = await this.update($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          window.s_alert("Data successfully updated");
          this.$router.push({ name: `Details${this.setup.route_prefix}` });
        }
      } else {
        let response = await this.create($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          window.s_alert("Data Successfully Created");
          this.$router.push({ name: `All${this.setup.route_prefix}` });
        }
      }
    },
    
    //add row for social links
    add_social_row: function () {
      console.log("social_data", this.social_data.length);
      if (this.social_data.length >= 4) {
        console.error("You can only add up to 4 social");
        return;
      }
      this.social_data.push({ ...this.social_data_object });
    },
    //delete row for social links
    delete_social_row(index) {
      if (index < 1) {
        console.error("cant delete first row");
        return;
      }
      this.social_data.splice(index, 1);
    },
    //validation for social link empty data
    validate_data: function () {
      this.errors = [];
      let valid = true;

      this.social_data.forEach((social, index) => {
        let socialErrors = {};

        // Validate icon field
        if (!social.icon) {
          socialErrors.icon = "Icon is required";
          valid = false;
        }

        // Validate title field
        if (!social.title) {
          socialErrors.link = "link is required";
          valid = false;
        }

        this.errors[index] = socialErrors;
      });

      // Log errors for debugging
      console.log(this.errors);

      if (!valid) {
        console.error("Validation failed");
        return false;
      }

      return true;
    },
  },

  computed: {
    ...mapState(store, {
      item: "item",
    }),
  },
};
</script>
<style>
.custom_error {
  border: 1px solid red;
}
</style>
