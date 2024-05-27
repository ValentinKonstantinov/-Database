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

function handleDelBranch(): void
{
    // Разбор параметров формы
    $id_branch = $_GET['value'] ?? null;

    if (!$id_branch)
    {
        showAddPostForm(errorMessage: 'нет id филиала');
        http_response_code(HTTP_STATUS_400_BAD_REQUEST);
        return;
    }
    $connection = connectDatabase();

    $postId = delBranchToDatabase($connection, [
        'id' => $id_branch
    ]);

    $postUrl = SHOW_POST_URL;
    writeRedirectSeeOther($postUrl);
}


try
{
    if (isRequestHttpMethod(HTTP_METHOD_GET))
    {
        handleDelBranch();
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
