<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Video;

use App\Domain\Video\Video;
use App\Domain\Video\VideoNotFoundException;
use App\Domain\Video\VideoRepository;

class InMemoryVideoRepository implements VideoRepository
{
    /**
     * @var Video[]
     */
    private $video;

    /**
     * InMemoryUserRepository constructor.
     *
     * @param array|null $users
     */
    public function __construct(array $video = null)
    {
        $this->video = $video ?? [
            1 => new Video(1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq'),
            2 => new Video(2, 'Esther Mangini Testimonial', 'Testimonials', 'Esther\'s journey to healthier bones', 'ybyot0dm7q'),
            3 => new Video(3, 'Teresa Cucurull Testimonial', '', 'Teresa\'s journey to healthier bones', 'mhmv73k989'),
            4 => new Video(4, 'Perfect Pilates For Osteoporosis - Legwork', '', 'Bone Healthy Exercises!', '3n5p02h26w'),
            5 => new Video(5, 'Perfect Pilates For Osteoporosis - Amazing Abs', '', 'Bone Healthy Exercises!', 'kkgeu7v2va'),
            6 => new Video(6, 'Lara\'s Homemade Granola', '', 'Bone Healthy Recipes', 'm6amjftj3w'),
            7 => new Video(7, 'Brazil Nut Pesto', '', 'Bone Healthy Recipes', 'ajoe5d0jk0')
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->video);
    }

    /**
     * {@inheritdoc}
     */
    public function findVideoOfId(int $id): Video
    {
        if (!isset($this->video[$id])) {
            throw new VideoNotFoundException();
        }

        return $this->video[$id];
    }
}
