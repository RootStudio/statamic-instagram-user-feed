<?php

namespace Pixney\StatamicInstagramUserFeed\Tags;

use Statamic\Tags\Tags;

class StatamicInstagramUserFeed extends Tags
{
    /**
     * The {{ statamic_instagram_user_feed }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        return view('statamic-instagram-user-feed::statamic-instagram-user-feed', [
            'profile'       => $this->params->get('profile', 0),
            'take'          => $this->params->get('take', config('statamic-instagram-user-feed.take')),
            'expiration'    => $this->params->get('expiration', config('statamic-instagram-user-feed.expiration')),
            'url'           => config('statamic-instagram-user-feed.url')
        ])->render();
    }

    /**
     * The {{ instagram_feed:example }} tag.
     *
     * @return string|array
     */
    public function example()
    {
        //
    }
}
