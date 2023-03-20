<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // this way you add a single rule
    $ecsConfig->rules([
        NoUnusedImportsFixer::class,
        DeclareStrictTypesFixer::class,
        TrailingCommaInMultilineFixer::class,
        ArrayIndentationFixer::class,
    ]);

    // this way you can add sets - group of rules
    $ecsConfig->sets([
        SetList::PSR_12,
        SetList::STRICT,
        //        SetList::COMMON,
        // run and fix, one by one
        //         SetList::SPACES,
        // SetList::ARRAY,
        // SetList::DOCBLOCK,
         SetList::NAMESPACES,
         SetList::COMMENTS,
    ]);
};
