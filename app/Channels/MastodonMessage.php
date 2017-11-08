<?php

namespace App\Channels;

class MastodonMessage
{
    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $domain;

    /**
     * @var string
     */
    public $token;

    /**
     * MastodonMessage constructor.
     *
     * @param string $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public static function create($status)
    {
        return new static($status);
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function status($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $domain
     *
     * @return $this
     */
    public function domain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function token($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'domain' => $this->domain,
            'token'  => $this->token,
            'status' => $this->status,
        ];
    }
}
