<?php

namespace Pixney\StatamicInstagramUserFeed\Http\Controllers;

use Statamic\Http\Controllers\Controller;
use Pixney\StatamicInstagramUserFeed\Feed\Instagram;

class InstagramController extends Controller
{
    protected $instagram;

    public function __construct()
    {
        $this->instagram = new Instagram();
    }

    public function feed(string $profile, ?int $take=null, ?int $expiration=null)
    {
        return $this->instagram->getFeed($profile, $take, $expiration);
    }
}
