<?php
declare(strict_types=1);

namespace App\Domain\Video;

use App\Domain\Video\Video;

interface VideoRepository
{
    /**
     * @return Video[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Video
     * @throws VideoNotFoundException
     */
    public function findVideoOfId(int $id): Video;
}
