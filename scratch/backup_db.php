<?php
/**
 * Script untuk backup database 'aps' menggunakan CodeIgniter Database Utility
 */
define('BASEPATH', 'dummy');
define('ENVIRONMENT', 'development');
require_once 'application/config/database.php';

$dsn = "mysql:host=" . $db['default']['hostname'] . ";dbname=" . $db['default']['database'];
try {
    $pdo = new PDO($dsn, $db['default']['username'], $db['default']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tables = [];
    $result = $pdo->query("SHOW TABLES");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    $sql = "-- Database Backup: " . $db['default']['database'] . "\n";
    $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        // Create table
        $res = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
        $sql .= "\n\n" . $res['Create Table'] . ";\n\n";

        // Get data
        $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $keys = array_map(function($k) { return "`$k`"; }, array_keys($row));
            $vals = array_map(function($v) use ($pdo) { 
                if ($v === null) return "NULL";
                return $pdo->quote($v); 
            }, array_values($row));
            $sql .= "INSERT INTO `$table` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $vals) . ");\n";
        }
    }

    file_put_contents('database/db_backup_' . date('Ymd_His') . '.sql', $sql);
    echo "Backup success: database/db_backup_" . date('Ymd_His') . ".sql";

} catch (PDOException $e) {
    echo "Backup failed: " . $e->getMessage();
}
