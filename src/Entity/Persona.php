<?php
namespace App\Entity;
use App\Entity\Telefono;
use App\Entity\Direccion;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model 
{
    protected $table = 'personas';
    protected $primaryKey = 'id'; 

    // union de ono to one
    public function direccion()
    {
        return $this->belongsTo(Direccion::class,'id_direccion');
    }
    
    //union de uno a muchos 
    public function telefonos()
    {
        return $this->hasMany(Telefono::class,'id_persona','id');// tabla , fk, pk
    }
}