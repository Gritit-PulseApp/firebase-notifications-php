<?php

namespace Firebase\Notifications\Handler;

use Firebase\Notifications\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class FirebaseNotificationHandler
 * @package Firebase\Notifications\Handler
 * @author George Hallam
 * @deprecated 
 * @see FirebaseCloudMessagingHandler
 */
class FirebaseNotificationHandler extends BaseHandler
{
    const FIREBASE_SEND_URL = 'https://fcm.googleapis.com/fcm/send';

    protected $authorisationKey;
    protected $headers = [];
    protected $client;

    /**
     * @param string $authorisationKey
     */
    public function setAuthHeader($authorisationKey)
    {
        $this->headers['Authorization'] = 'key=' . $authorisationKey;
    }

    /**
     * @return string
     */
    protected function getSendUrl()
    {
        return static::FIREBASE_SEND_URL;
    }

    /**
     * @param Notification $notification
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send($notification)
    {
        $headers = $this->headers;
        $request = new Request('POST', $this->getSendUrl(), $headers, $notification->getNotificationPayload());
        return $this->client->send($request, ['timeout' => 1]);
    }
}
