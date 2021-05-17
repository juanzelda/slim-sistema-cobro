<?php

use App\Controllers\ColaboradorController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/colaboradores', function (Group $group) {

        $group->get('', ColaboradorController::class . ':getColaboradores');
        $group->get('/{id:[0-9]+}', ColaboradorController::class . ':getColaborador');
        $group->post('', ColaboradorController::class . ':createColaborador');
        $group->put('/{id:[0-9]+}', ColaboradorController::class . ':updateColaborador');
        $group->delete('/{id:[0-9]+}', ColaboradorController::class . ':deleteColaborador');
    });
};
