<?php

Route::get('/',function(){
   return view('index');
});

Route::get('/users','ApiController@getUsers');
Route::post('/users/send','ApiController@send');
Route::post('/users/delete','ApiController@delete');



Route::post('/api/webhook/telegram/{token}','TelegramContoller@webhook');