<?php

return [
    'username'        => env('INSTAGRAM_USERNAME'),
    'password'        => env('INSTAGRAM_PASSWORD'),
    'url'             => env('INSTAGRAM_URL', '/statamic-instagram-user-feed/'),
    'expiration'      => env('INSTAGRAM_EXPIRATION', 3600),
    'take'            => env('INSTAGRAM_TAKE', 3),
    'date_format'     => env('INSTAGRAM_DATE_FORMAT', 'Y-m-d'),
];
