<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class badge-list extends Component
{
    protected string $view = 'forms.components.badge-list';

    public static function make(): static
    {
        return app(static::class);
    }
}
