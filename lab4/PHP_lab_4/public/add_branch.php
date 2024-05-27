<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/lib/request.php';
require_once __DIR__ . '/../src/lib/response.php';
require_once __DIR__ . '/../src/lib/database.php';
require_once __DIR__ . '/../src/lib/uploads.php';
require_once __DIR__ . '/../src/lib/views.php';

const SHOW_POST_URL = '/index.php';
const POST_ID_PARAM = 'id';

function showAddPostForm(?string $errorMessage = null): void
{
    echo renderView('index.php', [
        'errorMessage' => $errorMessage
    ]);
}

function handleAddBranch(): void
{
    // Разбор параметров формы

    $cityName = $_POST['branch-city'] ?? null;
    $streetName = $_POST['branch-street'] ?? null;
    $houseName = $_POST['branch-house'] ?? null;
    if (!$cityName || !$streetName || !$houseName)
    {
        showAddPostForm(errorMessage: 'Все поля обязательны для заполнения');
        http_response_code(HTTP_STATUS_400_BAD_REQUEST);
        return;
    }

    $connection = connectDatabase();

    $postId = saveBranchToDatabase($connection, [
        'city_name' => $cityName,
        'street_name' => $streetName,
        'house_name' => $houseName
    ]);

    $postUrl = SHOW_POST_URL;
    writeRedirectSeeOther($postUrl);
}


try
{
    if (isRequestHttpMethod(HTTP_METHOD_GET))
    {
        showAddPostForm();
    }
    elseif (isRequestHttpMethod(HTTP_METHOD_POST))
    {
        handleAddBranch();
    }
    else
    {
        writeRedirectSeeOther('/');
    }
}
catch (Throwable $ex)
{
    error_log((string)$ex);
    writeInternalError();
}
