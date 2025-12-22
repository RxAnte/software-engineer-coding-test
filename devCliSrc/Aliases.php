<?php

declare(strict_types=1);

namespace Cli;

use Throwable;

use function array_filter;
use function array_keys;
use function array_map;
use function array_slice;
use function array_splice;
use function array_values;
use function call_user_func_array;
use function count;
use function explode;
use function implode;
use function is_callable;

readonly class Aliases
{
    /** @var \Cli\Alias */
    private array $items;

    public function __construct()
    {
        $this->items = array_values(array_filter(
            array_map(
                [$this, 'createAliasFromClassString'],
                CommandClasses::classStrings(),
            ),
            static fn (Alias|null $i) => $i !== null,
        ));
    }

    private function createAliasFromClassString(string $classString): \Cli\Alias|null
    {
        try {
            if (! is_callable($classString . '::applyCommand')) {
                return null;
            }

            $event = new \Cli\ApplyCliCommandsEventForAliases();

            call_user_func_array(
                $classString . '::applyCommand',
                [$event],
            );

            $expression = explode(
                ' ',
                $event->expression->expression,
            )[0];

            return new \Cli\Alias($expression);
        } catch (Throwable) {
            return null;
        }
    }

    public function map(): void
    {
        foreach ($this->items as $item) {
            if (! $this->mapItem($item)) {
                continue;
            }

            break;
        }
    }

    private function mapItem(\Cli\Alias $alias): bool
    {
        $args = $_SERVER['argv'];

        $relevantArgs = array_slice(
            $args,
            1,
            $alias->toCount(),
        );

        $relevantArgsString = implode(':', $relevantArgs);

        if ($relevantArgsString !== $alias->from) {
            return false;
        }

        array_splice(
            $args,
            1,
            $alias->toCount(),
            $alias->from,
        );

        $_SERVER['argv'] = $args;

        $_SERVER['argc'] = count($args);

        return true;
    }
}
