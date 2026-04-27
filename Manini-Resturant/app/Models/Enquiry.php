<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'subject', 'message', 'status'
    ];
}