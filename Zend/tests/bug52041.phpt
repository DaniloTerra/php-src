--TEST--
Bug #52041 (Memory leak when writing on uninitialized variable returned from function)
--FILE--
<?php
function foo() {
	return $x;
}

try {
    foo()->a = 1;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    foo()->a->b = 2;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    foo()->a++;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    foo()->a->b++;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    foo()->a += 2;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
try {
    foo()->a->b += 2;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

foo()[0] = 1;
foo()[0][0] = 2;
foo()[0]++;
foo()[0][0]++;
foo()[0] += 2;
foo()[0][0] += 2;

var_dump(foo());
?>
--EXPECTF--
Notice: Undefined variable: x in %s on line %d
Attempt to assign property 'a' of non-object

Notice: Undefined variable: x in %s on line %d
Attempt to modify property 'a' of non-object

Notice: Undefined variable: x in %s on line %d
Attempt to increment/decrement property 'a' of non-object

Notice: Undefined variable: x in %s on line %d
Attempt to modify property 'a' of non-object

Notice: Undefined variable: x in %s on line %d
Attempt to assign property 'a' of non-object

Notice: Undefined variable: x in %s on line %d
Attempt to modify property 'a' of non-object

Notice: Undefined variable: x in %s on line %d

Notice: Undefined variable: x in %s on line %d

Notice: Undefined variable: x in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined variable: x in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined variable: x in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined variable: x in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined offset: 0 in %s on line %d

Notice: Undefined variable: x in %s on line %d
NULL
