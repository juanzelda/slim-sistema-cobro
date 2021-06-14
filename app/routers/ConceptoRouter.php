<?php

use App\Controllers\ConceptoController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/conceptos', function (Group $group) {

        $group->get('', ConceptoController::class . ':getConceptos');
        $group->get('/name-or-clave', ConceptoController::class . ':getConceptosByDescripcionOrClave');
        $group->get('/{id:[0-9]+}', ConceptoController::class . ':getConceptoId');
        $group->post('', ConceptoController::class . ':createConcepto');
        $group->put('/{id:[0-9]+}', ConceptoController::class . ':updateConcepto');
        $group->delete('/{id:[0-9]+}', ConceptoController::class . ':deleteConcepto');
    });
};
