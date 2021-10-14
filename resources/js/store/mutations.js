export default {

    // ------------------------------------------------------------------
    // начальные установки
    MUTATTION_settings(state) {

        // запрос
        axios
            .post('/api/settings')
            .then(response => {
                // запрос прошел успешно

                // сохранить в переменную
                state.settings = response.data.data;
            })
            .catch(error => {
                // ошибка

                // сообщение пользователю
                state.showInfo.message = 'Ошибка при загрузке начальных установок...';
                state.showInfo.color = 'error';
                state.showInfo.show = true;
            })
            .finally(() => {
                // финальная обработка
            });
    },

    // ------------------------------------------------------------------
    // окно сообщений
    MUTATTION_showInfo(state, getParams) {

        // показать всплывающее сообщение
        state.showInfo.message = getParams.message;
        state.showInfo.color = getParams.color;
        state.showInfo.show = true;

        // продублировать в консоль
        console.log(getParams.message);
    },
};
