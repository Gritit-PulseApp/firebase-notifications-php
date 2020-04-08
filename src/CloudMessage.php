<?php

namespace Firebase\Notifications;

use Firebase\Notifications\Exceptions\NotificationParameterException;

class CloudMessage implements BaseMessage
{
    const TARGET_TOKEN = 'token';
    const TARGET_TOPIC = 'topic';
    const TARGET_CODITION = 'condition';

    /**
     * @var string[]
     */
    protected $validTargets = [
        self::TARGET_TOKEN,
        self::TARGET_TOPIC,
        self::TARGET_CODITION,
    ];

    /**
     * @var array
     */
    protected $message;

    /**
     * @var bool
     */
    protected $targetSet = false;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $to
     * @param string $target
     * @return static $this
     */
    public function to($to, $target = self::TARGET_TOKEN)
    {
        if (!in_array($target, $this->validTargets)) {
            throw new NotificationParameterException(
                'Invalid target: ' . $target . ', please use one of: ' . implode(',', $this->validTargets)
            );
        }

        //Only allowed one target see: https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
        foreach ($this->validTargets as $validTarget) {
            unset($this->message[$validTarget]);
        }

        $this->targetSet = true;
        $this->message[$target] = $to;
        return $this;
    }

    /**
     * @param array $data
     * @return static $this
     */
    public function data(array $data)
    {
        $this->message['data'] = $data;
        return $this;
    }

    /**
     * @param array $data
     * @return static $this
     */
    public function notification(array $notification)
    {
        $this->message['notification'] = $notification;
        return $this;
    }

    /**
     * @param array $android
     * @return static $this
     */
    public function android(array $android)
    {
        $this->message['android'] = $android;
        return $this;
    }

    /**
     * @return array
     * @throws NotificationParameterException
     */
    public function getMessage()
    {
        if (false === $this->targetSet) {
            throw new NotificationParameterException(
                'No target set, please use one of: ' . implode(',', $this->validTargets)
            );

        }
        return [
            'message' => $this->message,
        ];
    }

    /**
     * @return string
     * @throws NotificationParameterException
     */
    public function getMessagePayload()
    {
        return \GuzzleHttp\json_encode($this->getMessage());
    }
}
