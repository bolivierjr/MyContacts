<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    // Set to false to turn off the automatic creation of updated_at and created_at fields.
    public $timestamps = false;

    protected $fillable = [
        'firstname', 'lastname', 'address', 'city',
        'state', 'zipcode', 'email', 'phone', 'last_contacted',
    ];

    /**
     *  Setting up one to many relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
