**Как запустить?**

Клонируем репозиторий:
`git clone https://github.com/Qerakl/StudentGroups.git`

Переходим в него:
`cd StudentGroups`

Устанавливаем composer:
`composer install`

Меняем файл .env под себя,

Устанавливаем ключ:
`php artisan key:generate`

Проверяем настройки файла .env.testing и меняем под себя,
Создаем Бд с названием laravel-student-test,

Выполняем миграции с автозаполнением:
`php artisan migrate --seed`

Запускаем тесты:
`php artisan test`

Запускаем сервер:
`php artisan serve`

**Как тестировать:**
тестировать данное приложение рекомендуется через Postmen

**Маршруты**

| Route                     | HTTP Method | Description                                  |
| ------------------------- | ----------- | -------------------------------------------- |
| /student                  | GET         | Получить список всех студентов               |
| /student                  | POST        | Создать нового студента                      |
| /student/{student}        | GET         | Получить данные конкретного студента         |
| /student/{student}        | PUT         | Обновить данные конкретного студента         |
| /student/{student}        | DELETE      | Удалить конкретного студента                 |
| /group                    | GET         | Получить список всех групп                   |
| /group                    | POST        | Создать новую группу                         |
| /group/{group}            | GET         | Получить данные конкретной группы            |
| /group/{group}            | PUT         | Обновить данные конкретной группы            |
| /group/{group}            | DELETE      | Удалить конкретную группу                    |
| /subject                  | GET         | Получить список всех предметов               |
| /subject                  | POST        | Создать новый предмет                        |
| /subject/{subject}        | GET         | Получить данные конкретного предмета         |
| /subject/{subject}        | PUT         | Обновить данные конкретного предмета         |
| /subject/{subject}        | DELETE      | Удалить конкретный предмет                   |
| /journal                  | GET         | Получить список всех записей журнала         |
| /journal                  | POST        | Создать новую запись в журнале               |
| /journal/group/{group}    | GET         | Получить журнал для группы по всем предметам |
| /journal/{studentSubject} | PUT         | Обновить оценку в журнале                    |
| /journal/{studentSubject} | DELETE      | Удалить запись из журнала                    |

