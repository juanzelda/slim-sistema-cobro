<?php

use App\Controllers\PerfilController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/perfiles', function (Group $group) {

        $group->get('', PerfilController::class . ':getPerfiles');
        $group->get('/{id:[0-9]+}', PerfilController::class . ':getPerfil');
        $group->post('', PerfilController::class . ':createPerfil');
        $group->put('/{id:[0-9]+}', PerfilController::class . ':updatePerfil');
        $group->delete('/{id:[0-9]+}', PerfilController::class . ':deletePerfil');
    });
};
