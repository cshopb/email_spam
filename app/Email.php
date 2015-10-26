<?php

namespace App;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Email extends Eloquent {

    /*
     * Fillable fields for new email.
     */
    protected $fillable = [
        'customer_id',
        'list',
        'email',
        'addition_info',
    ];

    /**
     * An email belongs to a customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Add a new email.
     *
     * @param array $attributes
     * @return static
     */
    public static function add(array $attributes)
    {
        return new static($attributes); // = new Email(array)
    }

    /**
     * Tries to get the email provided from the provided list.
     *
     * http://www.easylaravelbook.com/blog/2015/06/23/using-scopes-with-laravel-5/
     *
     * @param $query
     * @param $customer_id
     * @param $list_to_check
     * @param $email_to_check
     * @return mixed
     */
    public function scopeExists($query, $customer_id, $list_to_check, $email_to_check)
    {
        return $query->where('customer_id', $customer_id)
            ->where('list', $list_to_check)
            ->where('email', $email_to_check);
    }
}
