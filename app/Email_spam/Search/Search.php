<?php namespace App\Email_spam\Search;

use App\Customer;
use App\Email;

class Search {

    public function customers($search)
    {
        return Customer::search($search)->get();
    }

    public function emails($search)
    {
        return Email::search($search)->get();
    }

    public function all($search)
    {
        return $this->customers($search) + $this->emails($search);
    }
}