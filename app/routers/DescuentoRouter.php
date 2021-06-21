<?php

use App\Controllers\DescuentoController;
use App\Middleware\SessionMiddleware;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/descuentos', function (Group $group) {

        $group->get('/{id:[0-9]+}', DescuentoController::class . ':getDescuentos');
        $group->get('/{id:[0-9]+}/detalle', DescuentoController::class . ':detalleDescuento');
        $group->post('', DescuentoController::class . ':generarDescuento');
        $group->delete('/{id:[0-9]+}', DescuentoController::class . ':eliminarDescuento');
    })->add(new SessionMiddleware);
};
