import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "TodaySell";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "today-sells",

  module_name: "today-sell",
  store_prefix: "today_sell",
  route_prefix: "TodaySells",
  route_path: "today-sell",

  select_fields: [
    "id",
    "title",
    "description",
    "features",
    "key_features",
    "video_url",
    "image_gallery_left",
    "image_gallery_right",
    "status",
    "slug",
    "created_at",
  ],

  sort_by_cols: [
    "id",
    "title",
    "description",
    "features",
    "key_features",
    "video_url",
    "image_gallery_left",
    "image_gallery_right",
    "status",
    "created_at",
  ],
  table_header_data: ["id", "title", "status", "created_at"],
  table_row_data: ["id", "title", "status", "created_at"],

  layout_title: prefix + " Management",
  page_title: `${prefix} Management`,

  all_page_title: "All " + prefix,
  details_page_title: "Details " + prefix,
  create_page_title: "Create " + prefix,
  edit_page_title: "Edit " + prefix,
};

export default setup;
