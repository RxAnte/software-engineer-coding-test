<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Add;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;
use SoftwareEngineering\ActionResultResponder;
use SoftwareEngineering\ToDos\ToDoRepository;

use function is_array;

readonly class PostAddToDoAction
{
    public static function setRoute(RouteCollectorProxy $routes): void
    {
        $routes->post('/todos', self::class);
    }

    public function __construct(
        private ToDoRepository $repository,
        private ActionResultResponder $responder,
    ) {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $rawPostData = $request->getParsedBody();
        $rawPostData = is_array($rawPostData) ? $rawPostData : [];

        $postData = PostData::createFromArray($rawPostData);

        return $this->responder->respond($this->repository->create(
            $postData->title->toNative(),
        ));
    }
}
