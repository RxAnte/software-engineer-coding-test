<?php

declare(strict_types=1);

namespace SoftwareEngineering;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

use function json_encode;

readonly class ActionResultResponder
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function respond(ActionResult $result): ResponseInterface
    {
        $response = $this->responseFactory->createResponse(
            $result->success ? 200 : 400,
        );

        $response->getBody()->write(json_encode(
            $result->asArray(),
        ));

        return $response->withHeader(
            'Content-type',
            'application/json',
        );
    }
}
