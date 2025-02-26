--TEST--
Bug #44660 (Indexed and reference assignment to property of non-object don't trigger warning)
--FILE--
<?php
$s = "hello";
$a = true;

echo "--> read access: ";
echo $a->p;

echo "\n--> direct assignment:\n";
try {
    $a->p = $s;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "\n--> increment:\n";
try {
    $a->p++;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "\n--> reference assignment:\n";
try {
    $a->p =& $s;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "\n--> reference assignment:\n";
try {
    $s =& $a->p;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "\n--> indexed assignment:\n";
try {
    $a->p[0] = $s;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

echo "\n--> Confirm assignments have had no impact:\n";
var_dump($a);
?>
--EXPECTF--
--> read access: 
Notice: Trying to get property 'p' of non-object in %s on line %d

--> direct assignment:
Attempt to assign property 'p' of non-object

--> increment:
Attempt to increment/decrement property 'p' of non-object

--> reference assignment:
Attempt to modify property 'p' of non-object

--> reference assignment:
Attempt to modify property 'p' of non-object

--> indexed assignment:
Attempt to modify property 'p' of non-object

--> Confirm assignments have had no impact:
bool(true)
