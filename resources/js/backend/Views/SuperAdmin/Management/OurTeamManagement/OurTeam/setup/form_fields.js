export default [
  {
    name: "name",
    label: "Enter your name",
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
];
