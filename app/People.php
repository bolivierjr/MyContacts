<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    /**
     * Set to false to turn off the automatic creation of updated_at
     * and created_at fields.
     */
    public $timestamps = false;

    /**
     * Support for multiple emails and phone numbers using JSON casting.
     * Takes a php assoc array and converts it to JSON to store in the
     * MySQL database.
     */
    protected $casts = [
        'email' => 'array',
        'phone' => 'array',
    ];

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'address', 'city',
        'state', 'zipcode', 'last_contacted', 'create_at'
    ];

    /**
     *  Setting up one to many relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
