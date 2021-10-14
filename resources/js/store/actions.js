export default {

    // ------------------------------------------------------------------
    // начальные установки
    ACTION_settings({commit}) {

        commit("MUTATTION_settings");
    },

    // ------------------------------------------------------------------
    // окно сообщений
    ACTION_showInfo({commit}, getMessage, getColor = 'info') {

        commit("MUTATTION_showInfo",
            {
                message: getMessage,
                color: getColor,
            });
    },
};
