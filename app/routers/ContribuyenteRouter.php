<?php

use App\Controllers\ContribuyenteController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Middleware\SessionMiddleware;

return function (Group $groupApi) {

    $groupApi->group('/contribuyentes', function (Group $group) {

        $group->get('', ContribuyenteController::class . ':getContribuyentes');
        $group->get('/{id:[0-9]+}', ContribuyenteController::class . ':getContribuyente');
        $group->get('/name-or-id', ContribuyenteController::class . ':findContribuyenteByNameOrId');
        $group->post('', ContribuyenteController::class . ':createContribuyente');
        $group->put('/{id:[0-9]+}', ContribuyenteController::class . ':updateContribuyente');
        $group->delete('/{id:[0-9]+}', ContribuyenteController::class . ':deleteContribuyente');
    })->add(new SessionMiddleware);
};
