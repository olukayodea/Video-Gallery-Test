<?php
declare(strict_types=1);

namespace App\Domain\Video;

use JsonSerializable;

class Video implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $video_id;

    /**
     * @param int|null  $id
     * @param string    $title
     * @param string    $category
     * @param string    $description
     * @param string    $video_id
     */
    public function __construct(?int $id, string $title, string $category, string $description, string $video_id)
    {
        $this->id = $id;
        $this->title = ucfirst($title);
        $this->category = ucfirst($category);
        $this->description = $description;
        $this->video_id = $video_id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitile(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getVideo_id(): string
    {
        return $this->video_id;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'description' => $this->description,
            'video_id' => $this->video_id,
        ];
    }
}
