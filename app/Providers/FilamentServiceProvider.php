<?php

namespace App\Providers;

use Filament\Pages\Page;
use Filament\PluginServiceProvider;
use Filament\Navigation\NavigationItem;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            // Batasi menu dashboard hanya untuk pengepul
            Filament::registerUserMenuItems([
                'Dashboard' => fn (User $user) => $user->role === 'pengepul',
            ]);
        });
    }
}
