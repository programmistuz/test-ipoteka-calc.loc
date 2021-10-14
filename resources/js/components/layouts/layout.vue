<template>
    <v-app>

        <!-- верхний хедер -->
        <v-app-bar color="blue" app>

            <v-col class="d-flex">

                <!-- иконка -->
                <v-app-bar-nav-icon>
                </v-app-bar-nav-icon>

                <!-- название сайта -->
                <v-app-bar-title class="d-flex align-center">
                </v-app-bar-title>

            </v-col>

        </v-app-bar>

        <!-- основной контент -->
        <v-main>
            <v-container>

                <!-- компонент Vue-роутинга -->
                <router-view></router-view>

            </v-container>
        </v-main>

        <!-- нижний футер -->
        <v-footer>

            <v-col class="text-right">
                Титов Сергей. All right reserved. 2021
            </v-col>

        </v-footer>

        <!-- окно сообщений -->
        <v-snackbar
                dark top right multi-line
                v-model="showInfo.show"
                :color="showInfo.color"
                :timeout="showInfo.timeout">

            {{ showInfo.message }}

            <template v-slot:action="{ attrs }">
                <v-btn
                        dark
                        text
                        v-bind="attrs"
                        @click="showInfo.show = false"
                >
                    Закрыть
                </v-btn>
            </template>

        </v-snackbar>

    </v-app>
</template>

<script>

    import {mapState} from "vuex";

    export default {

        created() {
            // начальные установки
            this.$store.dispatch("ACTION_settings");
        },

        data() {
            return {};
        },

        computed: {
            ...mapState([
                'showInfo',
            ]),
        },

        methods: {}
    };
</script>
