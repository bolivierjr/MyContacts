<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'address', 'city',
        'state', 'zipcode', 'email', 'phone', 'last_contacted',
    ];

    /**
     *
     */
    public function user()
    {
        $this->belongsTo(App\User);
    }
}
