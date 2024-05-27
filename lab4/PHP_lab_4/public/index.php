<?php
declare(strict_types=1);
// . В начале файла подключаются необходимые библиотеки: request.php, response.php, database.php и views.php.

require_once __DIR__ . '/../src/lib/request.php';
require_once __DIR__ . '/../src/lib/response.php';
require_once __DIR__ . '/../src/lib/database.php';
require_once __DIR__ . '/../src/lib/views.php';

/* Определена функция handleShowPost(), которая выполняет следующие действия:*/
function handleShowBranchs(): void
{
    //- Устанавливает соединение с базой данных с помощью функции connectDatabase().
    $connection = connectDatabase();
    // - Получим список филиалов
    $posts = getListBranchesFromDatabase($connection);

    $postViews = [];

    foreach ($posts as $postData)
    {

        $postViews[] = [
            'id' => $postData['id'],
            'city' => $postData['city'],
            'street' => $postData['street'],
            'house_number' => $postData['house_number'],
            'quantity_workers' => $postData['quantity_workers']
        ];
    }
// Вызывает функцию renderView('posts_feed_page.php', ['posts' => $postViews]) 
// для отображения ленты публикаций, передавая массив представлений публикаций $postViews.*/
    echo renderView('list_branches.php', [
        'branches' => $postViews
    ]);
}

try
{
    if (isRequestHttpMethod(HTTP_METHOD_GET))
    {
        handleShowBranchs();
    }
    else
    {
        writeRedirectSeeOther($_SERVER['REQUEST_URI']);
    }
}
catch (Throwable $ex)
{
    error_log((string)$ex);
    writeInternalError();
}
