<?php
namespace App\Providers;
use App\Models\Deck;
use App\Policies\DeckPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Deck::class, DeckPolicy::class);
    }
}
