<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'pluralize']),
        ];
    }

    public function pluralize(int $count, string $singular, ?string $plurial = null): string
    {
        $_plurial = $plurial ?? $singular . "s";
        $str = ($count === 1) ? $singular : $_plurial;
        return "$count $str";
    }
}
