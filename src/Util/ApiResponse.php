<?php
namespace App\Util;
use Psr\Http\Message\ResponseInterface;

trait ApiResponse{

    public function successResponse(ResponseInterface $response,$data,$code=200)
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($code);
    }

    public function errorResponse(ResponseInterface $response)
    {
       $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($code);
    }

}