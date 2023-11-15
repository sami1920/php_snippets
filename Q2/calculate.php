<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parameter1 = $_POST['parameter_1'];
    $parameter2 = $_POST['parameter_2'];
    $operation = $_POST['operation'];

    switch ($operation) {
        case 'plus':
            $result = $parameter1 + $parameter2;
            break;
        case 'minus':
            $result = $parameter1 - $parameter2;
            break;
        case 'multiply':
            $result = $parameter1 * $parameter2;
            break;
        case 'divide':
            if ($parameter2 != 0) {
                $result = $parameter1 / $parameter2;
            } else {
                $result = 'Cannot divide by zero';
            }
            break;
        default:
            $result = 'Invalid operation';
            break;
    }

    echo $result;
}
