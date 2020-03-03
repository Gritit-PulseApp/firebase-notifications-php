<?php

namespace Firebase\Notifications\Handler;

use Firebase\Notifications\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class BaseHandler
 * @package Firebase\Notifications\Handler
 * @author George Hallam
 */
abstract class BaseHandler
{
    const FIREBASE_SEND_URL = 'https://fcm.googleapis.com/fcm/send';

    protected $authorisationKey;
    protected $headers = [];
    protected $client;

    /**
     * FirebaseNotificationHandler constructor.
     * @param string $authorisationKey
     * @param array $headers
     */
    public function __construct($authorisationKey, array $headers = ['Content-Type' => 'application/json'])
    {
        $this->client = new Client();
        $this->authorisationKey = $authorisationKey;
        $this->headers = $headers;
        $this->setAuthHeader($authorisationKey);
    }

    /**
     * @param string $authorisationKey
     */
    abstract protected function setAuthHeader($authorisationKey);

    /**
     * @return string
     */
    abstract protected function getSendUrl();

    /**
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param Notification $notification
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send(Notification $notification)
    {
        $headers = $this->headers;
        $request = new Request('POST', $this->getSendUrl(), $headers, $notification->getNotificationPayload());
        return $this->client->send($request, ['timeout' => 1]);
    }
}
