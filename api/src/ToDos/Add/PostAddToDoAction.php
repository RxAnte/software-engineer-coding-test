<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\Add;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;
use SoftwareEngineering\ToDos\ToDoRepository;

use function is_array;
use function json_encode;

class PostAddToDoAction
{
    public static function setRoute(RouteCollectorProxy $routes): void
    {
        $routes->post('/todos', self::class);
    }

    public function __construct(private ToDoRepository $repository)
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {
        $rawPostData = $request->getParsedBody();
        $rawPostData = is_array($rawPostData) ? $rawPostData : [];

        $postData = PostData::createFromArray($rawPostData);

        $result = $this->repository->create($postData->title->toNative());

        $response->getBody()->write(json_encode(
            $result->asArray(),
        ));

        return $response
            ->withStatus($result->success ? 200 : 400)
            ->withHeader(
                'Content-type',
                'application/json',
            );
    }
}
