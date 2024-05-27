<?php
/**
 * @var string|null $errorMessage
 */

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
 * branch_id: int
 * } $worker
 */

 /**
  * (int) $branch_id
  */




?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/navigation_bar.css">
    <link rel="stylesheet" href="/css/add_post_form.css">
</head>
<body>

<div class="form-container">
    <?php if ($worker == "null"): ?>
        <p>Добавьте нового сотрудника</p>
    <?php else: ?>
        <p>Отредактируйте данные сотрудника</p>
    <?php endif; ?>
    <form id="worker-form-add" class="form" action="add_worker.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="branch_id" value="<?php if ($worker == "null"): echo $branch_id; else: echo $worker['branch_id']; endif; ?>">
        <input type="hidden" name="id" value="<?php if ($worker == "null"): echo "null"; else: echo $worker['worker_id']; endif; ?>">
        <div class="form-field">
            <label for="branch-form-city-name">Фамилия</label>
            <input type="text" name="last_name" id="branch-form-last-name" placeholder="<?php if ($worker == "null"): echo "null"; else: echo $worker['last_name']; endif;  ?>" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Имя</label>
            <input type="text" name="first_name" id="branch-form-first-name" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Отчество</label>
            <input type="text" name="middle_name" id="branch-form-middle-name" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Дата рождения</label>
            <input type="text" name="birthdate" id="branch-form-middle-name" required maxlength="10"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Должность</label>
            <input type="text" name="job_title" id="branch-form-middle-name" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Номер телефона</label>
            <input type="text" name="phone_number" id="branch-form-middle-name" required maxlength="10"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">email</label>
            <input type="text" name="email" id="branch-form-middle-name" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Пол</label>
            <input type="text" name="gender" id="branch-form-gender" required maxlength="1"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Дата трудоустройства</label>
            <input type="text" name="hire_date" id="branch-form-hire_date" required maxlength="10"/>
        </div>
        <div class="form-field">
            <label for="branch-form-city-name">Комментарий</label>
            <input type="text" name="comment" id="branch-form-comment" required maxlength="400"/>
        </div>
        <div class="form-field form-field-full-width">
        <?php if ($worker == "null"): ?>
            <button type="submit">Добавить сотрудника</button>
        <?php else: ?>
            <button type="submit">Обновить данные сотрудника</button>
        <?php endif; ?>
        </div>
    </form>
</div>
</body>
</html>
