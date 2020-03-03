<?php

namespace Firebase\Notifications\Handler;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class FirebaseNotificationHandler
 * @package Firebase\Notifications\Handler
 * @author George Hallam
 */
class CloudMessagingHandler extends BaseHandler
{
    const FIREBASE_SEND_URL = 'https://fcm.googleapis.com/v1/projects/myproject-b5ae1/messages:send';

    /**
     * @param string $authorisationKey
     */
    protected function setAuthHeader($authorisationKey)
    {
        $this->headers['Authorization'] = 'Bearer ' . $authorisationKey;
    }

    /**
     * @return string
     */
    protected function getSendUrl()
    {
        return static::FIREBASE_SEND_URL;
    }
}
