<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Str;

Broadcast::channel(Str::slug(env('APP_NAME', 'laravel'), '_'). '_database_private-App.User.{id}', function ($user, $id) {
    return $user->hasRole(['admin']);
});

Broadcast::channel(Str::slug(env('APP_NAME', 'laravel'), '_') . '_database.{roomId}', function ($user, $roomId) {
    if ($user && $user->hasRole([$roomId])) {
        return ['id' => $user->id, 'name' => $user->name, 'role' => 'admin'];
    }

    return ['id' => $user->id, 'name' => 'guest', 'role' => 'guest'];

}, ['guards' => ['web', 'guest']]);

Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    return ['roomId' => $roomId];
});
