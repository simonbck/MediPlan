<script>
import { inject } from 'vue'
export default {
    name: "Overview",
    setup() {
        const toast = inject('toast')
        return { toast }
    },
    data() {
        return {
            medicament: {
                id: 0,
                pieces: '',
            },
            medicaments: {
                color: 'card text-white bg-success mb-3',
                on_stock_until: ''
            },
            date: ''
        };
    },
    methods: {
        checkMedicaments() {
            const today = new Date();
            const checkDate = Date.parse(date.value);
            let days = Math.round((checkDate - today) / (1000 * 60 * 60 * 24));
            days = days+2; //adding 2 days, for today and appointment for doctor | cronjob is running every day at 12am

            for (const [key, value] of Object.entries(this.medicaments)) {
                let pieces_per_day = value.pieces_morning+value.pieces_midday+value.pieces_evening+value.pieces_night;
                let needed_pieces = days * pieces_per_day;
                if(value.pieces < needed_pieces) {
                    value.color = 'card text-white bg-danger mb-3';
                } else {
                    value.color = 'card text-white bg-success mb-3';
                }
            }
        },
        save() {
            let data = {
                pieces: this.medicament.pieces
            };

            axios.post('/api/updatemedicament/'+this.medicament.id,  data).then(response => {
                this.medicament = {};
                this.toast.success({
                    title: response.data.title,
                    message: response.data.message,
                    delay: 50000
                });
                this.fetchData();
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
        },
        async fetchData() {
            const { data: response } = await axios.get('/api/medicationplan');
            this.medicaments = response.data;

            for (const [key, value] of Object.entries(this.medicaments)) {
                value.color = 'card text-white bg-success mb-3';

                let pieces_per_day = value.pieces_morning+value.pieces_midday+value.pieces_evening+value.pieces_night;
                let days = value.pieces / pieces_per_day - 1; //-1 for today
                const today = new Date();
                let till_date = today.setDate(today.getDate() + days)
                let year = new Intl.DateTimeFormat(navigator.language, { year: 'numeric' }).format(till_date);
                let month = new Intl.DateTimeFormat(navigator.language, { month: 'numeric' }).format(till_date);
                let day = new Intl.DateTimeFormat(navigator.language, { day: '2-digit' }).format(till_date);

                if(navigator.language === 'de') {
                    value.on_stock_until = day+'.'+month+'.'+year;
                } else {
                    value.on_stock_until = month+'-'+day+'-'+year;
                }
            }
        }
    },
    created() {
        this.fetchData();
    },
}
</script>

<template>
    <FlashToast/>
    <div class="row justify-content-around">

        <div class="col-6" v-for="(item, index) in medicaments" :key="index">
            <div :class="item.color">
                <div class="card-header">{{ item.name+" "+item.dose }}</div>
                <div class="card-body">
                    <p class="card-text">{{ $t('overview.on_stock')}} {{ item.pieces }}<br>{{ $t('overview.on_stock_until')}} {{ item.on_stock_until }}</p>
                </div>
            </div>
        </div>


        <div class="col-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-success text-white">{{ $t('overview.search') }}</div>
                <div class="card-body">
                    <div class="col-auto">
                        <label for="date" class="visually-hidden">{{ $t('overview.date') }}</label>
                        <input type="date" v-model="date" class="form-control" id="date" placeholder="{{ $t('overview.date') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" @click="checkMedicaments" class="btn btn-primary mb-3">{{ $t('overview.check') }}</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-success text-white">{{ $t('overview.restock') }}</div>
                <div class="card-body">
                    <div class="col-auto">
                        <select class="form-select" v-model="medicament.id" aria-label="Medikament">
                            <option v-for="(item, index) in medicaments"
                                    :value="item.id"
                                    :key="index">
                                {{ item.name+" "+item.dose}}
                            </option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="pieces" class="visually-hidden">{{ $t('medicationplan.pieces') }}</label>
                        <input type="text" v-model="medicament.pieces" class="form-control" id="pieces" :placeholder="$t('medicationplan.pieces')">
                    </div>
                    <div class="col-auto">
                        <button @click="save" type="submit" class="btn btn-primary mb-3">{{ $t('medicationplan.add') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
