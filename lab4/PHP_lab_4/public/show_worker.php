<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/lib/request.php';
require_once __DIR__ . '/../src/lib/response.php';
require_once __DIR__ . '/../src/lib/database.php';
require_once __DIR__ . '/../src/lib/views.php';

function handleShowWorker(): void
{
    $branchId = $_GET['branch_id'];
    $postId = $_GET['post_id'];
    if ($postId === "null")
    {
        echo renderView('worker_form_page.php', [
            'worker' => $postId,
            'branch_id' => $branchId
        ]);
        exit();
    }

    if (!is_numeric($postId))
    {
        writeErrorNotFound();
        exit();
    }

    $connection = connectDatabase();
    $postData = findWorkerInDatabase($connection, (int)$postId);
    if (!$postData)
    {
        writeErrorNotFound();
        exit();
    }

    $workerView = [
        'worker_id' => $postData['id'],
        'first_name' => $postData['first_name'],
        'last_name' => $postData['last_name'],
        'middle_name' => $postData['middle_name'],
        'phone_number' => $postData['phone_number'],
        'email' => $postData['email'],
        'gender' => $postData['gender'],
        'job_title' => $postData['job_title'],
        'birthdate' => $postData['birthdate'],
        'hire_date' => $postData['hire_date'],
        'comment' => $postData['comment'],
        'branch_id' => $postData['branch_id']
    ];
    
    echo renderView('worker_form_page.php', [
        'workers' => $workerView,
        'branch_id' => $branchId
    ]);
}

try
{
    if (isRequestHttpMethod(HTTP_METHOD_GET))
    {
        handleShowWorker();
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
