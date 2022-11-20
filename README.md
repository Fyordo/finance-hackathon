# Mobyte SCBChallenge API

### _CI Status:_ ![Unit-testing](https://github.com/Fyordo/finance-hackathon/actions/workflows/laravel.yml/badge.svg)
### Хостинг: http://mobytescbteamchallenge.herokuapp.com/
### Документация к АПИ: `config/Finance.postman_collection.json`

## Стек технологий

<br>
<br>
<p align="center">
    <a href="https://php.net" target="_blank">
        <img src="https://www.php.net/images/logos/php-logo-white.svg" width="200" title="hover text" alt="">
    </a>
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p><br>
<p align="center">
    <a href="https://hub.docker.com/" target="_blank">
        <img src="https://www.svgrepo.com/show/349342/docker.svg" width="200" title="hover text" alt="">
    </a>
</p><br>
<p align="center">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Postgresql_elephant.svg/993px-Postgresql_elephant.svg.png" width="200" title="hover text" alt="">
    <img src="https://cdn0.iconfinder.com/data/icons/ui-16px-perfect-megapack-line/16/82_Add-512.png" width="100" title="hover text" alt="">
    <img src="https://cdn4.iconfinder.com/data/icons/redis-2/1451/Untitled-2-512.png" width="200" title="hover text" alt="">
</p><br>

## Развёртывание

#### _Не забудьте перед запуском заполнить .env файл (пример структуры указан в файле `.env.example`)_

### Сервисы приложения
- **NGINX** (Работает на порту **8099**)
- **PHP-FRM** (С установленным `composer` и нужными `extentions`)
- **PostgreSQL DB** (Работает на порту, указанном в файле окружения `.env`)
- **Redis**

### **Через Makefile**
```
make up
```

### **Через Docker-Compose**
```
docker-compose up -d --build
docker exec -it ${APP_NAME}-nginx bash
chmod -R guo+w /var/www/storage
```

#### _При ошибке запуска контейнера NGINX повторить команду или запустить контейнер вручную_

## Свёртывание

### **Через Makefile**
```
make down
```

### **Через Docker-Compose**
```
docker-compose down
```

## Дополнительные репозитории
### [Сайт модератора (администратора)](https://github.com/akmalova/mobyte_scbteamchallenge_admin)
### [Основное мобильное приложение](https://github.com/MobyteDev/mobyte_scbteamchallenge)

## Основной функционал
- Ролевая модель (пользователь и администратор приложения, необходимы интерфейсы для каждой роли)
- Функционал регистрации новых пользователей (в рамках процесса регистрации создается первый рублевый счет для торговли)
- Функционал для блокировки/разблокировки пользователей
- Функционал для пополнения и выведения средств с рублевого счета
- Функционал открытия нового счета для проведения операций над выбранной пользователем валютой
- Отображение сводной информации по имеющимся в портфеле пользователя активам. Состав представленной информации должен быть обоснован
- Отображение исторической информации о движении валюты (отчет по сделанным операциям)
- Отображение общей информации о пользователе приложения в удобном и понятном для пользователя виде (профиль текущего пользователя), в т.ч., и информация о реквизитах счетов, с которых совершаются операции над валютами
- Функционал торговли, возможность покупать и продавать валюту по рыночному курсу (курс из внешнего источника)

## Дополнительный функционал
- Команда `make console` для попадание в консоль сервиса php-fpm
- Команда `make crud model=НазваниеМодели` для оперативного создания CRUD-структуры модели
- Настроено CI\CD с автоматическим тестированием с помощью Heroku Buildpack и GitHub Actions
- Реализована система персонального доступа к ресурсам базы данных
- Добавлена документация к API с помощью Postman и Swagger OpenAPI

## Лицензия проекта

Проект использует [MIT license](https://opensource.org/licenses/MIT).
