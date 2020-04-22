<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //Rule: Table name must be plural and model name must be singular, like table = contacts & model = Contact. 


      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_name', 'contact_email', 'contact_phone', 'contact_image', 'contact_status',
    ];
}
