<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipcode',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    #@TODO: Arrumar isso aqui
    /*public function orders(){
        return $this->belongsToMany(Order::class, 'client_id', 'id');
    }*/
}
