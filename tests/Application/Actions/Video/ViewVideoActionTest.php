<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Video;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Video\Video;
use App\Domain\Video\VideoNotFoundException;
use App\Domain\Video\VideoRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewVideoActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $video = new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq');

        $userRepositoryProphecy = $this->prophesize(VideoRepository::class);
        $userRepositoryProphecy
            ->findVideoOfId(1)
            ->willReturn($video)
            ->shouldBeCalledOnce();

        $container->set(VideoRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $video);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsVideoNotFoundException()
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false ,false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        /** @var Container $container */
        $container = $app->getContainer();

        $userRepositoryProphecy = $this->prophesize(VideoRepository::class);
        $userRepositoryProphecy
            ->findVideoOfId(1)
            ->willThrow(new VideoNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(VideoRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The user you requested does not exist.');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
