<?php

Route::post(config('app.webhook-url'),'TelegramContoller@webhook');