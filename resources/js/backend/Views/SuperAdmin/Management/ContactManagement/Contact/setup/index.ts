
import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Contact";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "contacts",

    module_name: "contact",
    store_prefix: "contact",
    route_prefix: "Contact",
    route_path: "contact",

    select_fields: [
        "id",
        "name",
            "email",
            "service_types",
            "phone_number",
            "message",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "name",
            "email",
            "service_types",
            "phone_number",
            "message",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "name",
            "email",
            "service_types",
            "phone_number",
            "message",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "name",
            "email",
            "service_types",
            "phone_number",
            "message",
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
