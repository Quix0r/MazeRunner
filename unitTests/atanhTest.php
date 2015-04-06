<?php

set_include_path(implode(PATH_SEPARATOR, array(
    '/xampp/php/pear',
    './',
    get_include_path(),
)));

include_once 'Math/Complex.php';
include_once 'Math/ComplexOp.php';


$x = new Math_Complex(-0.98765,	-0.4321);
var_dump($x);
$result = Math_ComplexOp::atanh($x);
var_dump($result);

