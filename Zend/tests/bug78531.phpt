--TEST--
Bug #78531 (Crash when using undefined variable as object)
--FILE--
<?php
try {
    $u1->a += 5;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    $x = ++$u2->a;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    $x = $u3->a++;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    $u4->a->a += 5;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
?>
--EXPECTF--
Notice: Undefined variable: u1 in %s on line %d
Attempt to assign property 'a' of non-object

Notice: Undefined variable: u2 in %s on line %d
Attempt to increment/decrement property 'a' of non-object

Notice: Undefined variable: u3 in %s on line %d
Attempt to increment/decrement property 'a' of non-object

Notice: Undefined variable: u4 in %s on line %d
Attempt to modify property 'a' of non-object
