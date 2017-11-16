<?php

Route::get('/',function(){
   return view('index');
});

Route::get('/users','ApiController@getUsers');


Route::post('/api/webhook/telegram/{token}','TelegramContoller@webhook');