<?php

require "src/Acara.php";
require "includes/config.php";

$acara = new Acara();

$all_events = $acara->showAcara($pdo, $limit = 1, $all = true);

var_dump($all_events);

?>