export default [
	{
		name: "name",
		label: "Enter your name",
		type: "text",
		value: "",
	},

	{
		name: "type",
		label: "Enter your type",
		type: "select",
		label: "Select type",
		multiple: false,
		data_list: [
			{
				label: "Image",
				value: "image",
			},
			{
				label: "Video",
				value: "video",
			},
		],
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
