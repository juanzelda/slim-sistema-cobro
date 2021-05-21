<?php

use App\Controllers\PagoController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/pagos', function (Group $group) {

        $group->get('/{id:[0-9]+}', PagoController::class . ':getPagos');
        $group->post('/{id:[0-9]+}', PagoController::class . ':addPago');
        $group->delete('/{id:[0-9]+}', PagoController::class . ':eliminarPago');
        
    });
};
