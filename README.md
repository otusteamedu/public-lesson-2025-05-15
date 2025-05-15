# Репозиторий для [публичного урока](https://otus.ru/lessons/symfony/#event-5728) по курсу [Symfony Framework](https://otus.ru/lessons/symfony/)

## Инициализация проекта
1. Запустить контейнеры командой `docker-compose up -d`
2. Войти в контейнер командой `docker exec -it php sh`
3. Установить необходимые пакеты командой `composer install`
4. Инициализировать БД командой `php bin/console doctrine:migrations:migrate`
5. Выйти из контейнера

## Проверяем статические переводы
1. Выполняем запрос Get static translation из Postman-коллекции с `message = Hello, world`, видим перевод
2. Выполняем запрос Get static translation из Postman-коллекции с `message = Test message`, видим перевод
3. Выполняем запрос Get static translation из Postman-коллекции с `message = Unknown message`, видим текст без
   перевода
4. Выполняем запрос Get static translation из Postman-коллекции с `message = Hello, name = Вася`, видим
   подстановку имени
5. Выполняем запрос Get static translation из Postman-коллекции с `message = Gender, name = Вася`,
   `gender = male`, видим подстановку имени и глагол в форме мужского рода
6. Выполняем запрос Get static translation из Postman-коллекции с `message = Gender, name = Света`,
   `gender = female`, видим подстановку имени и глагол в форме женского рода
7. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
   `number = 1`, видим подстановку имени и правильную форму числительного
8. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
   `number = 2`, видим подстановку имени и правильную форму числительного
9. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
   `number = 5`, видим подстановку имени и правильную форму числительного
10. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
    `number = 11`, видим подстановку имени и правильную форму числительного
11. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
    `number = 13`, видим подстановку имени и правильную форму числительного
12. Выполняем запрос Get static translation из Postman-коллекции с `message = Number, name = Света`,
    `number = 101`, видим подстановку имени и правильную форму числительного

## Проверяем динамические переводы
1. Выполняем запрос Create translatable message из Postman-коллекции с `locale = en_US`, проверяем, что создалось в БД
2. Выполняем запрос Get translatable message из Postman-коллекции без указания локали, видим корректный ответ
3. Выполняем запрос Get translatable message из Postman-коллекции с локалью `de`, видим пустой ответ
4. Выполняем запрос Get translatable message из Postman-коллекции с локалью `de` и fallback = 1, видим ответ без
   перевода
5. Выполняем запрос Add translation из Postman-коллекции с локалью `locale = en_US`, проверяем, что изменилось в БД
6. Выполняем запрос Add translation из Postman-коллекции с локалью `locale = de`, проверяем, что изменилось в БД
7. Ещё раз выполняем запрос Add translation из Postman-коллекции с локалью `locale = de`, проверяем, что изменилось в БД

Автор: [Михаил Каморин](mailto:m.v.kamorin@gmail.com)
