<?php
use App\Controllers\SecurityController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/seguridad', function (Group $group) {

        $group->post('', SecurityController::class . ':initSesion');

    });
};
