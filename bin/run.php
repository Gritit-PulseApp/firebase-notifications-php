<?php


use Firebase\Notifications\Notification;

require __DIR__ . '/../vendor/autoload.php';


$key = 'AAAAvEuCGNA:APA91bHAYytlS2f0yhiHxji8njM4hm8ALzv63smka4ansE94yoUTkI0pPbCPwtBQFQcdqAVe2ZKWJGPkGoKjgOg34il3DSXQ2Z3EDfyvZagZm8NscvvNW3HSPnq4iEGNvdiMpecpEqOO';

$handler = new \Firebase\Notifications\Handler\FirebaseNotificationHandler($key);

$notification = new Notification();

$notification
    ->to('d6Y6yFyL-nU:APA91bGRU8l1zo5skKC-5MnFcAb2fw3dWjnMoZMPtYoHQpQTifEIPSlcm6iTEK6rx-2I9pX2T4KDeu0i78NxACer-ZGU5qaD8zRfB67Bpp1OtWJggr6sQieO4rM94b83ARbSlOY7P9Wa')
    ->title('New notification class')
    ->body('Nice big body')
    ->icon('https://pbs.twimg.com/profile_images/1831635783/Cat_Icon_smaller_400x400.jpg')
    ->data(['some' => 'data']);

$handler->send($notification);