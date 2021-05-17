<?php

use App\Controllers\ReciboController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/recibos', function (Group $group) {

        $group->get('/{id:[0-9]+}', ReciboController::class . ':getRecibos');
        $group->get('/{id:[0-9]+}/detalle', ReciboController::class . ':detalleRecibo');
        $group->post('', ReciboController::class . ':generarRecibo');
        $group->delete('/{id:[0-9]+}', ReciboController::class . ':eliminarRecibo');
    });
};
