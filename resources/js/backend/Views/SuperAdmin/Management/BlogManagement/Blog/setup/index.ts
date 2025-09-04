import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Blog";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "blogs",

  module_name: "blog",
  store_prefix: "blog",
  route_prefix: "Blog",
  route_path: "blog",

  select_fields: [
    "id",
    "blog_category_id",
    "title",
    "tags",

    "writer",
    "meta_description",
    "meta_keywords",
    "blog_type",
    "url",
    "show_top",
    "thumbnail_image",
    "image",
    "status",
    "slug",
    "created_at",
    "description",
  ],

  sort_by_cols: [
    "id",
    "title",
    "description",
    "tags",

    "writer",
    "meta_description",
    "meta_keywords",
    "thumbnail_image",
    "image",
    "blog_type",
    "url",
    "show_top",
    "status",
    "created_at",
  ],
  table_header_data: ["id", "Category", "title", "status", "created_at"],
  table_row_data: ["id", "blog_category", "title", "status", "created_at"],

  details_page_data: [
    "id",
    "blog_category",
    "title",
    "tags",

    "writer",
    "meta_description",
    "meta_keywords",
    "blog_type",
    "url",
    "show_top",
    "thumbnail_image",
    "image",
    "status",
    "slug",
    "created_at",
    "description",
  ],

  layout_title: prefix + " Management",
  page_title: `${prefix} Management`,

  all_page_title: "All " + prefix,
  details_page_title: "Details " + prefix,
  create_page_title: "Create " + prefix,
  edit_page_title: "Edit " + prefix,
};

export default setup;
