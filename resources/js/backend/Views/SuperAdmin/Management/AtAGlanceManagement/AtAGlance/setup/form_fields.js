export default [
	{
		name: "title",
		label: "Enter your title",
		type: "text",
		value: "",
	},

	{
		name: "icon",
		label: "Enter your icon",
		type: "file",
		value: "",
	},

	{
		name: "number",
		label: "Enter your number",
		type: "number",
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
