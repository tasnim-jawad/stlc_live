export default [
  {
    name: "gallery_category_id",
    label: "Select Gallery category ",
    type: "select",
    value: "",
    data_list: [],
  },
  {
    name: "title",
    label: "Enter your title",
    type: "text",
    value: "",
  },
  
  // {
  //   name: "type",
  //   label: "Enter your type",
  //   type: "select",
  //   label: "Select type",
  //   multiple: false,
  //   data_list: [
  //     {
  //       label: "Image",
  //       value: "image",
  //     },
  //     {
  //       label: "Video",
  //       value: "video",
  //     },
  //   ],
  //   value: "",
  // },

  {
    name: "video",
    label: "Enter your video url(youtube)",
    type: "text",
    value: "",
    placeholder: "https://www.youtube.com/watch?v=example",
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
