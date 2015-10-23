<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Customer extends Eloquent {

    // No timestamps for a customer.
    public $timestamps = false;

    // Fillable fields for a customer.
    protected $fillable = [
        'name',
    ];

    /**
     * A customer belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}
