# XPresent

Проект написан на **Laravel + Inertia** с **PHP 8.3**.  
Для очередей и кеша используется **Redis**, база данных — **MySQL**, веб-сервер — **Nginx**.
Также на фронте используется tailwind.

---

## 🚀 Запуск проекта

1. Клонируем репозиторий и переходим в директорию проекта:

```bash
git clone https://github.com/puuulia/xpresent.git
cd xpresent
```

2. Скопируйте .env файлы:
```
cp .env.example .env
cd docker
cp .env.example .env
```

3. Запустите Docker контейнеры:
```docker compose up -d```

4. Установите зависимости:
```
docker compose exec workspace composer install
docker compose exec workspace npm install
docker compose exec workspace npm run build
```

5. Настройте Laravel:
```
docker compose exec workspace php artisan key:generate
docker compose exec workspace php artisan storage:link
docker compose exec workspace php artisan migrate:fresh --seed
```

6. Запустите очереди с Horizon:
```
docker compose exec workspace php artisan horizon
```

### Для запуска в dev режиме необходимо запустить
```
docker compose exec workspace npm run dev
```

### 🔧 Доступные инструменты

- **Log Viewer:** `/log-viewer`
- **Laravel Telescope:** `/telescope`
- **Laravel Horizon:** `/horizon`

### 🛠 Работа с кодом

- Для **pull request’ов** автоматически запускаются **PHPStan** и **Rector**.
- Все изменения делаются в отдельной ветке, затем мерж в `dev`.

