# Firebase notifications php

Wraps the curl methods to send notifications to firebase

Example usage

```
$key = 'FIREBASE_SERVER_KEY';

$handler = new \Firebase\Notifications\Handler\FirebaseNotificationHandler($key);

$notification = new Notification();

$notification
    ->to('DEVICE_ID')
    ->title('Awesome title');

$handler->send($notification);
```