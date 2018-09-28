# Parse XML

Консольное приложение на lumen

Приложение разворачивается с помощью Docker (docker-compose up -d --build)

## Команды

``docker-compose exec php-cli php artisan xml:parse /var/www/raspvariant.xml``

Происходит наполнение таблицы StopPoints

``docker-compose exec php-cli php artisan xml:count_events /var/www/raspvariant.xml {num}`` 

Количество рейсов по номеру, где 
* {num} - цифра 

``docker-compose exec php-cli php artisan xml:total_time_events /var/www/raspvariant.xml {num}``

Общее время рейсов по номеру, где 
* {num} - цифра

``docker-compose exec php-cli php artisan xml:stops /var/www/raspvariant.xml {num} {from} {to}``

Таблица остановк по номеру, времени начала/окончания, где 
* {num} - цифра
* {from} - строка, пример '10:00'
* {to} - строка, пример '11:00'