<?php

use App\Controllers\SecurityController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Middleware\SessionMiddleware;

return function (Group $groupApi) {

    $groupApi->group('/seguridad', function (Group $group) {

        $group->post('', SecurityController::class . ':initSesion');
        $group->get('/menu', SecurityController::class . ':buildMenu')->add(new SessionMiddleware);
    });
};
