<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'avatar','cod_persona',
    ];

    // Relacion entre usuario y perfil
    public function persona()
    {
      return $this->belongsTo('App\Models\Persona', 'cod_persona', 'id');
    }

}
