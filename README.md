## О приложении

Тестовое задание:

"Расчет иппотеки аннуитетными платежами."

## Стек технологий

- Laravel
- Vue + Vuex + Vuetify

## Установка

- создать базу данных (БД);
- переименовать конфигурационный файл .env.example в .env;
- обновить настройки соединения с БД в .env;
- открыть в папке проекта окно терминала или bash-консоль;
- выполнить команды:
- "composer install";
- "php artisan migrate";
- "npm run dev" (необязательно);

## Описание и формулы, взятые за основу 

https://temabiz.com/finterminy/ap-formula-i-raschet-annuitetnogo-platezha.html

Разработать ипотечный калькулятор с возможностью просмотра графика платежей.

Можно вдохновляться - https://www.vtb.ru/personal/ipoteka/ipotechnyj-kalkulyator/gotovoe-zhilye/ и https://www.sberbank.ru/ru/person/credits/home/buying_complete_house

Поля формы:
- Цель кредита - регулирует минимальную ставку, селект-инпут, справочник вместе со значениями минимальной ставки нужно запросить с сервера
- Есть зарплатная карта - чекбокс, в положении "да" уменьшает размер ставки на X (X нужно запросить с сервера), в положении "нет" - увеличивает на X
- Стоимость жилья - инпут или ползунок, ограничить ввод целыми числами от X до Z с шагом Y (X, Y, Z запросить с сервера)
- Первоначальный взнос - инпут или ползунок, ограничить ввод целыми числами от X до Z с шагом Y (X и Y получаем с сервера, Z - ограничивается стоимостью жилья, но валидацию проводим только при сабмите формы)
- Срок кредита - инпут или ползунок, ограничить ввод целыми числами от X до Z с шагом 1 (X и Z запросить с сервера)

При сабмите формы выдаем пользователю график платежей в модальном окне (внутри модалки - таблица со скроллом).
Расчет делаем на фронтенде, аннуитетными платежами.
Считать начинаем с текущего месяца и до конца срока кредитования. Каждая строка таблицы - один платеж.

Поля таблицы графика платежей:
- Месяц, год
- Сумма платежа (везде одинаковая, так как платеж аннуитетный)
- Часть суммы, которая идет на погашение процентов
- Часть суммы, которая идет на погашение основного долга
- Остаток долга

Запросы к серверу можно делать моками.

Стек технологий: Vue 2 или 3, компонентная библиотека по желанию, использование TypeScript будет плюсом.

Выполненное тестовое скинуть ссылкой на репозиторий. Обязательно наличие файла README.md с инструкцией по разворачиванию проекта.

