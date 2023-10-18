<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;

use function json_encode;

readonly class GetToDoListAction
{
    public static function setRoute(RouteCollectorProxy $routes): void
    {
        $routes->get('/todos', self::class);
    }

    public function __construct(private ToDoRepository $repository)
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $response->getBody()->write(json_encode(
            $this->repository->findAll()->asArray(),
        ));

        return $response->withHeader(
            'Content-type',
            'application/json',
        );
    }
}
