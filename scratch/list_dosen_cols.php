<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$res = $mysqli->query("SHOW COLUMNS FROM master_dosen");
while ($row = $res->fetch_assoc()) {
    print_r($row);
}
