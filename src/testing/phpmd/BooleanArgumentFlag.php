<?php declare(strict_types = 1);

use PHPMD\AbstractNode;
use PHPMD\Rule\CleanCode\BooleanArgumentFlag as ParentBooleanArgumentFlag;

/**
 * ### Check for a boolean flag in the method/ function signature
 *
 * Boolean flags are signs for single responsibility principle violations.
 * @since 1.0.0
 */
final class src_testing_phpmd_BooleanArgumentFlag extends ParentBooleanArgumentFlag {

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
    #[\Override]
    public function apply (AbstractNode $node):void {

        if (\in_array(
            $node->getNamespaceName(),
            explode(',', $this->getStringProperty('exclude_namespaces')),
            true
        )) return;

        parent::apply($node);

    }

}