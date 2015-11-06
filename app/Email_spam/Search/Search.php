<?php

namespace App\Email_spam\Search;

use Auth;

class Search {

    public function customers($search)
    {
        return Auth::user()->customers()->search($search)->get();
    }

    public function emails($search)
    {
        return Auth::user()->emails()->search($search)->get();
    }

    public function all($search)
    {
        return $this->customers($search) + $this->emails($search);
    }
}