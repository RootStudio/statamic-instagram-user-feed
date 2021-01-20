<?php

use Illuminate\Support\Facades\Route;
use Pixney\StatamicInstagramUserFeed\Http\Controllers\InstagramController;

Route::get(config('statamic-instagram-user-feed.url') . '{profile}/{take?}/{expiration?}', [InstagramController::class, 'feed']);
