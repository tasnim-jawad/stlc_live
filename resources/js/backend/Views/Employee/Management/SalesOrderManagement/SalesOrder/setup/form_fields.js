export default [
  {
    name: "order_title",
    label: "  order title",
    type: "text",
    value: "",
  },

  {
    name: "reference",
    label: "  reference",
    type: "text",
    value: "",
  },

  {
    name: "customer_id",
    label: "  customer id",
    type: "number",
    value: "",
  },

  {
    name: "date",
    label: "  date",
    type: "datetime",
    value: "",
  },

  {
    name: "subtotal",
    label: "  subtotal",
    type: "number",
    value: "",
  },

  {
    name: "due",
    label: "  due",
    type: "number",
    value: "",
  },

  {
    name: "paid",
    label: "  paid",
    type: "number",
    value: "",
  },

  {
    name: "discount",
    label: "  discount",
    type: "number",
    value: "",
  },

  {
    name: "total",
    label: "  total",
    type: "number",
    value: "",
  },

  {
    name: "order_status",
    label: "  order status",
    type: "select",
    label: "Select order status",
    multiple: false,
    data_list: [
      {
        label: "Pending",
        value: "pending",
      },
      {
        label: "Due",
        value: "due",
      },
      {
        label: "Paid",
        value: "paid",
      },
    ],
    value: "",
  },
];
