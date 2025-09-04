import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Banner";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "banners",

  module_name: "banner",
  store_prefix: "banner",
  route_prefix: "Banner",
  route_path: "banner",

  select_fields: [
    "id",
    "short_title",
    "short_description",
    "video_url",
    "video_file",
    "video_type",
    "status",
    "display_status",
    "slug",
    "created_at",
  ],

  sort_by_cols: [
    "id",
    "short_title",
    "short_description",

    "status",
    "created_at",
  ],
  table_header_data: [
    "id",
    "short_title",
    "short_description",
    "display_status",

    "status",
    "created_at",
  ],
  table_row_data: [
    "id",
    "short_title",
    "short_description",
    "display_status",

    "status",
    "created_at",
  ],

  layout_title: prefix + " Management",
  page_title: `${prefix} Management`,

  all_page_title: "All " + prefix,
  details_page_title: "Details " + prefix,
  create_page_title: "Create " + prefix,
  edit_page_title: "Edit " + prefix,
};

export default setup;
