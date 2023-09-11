<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;


class SubTarefa extends Model
{
     /**
      * The attributes that are mass assignable.
      *
      * @var string[]
      */
     protected $fillable = [
          'id_tarefa',
          'description',
          'status',
     ];

     /**
      * The attributes excluded from the model's JSON form.
      *
      * @var string[]
      */
}
