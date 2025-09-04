<template>
  <div>
    <form @submit.prevent="submitHandler">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="text-capitalize">
            {{
              param_id
                ? `${setup.edit_page_title}`
                : `${setup.create_page_title}` + "s"
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
              v-for="(form_field, index) in filtered_form_fields"
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
                :onchange="changeAction"
                :onchangeAction="form_field.onchangeAction"
              />
            </template>

            <div
              class="col-md-12 pt-3"
              id="features_section"
              v-if="!['our_mission', 'our_vission'].includes(page_type)"
            >
              <div
                class="d-flex justify-content-between align-items-center border-bottom pb-2"
              >
                <h5 class="m-0">Add feature</h5>
                <button
                  class="btn btn-sm btn-outline-success"
                  @click.prevent="add_features_row"
                >
                  Add row
                </button>
              </div>
              <!-- <h5>Add feature</h5> -->
              <div
                class="row align-items-center"
                v-for="(features, index) in features_data"
                :key="index"
              >
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">icon</label>
                    <div class="mt-1 mb-3">
                      <select
                        class="form-control form-control-square mb-2"
                        :name="`features[${index}][icon]`"
                        v-model="features.icon"
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
                    <label for="">title</label>
                    <div class="mt-1 mb-3">
                      <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`features[${index}][title]`"
                        v-model="features.title"
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
                    @click.prevent="delete_features_row(index)"
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
    form_fields: JSON.parse(JSON.stringify(form_fields)), // Make reactive
    page_type: "", // Add this for tracking selected page type

    param_id: null,

    features_data_object: {
      icon: "",
      title: "",
    },

    features_data: [
      {
        icon: "",
        title: "",
      },
    ],
    errors: [],

    icons: [
      { class: "fa-solid fa-check", title: "Check" },
      { class: "fa-solid fa-shield", title: "Shield" },
      { class: "fa-solid fa-star", title: "Star" },
      { class: "fa-solid fa-heart", title: "Heart" },
      { class: "fa-solid fa-user", title: "User" },
      { class: "fa-solid fa-cog", title: "Settings" },
      { class: "fa-solid fa-envelope", title: "Envelope" },
      { class: "fa-solid fa-phone", title: "Phone" },
      { class: "fa-solid fa-globe", title: "Globe" },
      { class: "fa-solid fa-clock", title: "Clock" },
      { class: "fa-solid fa-thumbs-up", title: "Thumbs Up" },
      { class: "fa-solid fa-camera", title: "Camera" },
      { class: "fa-solid fa-shopping-cart", title: "Shopping Cart" },
      { class: "fa-solid fa-lock", title: "Lock" },
      { class: "fa-solid fa-chart-bar", title: "Chart Bar" },
      { class: "fa-solid fa-person-shelter", title: "Person Shelter" },
      { class: "fa-solid fa-person-booth", title: "Person Booth" },
      { class: "fa-solid fa-people-roof", title: "People Roof" },
      { class: "fa-solid fa-restroom", title: "Restroom" },
      { class: "fa-solid fa-kitchen-set", title: "Kitchen Set" },
      { class: "fa-solid fa-faucet-drip", title: "Water Faucet" },
      { class: "fa-solid fa-warehouse", title: "Warehouse" },
      { class: "fa-solid fa-road", title: "Road" },
      { class: "fa-solid fa-building", title: "Building" },
      { class: "fa-solid fa-school", title: "School" },
      { class: "fa-solid fa-building-columns", title: "Government Building" },
      { class: "fa-solid fa-bed", title: "Bed" },
      { class: "fa-solid fa-hospital", title: "Hospital" },
      { class: "fa-solid fa-fan", title: "Fan" },
      { class: "fa-solid fa-temperature-arrow-up", title: "High Temperature" },
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
        console.log("this.item", this.item);

        this.form_fields.forEach((field, index) => {
          Object.entries(this.item).forEach((value) => {
            if (field.name == value[0]) {
              this.form_fields[index].value = value[1];
            }
            // Set summernote content for description
            // if (field.name == "description" && value[0] == "description") {
            //   setTimeout(function () {
            //     $("#description").summernote("code", value[1]);
            //   }, 1000);
            // }
          });
        });

        // Set page_type for filtering and features section
        if (this.item.page_type) {
          this.page_type = this.item.page_type;
        }

        this.features_data = [];
        let features = this.item.features;
        // Parse if it's a JSON string
        if (typeof features === "string") {
          try {
            features = JSON.parse(features);
          } catch (e) {
            features = [];
          }
        }
        (features || []).forEach((element) => {
          this.features_data.push({
            icon: element.icon,
            title: element.title,
          });
        });
      }
    },

    submitHandler: async function ($event) {
      // console.log("this.validate_data()", this.validate_data());
      if (!this.validate_data()) {
        return; // Stop submission if validation fails
      }

      this.set_only_latest_data(true);
      if (this.param_id) {
        // this.setSummerEditor();
        let response = await this.update($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          window.s_alert("Data successfully updated");
          this.$router.push({ name: `Details${this.setup.route_prefix}` });
        }
      } else {
        // this.setSummerEditor();
        let response = await this.create($event);
        // await this.get_all();
        if ([200, 201].includes(response.status)) {
          window.s_alert("Data Successfully Created");
          this.$router.push({ name: `All${this.setup.route_prefix}` });
        }
      }
    },

    // setSummerEditor() {
    //   // Set description summernote content
    //   var markupStr = $("#description").summernote("code");
    //   var target = document.createElement("input");
    //   target.setAttribute("name", "description");
    //   target.value = markupStr;
    //   document.getElementById("description").appendChild(target);
    // },
    add_features_row: function () {
      console.log("features_data", this.features_data.length);
      if (this.features_data.length >= 4) {
        console.error("You can only add up to 4 features");
        return;
      }
      this.features_data.push({ ...this.features_data_object });
    },
    delete_features_row(index) {
      if (index < 1) {
        console.error("cant delete first row");
        return;
      }
      this.features_data.splice(index, 1);
    },

    validate_data: function () {
      this.errors = [];
      let valid = true;
      if (!["our_mission", "our_vission"].includes(this.page_type)) {
        this.features_data.forEach((features, index) => {
          let featuresErrors = {};

          // Validate icon field
          if (!features.icon) {
            featuresErrors.icon = "Icon is required";
            valid = false;
          }

          // Validate title field
          if (!features.title) {
            featuresErrors.title = "Title is required";
            valid = false;
          }

          this.errors[index] = featuresErrors;
        });
      }

      // Log errors for debugging
      console.log(this.errors);

      if (!valid) {
        console.error("Validation failed");
        return false;
      }

      return true;
    },

    changeAction: function (actionTitle, event, ref) {
      this[actionTitle](actionTitle, event, ref);
    },

    onSelectChange(actionTitle, event, ref) {
      console.log("onSelectChange event:", event.target.value);
      this.page_type = event.target.value;
    },
  },

  computed: {
    ...mapState(store, {
      item: "item",
    }),

    filtered_form_fields() {
      const pageType = this.page_type;
      const fieldsToRemove = [
        "title",
        "quotation",
        "video_url",
        "secondery_image",
      ];
      return this.form_fields.filter((f) => {
        if (pageType === "our_mission" || pageType === "our_vission") {
          return !fieldsToRemove.includes(f.name);
        }
        return true;
      });
    },
  },
};
</script>
<style>
.custom_error {
  border: 1px solid red;
}
</style>
