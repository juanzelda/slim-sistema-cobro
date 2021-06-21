<?php

use App\Controllers\PeloyController;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $groupApi) {

    $groupApi->group('/peloy', function (Group $group) {

        $group->get('', PeloyController::class . ':getPeloy');
        $group->post('', PeloyController::class . ':addPeloy');
        
    });
};
