<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // field yang boleh diisi secara mass-assignment
    protected $fillable = ['name', 'price', 'description', 'image', 'user_id'];

    // relasi ke table users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
