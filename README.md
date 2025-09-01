## Установка и запуск

### 1. Клонирование проекта

```bash
git clone <repository-url>
cd OnlyD
```

### 2. Установка зависимостей

```bash
composer install
```

### 3. Настройка окружения

Скопируйте файл окружения:

```bash
cp .env.example .env
```

### 4. Генерация ключа приложения

```bash
php artisan key:generate
```

### 5. Настройка базы данных

#### Вариант 1: Использование Docker

В проекте уже есть готовый файл `docker-compose.yaml`. Запустите базу данных:

```bash
docker-compose up -d
```

Обновите настройки в `.env`:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=onlyd
DB_USERNAME=user
DB_PASSWORD=password
```

#### Вариант 2: Локальная установка PostgreSQL

Создайте базу данных PostgreSQL:

```sql
CREATE DATABASE car_booking;
```

Выполните миграции:

```bash
php artisan migrate
```

### 6. Заполнение тестовыми данными

```bash
php artisan db:seed
```

### 7. Запуск сервера

```bash
php artisan serve
```

Приложение будет доступно по адресу: http://localhost:8000

## Структура базы данных

### Основные таблицы:

- `employees` - Сотрудники
- `positions` - Должности сотрудников
- `comfort_categories` - Категории комфорта автомобилей
- `car_models` - Модели автомобилей
- `cars` - Автомобили
- `drivers` - Водители
- `reservations` - Бронирования
- `comfort_categories_positions` - Связь должностей с доступными категориями комфорта

## API Документация

### Получение доступных автомобилей

**Эндпоинт:** `GET /api/cars`

**Параметры запроса:**
- `employee_id` (обязательный) - ID сотрудника
- `starts_at` (обязательный) - время начала (Y-m-d H:i:s)
- `finishes_at` (обязательный) - время окончания (Y-m-d H:i:s)
- `comfort_category_id` (опциональный) - ID категории комфорта (можно несколько через запятую)
- `car_model_id` (опциональный) - ID модели автомобиля (можно несколько через запятую)

**Пример запроса:**
```bash
curl "http://localhost:8000/api/cars?employee_id=1&starts_at=2025-09-02%2009:00:00&finishes_at=2025-09-02%2017:00:00&comfort_category_id=1,2"
```

**Пример ответа:**
```json
{
  "data": [
    {
      "id": 4,
      "registration_number": "а123бв",
      "car_model_id": 1,
      "driver_id": 1,
      "car_model": {
        "id": 1,
        "name": "Renault Logan",
        "comfort_category_id": 1,
        "comfort_category": {
            "id": 1,
            "name": "Economy",
            "created_at": "2025-08-31T13:14:02.000000Z",
            "updated_at": "2025-08-31T13:14:02.000000Z"
        }
      },
        "driver": {
            "id": 1,
            "full_name": "Prof. Meda Mraz V",
            "created_at": "2025-08-31T13:14:02.000000Z",
            "updated_at": "2025-08-31T13:14:02.000000Z"
        }
    }
  ],
  "count": 1,
  }
}
```
### Примеры использования API

#### 1. Получить все доступные автомобили для сотрудника

```bash
curl "http://localhost:8000/api/cars?employee_id=1&starts_at=2025-09-02%2009:00:00&finishes_at=2025-09-02%2017:00:00"
```

#### 2. Фильтрация по категории комфорта

```bash
curl "http://localhost:8000/api/cars?employee_id=1&starts_at=2025-09-02%2009:00:00&finishes_at=2025-09-02%2017:00:00&comfort_category_id=1"
```

#### 3. Фильтрация по модели автомобиля

```bash
curl "http://localhost:8000/api/cars?employee_id=1&starts_at=2025-09-02%2009:00:00&finishes_at=2025-09-02%2017:00:00&car_model_id=1,2"
```

#### 4. Комбинированная фильтрация

```bash
curl "http://localhost:8000/api/cars?employee_id=1&starts_at=2025-09-02%2009:00:00&finishes_at=2025-09-02%2017:00:00&comfort_category_id=1,2&car_model_id=1"
```

