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
     * @param string $title
     * @return Notification $this
     */
    public function title($title)
    {
        $this->notification['notification']['title'] = $title;
        return $this;
    }

    /**
     * @param string $body
     * @return Notification $this
     */
    public function body($body)
    {
        $this->notification['notification']['body'] = $body;
        return $this;
    }

    /**
     * @param string $icon
     * @return Notification $this
     */
    public function icon($icon)
    {
        $this->notification['notification']['icon'] = $icon;
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
        if (!isset($this->notification['notification']['title'])) {
            throw new NotificationParameterException('Missing \'title\' value');
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