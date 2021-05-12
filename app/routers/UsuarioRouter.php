<?php

use App\Controllers\UsuarioController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/usuarios', function (Group $group) {

        $group->get('', UsuarioController::class . ':getUsuarios');
        $group->get('/{id:[0-9]+}', UsuarioController::class . ':getUsuario');
        $group->post('', UsuarioController::class . ':createUser');
        $group->put('/{id:[0-9]+}', UsuarioController::class . ':updateUsuario');
        $group->delete('/{id:[0-9]+}', UsuarioController::class . ':deleteUsuario');
    });
};
