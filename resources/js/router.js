// страницы
import homePageComponent from './components/pages/home_page_component';

// 404 страница
const NotFound = {
    template: '<h2>Извините, страница не найдена!</h2>'
};

import VueRouter from 'vue-router';

const routes = [
    {
        path: '/',
        component: homePageComponent,
        name: 'home',
    },

    // в конце списка - 404 страница
    {
        path: '*',
        component: NotFound,
        name: '404',
    }
];

export default new VueRouter({
    routes,
    mode: 'history'
});
