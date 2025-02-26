--TEST--
using different variables to access array offsets
--FILE--
<?php

$arr = array(1,2,3,4,5,6,7,8);

var_dump($arr[1]);
var_dump($arr[0.0836]);
var_dump($arr[NULL]);
var_dump($arr["run away"]);

var_dump($arr[TRUE]);
var_dump($arr[FALSE]);

$fp = fopen(__FILE__, "r");
var_dump($arr[$fp]);

$obj = new stdClass;
try {
    var_dump($arr[$obj]);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

$arr1 = Array(1,2,3);
try {
    var_dump($arr[$arr1]);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "Done\n";
?>
--EXPECTF--
int(2)
int(1)

Notice: Undefined index:  in %s on line %d
NULL

Notice: Undefined index: run away in %s on line %d
NULL
int(2)
int(1)

Notice: Resource ID#%d used as offset, casting to integer (%d) in %s on line %d
int(%d)
Illegal offset type
Illegal offset type
Done
