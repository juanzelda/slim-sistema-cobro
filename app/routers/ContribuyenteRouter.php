<?php

use App\Controllers\ContribuyenteController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/contribuyentes', function (Group $group) {

        $group->get('', ContribuyenteController::class . ':getContribuyentes');
        $group->get('/{id:[0-9]+}', ContribuyenteController::class . ':getContribuyente');
        $group->post('', ContribuyenteController::class . ':createContribuyente');
        $group->put('/{id:[0-9]+}', ContribuyenteController::class . ':updateContribuyente');
        $group->delete('/{id:[0-9]+}', ContribuyenteController::class . ':deleteContribuyente');
    });
};
