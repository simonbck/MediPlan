<script>
import {VuetableFieldMixin} from "vue3-vuetable";
import { inject } from 'vue'

export default {
    setup() {
        const toast = inject('toast')
        return { toast }
    },
    methods: {
        delete(rowData) {
            axios.post('/api/deletemedicament/'+rowData.id, {}).then(response => {
                this.medicament = {};
                this.toast.success({
                    title: response.data.title,
                    message: response.data.message,
                    delay: 50000
                });
                this.$parent.reload();
            })
            .catch(e => {
                if(e.status === 422) {
                    this.toast.error({
                        title: this.$t('medicationplan.error_title'),
                        message: e.response.data.message,
                        delay: 50000
                    });
                } else {
                    this.toast.error({
                        title: this.$t('medicationplan.error_title'),
                        message: this.$t('medicationplan.error_message'),
                        delay: 50000
                    });
                }
            });
        }
    },
    name: 'vuetable-field-delete',
    mixins: [VuetableFieldMixin],
}
</script>

<template>
    <th v-if="isHeader">
        {{ this.$t('medicationplan.action') }}
    </th>
    <td v-else>
        <!--<td><i class="bi bi-pencil"></i>-->

       <i class="bi bi-trash" @click="this.delete(rowData)"></i>
    </td>
</template>

<style scoped>

</style>


