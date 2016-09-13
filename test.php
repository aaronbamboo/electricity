<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'includes/Modal.class.php';
header('Content-Type:text/html;Charset=utf-8');  ?>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <title><?= PAGE_SYSTEM_NAME ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Le styles -->
        <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
<!--        <script src="./bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>-->
        <script src="./bootstrap/js/bootstrap.min.js"></script>

<?php
$m = new M();
$m->execSQL("INSERT INTO ctc_projectinfo (project_name, project_aera) VALUES ('诸暨城关东一路北', '诸暨市')");
echo $m->Total('ctc_projectinfo');

$data = $m->getAll('ctc_projectinfo', "project_id,project_name,project_aera", "project_name like '%诸暨%'");
foreach($data as $row) {
    echo $row['project_id'] . ";" . $row['project_name'] . ";" . $row['project_aera'] . "<br>";
}
?>
