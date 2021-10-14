<template>
    <section>
        <v-container>
            <v-layout>

                <v-card
                        width="100%"
                        :loading="loading"
                        class="mx-auto pa-5"
                >

                    <v-card-title>
                        <h2>
                            Рассчет ипотеки
                        </h2>
                    </v-card-title>

                    <v-card-text>
                        Кредитный калькулятор поможет подобрать выгодные условия

                        <v-container>
                            <v-row v-if="typeof(settings.purpose) !== 'undefined'">

                                <!-- -------------------------------------------- -->
                                <!-- левая часть -->
                                <v-col cols="8">

                                    <v-combobox
                                            v-model="purpose"
                                            :items="purposeItems"
                                            label="Цель кредита"
                                            outlined
                                            dense
                                    ></v-combobox>

                                    <v-switch
                                            v-model="salaryCard"
                                            :label="`Заработная карта: ` + (salaryCard ? `есть (минус ` : `нет (плюс `) + settings.salary_rate + `%)`"
                                    ></v-switch>

                                    <v-subheader class="pl-0">
                                        Стоимость недвижимости:
                                    </v-subheader>
                                    <v-slider
                                            v-model="apartmentCost"
                                            thumb-label="always"
                                            :max="settings.apartment_cost.max"
                                            :min="settings.apartment_cost.min"
                                            :step="settings.apartment_cost.step"
                                            class="mt-5"
                                    >
                                        <template v-slot:append>
                                            <v-text-field
                                                    v-model="apartmentCost"
                                                    type="number"
                                                    :max="settings.apartment_cost.max"
                                                    :min="settings.apartment_cost.min"
                                                    :step="settings.apartment_cost.step"
                                            ></v-text-field>
                                        </template>
                                    </v-slider>

                                    <v-subheader class="pl-0">
                                        Первоначальный взнос:
                                    </v-subheader>
                                    <v-slider
                                            v-model="firstPayment"
                                            thumb-label="always"
                                            :max="firstPaymentMax"
                                            :min="settings.first_payment.min"
                                            step="1"
                                            class="mt-5"
                                    >
                                        <template v-slot:append>
                                            <v-text-field
                                                    v-model="firstPayment"
                                                    type="number"
                                                    :max="firstPaymentMax"
                                                    :min="settings.first_payment.min"
                                                    step="1"
                                            ></v-text-field>
                                        </template>
                                    </v-slider>

                                    <v-subheader class="pl-0">
                                        Срок кредита, лет:
                                    </v-subheader>
                                    <v-slider
                                            v-model="creditTerm"
                                            thumb-label="always"
                                            :max="settings.credit_term.max"
                                            :min="settings.credit_term.min"
                                            step="1"
                                            class="mt-5"
                                    >
                                        <template v-slot:append>
                                            <v-text-field
                                                    v-model="creditTerm"
                                                    type="number"
                                                    :max="settings.credit_term.max"
                                                    :min="settings.credit_term.min"
                                                    step="1"
                                            ></v-text-field>
                                        </template>
                                    </v-slider>

                                </v-col>

                                <!-- -------------------------------------------- -->
                                <!-- правая часть -->
                                <v-col cols="4">

                                    <v-text-field
                                            :value="monthlyPayment.toLocaleString() + ' руб.'"
                                            label="Ежемесячный платеж"
                                            readonly
                                    ></v-text-field>

                                    <v-text-field
                                            :value="creditAmount.toLocaleString() + ' руб.'"
                                            label="Сумма кредита"
                                            readonly
                                    ></v-text-field>

                                    <v-text-field
                                            :value="interestRate.toFixed(2) + '%'"
                                            label="Процентная ставка"
                                            readonly
                                    ></v-text-field>

                                    <!-- модальное окно -->
                                    <v-dialog
                                            v-model="dialog"
                                            scrollable
                                            max-width="1000px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on"
                                            >
                                                График платежей
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>График платежей</v-card-title>
                                            <v-divider></v-divider>
                                            <v-card-text>
                                                <v-data-table
                                                        :headers="headers"
                                                        :items="monthlyPayments"
                                                        :items-per-page="100"
                                                        class="elevation-1"
                                                ></v-data-table>
                                            </v-card-text>
                                            <v-divider></v-divider>
                                            <v-card-actions>
                                                <v-btn
                                                        color="blue darken-1"
                                                        text
                                                        @click="dialog = false"
                                                >
                                                    Закрыть
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>

                                </v-col>

                            </v-row>
                        </v-container>

                    </v-card-text>
                </v-card>

            </v-layout>
        </v-container>
    </section>
</template>

<script>

    import {mapState} from "vuex";

    export default {

        data() {
            return {
                loading: false,

                dialog: false,

                // левая часть
                purpose: null, // цель кредита и минимальная процентная ставка
                salaryCard: false, // значение от наличия заработной карты
                apartmentCost: null, // стоимость жилья
                firstPayment: null, // первоначальный взнос
                creditTerm: null, // срок кредита

                headers: [
                    {text: '№', value: 'nn'},
                    {text: 'месяц', value: 'month'},
                    {text: 'год', value: 'year'},
                    {text: 'сумма, руб.', value: 'summa'},
                    {text: 'погашение процентов, руб.', value: 'percent'},
                    {text: 'погашение долга, руб.', value: 'debt'},
                    {text: 'остаток, руб.', value: 'balance'},
                ],
            };
        },

        computed: {
            ...mapState([
                'settings',
                'month',
                'showInfo',
            ]),

            // цель кредита
            purposeItems: function () {
                if (typeof (this.settings.purpose) !== 'undefined') {
                    return this.settings.purpose.map(function (item) {
                        return {
                            text: item.name + ' (' + item.min_rate + '%)',
                            value: item.min_rate,
                        };
                    });
                }
                else {
                    return [];
                }
            },

            // первоначальный взнос - максимальное значение - ограничивается стоимостью жилья
            firstPaymentMax: function () {
                return (this.apartmentCost < this.settings.first_payment.max) ? this.apartmentCost : this.settings.first_payment.max;
            },

            // сумма кредита
            creditAmount: function () {
                return this.apartmentCost - this.firstPayment;
            },

            // процентная ставка
            interestRate: function () {
                if (this.purpose !== null) {
                    return this.purpose.value + ((this.salaryCard ? -1 : 1) * this.settings.salary_rate);
                }
                else {
                    return 0;
                }
            },

            // месячная ставка по кредиту (годовая, разделенная на 12-ть)
            interestRateMonth: function () {
                return this.interestRate / 100 / 12;
            },

            // ежемесячный взнос
            monthlyPayment: function () {
                if (this.purpose !== null) {
                    return Math.round(this.creditAmount * (this.interestRateMonth + this.interestRateMonth / (Math.pow(1 + this.interestRateMonth, this.creditTerm * 12) - 1)));
                }
                else {
                    return 0;
                }
            },

            // ежемесячные платежи
            monthlyPayments: function () {
                let monthlyPayments = [];
                if (this.purpose !== null) {

                    // остаток в начале равен сумме кредита
                    let balance = this.creditAmount;
                    // текущая дата
                    let now = new Date();

                    for (let i = 1; i <= this.creditTerm * 12; i++) {

                        // погашение процентов
                        let percent = balance * this.interestRateMonth;
                        // погашение долга
                        let debt = this.monthlyPayment - percent;
                        // уменьшить баланс
                        balance -= debt;
                        if (balance < 0) balance = 0;

                        // текущий месяц
                        let currentMonth = now.getMonth();
                        let currentYear = now.getFullYear();

                        monthlyPayments.push(
                            {
                                nn: i,
                                month: this.month[currentMonth],
                                year: currentYear,
                                summa: this.monthlyPayment.toLocaleString(),
                                percent: percent.toLocaleString(),
                                debt: debt.toLocaleString(),
                                balance: balance.toLocaleString(),
                            }
                        );

                        // сдвинуть на месяц вперед
                        now.setMonth(currentMonth + 1);
                    }
                }
                console.table(monthlyPayments);
                return monthlyPayments;
            },
        },

        methods: {}
    };
</script>
