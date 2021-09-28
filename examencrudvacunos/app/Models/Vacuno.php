<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuno extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombrev', 'pesov', 'razav', 'nacimientov', 'codigov'
    ];
}
