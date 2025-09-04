export default [
  {
    name: "page_type",
    label: "Enter your page type",
    type: "select",
    label: "Select page type",
    multiple: false,
    data_list: [
      {
        label: "About_us",
        value: "about_us",
      },
      {
        label: "Our_mission",
        value: "our_mission",
      },
      {
        label: "Our_vission",
        value: "our_vission",
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
    label: "Enter your quotation",
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
    label: "Enter your primary image",
    type: "file",
    value: "",
  },

  {
    name: "secondery_image",
    label: "Enter your secondery image",
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
    type: "textarea",
    value: "",
    row_col_class: "col-md-12",
  },
];
