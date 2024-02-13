<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use App\Framework\Model;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ObjectType;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\FixModelMappingsRector\FixModelMappingsRectorTest
 */
final class FixModelMappingsRector extends AbstractRector
{

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            "Fix Model mappings",
            [
                new CodeSample(
                    '$this->belongsTo("User");',
                    '$this->belongsTo(User::class);',
                )
            ]);
    }

    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /** @param MethodCall $node */
    public function refactor(Node $node): ?Node
    {

        // First we check if the method call is being made on a Model class
        if (!$this->isObjectType($node->var, new ObjectType(Model::class))) {
            return null;
        }

        // Then we check if the method being called is `belongsTo`
        if (!$this->isName($node->name, 'belongsTo')) {
            return null;
        }


        // Finally we check if the first argument is a string, if so convert it to a class constant
        $arg = $node->args[0] ?? null;
        if (! $arg instanceof Arg) {
            return null;
        }

        if (! $arg->value instanceof String_) {
            return null;
        }

        $fqcn = 'App\\Models\\' . $arg->value->value;
        $arg->value = new ClassConstFetch(new Name($fqcn), new Identifier("class"));

        return $node;
    }

}
