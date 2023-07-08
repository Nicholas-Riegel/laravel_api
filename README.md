1. To make the posts model:
php artisan make:model Post -mcr (migrate, controller, resource)

2. php artisan migrate

3. in api.php
Route::resource('posts',PostController::class);