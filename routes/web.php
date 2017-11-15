<?php

Route::get('/',function(){
   return view('index');
});

Route::post('/api/webhook/telegram/{token}','TelegramContoller@webhook');