Тестовое задание - расчет ипотеки

-------
Создание базы данных
.env - настройка строки соединения с базой данных.

composer require laravel/ui - чтобы Vue-фронт установился (и Auth роуты создались)
php artisan ui vue --auth - чтоб папка compomemts появилась и app.js наполнилась

php artisan migrate - создание и наполнение таблиц

--------
npm и Vue-компоненты:

npm install
npm install -D vue-loader vue-template-compiler - а то ошибка Vue
npm install vue vue-router vue-axios --save - три модуля. Роут. Запрос к базе данных
npm install vuex --save - VUEX
npm install @nuxtjs/vuetify -D
npm run watch

Формулы по расчету ипотеки взял отсюда:
https://temabiz.com/finterminy/ap-formula-i-raschet-annuitetnogo-platezha.html
