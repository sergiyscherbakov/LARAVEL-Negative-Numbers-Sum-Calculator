# Negative Numbers Sum Calculator

Веб-додаток для обчислення суми від'ємних елементів з масиву чисел. Реалізовано повноцінний CRUD-функціонал для керування числовими даними з можливістю додавання, редагування та видалення елементів через зручний графічний інтерфейс. Система автоматично обчислює та відображає суму всіх від'ємних чисел у режимі реального часу.

## Використані технології

- **Backend:** Laravel Framework v12.x (PHP 8.2+)
- **Database:** PostgreSQL v17.6
- **Frontend:** Bootstrap v5.3, Blade Templates
- **Server:** PHP Built-in Development Server
- **Additional:** Composer (dependency management), Eloquent ORM

## Встановлення Composer та Laravel

### Встановлення Composer

Composer - це менеджер залежностей для PHP, необхідний для роботи з Laravel.

#### Windows

1. Завантажте інсталятор Composer з офіційного сайту:
   ```
   https://getcomposer.org/Composer-Setup.exe
   ```

2. Запустіть інсталятор та слідуйте інструкціям
3. Переконайтеся, що шлях до PHP вказаний правильно (наприклад, `C:\xampp\php\php.exe`)
4. Після встановлення перевірте версію:
   ```bash
   composer --version
   ```

#### Linux/macOS

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### Встановлення Laravel

Laravel встановлюється через Composer. Після встановлення Composer ви можете:

1. **Встановити Laravel Installer глобально:**
   ```bash
   composer global require laravel/installer
   ```

2. **Створити новий Laravel проект:**
   ```bash
   laravel new назва-проекту
   ```

3. **Або створити проект через Composer:**
   ```bash
   composer create-project laravel/laravel назва-проекту
   ```

## Залежності проекту

### Основні залежності (Production)

Визначені в `composer.json` секції `require`:

- **PHP:** `^8.2` - Мінімальна версія PHP 8.2
- **laravel/framework:** `^12.0` - Головний фреймворк Laravel версії 12.x
- **laravel/tinker:** `^2.10.1` - Інтерактивна консоль REPL для Laravel

### Залежності для розробки (Development)

Визначені в `composer.json` секції `require-dev`:

- **fakerphp/faker:** `^1.23` - Генератор фейкових даних для тестування
- **laravel/pail:** `^1.2.2` - Інструмент для перегляду логів у реальному часі
- **laravel/pint:** `^1.24` - Інструмент для форматування PHP коду
- **laravel/sail:** `^1.41` - Docker-середовище для Laravel
- **mockery/mockery:** `^1.6` - Бібліотека для створення mock-об'єктів у тестах
- **nunomaduro/collision:** `^8.6` - Красивий обробник помилок для командного рядка
- **phpunit/phpunit:** `^11.5.3` - Фреймворк для unit-тестування

### PHP Розширення

Для роботи з PostgreSQL необхідні розширення:

- `pdo` - PHP Data Objects
- `pdo_pgsql` - PDO драйвер для PostgreSQL
- `pgsql` - PostgreSQL функції

### Команди Composer для встановлення залежностей

```bash
# Встановлення всіх залежностей (production + development)
composer install

# Встановлення тільки production залежностей
composer install --no-dev

# Оновлення всіх залежностей
composer update

# Оновлення конкретного пакета
composer update laravel/framework

# Перегляд списку встановлених пакетів
composer show

# Перегляд outdated пакетів
composer outdated
```

## Встановлення та налаштування

### Вимоги

- PHP 8.2 або вище
- Composer
- PostgreSQL 17.6
- Розширення PHP: PDO, pdo_pgsql, pgsql

### Крок 1: Клонування проекту

```bash
cd C:\Users\Сергей\Documents\2025\Аспірантура ЗНТУ 124\Laravel\negative-sum-calculator
```

### Крок 2: Встановлення залежностей

```bash
composer install
```

### Крок 3: Налаштування бази даних

1. Переконайтеся, що PostgreSQL запущено
2. Файл `.env` вже налаштовано з наступними параметрами:

```env
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=negative_sum_db
DB_USERNAME=postgres
DB_PASSWORD=1234
```

### Крок 4: Увімкнення PostgreSQL розширень в PHP

Відредагуйте файл `C:\xampp\php\php.ini` та розкоментуйте:

```ini
extension=pdo_pgsql
extension=pgsql
```

### Крок 5: Запуск міграцій

```bash
php artisan migrate
```

### Крок 6: Запуск локального сервера

```bash
php artisan serve
```

Додаток буде доступний за адресою: `http://127.0.0.1:8000`

## Робота з базою даних через командний рядок

### Підключення до PostgreSQL

```bash
psql -U postgres
```

Пароль: `1234`

### Перегляд бази даних

```sql
-- Підключення до бази даних
\c negative_sum_db

-- Перегляд всіх таблиць
\dt

-- Перегляд структури таблиці numbers
\d numbers

-- Перегляд всіх записів
SELECT * FROM numbers;

-- Перегляд суми від'ємних чисел
SELECT SUM(value) as negative_sum FROM numbers WHERE value < 0;

-- Вихід з psql
\q
```

## Функціональність

1. **Перегляд списку чисел** - відображення всіх доданих чисел з автоматичним обчисленням суми від'ємних елементів
2. **Додавання числа** - можливість додати нове число (додатне або від'ємне)
3. **Редагування числа** - зміна значення існуючого числа
4. **Перегляд деталей** - детальна інформація про конкретне число
5. **Видалення числа** - видалення числа з бази даних
6. **Валідація даних** - перевірка введених даних на стороні сервера

## Структура проекту

```
negative-sum-calculator/
├── app/
│   ├── Http/Controllers/
│   │   └── NumberController.php      # Контролер для роботи з числами
│   └── Models/
│       └── Number.php                 # Модель для таблиці numbers
├── database/
│   └── migrations/
│       └── 2025_10_24_070032_create_numbers_table.php  # Міграція БД
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          # Головний шаблон
│       └── numbers/
│           ├── index.blade.php        # Список чисел
│           ├── create.blade.php       # Форма створення
│           ├── edit.blade.php         # Форма редагування
│           └── show.blade.php         # Перегляд деталей
├── routes/
│   └── web.php                        # Маршрути додатку
└── .env                               # Конфігурація оточення
```

## Маршрути

| Метод | URI | Дія | Опис |
|-------|-----|-----|------|
| GET | `/` | index | Головна сторінка зі списком чисел |
| GET | `/numbers` | index | Список всіх чисел |
| GET | `/numbers/create` | create | Форма для додавання числа |
| POST | `/numbers` | store | Збереження нового числа |
| GET | `/numbers/{number}` | show | Перегляд конкретного числа |
| GET | `/numbers/{number}/edit` | edit | Форма редагування числа |
| PUT/PATCH | `/numbers/{number}` | update | Оновлення числа |
| DELETE | `/numbers/{number}` | destroy | Видалення числа |

## Скріншоти

Додаток має адаптивний дизайн на основі Bootstrap 5.3 з наступними сторінками:
- Головна сторінка зі списком чисел та відображенням суми від'ємних елементів
- Форма додавання нового числа
- Форма редагування існуючого числа
- Сторінка перегляду деталей числа

## Автор

Проект створено як навчальне завдання для демонстрації роботи з Laravel, PostgreSQL та Bootstrap.

## Ліцензія

Цей проект є навчальним та розповсюджується під ліцензією MIT.


## Автор

**Розробник:** Сергій Щербаков
**Email:** sergiyscherbakov@ukr.net
**Telegram:** @s_help_2010
