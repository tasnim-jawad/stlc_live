export default [
  {
    name: "page_type",
    label: "Enter your page type",
    type: "select",
    label: "Select page type",
    multiple: false,
    data_list: [
      {
        label: "About us",
        value: "about_us",
      },
      {
        label: "Our mission",
        value: "our_mission",
      },
      {
        label: "Our vision",
        value: "our_vision",
      },
      {
        label: "Core Values",
        value: "core_values",
      },
    ],
    value: "",
    onchangeAction: "onSelectChange",
  },

  {
    name: "title",
    label: "Enter your title",
    type: "text",
    value: "",
  },
  {
    name: "quotation",
    label: "Enter your circle text(max 36 char)",
    type: "text",
    value: "",
  },

  {
    name: "video_url",
    label: "Enter your video url",
    type: "text",
    value: "",
  },

  {
    name: "primary_image",
    label: "Enter your images (5 images for design purpose)",
    type: "file",
    multiple: "true",
    accept: "image/*",
    images_list: [],
  },

  {
    name: "secondary_image",
    label: "Enter your secondary image",
    type: "file",
    value: "",
  },

  {
    name: "status",
    label: "select status",
    type: "select",
    value: "",
    data_list: [
      {
        label: "Active",
        value: "active",
      },
      {
        label: "Inactive",
        value: "inactive",
      },
    ],
  },

  {
    name: "description",
    label: "Enter your description",
    type: "texteditor",
    value: "",
    row_col_class: "col-md-12",
  },
];
