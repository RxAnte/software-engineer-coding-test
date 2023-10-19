<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Delete;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;
use SoftwareEngineering\ActionResultResponder;

use function assert;
use function is_string;

readonly class DeleteToDoAction
{
    public static function setRoute(RouteCollectorProxy $routes): void
    {
        $routes->delete('/todos/{id}', self::class);
    }

    public function __construct(
        private ActionResultResponder $responder,
        private DeleteIfApplicable $delete,
    ) {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $id = $request->getAttribute('id');
        assert(is_string($id));

        return $this->responder->respond($this->delete->delete($id));
    }
}
