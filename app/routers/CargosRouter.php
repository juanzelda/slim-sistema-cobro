<?php

use App\Controllers\CargoController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/cargos', function (Group $group) {

        $group->get('/{id:[0-9]+}', CargoController::class . ':getCargos');
        $group->post('/{id:[0-9]+}', CargoController::class . ':addCargo');
        $group->put('/{id:[0-9]+}', CargoController::class . ':updateCargo');
        $group->delete('/{id:[0-9]+}', CargoController::class . ':deleteCargo');
    });
};
