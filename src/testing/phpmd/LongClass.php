<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Web Application Framework package
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2025 FireHub Web Application Framework
 * @license <https://opensource.org/licenses/OSL-3.0> OSL Open Source License version 3
 *
 * @package Core\Testing
 *
 * @version GIT: $Id$ Blob checksum.
 */

namespace src\testing\phpmd;

use PHPMD\AbstractNode;
use PHPMD\Rule\Design\LongClass as ParentLongClass;
use Override;

use function in_array;

/**
 * ### Check for a long class size
 *
 * Long Class files are indications that the class may be trying to do too much.
 * @since 1.0.0
 */
final class LongClass extends ParentLongClass {

    /**
     * ### Applies the rule to the given node.
     *
     * If the node's namespace matches the 'exclude_namespaces' property,
     * the rule is not applied. Otherwise, the parent apply method is invoked.
     * @since 1.0.0
     *
     * @param \PHPMD\AbstractNode $node <p>
     * The node to which the rule is applied.
     * </p>
     *
     * @return void
     */
    #[Override]
    public function apply (AbstractNode $node):void {

        if (in_array(
            $node->getNamespaceName(),
            explode(',', $this->getStringProperty('exclude_namespaces')),
            true
        )) return;

        parent::apply($node);

    }

}