<?php

namespace App\Models;

use App\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $casts = [
        'city' => City::class,
    ];
    protected $fillable = [
        "fullname",
        "phone_number",
        "email",
        "city",
    ];
}
