<?php

namespace App;

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
}
