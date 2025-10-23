export default [
	{
		name: "title",
		label: "Enter your title",
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
		name: "primary_image",
		label: "Enter your primary image",
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
		name: "url",
		label: "Enter your Short Description",
		type: "text",
		value: "",
		row_col_class: "col-md-12",
	},
	{
		name: "description",
		label: "Enter your description",
		type: "textarea",
		value: "",
		row_col_class: "col-md-12",
	},
];
