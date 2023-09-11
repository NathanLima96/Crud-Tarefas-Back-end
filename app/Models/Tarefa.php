<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;


class Tarefa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
          'titulo',
          'description',
          'data_vencimento',
          'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    public function subs (){
     return $this->hasMany(SubTarefa::class, 'id_tarefa');
 }
}
