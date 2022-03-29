<?php

$data = json_decode(file_get_contents('php://input'));

$response['result'] = mathOperation($data->arg1, $data->arg2, $data->operation) ;

header("Content-type: application/json");
echo json_encode($response);

