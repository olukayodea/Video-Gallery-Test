<?php
declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\Video;

use App\Domain\Video\Video;
use App\Domain\Video\VideoNotFoundException;
use App\Infrastructure\Persistence\Video\InMemoryVideoRepository;
use Tests\TestCase;

class InMemoryVideoRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $video = new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq');

        $userRepository = new InMemoryVideoRepository([1 => $video]);

        $this->assertEquals([$video], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq'),
            2 => new Video(2, 'Esther Mangini Testimonial', 'Testimonials', 'Esther\'s journey to healthier bones', 'ybyot0dm7q'),
            3 => new Video(3, 'Teresa Cucurull Testimonial', '', 'Teresa\'s journey to healthier bones', 'mhmv73k989'),
            4 => new Video(4, 'Perfect Pilates For Osteoporosis - Legwork', '', 'Bone Healthy Exercises!', '3n5p02h26w'),
            5 => new Video(5, 'Perfect Pilates For Osteoporosis - Amazing Abs', '', 'Bone Healthy Exercises!', 'kkgeu7v2va'),
            6 => new Video(6, 'Lara\'s Homemade Granola', '', 'Bone Healthy Recipes', 'm6amjftj3w'),
            7 => new Video(7, 'Brazil Nut Pesto', '', 'Bone Healthy Recipes', 'ajoe5d0jk0')
        ];

        $userRepository = new InMemoryVideoRepository();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $video = new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq');

        $videoRepository = new InMemoryVideoRepository([1 => $video]);

        $this->assertEquals($video, $videoRepository->findVideoOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $videoRepository = new InMemoryVideoRepository([]);
        $this->expectException(VideoNotFoundException::class);
        $videoRepository->findVideoOfId(1);
    }
}
