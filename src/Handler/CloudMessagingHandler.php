<?php

namespace Firebase\Notifications\Handler;

use Firebase\Notifications\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class FirebaseNotificationHandler
 *
 * @package Firebase\Notifications\Handler
 * @author George Hallam
 */
class CloudMessagingHandler extends BaseHandler
{
    const FIREBASE_SEND_URL = 'https://fcm.googleapis.com/v1/projects/{{project-id}}/messages:send';

    /**
     * @var string
     */
    protected $projectName;

    /**
     * CloudMessagingHandler constructor.
     *
     * @param string $projectName
     * @param string $authorisationKey
     * @param array  $headers
     */
    public function __construct($projectName, $authorisationKey, array $headers = ['Content-Type' => 'application/json'])
    {
        $this->projectName = $projectName;
        parent::__construct($authorisationKey, $headers);
    }

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
        return str_replace('{{project-id}}', $this->projectName, static::FIREBASE_SEND_URL);
    }
}
