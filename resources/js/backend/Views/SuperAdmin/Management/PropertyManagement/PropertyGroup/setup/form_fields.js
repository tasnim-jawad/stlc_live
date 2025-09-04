export default [
	{
		name: "name",
		label: "Enter your name",
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
];
