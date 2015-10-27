<?php

namespace Email_spam\Search;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('search', 'Email_spam\Search\Search');
    }
}