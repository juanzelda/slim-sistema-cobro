<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'concepto';
    protected $primaryKey = 'id';

    // union de ono to one
    // public function direccion()
    // {
    //     return $this->belongsTo(Direccion::class, 'id_direccion');
    // }

    //union de uno a muchos
    // public function telefonos()
    // {
    //     return $this->hasMany(Telefono::class, 'id_persona', 'id'); // tabla , fk, pk
    // }
}
