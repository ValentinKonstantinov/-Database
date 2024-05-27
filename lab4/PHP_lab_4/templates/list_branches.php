<?php
/**
 * @var array{
 *   id: int,
 *   city: string,
 *   street: string,
 *   house_number: string,
 *   quantity_workers: int,
 * }[] $branches
 */

/**
 * @param int $branchId
 * @return string
 */
function getBranchPageUrl(int $branchId): string
{
    return "/show_branch.php?post_id=$branchId";
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
        <p>Список всех филиалов</p>
    </div>
    <div>
    <form id="branch-form-add" class="form" action="add_branch.php" method="post" enctype="multipart/form-data">
        <div class="form-field">
            <label for="branch-form-city-name">Введите город</label>
            <input type="text" name="branch-city" id="branch-form-city-name" required maxlength="40"/>
        </div>
        <div class="form-field">
            <label for="branch-form-street-name">Введите улицу</label>
            <input type="text" name="branch-street" id="branch-form-street-name" required maxlength="100"/>
        </div>
        <div class="form-field">
            <label for="branch-form-house-name">Введите номер дома</label>
            <input type="text" name="branch-house" id="branch-form-house-name" required maxlength="40"/>
        </div>
        <?php if (isset($errorMessage)): ?>
            <div class="form-field form-field-full-width">
                <p class="form-error"><?= $errorMessage ?></p>
            </div>
        <?php endif; ?>

        <div class="form-field form-field-full-width">
            <button type="submit">Добавить филиал</button>
        </div>
    </form>

    </div>

    <table border="1">
    <caption>Филиалы</caption>
    <thead>
        <tr>
            <th>Город</th>
            <th>Улица</th>
            <th>Номер дома</th>
            <th>Количество сотрудников</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($branches as $branch): ?>
            <?php if (!empty($branch['id'])): ?>
                <tr>
                    <td>
                        <a href="<?= getBranchPageUrl($branch['id']) ?>" class="table-row-link">
                            <?= htmlentities($branch['city']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= getBranchPageUrl($branch['id']) ?>" class="table-row-link">
                            <?= htmlentities($branch['street']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= getBranchPageUrl($branch['id']) ?>" class="table-row-link">
                            <?= htmlentities($branch['house_number']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= getBranchPageUrl($branch['id']) ?>" class="table-row-link">
                            <?= htmlentities($branch['quantity_workers']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="del_branch.php?value=<?= $branch['id'] ?>" class="btn">Удалить филиал</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>


</body>
</html>
