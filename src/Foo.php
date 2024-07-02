<?php

declare(strict_types=1);

namespace src;

use function in_array;

use const T_CLASS;
use const T_ENUM;
use const T_FUNCTION;
use const T_INTERFACE;
use const T_TRAIT;

final readonly class Foo
{

    private function isDocBlockRequired(array $token, array $tokens, int $index): bool
    {
        if (! in_array($token[0], [T_CLASS, T_TRAIT, T_INTERFACE, T_ENUM, T_FUNCTION], true)) {
            return false;
        }
        if ($token[0] === T_CLASS) {
            if ($this->isAnonymousClass($tokens, $index) || $this->isClosure($tokens, $index)) {
                return false;
            }
        }

        if ($token[0] === T_FUNCTION) {
            if ($this->isAnonymousFunction($tokens, $index) || ! $this->isFunctionDeclaration($tokens, $index)) {
                return false;
            }
        }

        return true;
    }
}
