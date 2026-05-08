<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$res = $mysqli->query("SHOW COLUMNS FROM trx_masa_studi");
while ($row = $res->fetch_assoc()) {
    print_r($row);
}
