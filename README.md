# Тестовый проект

Приложение содержит страницу товаров с возможностью покупки в двух валютах (рубли и тенге). Создано с использованием фреймворков [Laravel](https://laravel.com/), [Vue](https://vuejs.org/). Настроен CRON для получения [данных](https://nationalbank.kz/rss/rates_all.xml) из Национального банка РК. Интегрирован сервис платежей [CloudPayments](https://cloudpayments.ru/) в тестовом режиме. В качестве СУБД во время разработки использовался SQLite, однако при деплое возможно использовать любую другую. 

### Требования к серверу
- PHP версии **8.0** и выше
- [Composer](https://getcomposer.org/) и [NPM](https://www.npmjs.com/) последней версии (разработка велась именно на них).
- Модуль PHP для работы с СУБД
- [Все требования](https://laravel.com/docs/8.x/deployment#server-requirements), которые необходимы для работы фреймворка Laravel 

### Порядок развертывания приложения
- Скачать исходный код из [этого]() репозитория.
- Установить зависимости используя Composer и NPM, выполнив команду:
  ```bash
  composer i --no-dev && npm i --only=prod
  ```
- Скопировать в проекте файл `.env.example` и переименовать в `.env`
- Сгенерировать ключ приложения выполнив команду:
  ```bash
  php artisan key:generate
  ```
- Создать базу данных в выбранной СУБД:
  - SQLite - создать базу любым известным способом (например используя утилиту `sqlite3` или просто создав файл с расширением `.sqlite`). Подключить ее в файле `.env`:
    ```dotenv
    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/database.sqlite
    DB_FOREIGN_KEYS=true
    ```
  - PostgreSQL, MySQL - создать базу, установить пользователя и роль для него, Подключить в файле `.env`:
    ```dotenv
    DB_CONNECTION=mysql # или нужный драйвер
    DB_HOST=local # или необходимый где расположена база
    DB_PORT=3306
    DB_DATABASE=rocket # имя базы
    DB_USERNAME=admin # имя пользователя
    DB_PASSWORD=password # пароль пользователя
    ```
- Выполнить миграции базы данных с использованием начальных записей
    ```bash
  php artisan migrate:fresh --seed
    ```
- Значение `APP_DEBUG` в файле `.env` установить в `false`
- Установить верное значение `APP_URL` в `.env`
- Запустить CRON. Есть два пути:
  - Простой, выполнив команду на сервере:
    ```bash
    php artisan schedule:work
    ```
    В этом случае запись для CRON создавать нет необходимости, так в Laravel 8 при запуске этой команды запланированные задачи будут выполняться в фоне, пока команда не будет остановлена.
  - Старый, но все еще актуальный. Выполнить команду:
    ```bash
    crontab -e
    ```
    и прописать следующую команду, изменив путь в корень проекта:
    ```bash
    * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
    ```
- Установить права серверу на файлы проекта:
    ```bash
  sudo chown -R www-data:www-data /path/to/your/project
  sudo usermod -a -G www-data ubuntu
  sudo find /path/to/your/project -type f -exec chmod 644 {} \;  
  sudo find /path/to/your/project -type d -exec chmod 755 {} \;
  sudo chgrp -R www-data /path/to/your/project/storage /path/to/your/project/bootstrap/cache
  sudo chmod -R ug+rwx /path/to/your/project/storage /path/to/your/project/bootstrap/cache
    ```

