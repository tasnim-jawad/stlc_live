export default [
  {
    name: "short_title",
    label: "Enter your short title",
    type: "text",
    value: "",
  },

  {
    name: "short_description",
    label: "Enter your short description",
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
		name: "display_status",
		label: "select display status",
		type: "select",
		value: "",
		data_list: [
			{
				label: "Show",
				value: 1,
			},
			{
				label: "hide",
				value: 0,
			},
		],
	},

  // {
  // 	name: "video_url",
  // 	label: "Enter your video url",
  // 	type: "text",
  // 	value: "",
  // },

  // {
  // 	name: "video_type",
  // 	label: "Enter your video type",
  // 	type: "text",
  // 	value: "",
  // },
];
