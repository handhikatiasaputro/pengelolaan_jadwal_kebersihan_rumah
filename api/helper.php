<?php

function response($data, $code)
{
    http_response_code($code);
    header('Content-Type: application/json');
    return json_encode($data);
}