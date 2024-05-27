<?php
declare(strict_types=1);

require_once __DIR__ . '/paths.php';

const DATABASE_CONFIG_NAME = 'roadsandpotholes.db.ini';


function connectDatabase(): PDO
{
    $configPath = getConfigPath(DATABASE_CONFIG_NAME);
    if (!file_exists($configPath))
    {
        throw new RuntimeException("Could not find database configuration at '$configPath'");
    }
    $config = parse_ini_file($configPath);
    if (!$config)
    {
        throw new RuntimeException("Failed to parse database configuration from '$configPath'");
    }

    // Проверяем наличие всех ключей конфигурации.
    $expectedKeys = ['dsn', 'user', 'password'];
    $missingKeys = array_diff($expectedKeys, array_keys($config));
    if ($missingKeys)
    {
        throw new RuntimeException('Wrong database configuration: missing options ' . implode(' ', $missingKeys));
    }

    return new PDO($config['dsn'], $config['user'], $config['password']);
}


function getListBranchesFromDatabase(PDO $connection): array
{
    // NOTE: запрос выводит все данные о филиалах и количестве работников в филиале
    $query = <<<SQL
        SELECT
            b.id,
            b.city,
            b.street,
            b.house_number,
            (SELECT COUNT(w.id)
            FROM worker w
            WHERE w.branch_id = b.id) AS quantity_workers
        FROM branch b
        ORDER BY b.id DESC
    SQL;

    return $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function saveBranchToDatabase(PDO $connection, array $postData): int
{
    $query = <<<SQL
        INSERT INTO branch
            (city, street, house_number)
        VALUES
            (:city_name, :street_name, :house_name)
        SQL;

    $statement = $connection->prepare($query);
    $statement->execute([
        ':city_name' => $postData['city_name'],
        ':street_name' => $postData['street_name'],
        ':house_name' => $postData['house_name']
    ]);

    return (int)$connection->lastInsertId();
}


function delBranchToDatabase(PDO $connection, array $postData): int
{
    $query = <<<SQL
            DELETE FROM branch
            WHERE branch.id = (:id);
        SQL;

    $statement = $connection->prepare($query);
    $statement->execute([
        ':id' => $postData['id']
    ]);

    return (int)$connection->lastInsertId();
}

function findWorkersInDatabase(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT
            w.*
        FROM worker w
        WHERE w.branch_id = $id
        ORDER BY w.id DESC;
        SQL;

        return $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function findBranchInDatabase(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT
            b.id AS branch_id,
            b.city AS branch_city,
            b.street AS branch_street,
            b.house_number AS branch_house_number,
            (SELECT COUNT(w.id)
            FROM worker w
            WHERE w.branch_id = $id) AS quantity_workers
        FROM branch b
        WHERE b.id = $id;
        SQL;

        return $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function findWorkerInDatabase(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT
            w.*
        FROM worker w
        WHERE w.id = $id
        SQL;

    return $connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
}