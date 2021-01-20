# Statamic Instagram Feed

## Quick Installation - Get going Directly!

Start off by creating a "dumb" instagram account and add it's credentials to your
.env file:

```
INSTAGRAM_USERNAME=
INSTAGRAM_PASSWORD=
```

You are also able to define the url to be used when retrieving the feed
(defaults to : **/statamic-instagram-user-feed/**)

```
INSTAGRAM_URL="/statamic-instagram-user-feed/"
```

Define default cache in seconds (defaults to 60 minutes)

```
INSTAGRAM_INSTAGRAM_EXPIRATION=3600
```

Define default posts to grab (defaults to 3 posts)

```
INSTAGRAM_TAKE=3
```

Define date format
```
INSTAGRAM_DATE_FORMAT="Y-m-d H:i:s"
```

### Install alpine js.

[Follow install instructions on the alpine website](https://github.com/alpinejs/alpine)

`<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>`

### Add the tag to your antlers view

`{{ instagram_feed profile="nummer.ett.ostersund" take="6" cache="86400" }}`

You are done.

## Available Tag properties

`profile`

`take`

`cache`

## Roadmap
- Write tests
## License

Before going into productions with Statamic Instagram User Feed, you need to buy a license at the Statamic Marketplace.

Statamic Instagram User Feed **is not** free software.

php artisan vendor:publish --tag=statamic-instagram-user-feed-views --force
php artisan vendor:publish --tag=statamic-instagram-user-feed-config --force
