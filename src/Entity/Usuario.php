<?php
namespace App\Entity;
use App\Entity\Perfil;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id'; 
    
    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class,"usuario_perfil","id_usuario","id_perfil");
    }
}