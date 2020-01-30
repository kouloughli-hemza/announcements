<?php

namespace Kouloughli\Announcements\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Kouloughli\Announcements\Announcement;

class Deleted
{
    use Dispatchable;

    public $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }
}
