<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Support
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace FireHub\Core\Support\DataStructures\Helpers;

use FireHub\Core\Support\Contracts\HighLevel\DataStructures;
use FireHub\Core\Support\LowLevel\DataIs;

/**
 * ### Sequence range helps you get information about positions in a sequence
 * @since 1.0.0
 */
readonly class SequenceRange {

    /**
     * ### Total number of data structure items
     * @since 1.0.0
     *
     * @var non-negative-int
     */
    private int $total;

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\Contracts\HighLevel\DataStructures::count() To get total number of items in
     * the data structure.
     *
     * @param \FireHub\Core\Support\Contracts\HighLevel\DataStructures<mixed, mixed> $data_structure <p>
     * Instance of data structures.
     * </p>
     * @param int $offset <p>
     * Sequence offset position.
     * </p>
     * @param null|int $length [optional] <p>
     * Sequence length.
     * If length is omitted, then the sequence will have everything from offset up until the end of the sequence.
     * </p>
     *
     * @return void
     */
    public function __construct (
        protected DataStructures $data_structure,
        private int $offset,
        private ?int $length = null
    ) {

        $this->total = $this->data_structure->count();

    }

    /**
     * ### Sequence start position
     * @since 1.0.0
     *
     * @return non-negative-int Sequence start position.
     */
    public function start ():int {

        return match (true) {
            $this->offset > $this->total => $this->total,
            $this->offset >= 0 => $this->offset,
            default => max($this->total + $this->offset, 0)
        };

    }

    /**
     * ### Sequence end position
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Helpers\SequenceRange::start() To get the start position for a sequence.
     * @uses \FireHub\Core\Support\LowLevel\DataIs::null() To check if the $length argument has been passed.
     *
     * @return non-negative-int Slice end position.
     */
    public function end ():int {

        $start = $this->start();

        return match (true) {
            $this->total + $this->length < $start => $start,
            $this->length < 0 => $this->total + $this->length,
            $start + $this->length > $this->total
                || $this->length >= $this->total
                || DataIs::null($this->length)
                    => $this->total,
            default => $start + $this->length
        };

    }

    /**
     * ### Count the number of items between start and end positions
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Support\DataStructures\Helpers\SequenceRange::start() To get the start position for a sequence.
     * @uses \FireHub\Core\Support\DataStructures\Helpers\SequenceRange::end() To get the end position for a sequence.
     *
     * @return non-negative-int The number of items between start and end positions.
     */
    public function count ():int {

        return ($result = $this->end() - $this->start()) < 0 ? 0 : $result;

    }

}