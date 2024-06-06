<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
     ];
    protected $table = 'cart';

    public function users() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
