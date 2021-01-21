<?php

namespace Pixney\StatamicInstagramUserFeed\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\Controller;
use Pixney\StatamicInstagramUserFeed\Feed\InstagramFeed;

class InstagramController extends Controller
{
    protected $instagramFeed;

    public function __construct()
    {
        $this->instagramFeed = new InstagramFeed();
    }

    /**
     * Return an instagram feed of posts by a user profile.
     *
     * @param Request $request
     * @return object
     */
    public function feed(Request $request) :object
    {
        $validated = $request->validate([
            'profile'       => 'required|string',
            'take'          => 'required|numeric|min:1|max:12',
            'expiration'    => 'required|numeric',
        ]);

        // Let's make sure the traffic comes from our own website
        if (config('statamic-instagram-user-feed.check_referer')) {
            $referer         = request()->headers->get('referer');
            $startWithAppUrl = starts_with($referer, config('app.url'));
            if (empty($referer) || !$startWithAppUrl) {
                abort(404);
            }
        }

        return $this->instagramFeed->getFeed($validated['profile'], (int)$validated['take'], (int) $validated['expiration']);
    }
}
