<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    //
    protected $fillable = ['nombre','apellido','cedula','fechanacimiento','email','direccion','telefono'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
}