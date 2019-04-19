# Backend Task

* demo圖片放置於demo-images資料夾

## Build a RESTful-API ecosystem for to-do list with Laravel, PHP 7.2, Nginx, MySQL.

### DB schema fields
`id`, `title`, `content`, `attachment`, `created_at`, `done_at`, `deleted_at`

### Minimum Requirments

1. JSON-API like response and JSON payload or multipart for requests
2. API that modifies data *must* be protected by tokens
3. Tokens can be self-designed or JWT token
4. Design DB schema by your self

### Optional

1. Optimize performance /w some other technologies
2. Create a local dev environment using Docker
3. Tokens with TTL
4. Tokens with RefreshToken

### API List

* get all to-do lists
    /api/tasks
* get one to-do list
    /api/tasks/{id}
* create one to-do list
    /api/tasks
* update one to-do list
    /api/tasks/{id}
* delete one to-do list
    /api/tasks/{id}
* delete all to-do list
    /api/tasks
* generate a new token
* get token status (Only if tokens with TTL or RefreshToken)
* api路徑 

    Verb      | Path              | Action  |Route Name   |
    ----------|:-----------------:|--------:|------------:|
    GET       | /tasks            |  index  |tasks.index  |
    POST      | /tasks            |  store  |tasks.store  |
    GET       | /tasks/{id}       |  show   |tasks.show   |
    PUT/PATCH | /tasks/{id}       |  update |tasks.update |
    DELETE    | /tasks/{id}       |  destroy|tasks.destroy| 

 
### Notice

Please upload your source code to GitHub or other similar service

## 程式執行順序
將程式放置於可以執行laravel 的環境下，並依序照下列步驟做初始設定。
    composer install
    php artisan key:generate
    php artisan make:auth
    php artisan jwt:secret
    php artisan migrate

進入路徑 /register 註冊一個帳號，登入並取得一個有效的token