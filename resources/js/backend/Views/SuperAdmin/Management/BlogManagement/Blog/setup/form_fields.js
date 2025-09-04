export default [
  {
    name: "blog_category_id",
    label: "Enter your category",
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

  {
    name: "tags",
    label: "Enter your tags",
    type: "text",
    value: "",
  },

  //   {
  //     name: "publish_date",
  //     label: "Enter your publish date",
  //     type: "datetime-local",
  //     value: "",
  //   },

  {
    name: "writer",
    label: "Enter your writer",
    type: "text",
    value: "",
  },

  {
    name: "meta_description",
    label: "Enter your meta description",
    type: "text",
    value: "",
  },

  {
    name: "meta_keywords",
    label: "Enter your meta keywords",
    type: "text",
    value: "",
  },

  {
    name: "blog_type",
    label: "Enter your blog type",
    type: "text",
    value: "",
  },

  {
    name: "url",
    label: "Enter your url",
    type: "text",
    value: "",
  },

  {
    name: "show_top",
    label: "Enter your show top",
    type: "text",
    value: "",
  },
  {
    name: "thumbnail_image",
    label: "Upload thumbnail image",
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
  //   {
  //     name: "image",
  //     label: "Upload  image",
  //     type: "file",
  //     value: "",
  //   },
  {
    name: "description",
    label: "Enter your description",
    type: "texteditor",
    value: "",
    row_col_class: "col-12",
  },

  
];
