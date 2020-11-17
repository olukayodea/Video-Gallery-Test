<?php
declare(strict_types=1);

namespace App\Application\Actions\Video;

use Psr\Http\Message\ResponseInterface as Response;

class ViewVideoAction extends VideoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $videoId = (int) $this->resolveArg('id');
        $video = $this->videoRepository->findVideoOfId($videoId);

        $this->logger->info("Video of id `${videoId}` was viewed.");

        return $this->respondWithData($video);
    }
}
