<?php
declare(strict_types=1);

namespace Tests\Domain\Video;

use App\Domain\Video\Video;
use Tests\TestCase;

class VideoTest extends TestCase
{
    public function userProvider()
    {
        return [
            [1, 'What It\'s Like To Work At AlgaeCal', '', 'Discover what it\'s like to work at AlgaeCal with this quick video!', 'm3ralniniq'],
            [2, 'Esther Mangini Testimonial', 'Testimonials', 'Esther\'s journey to healthier bones', 'ybyot0dm7q'],
            [3, 'Teresa Cucurull Testimonial', '', 'Teresa\'s journey to healthier bones', 'mhmv73k989'],
            [4, 'Perfect Pilates For Osteoporosis - Legwork', '', 'Bone Healthy Exercises!', '3n5p02h26w'],
            [5, 'Perfect Pilates For Osteoporosis - Amazing Abs', '', 'Bone Healthy Exercises!', 'kkgeu7v2va'],
            [6, 'Lara\'s Homemade Granola', '', 'Bone Healthy Recipes', 'm6amjftj3w'],
            [7, 'Brazil Nut Pesto', '', 'Bone Healthy Recipes', 'ajoe5d0jk0']
        ];
    }

    /**
     * @dataProvider userProvider
     * @param $id
     * @param $title
     * @param $category
     * @param $description
     * @param $video_id
     */
    public function testGetters($id, $title, $category, $description, $video_id)
    {
        $video = new Video($id, $title, $category, $description, $video_id);

        $this->assertEquals($id, $video->getId());
        $this->assertEquals($title, $video->getTitile());
        $this->assertEquals($category, $video->getCategory());
        $this->assertEquals($description, $video->getDescription());
        $this->assertEquals($video_id, $video->getVideo_id());
    }

    /**
     * @dataProvider userProvider
     * @param $id
     * @param $title
     * @param $category
     * @param $description
     * @param $video_id
     */
    public function testJsonSerialize($id, $title, $category, $description, $video_id)
    {
        $video = new Video($id, $title, $category, $description, $video_id);

        $expectedPayload = json_encode([
            'id' => $id,
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'video_id' => $video_id,
        ]);

        $this->assertEquals($expectedPayload, json_encode($video));
    }
}
