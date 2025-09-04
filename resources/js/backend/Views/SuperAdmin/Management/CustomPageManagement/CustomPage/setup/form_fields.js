export default [
	{
		name: "title",
		label: "Enter your title",
		type: "text",
		value: "",
	},

	{
		name: "page_permalink",
		label: "Enter your page permalink",
		type: "text",
		value: "",
	},

	{
		name: "banner_image",
		label: "Enter your banner image",
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
		row_col_class: "col-12",
	},
];
