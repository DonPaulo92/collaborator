# Тестове

REST API на Yii2 для обчислення суми парних чисел з масиву.

## Встановлення

Швидко встановити
```bash
make reinstall
```
Поетапно
1. Cбудуйте Docker образ:
```bash
make build
```

1. Запустіть контейнери:
```bash
make up
```

3. Встановіть залежності:
```bash
make install
```

## Використання

### API Endpoint

**POST** `/api/sum-even`

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
    "numbers": [1, 2, 3, 4, 5, 6]
}
```

**Response:**
```json
{
    "sum": 12
}
```

### Приклади запитів

#### Успішний запит:
```bash
curl -X POST http://localhost:8000/api/sum-even \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, 6]}'
```

#### Запит з помилкою:
```bash
curl -X POST http://localhost:8000/api/sum-even \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, "6"]}'
```

**Відповідь з помилкою:**
```json
{
    "status": "error",
    "errors": {
        "numbers": ["Each number must be a strict integer."]
    },
    "code": 400
}
```

**Відповідь з помилкою:**
```json
{
    "status": "error",
    "errors": {
        "numbers": ["Each number must be a strict integer."]
    },
    "code": 400
}
```

## Архітектура
1. **Контролер** (`SumController`) - обробляє HTTP запити
2. **Форма** (`EventSumForm`) - валідація даних
3. **DTO** (`NumbersDTO`) - передає дані
4. **Сервіс** (`SumService`) - містить бізнес-логіку
4. **Інтерфейс** (`SumServiceInterface`) - інтерфейс для сервісу** 

## Команди Makefile
- `make build` - зібрати Docker образи
- `make up` - запустити контейнери
- `make down` - зупинити контейнери
- `make install` - встановити залежності
- `make reinstall` - встановити залежності знову`
- `make test_group` - тести`
- 
## Команди для тестування
- `make test_group api-sum-controller-action-enum-sum` - тест контроллера
- `make test_group unit-models-even-sum-form` - тест форми
- `make test_group unit-services-sum-service` - тест сервіса

