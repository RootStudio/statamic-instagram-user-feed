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
        $profile     = $this->params->get('profile', 0);
        $take        = $this->params->get('take', config('statamic-instagram-user-feed.take'));
        $expiration  = $this->params->get('expiration', config('statamic-instagram-user-feed.expiration'));
        $url         = config('statamic-instagram-user-feed.url');
        $endPoint    = $this->makeEndPoint($url, $profile, $take, $expiration);

        return view('statamic-instagram-user-feed::statamic-instagram-user-feed', [
            'profile'       => $profile,
            'take'          => $take,
            'expiration'    => $expiration,
            'url'           => $url,
            'endpoint'      => $endPoint
        ])->render();
    }

    /**
     * Make our endpoint
     *
     * @param string $url
     * @param string $profile
     * @param integer $take
     * @param integer $expiration
     * @return string
     */
    private function makeEndPoint(string $url, string $profile, int $take, int $expiration): string
    {
        return "{$url}?profile={$profile}&take={$take}&expiration={$expiration}";
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
