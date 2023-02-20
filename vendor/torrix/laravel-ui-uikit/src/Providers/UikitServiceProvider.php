<?php

namespace Torrix\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\Presets\Vue;
use Laravel\Ui\UiCommand;
use Torrix\Presets\Uikit;

class UikitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        UiCommand::macro('uikit', static function ($command) {
            Uikit::install();
            Vue::install();

            if ($command->option('auth')) {
                Uikit::auth();
            }
        });
    }
}
