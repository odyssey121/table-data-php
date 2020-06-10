Простая таблица с записями и поиском + фильтрация (пока не сделана как нужно)

##для тестовой развертки приложения выполнить:

    $ git clone https://github.com/odyssey121/table-data-php.git
    $ cd table-data-php
    $ docker-compose up --build
    $ docker-compose exec php ./vendor/bin/phinx migrate
    $ затем docker-compose exec php ./vendor/bin/phinx seed:run
    $ пересобираем docker-compose up --build 

    
 - Nginx APP : http://localhost:8080


## Автор

[Alexey Shirnin](https://github.com/odyssey121/)
