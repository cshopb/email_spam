<?php

namespace App\Email_spam\Search;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('search', 'App\Email_spam\Search\Search');
    }
}