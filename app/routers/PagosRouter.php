<?php

use App\Controllers\PagoController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/pagos', function (Group $group) {

        $group->get('', PagoController::class . ':addPago');
        $group->get('/{id:[0-9]+}', PagoController::class . ':getColaborador');
        $group->post('/{id:[0-9]+}', PagoController::class . ':addPago');
        $group->put('/{id:[0-9]+}', PagoController::class . ':updateColaborador');
        $group->delete('/{id:[0-9]+}', PagoController::class . ':deleteColaborador');
    });
};
