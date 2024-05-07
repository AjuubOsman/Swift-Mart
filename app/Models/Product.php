<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'inventory',
        'category_id',

    ];
    protected $table = 'products';

    public function categories() {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }
}
