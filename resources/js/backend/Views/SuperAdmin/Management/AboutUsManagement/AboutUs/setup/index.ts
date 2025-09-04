import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "AboutU";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "about-uses",

  module_name: "about-us",
  store_prefix: "about_us",
  route_prefix: "AboutUs",
  route_path: "about-us",

  select_fields: [
    "id",
    "title",
    "description",
    "features",
    "quotation",
    "video_url",
    "primary_image",
    "secondery_image",
    "page_type",
    "status",
    "slug",
    "created_at",
  ],

  sort_by_cols: [
    "id",
    "title",

    "quotation",
    "video_url",
    "primary_image",
    "secondery_image",
    "page_type",
    "status",
    "created_at",
  ],
  table_header_data: ["id", "title", "page_type", "status", "created_at"],
  table_row_data: ["id", "title", "page_type", "status", "created_at"],

  layout_title: prefix + " Management",
  page_title: `${prefix} Management`,

  all_page_title: "All " + prefix,
  details_page_title: "Details " + prefix,
  create_page_title: "Create " + prefix,
  edit_page_title: "Edit " + prefix,
};

export default setup;
