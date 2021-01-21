<?php

namespace Pixney\StatamicInstagramUserFeed\Http\Controllers;

use Statamic\Http\Controllers\Controller;
use Pixney\StatamicInstagramUserFeed\Feed\InstagramFeed;

class InstagramController extends Controller
{
    protected $instagramFeed;

    public function __construct()
    {
        $this->instagramFeed = new InstagramFeed();
    }

    public function feed(string $profile, ?int $take=null, ?int $expiration=null)
    {
        return $this->instagramFeed->getFeed($profile, $take, $expiration);
    }
}
