<?php

namespace App;

use Eloquent;

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

    /**
     * A customer has many emails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany('App\Email');
    }

    /**
     * Search in customers if there is a name like the provided search query.
     *
     * @param $query
     * @param $search
     */
    public function scopeSearch($query, $search)
    {
        // http://www.brainbell.com/tutorials/MySQL/Using_The_LIKE_Operator.htm
        // http://stackoverflow.com/questions/15042197/access-variables-from-parent-scope-in-anonymous-php-function
        // http://php.net/manual/en/functions.anonymous.php

            return $query->where('name', 'LIKE', "%$search%");
    }

    public function scopeList($query)
    {
        return $query->orderBy('name', 'asc')->lists('name', 'id');
    }

    /**
     * Return the name of the customer when provided an ID.
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeName($query, $id)
    {
        return $query->where('id', $id)->lists('name');
    }
}
