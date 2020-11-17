<?php
declare(strict_types=1);

namespace App\Domain\Video;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VideoNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The video you requested does not exist.';
}
