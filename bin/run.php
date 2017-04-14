<?php


use Firebase\Notifications\Notification;

require __DIR__ . '/../vendor/autoload.php';


$key = 'AAAAvEuCGNA:APA91bHAYytlS2f0yhiHxji8njM4hm8ALzv63smka4ansE94yoUTkI0pPbCPwtBQFQcdqAVe2ZKWJGPkGoKjgOg34il3DSXQ2Z3EDfyvZagZm8NscvvNW3HSPnq4iEGNvdiMpecpEqOO';

$handler = new \Firebase\Notifications\Handler\FirebaseNotificationHandler($key);

$notification = new Notification();

$notification
    ->to('fzmIMSUIm0c:APA91bHbZxTdvQmgEEq6cPJ9-HZkSKcDXIJQ9pIvcQfSTW78bq7fV8aiBC4rCB-U7Stzos0kFH4sikGbQL9re_Z4bEMLlubdGLjypA9WMD-dTtRRwX8CX53Y3KMxKD7lPantsuHZOzFb')
    ->title('New notification class');

$handler->send($notification);