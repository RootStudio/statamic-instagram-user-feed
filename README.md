# Statamic Instagram Feed

## Quick Installation - Get going Directly!
Just like me, you probably just wanna get started as soon as possible, so let's
get to it!

You could use your real instagram account, but i recommend getting a dummy one
and use that.

Once you have your username and password to that instagram account, add those credentials
to your .env file: 

```
INSTAGRAM_USERNAME=
INSTAGRAM_PASSWORD=
```

Since you are already inside this file we might as well have a look at what other settings
that can be set here:

```
# The url used to get the feeds remember to start and end it with a slash.
INSTAGRAM_URL="/statamic-instagram-user-feed/"

# Control how the date is formatted
INSTAGRAM_DATE_FORMAT="Y-m-d H:i:s"

# Set the expiration time of the cache.
INSTAGRAM_EXPIRATION=3600

# Set how many posts should be fetched.
INSTAGRAM_TAKE=3
```

You don't have to add these settings yourself, the valued you see above are the
default ones already set for you.

**Important** The cache expiration and the value to take (number of posts) can
be set with the Antlers tag. It is handy if you want to show different feeds with
different settings.

Next up, install Alpine (under the hood we are just returning a json object with
all the data, so you can use whatever you like.), [check out their website with instructions
on how to do that](https://github.com/alpinejs/alpine). But since you just want to get
started quickly, paste this into your layout.antlers.html file in the head:

`<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>`

Finally add our tag wherever you want to display your instagram feed (**Important:** You must 
supply the profile of which feed you want to display):
`{{ statamic_instagram_user_feed profile="pixney" }}`

You are done.


## Tag Parameters

```
{{ statamic_instagram_user_feed profile="pixney" expiration="3600" take="3" }}
```

| Field       | Default Value | Description                                |
|-------------|---------------|--------------------------------------------|
| profile     | null          | Instagram profile name to get feed from.            |
| expiration  | 3600          | Number of seconds to cache the feed.                |
| take        | 3             | The number of posts to get (default:3,min:1,max:12) |


## Publish and Customize the view to your liking
Run this command to publish the view which is fully customisable `php artisan vendor:publish --tag=statamic-instagram-user-feed-views --force`

The simple example included is using Alpine and the Fetch API. But we are returning a normal json object which
means you can use any tools of your liking.

## Publish the configuration
You should not need to change anything to the configuration file, but it 
is possible by the following command : `php artisan vendor:publish --tag=statamic-instagram-user-feed-config --force`

## Roadmap

- Include instagram stories
- Write tests

## License

Before going into productions with Statamic Instagram User Feed, you need to buy a license at the Statamic Marketplace.

Statamic Instagram User Feed **is not** free software.


