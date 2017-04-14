# Firebase notifications php

Wraps the curl methods to send notifications to firebase

Example usage

```
$key = 'FIREBASE_SERVER_KEY';

$handler = new \Firebase\Notifications\Handler\FirebaseNotificationHandler($key);

$notification = new Notification();

$notification
    ->to('DEVICE_ID')
    ->title('Awesome title')
    ->body('Nice big body')
    ->icon('http://link-to-resource.jpg')
    ->data(['some' => 'data']);

$handler->send($notification);
```