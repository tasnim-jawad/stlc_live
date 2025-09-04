export default [
  {
    name: "name",
    label: "Enter your name",
    type: "text",
    value: "",
  },

  {
    name: "company",
    label: "Enter your company",
    type: "text",
    value: "",
  },

  {
    name: "company_location",
    label: "Enter your company location",
    type: "text",
    value: "",
  },

  {
    name: "designation",
    label: "Enter your designation",
    type: "text",
    value: "",
  },

  {
    name: "image",
    label: "Enter your image",
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
    name: "feedback",
    label: "Enter your feedback",
    type: "texteditor",
    value: "",
	row_col_class: "col-12",
  },

];
