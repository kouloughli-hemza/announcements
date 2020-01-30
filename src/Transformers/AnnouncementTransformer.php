<?php

namespace Kouloughli\Announcements\Transformers;

use League\Fractal\TransformerAbstract;
use Kouloughli\Announcements\Announcement;
use Kouloughli\Transformers\UserTransformer;

class AnnouncementTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Announcement $announcement)
    {
        return [
            'id' => (int) $announcement->id,
            'user_id' => (int) $announcement->user_id,
            'title' => $announcement->title,
            'body' => $announcement->body,
            'parsed_body' => (string) $announcement->parsed_body,
            'created_at' => (string) $announcement->created_at,
            'updated_at' => (string) $announcement->updated_at,
        ];
    }

    public function includeUser(Announcement $announcement)
    {
        return $this->item($announcement->creator, new UserTransformer);
    }
}
