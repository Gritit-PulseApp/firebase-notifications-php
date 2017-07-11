<?php

namespace Firebase\Notifications;

use Firebase\Notifications\Exceptions\NotificationParameterException;

/**
 * Class Notification
 * @package Firebase\Notifications
 * @author George Hallam
 */
class Notification
{

    protected $notification;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Notification constructor.
     * @param array $notification
     */
    public function __construct(array $notification = [])
    {
        $this->notification = $notification;
    }

    /**
     * @param string $to
     * @return Notification $this
     */
    public function to($to)
    {
        $this->notification['to'] = $to;
        return $this;
    }

    /**
     * @param array $data
     * @return Notification $this
     */
    public function data(array $data)
    {
        $this->notification['data'] = $data;
        return $this;
    }

    /**
     * @return array
     * @throws NotificationParameterException
     */
    public function getNotification()
    {
        if (!isset($this->notification['to'])) {
            throw new NotificationParameterException('Missing \'to\' value');
        }
        return $this->notification;
    }

    /**
     * @return string
     * @throws NotificationParameterException
     */
    public function getNotificationPayload()
    {
        return \GuzzleHttp\json_encode($this->getNotification());
    }

}