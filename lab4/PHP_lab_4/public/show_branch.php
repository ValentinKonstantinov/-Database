<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/lib/request.php';
require_once __DIR__ . '/../src/lib/response.php';
require_once __DIR__ . '/../src/lib/database.php';
require_once __DIR__ . '/../src/lib/views.php';

function handleShowBranch(): void
{
    $brachId = $_GET['post_id'];
    if (!is_numeric($brachId))
    {
        writeErrorNotFound();
        exit();
    }

    $connection = connectDatabase();

    $branchData = findBranchInDatabase($connection, (int)$brachId);
    $workers = findWorkersInDatabase($connection, (int)$brachId);
    if (!$branchData)
    {
        writeErrorNotFound();
        exit();
    }
    foreach ($branchData as $data)
    {
        $branchViews = [
            'id_branch' => $data['branch_id'],
            'branch_city' => $data['branch_city'],
            'branch_street' => $data['branch_street'],
            'branch_house_number' => $data['branch_house_number'],
            'quantity_workers' => $data['quantity_workers']
        ];
    };



    $workersViews = [];
    foreach ($workers as $worcersData)
    {

        $workersViews[] = [
            'worker_id' => $worcersData['id'],
            'first_name' => $worcersData['first_name'],
            'last_name' => $worcersData['last_name'],
            'middle_name' => $worcersData['middle_name'],
            'phone_number' => $worcersData['phone_number'],
            'email' => $worcersData['email'],
            'gender' => $worcersData['gender'],
            'job_title' => $worcersData['job_title'],
            'birthdate' => $worcersData['birthdate'],
            'hire_date' => $worcersData['hire_date'],
            'comment' => $worcersData['comment']
        ];
    }




    echo renderView('branch_page.php', [
        'workers' => $workersViews,
        'branch' => $branchViews
    ]);
}

try
{
    if (isRequestHttpMethod(HTTP_METHOD_GET))
    {
        handleShowBranch();
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
