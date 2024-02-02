<?php

namespace App\Tools\Rector;

use App\Framework\Model;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ObjectType;
use PhpParser\Node;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class FixModelMappingsRector extends AbstractRector
{

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            "Fix Model mappings",
            [
                new CodeSample(
                    "\$this->belongsTo('User');",
                    "\$this->belongsTo(User::class);",
                )
            ]);
    }

    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    public function refactor(Node $node): ?Node
    {
        // First we check if the method call is being made on a Model class
        $varType = $this->getType($node->var);
        $modelType = new ObjectType(Model::class);
        if (!$modelType->isSuperTypeOf($varType)->yes()) {
            return null;
        }

        // Then we check if the method being called is either belongsTo or hasMany
        $methodName = $node->name;
        if (! $methodName instanceof Identifier) {
            return null;
        }
        if (!in_array($methodName, ['belongsTo', 'hasMany'])) {
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