# Statamic Instagram Feed
This addon will allow you to fetch instagram feed and storied without Oauth. 

**Attention:** This addon is based on the following stable and popular package: 
[Instagram User Feed](https://github.com/pgrimaud/instagram-user-feed)

If for some reason it should stop working, so might this addon. Please keep that 
in mind before buying this addon. However, that package has been around for a while
and we have used it since 2018 without having any problems.


## Quick Start
You could use your real instagram account, but we recommend getting a dummy one
and use that.

### ENV Settings
Once you have your username and password, add those credentials to your .env file: 

```
INSTAGRAM_USERNAME=
INSTAGRAM_PASSWORD=
```

Below are the other **optional** settings you can make to your .env file.
**INSTAGRAM_EXPIRATION** & **INSTAGRAM_TAKE** can be set using the Antlers tag. It 
is handy if you want to show different feeds with different settings.

```
# The url used to get the feeds remember to start and end it with a slash.
INSTAGRAM_URL="/statamic-instagram-user-feed/"

# Control how the date is formatted
INSTAGRAM_DATE_FORMAT="Y-m-d H:i:s"

# Set the expiration time of the cache.
INSTAGRAM_EXPIRATION=3600

# Set how many posts should be fetched.
INSTAGRAM_TAKE=3

# Activate a check to make sure traffic comes from your own website
INSTAGRAM_CHECK_REFERER=true
```

*If you don't specify these, the default values shown will be used.*

### Add Alpine to your project
Don't worry, you don't **have to** use Alpine if you don't like. A simple JSON object
is returned to you, which means you can use whatever tool you like such as Vanilla Javascript,
Vue, React or whatever.

However, we wanted to get up and run quickly, so we added a default view for you which
included an Alpine implementation and the Fetch API. [Go to their website to see the best practices when it comes to installation.](https://github.com/alpinejs/alpine)

For now, let us add the following script tag to your layout file:

```html

 <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

```

Finally add our tag wherever you want to display your instagram feed (**Important:** You must 
supply the profile of whos feed you want to display):

`{{ statamic_instagram_user_feed profile="pixney" }}`

You are done and it should work!


## Tag Parameters

```
{{ statamic_instagram_user_feed profile="pixney" expiration="3600" take="3" }}
```

| Field       | Default Value | Description                                         |
|-------------|---------------|-----------------------------------------------------|
| profile     | null          | Instagram profile name to get feed from.            |
| expiration  | 3600          | Number of seconds to cache the feed.                |
| take        | 3             | The number of posts to get (default:3,min:1,max:12) |

## Available fields
| Field          | Description                                          |
|----------------|------------------------------------------------------|
| id             | Instagram Profile ID                                 |
| fullName       | Instagram Profile Full Name                          |
| biography      | Instagran Profile Biography                          |
| externalUrl    | Instamgram Profile Url                               |
| profilePicture | Instagram Profile Picture                            |
| feed           | Instagram Profile Feed (See available fields below)  | 

## Feed
| Field                  | Description                                          |
|------------------------|------------------------------------------------------|
| id                     | Feed Id                                              |
| width                  | Width of post image in pixels                        |
| height                 | Height of post image in pixels                       |
| displaySrc             | Post Image                                           |
| getThumbnailSrc        | Post Thumbnail Image                                 |
| date                   | Post Date                                            | 
| caption                | Post Caption                                         | 
| captionWithoutHashtags | Post Caption without hashtags                        | 
| comments               | Post Comments                                        | 
| likes                  | Post Likes                                           | 
| link                   | Post Link                                            | 
| location               | Location if set                                      | 
| hashtags               | Post Hashtags                                        | 


## Publish and Customize the view to your liking
Run the following command to publish a fully customizable view: `php artisan vendor:publish --tag=statamic-instagram-user-feed-views --force`

## Publish the configuration
You should not need to change anything to the configuration file, but it 
is possible by the following command : `php artisan vendor:publish --tag=statamic-instagram-user-feed-config --force`

## Alpine Helpers
If you love Alpine just like us, maybe you wanna continue using it. If that is the case, make sure you [checkout
the available helpers](https://github.com/alpine-collective/alpine-magic-helpers). Especially these two:

- [Truncate (if you want to show less of the caption)](https://github.com/alpine-collective/alpine-magic-helpers#truncate)
- [Fetch (if you want to change from Fetch API)](https://github.com/alpine-collective/alpine-magic-helpers#fetch)

## Roadmap

- Include instagram stories
- Add front end themes using Tailwind CSS
- Add more functionality and options
- Write tests

## License

Before going into productions with Statamic Instagram User Feed, you need to buy a license at the Statamic Marketplace.

Statamic Instagram User Feed **is not** free software.


