<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Test
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace support\datastructures\linear\dynamic\collection;

use FireHub\Core\Testing\Base;
use FireHub\Core\Support\DataStructures\Linear\Dynamic\Collection\ {
    Indexed, Associative, Matrix
};
use FireHub\Core\Support\DataStructures\Operation\Select;
use FireHub\Core\Support\DataStructures\Function\GroupBy;
use FireHub\Core\Support\DataStructures\Helpers\Where;
use FireHub\Core\Support\Enums\Comparison;
use PHPUnit\Framework\Attributes\ {
    CoversClass, Group, Small
};

/**
 * ### Test Matrix array collection class
 * @since 1.0.0
 */
#[Small]
#[Group('datastructures')]
#[CoversClass(Matrix::class)]
#[CoversClass(Select::class)]
#[CoversClass(GroupBy::class)]
#[CoversClass(Where::class)]
#[CoversClass(Comparison::class)]
final class MatrixTest extends Base {

    public Matrix $collection;

    public Matrix $numbers;

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function setUp ():void {

        $this->collection = new Matrix([
            1 => ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21],
            2 => ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27],
            3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
            4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
            5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
        ]);

        $this->numbers = new Matrix([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]);

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testSelect ():void {

        $collection = new Matrix([
            3 => ['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25],
            4 => ['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14],
            5 => ['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]
        ]);

        $this->assertEquals(
            $collection,
            $this->collection->select(
                'id', Comparison::GREATER, 2, ['lastname', Comparison::EQUAL, 'Doe']
            )->or('firstname', Comparison::EQUAL, 'Richard')->result()
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testColumn ():void {

        $collection = new Indexed([
            'Doe', 'Doe', 'Roe', 'Doe', 'Doe'
        ]);

        $this->assertEquals(
            $collection,
            $this->collection->column('lastname')
        );

        $collection = new Associative([
            'John' => 'Doe',
            'Jane' => 'Doe',
            'Richard' => 'Roe',
            'Johnie' => 'Doe',
            'Janie' => 'Doe'
        ]);

        $this->assertEquals(
            $collection,
            $this->collection->column('lastname', 'firstname')
        );

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testCollapse ():void {

        $collection = new Indexed([
            1, 2, 3, 4, 5, 6, 7, 8, 9
        ]);

        $this->assertEquals(
            $collection,
            $this->numbers->collapse());

    }

    /**
     * @since 1.0.0
     *
     * @return void
     */
    public function testGroupBy ():void {

        $collection = new Matrix([
            'Doe' => [
                'John' => [['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'age' => 21]],
                'Jane' => [['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'age' => 27]],
                'Johnie' => [['id' => 4, 'firstname' => 'Johnie', 'lastname' =>'Doe', 'age' => 14]],
                'Janie' => [['id' => 5, 'firstname' => 'Janie', 'lastname' =>'Doe', 'age' => 16]]
            ],
            'Roe' => [
                'Richard' => [['id' => 3, 'firstname' => 'Richard', 'lastname' =>'Roe', 'age' => 25]]
            ]
        ]);

        $this->assertEquals(
            $collection,
            new GroupBy($this->collection)('lastname', fn($value) => $value['firstname'])
        );

    }

}