<?php

namespace Kouloughli\Announcements\Listeners;

use Illuminate\Support\Str;
use Kouloughli\Announcements\Events\Created;
use Kouloughli\Announcements\Events\Deleted;
use Kouloughli\Announcements\Events\Updated;
use Kouloughli\UserActivity\Logger;

class ActivityLogSubscriber
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $this->logger->log(__('announcements::log.created_announcement', [
            'id' => $event->announcement->id,
            'title' => Str::limit($event->announcement->title, 50)
        ]));
    }

    public function onUpdate(Updated $event)
    {
        $this->logger->log(__('announcements::log.created_announcement', [
            'id' => $event->announcement->id
        ]));
    }

    public function onDelete(Deleted $event)
    {
        $this->logger->log(__('announcements::log.deleted_announcement', [
            'id' => $event->announcement->id
        ]));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = self::class;

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
    }
}
