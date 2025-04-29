<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
    'first_name',
    'last_name',
    'gender',
    'email',
    'tel',
    'address',
    'inquiry_type',
    'inquiry_content',
];

public function category()
{
    return $this->belongsTo(Category::class, 'inquiry_type');
}

}
