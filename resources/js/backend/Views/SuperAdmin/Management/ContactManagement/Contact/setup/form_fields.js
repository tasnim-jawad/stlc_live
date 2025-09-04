export default [
  {
    name: "name",
    label: "Enter your name",
    type: "text",
    value: "",
  },

  {
    name: "email",
    label: "Enter your email",
    type: "text",
    value: "",
  },

  {
    name: "service_types",
    label: "Enter your service types",
    type: "text",
    value: "",
  },

  {
    name: "phone_number",
    label: "Enter your phone number",
    type: "text",
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
    name: "message",
    label: "Enter your message",
    type: "texteditor",
    value: "",
    row_col_class: "col-md-12",
  },
];
