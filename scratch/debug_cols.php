<?php
$mysqli = new mysqli("localhost", "root", "", "aps");
$res = $mysqli->query("DESC trx_kepuasan_pengguna");
$fields = [];
while($row = $res->fetch_assoc()) $fields[] = $row['Field'];
echo implode(", ", $fields);
