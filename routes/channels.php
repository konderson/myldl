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
Broadcast::channel('messages.{id}', function ($user, $id) {

    return (int) $user->id ==(int) $id;

});

Broadcast::channel('delmessage.{id}', function ($user, $id) {

    return (int) $user->id ==(int) $id;

});
Broadcast::channel('read.{id}', function ($user, $id) {

    return (int) $user->id ==(int) $id;

});
Broadcast::channel('typingevent',function ($user){
    return Auth::check();
});