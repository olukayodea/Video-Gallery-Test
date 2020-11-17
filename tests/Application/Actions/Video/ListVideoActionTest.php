<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Video;

use App\Application\Actions\ActionPayload;
use App\Domain\Video\VideoRepository;
use App\Domain\Video\Video;
use DI\Container;
use Tests\TestCase;

class ListVideoActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $video = new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq');

        $userRepositoryProphecy = $this->prophesize(VideoRepository::class);
        $userRepositoryProphecy
            ->findAll()
            ->willReturn([$video])
            ->shouldBeCalledOnce();

        $container->set(VideoRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, [$video]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
