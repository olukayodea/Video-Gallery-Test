<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class LoginUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        // $userId = (string) $this->resolveArg('username');
        $userId = $data['username'];
        $user = $this->userRepository->loginUserOfId($userId);

        $this->logger->info("User of username `${userId}` was viewed.");

        return $this->respondWithData($user);
    }
}
