<?php
declare(strict_types=1);

namespace App\Application\Actions\Video;

use Psr\Http\Message\ResponseInterface as Response;

class ListVideoAction extends VideoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $video = $this->videoRepository->findAll();

        $this->logger->info("Video list was viewed.");

        return $this->respondWithData($video);
    }
}
