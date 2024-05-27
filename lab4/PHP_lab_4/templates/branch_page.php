<?php
/**
 * @var array{
 * worker_id: int,
 * first_name: string,
 * last_name: string,
 * middle_name: string,
 * phone_number: string,
 * email: string,
 * gender: "M"|"W",
 * job_title: string,
 * birthdate: DateTimeImmutable,
 * hire_date: DateTimeImmutable,
 * comment: string,
 * }[] $workers
 */

 /**
 * @var array{
 * id_branch: int,
 * branch_city: string,
 * branch_street: string,
 * branch_house_number: string,
 * quantity_workers: string,
 * }$branch
 */   
 

/**

 * @return string
 */

 function getworkerPageUrl($branch, $workerId): string
 {
     if (!is_int($workerId) && $workerId !== null) {
         // Обработка ошибки, когда $workerId не является целочисленным типом
         return '';
     }
     if ($workerId === null) {
        return "/show_worker.php?branch_id={$branch['id_branch']}&post_id=null";
    }
 
     return "/show_worker.php?branch_id={$branch['id_branch']}&post_id=$workerId";
 }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/list_branches.css">
</head>
<body>
    <div>
        <p> филиал</p>
        <div>
            <?php "г. " . htmlentities($branch['branch_city']) . " ул. " 
            . htmlentities($branch['branch_street']) . " д. " 
            . htmlentities($branch['branch_house_number']) . " " 
            . htmlentities($branch['quantity_workers']) . " работников"?>
        </div>
    </div>

        <a href="<?= getworkerPageUrl($branch, null) ?>">Добавить работника</a>

    <div>

        <table border="1">
            <caption>Работники</caption>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th></th>
            </tr>
            <?php foreach ($workers as $worker): ?>
                <?php if  (!empty($worcer['first_name'])): ?>
                    <tr>
                        <td>
                            <a href="<?= getworkerPageUrl($branch, $worker['worker_id']) ?>">
                                <?= htmlentities($worker['first_name']) ?>
                            </a>
                        </td>
                        <td><?= htmlentities($worker['last_name']) ?></td>
                        <td><?= htmlentities($worker['middle_name']) ?></td>
                        <td>
                            <a href="del_worker.php?value=<?=$worker['worker_id']?>" class="btn">Удалить работника</a>
                        </td>
                        <td></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
</body>
</html>
