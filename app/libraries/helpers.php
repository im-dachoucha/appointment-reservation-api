<?php

/**
 * @author: dachoucha abderrahmane
 */

function response($data, $method, $code){
    header("Access-Control-Allow-Origin: www.example.com");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: " . $method);
    http_response_code($code);
    echo json_encode($data);
}