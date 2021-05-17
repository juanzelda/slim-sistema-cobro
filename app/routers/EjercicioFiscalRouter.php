<?php

use App\Controllers\EjercicioFiscalController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/ejercicio-fiscal', function (Group $group) {

        $group->get('', EjercicioFiscalController::class . ':getEjercicioFiscales');
        $group->get('/{id:[0-9]+}', EjercicioFiscalController::class . ':getEjercicioFiscal');
        $group->post('', EjercicioFiscalController::class . ':createEjercicioFiscal');
        $group->put('/{id:[0-9]+}', EjercicioFiscalController::class . ':updateEjercicioFiscal');
        $group->delete('/{id:[0-9]+}', EjercicioFiscalController::class . ':deleteEjercicioFiscal');
    });
};
