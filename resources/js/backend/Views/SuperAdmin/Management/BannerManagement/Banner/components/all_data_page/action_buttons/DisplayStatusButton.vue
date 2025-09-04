<template>
    <a v-if="item.display_status == '1'" href="" @click.prevent="updateDisplayStatus(item)" class="border-warning">
        <i class="fa fa-eye-slash text-warning"></i>
        Don't Display
    </a>
    <a v-if="item.display_status == '0'" href="" @click.prevent="updateDisplayStatus(item)" class="border-warning">
        <i class="fa fa-eye text-warning"></i>
        Display
    </a>
</template>
<script>
import { mapActions } from 'pinia';
import { store } from '../../../store';


export default {
    props: {
        item: {
            slug: "",
        }
    },
    methods: {
        ...mapActions(store, [
            `restore`,
            `deactive`,
            `get_all`,
            `set_only_latest_data`,
            `set_item`,
            `update_display_status`,
        ]),
        updateDisplayStatus: async function (item) {
            console.log(item);

            let action = item.display_status == 1 ? 0 : 1;
            let con = await window.s_confirm('Are you sure want to ' + action + ' ?');
            if (con) {
                this.set_item(item);
                this.set_only_latest_data(true);
                let response = await this.update_display_status();
                if (response.data.status === "success") {
                    await this.get_all();
                    window.s_alert(response.data?.message);
                    this.set_only_latest_data(true);
                } else {
                    window.s_warning(response.data?.message);
                }
            }
        },
    }
}
</script>
<style lang="">

</style>
