<script>
import { inject } from 'vue'
export default {
    name: 'medication-plan',
    setup() {
        const toast = inject('toast')
        return { toast }
    },
    data() {
        return {
            medicament: {
                name: '',
                dose: '',
                unit: '',
                pieces_morning: '',
                pieces_midday: '',
                pieces_evening: '',
                pieces_night: ''
            },
            fields: []
        };
    },
    methods: {
        save() {
            const data = {
                name: this.medicament.name,
                dose: this.medicament.dose,
                unit: this.medicament.unit,
                pieces_morning: this.medicament.pieces_morning,
                pieces_midday: this.medicament.pieces_midday,
                pieces_evening: this.medicament.pieces_evening,
                pieces_night: this.medicament.pieces_night,
            };

            axios.post('/api/addmedicament',  data).then(response => {
                this.medicament = {};
                this.toast.success({
                    title: response.data.title,
                    message: response.data.message,
                    delay: 50000
                });
                this.$refs.table.reload();
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
    }
}

</script>

<template>
    <div class="table-responsive">
    <FlashToast/>
    <vuetable ref="table"
    :fields="[
        {name: 'id', title: '#'},
        {name: 'name', title: $t('medicationplan.medicament')},
        {name: 'dose', title: $t('medicationplan.dose')},
        {name: 'pieces_morning', title: $t('medicationplan.morning')},
        {name: 'pieces_midday', title: $t('medicationplan.midday')},
        {name: 'pieces_evening', title: $t('medicationplan.evening')},
        {name: 'pieces_night', title: $t('medicationplan.night')},
        {name: 'vuetable-field-delete'}
    ]"
    :api-mode=true
    :per-page="5"
    :apiUrl="'api/medicationplan'"
    >
    </vuetable>
    </div>
    <div class="card text-white mb-3">
        <div class="card-header bg-success text-white">{{ $t('medicationplan.add_medicament') }}</div>
        <div class="card-body">
                <div class="row g-1">
                    <div class="col-4">
                        <label for="name" class="visually-hidden">{{ $t('medicationplan.name') }}</label>
                        <input type="text" v-model="medicament.name" name="name" class="form-control" :placeholder="$t('medicationplan.name')">
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col-2">
                        <label for="dose" class="visually-hidden">{{ $t('medicationplan.dose') }}</label>
                        <input type="text" v-model="medicament.dose" name="dose" class="form-control" :placeholder="$t('medicationplan.dose')">
                    </div>
                    <div class="col-2">
                        <select v-model="medicament.unit" class="form-select" name="unit">
                            <option :value="'mg'">{{ $t('medicationplan.milligram') }}</option>
                            <option :value="'ml'">{{ $t('medicationplan.milliliter') }}</option>
                            <option :value="'ug'">{{ $t('medicationplan.microgram') }}</option>
                        </select>
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col-2">
                        <label for="pieces_morning" class="visually-hidden">{{ $t('medicationplan.morning') }}</label>
                        <input type="text" readonly class="form-control-plaintext" :value="$t('medicationplan.morning')">
                    </div>
                    <div class="col-2">
                        <label for="pieces_morning" class="visually-hidden">{{ $t('medicationplan.pieces') }}</label>
                        <input type="text" v-model="medicament.pieces_morning" class="form-control" :placeholder="$t('medicationplan.pieces')">
                    </div>

                </div>
                <div class="row g-1">
                    <div class="col-2">
                        <label for="pieces_midday" class="visually-hidden">{{ $t('medicationplan.midday') }}</label>
                        <input type="text" readonly class="form-control-plaintext" :value="$t('medicationplan.midday')">
                    </div>
                    <div class="col-2">
                        <label for="pieces_midday" class="visually-hidden">{{ $t('medicationplan.pieces') }}</label>
                        <input type="text" v-model="medicament.pieces_midday" class="form-control" :placeholder="$t('medicationplan.pieces')">
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col-2">
                        <label for="pieces_evening" class="visually-hidden">{{ $t('medicationplan.evening') }}</label>
                        <input type="text" readonly class="form-control-plaintext" :value="$t('medicationplan.evening')">
                    </div>
                    <div class="col-2">
                        <label for="pieces_evening" class="visually-hidden">{{ $t('medicationplan.pieces') }}</label>
                        <input type="text" v-model="medicament.pieces_evening" class="form-control" :placeholder="$t('medicationplan.pieces')">
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col-2">
                        <label for="pieces_night" class="visually-hidden">{{ $t('medicationplan.night') }}</label>
                        <input type="text" readonly class="form-control-plaintext" :value="$t('medicationplan.night')">
                    </div>
                    <div class="col-2">
                        <label for="pieces_night" class="visually-hidden">{{ $t('medicationplan.pieces') }}</label>
                        <input type="text" v-model="medicament.pieces_night" class="form-control" :placeholder="$t('medicationplan.pieces')">
                    </div>
                </div>
                <div class="col-auto">
                    <button @click="save" class="btn btn-primary mb-3">{{ $t('medicationplan.add') }}</button>
                </div>
        </div>
    </div>
</template>

<style scoped>

</style>
