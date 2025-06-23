<?php declare(strict_types = 1);

namespace FireHub\Core;

use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Indexed, Associative, Obj
};
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy;
use FireHub\Core\Support\DataStructures\Linear\Fixed;

/**
 * @template TValue of 'John'|'Jane'|'Richard'
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Indexed<TValue>
 */
class IndexedExtend extends Indexed {}
function indexed ():void {

    $array = ['John', 'Jane', 'Jane', 'Jane', 'Richard', 'Richard'];

    $collection = new Indexed();
    //\PHPStan\dumpType($collection);

    $collection = new IndexedExtend();
    //\PHPStan\dumpType($collection);

}

/**
 * @template TKey of 'firstname'|'lastname'|'age'
 * @template TValue of 'John'|'Doe'|25
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Associative<TKey, TValue>
 */
class AssociativeExtend extends Associative {}
function associative ():void {

    $array = ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25];

    $collection = new Associative($array);
    \PHPStan\dumpType($collection->sort());
    //\PHPStan\dumpType($collection);

    $collection = new AssociativeExtend($array);
    \PHPStan\dumpType($collection->sortBy(function($va1, $val2) {
        \PHPStan\dumpType($va1);
        return $va1 < 'x';
    }));
    //\PHPStan\dumpType($collection)

}

/**
 * @template TObject of Indexed<int>
 * @template TInfo of string
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\Obj<TObject, TInfo>
 */
class ObjExtend extends Obj {}
function obj ():void {

    $collection = new Obj();
    //\PHPStan\dumpType($collection);

    $collection = new ObjExtend();
    //\PHPStan\dumpType($collection);

}

/**
 * @template TKey of 'firstname'|'lastname'|'age'
 * @template TValue of 'John'|'Doe'|25
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Dynamic\Lazy<TKey, TValue>
 */
class LazyExtend extends Lazy {}
function lazy ():void {

    $collection = new Lazy(fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25]);
    //\PHPStan\dumpType($collection);

    $collection = new LazyExtend(fn() => yield from ['firstname' => 'John', 'lastname' => 'Doe', 'age' => 25]);
    //\PHPStan\dumpType($collection);

}

/**
 * @template TValue of 'one'|'two'|'three'
 *
 * @extends \FireHub\Core\Support\DataStructures\Linear\Fixed<TValue>
 */
class FixedExtend extends Fixed {}
function fixed ():void {

    $collection = new Fixed(3);
    $collection[0] = 'one';
    $collection[1] = 'two';
    $collection[2] = 'three';
    //\PHPStan\dumpType($collection);

    $collection = new FixedExtend(3);
    $collection[0] = 'one';
    $collection[1] = 'two';
    $collection[2] = 'three';
    //\PHPStan\dumpType($collection);

}