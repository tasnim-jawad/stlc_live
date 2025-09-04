export default [
  {
    name: "title",
    label: "Enter your title",
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
    name: "image_gallery_left",
    label: "Enter your image gallery left",
    type: "file",
    multiple: true,
    value: "",
  },

  {
    name: "image_gallery_right",
    label: "Enter your image gallery right",
    type: "file",
    multiple: true,
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
