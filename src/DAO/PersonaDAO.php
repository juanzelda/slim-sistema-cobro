<?php

namespace App\DAO;

use App\Entity\Direccion;
use Illuminate\Support\Facades\DB;
use App\Entity\Persona;
use App\Entity\Telefono;

class PersonaDAO
{

    public function __construct()
    {
    }


    public static function getPersonas($p)
    {

        $query = Persona::join("direccion", "personas.id_direccion", "direccion.id")
            ->join("telefonos", "personas.id", "telefonos.id_persona")
            ->select("personas.id", "nombre", "paterno", "materno", "calle", "colonia", "num_ext")
            ->addSelect(DB::raw("GROUP_CONCAT(telefonos.telefono) AS telefonos"))
            ->groupBy("personas.id");

        if ($p->nombre ?? false) {
            $query->where("nombre", $p->nombre);
        }

        if ($p->paterno ?? false) {
            $query->where("paterno", $p->paterno);
        }

        if ($p->materno ?? false) {
            $query->where("materno", $p->materno);
        }

        return $query->get();
    }

    public static function getPersonaById($id)
    {

        return Persona::find($id);
    }


    public static function setPersona($p)
    {

        return  DB::transaction(function () use ($p) { //inicia transaccion

            //se crea entidad de direccion se llena datos y se guarda
            $direccion = new Direccion();
            $direccion->calle = $p->calle;
            $direccion->colonia = $p->colonia;
            $direccion->num_ext = $p->num_ext;
            $direccion->save();

            //se crea entidad de telefono pero no se guarda aun 
            $telefono = new Telefono();
            $telefono->telefono = $p->telefono;
            $telefono->tipo = 1;

            //se crea entidad de celular pero no se guarda aun 
            $celular = new Telefono();
            $celular->telefono = $p->celular;
            $celular->tipo = 3;

            //se crea entidad de persona y se llena 
            $persona = new Persona();
            $persona->nombre = $p->nombre;
            $persona->paterno = $p->paterno;
            $persona->materno = $p->materno;
            $persona->direccion()->associate($direccion); //asocia la direccion creada naterior mente en una relaccion one to one
            $persona->save(); //guarda persona
            $persona->telefonos()->saveMany([$telefono, $celular]); //guarda los telefonos y al mismo tiempo los relaciona con la persona

            return $persona->id; //regresa el id de persona generado

        });
    }

    public static function updatePersona($id, $p)
    {

        return  DB::transaction(function () use ($id,$p) { //inicia transaccion

            //se crea entidad de direccion se llena datos y se guarda
            $direccion = Direccion::find($p->id_direccion);
            $direccion->calle = $p->calle;
            $direccion->colonia = $p->colonia;
            $direccion->num_ext = $p->num_ext;
            $direccion->save();

            //se crea entidad de persona y se llena 
            $persona = Persona::find($id);
            $persona->nombre = $p->nombre;
            $persona->paterno = $p->paterno;
            $persona->materno = $p->materno;
            $persona->save(); //guarda persona

            return $persona->id; //regresa el id de persona generado

        });
    }

    public static function deletePersona($id)
    {
        return Persona::find($id)->delete();
    }
}
