<?php

namespace Pixney\StatamicInstagramUserFeed\Feed;

use Instagram\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class InstagramFeed
{
    /**
     * Instagram API
     */
    protected $api;

    /**
     * Instagram Profile to fetch feed from
     */
    protected string $profile;

    /**
     * Number of posts to retrieve
     */
    protected ?int $take;

    /**
     * Cache response for this number of seconds
     */
    protected ?int $expiration;

    /**
     * Our cache key
     */
    protected string $cacheKey;

    public function __construct()
    {
        $cachePool       = new FilesystemAdapter('instagram', 0, config('cache.stores.file.path'));
        $this->api       = new Api($cachePool);
    }

    /**
     * Make sure we have username and password set.
     *
     * @return boolean
     */
    private function verifyCredentials() :bool
    {
        if (empty(config('statamic-instagram-user-feed.username')) || empty(config('statamic-instagram-user-feed.password'))) {
            return false;
        }

        return true;
    }

    /**
     * Define how many posts from the feed to retrieve
     *
     * @param integer|null $nr
     * @return void
     */
    private function setTake(?int $nr) :void
    {
        $this->take = (is_null($nr)) ? config('statamic-instagram-user-feed.take') : $nr;
    }

    /**
     * Set for how long we should cache the feed
     *
     * @param integer|null $expiration
     * @return void
     */
    private function setExpiration(?int $expiration) :void
    {
        $this->expiration = (is_null($expiration)) ? config('statamic-instagram-user-feed.cache') : $expiration;
    }

    /**
     * Set the profile to fetch the feed from
     *
     * @param string $profile
     * @return boolean
     */
    private function setProfile(string $profile) :bool
    {
        if (!$profile || empty($profile)) {
            return false;
        }

        $this->profile = $profile;

        return true;
    }

    /**
     * Remove hashtags from the caption
     *
     * @param string $string
     * @return string
     */
    public function removeHashtagsFrom(string $string) :string
    {
        $re = '/#([\p{Latin}0-9_]*)/u';

        return preg_replace($re, '', $string);
    }

    /**
     * Create cache key from profile and cache expiration
     *
     * @return string
     */
    private function setCacheKey() :void
    {
        $this->cacheKey = md5($this->take . $this->profile . $this->expiration);
    }

    /**
     * Get instagram user feed
     *
     * @param string $profile
     * @param integer|null $take
     * @param integer|null $expiration
     * @return object
     */
    public function getFeed(string $profile, ?int $take, ?int $expiration) :object
    {
        $this->setTake($take);
        $this->setExpiration($expiration);

        if (!$this->verifyCredentials() || !$this->setProfile($profile)) {
            return response()->json(['data'  => 'Missing profile or no credentials set.'], 400);
        }

        $this->setCacheKey();

        if (Cache::has($this->cacheKey) && $this->expiration > 0) {
            return response()->json([
                'data'  => Cache::get($this->cacheKey),
            ], 200);
        }

        try {
            $this->api->login(config('statamic-instagram-user-feed.username'), config('statamic-instagram-user-feed.password'));
            $profile = $this->api->getProfile($this->profile);
            //$feedStories = $this->api->getStories($profile->getId());
            $feed = $this->makeFeed(collect($profile->getMedias()))->take($this->take);

            $output = [
                'id'             => $profile->getId(),
                'fullName'       => $profile->getFullName(),
                'biography'      => $profile->getBiography(),
                'externalUrl'    => $profile->getExternalUrl(),
                'profilePicture' => $profile->getProfilePicture(),
                'feed'           => $feed
            ];

            Cache::put($this->cacheKey, $output, $this->expiration);

            return response()->json(['data' => $output, ], 200);
        } catch (\Throwable $th) {
            Log::error('Statamic Instagram User Feed Error:' . $th->getMessage() . "\n" . $th->getTraceAsString());
            return response()->json(['data' => $th->getMessage()], 500);
        }
    }

    /**
     * Transform our media collection
     *
     * @param \Illuminate\Support\Collection $medias
     * @return \Illuminate\Support\Collection
     */
    protected function makeFeed(\Illuminate\Support\Collection $medias)
    {
        return $medias->transform(function ($media) {
            $location = '';

            if ($media->getLocation()) {
                $location = $media->getLocation()->name;
            }

            return [
                'id'                               => $media->getId(),
                'width'                            => $media->getWidth(),
                'height'                           => $media->getHeight(),
                'displaySrc'                       => $media->getDisplaySrc(),
                'getThumbnailSrc'                  => $media->getThumbnailSrc(),
                'date'                             => $media->getDate()->format(config('statamic-instagram-user-feed.date_format')),
                'caption'                          => $media->getCaption(),
                'captionWithoutHashtags'           => $this->removeHashtagsFrom($media->getCaption()),
                'comments'                         => $media->getComments(),
                'likes'                            => $media->getLikes(),
                'link'                             => $media->getLink(),
                'location'                         => $location,
                // 'video'                            => $media->getVideo(),
                // 'videoViewCount'                   => $media->getVideoViewCount(),
                'hashtags'                         => $media->getHashtags()
            ];
        });
    }
}
