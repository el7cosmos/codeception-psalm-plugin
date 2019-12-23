<?php

namespace Psalm\CodeceptionPlugin\ReturnTypeProvider;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ClassConstFetch;
use Psalm\CodeLocation;
use Psalm\Context;
use Psalm\Plugin\Hook\MethodReturnTypeProviderInterface;
use Psalm\StatementsSource;
use Psalm\Type\Atomic\TNamedObject;
use Psalm\Type\Union;

class StubReturnTypeProvider implements MethodReturnTypeProviderInterface
{

    /**
     * @inheritDoc
     */
    public static function getClassLikeNames(): array
    {
        return ['Codeception\Test\Feature\Stub'];
    }

    /**
     * @inheritDoc
     *
     * @throws \Psalm\Exception\TypeParseTreeException
     */
    public static function getMethodReturnType(
        StatementsSource $source,
        string $fq_classlike_name,
        string $method_name_lowercase,
        array $call_args,
        Context $context,
        CodeLocation $code_location,
        array $template_type_parameters = null,
        string $called_fq_classlike_name = null,
        string $called_method_name_lowercase = null
    ): ?Union {
        $methods = [
            'stubstart',
            'stubend',
        ];
        if (!in_array($method_name_lowercase, $methods, true)) {
            $arg = $call_args[0];
            assert($arg instanceof Arg);
            assert($arg->value instanceof ClassConstFetch);
            return new Union([TNamedObject::create($arg->value->class->getAttribute('resolvedName'))]);
        }

        return null;
    }
}
