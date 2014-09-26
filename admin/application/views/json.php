<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
echo json_encode($json);
//print_r($json);
?>