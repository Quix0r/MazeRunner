<?php

include_once '../Classes/bootstrap.php';


$x = new Complex\Complex(-0.98765,	-0.4321);
var_dump($x);
$result = Complex\atanh($x);
var_dump($result);

