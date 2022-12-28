<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use HasFactory;
    protected $fillable = [
        'site_title',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'favicon',
        'logo',
        'phone',
        'email',
        'address',
        'copy_right',
        'status',
        'theme_color',
        'side_bar',
    ];
}
