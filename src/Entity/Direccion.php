<?php
namespace App\Entity;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model 
{
    protected $table = 'direccion';
    protected $primaryKey = 'id';  
    
    public function direccion()
    {
        return $this->hasOne(Persona::class, 'id_direccion', 'id');// tabla , fk, pk
    }
}