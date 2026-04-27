<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rating', 'content', 'source', 'approved', 'avatar'];

    protected function casts(): array
    {
        return [
            'approved' => 'boolean',
            'rating'   => 'integer',
        ];
    }
}