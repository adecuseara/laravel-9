<?php

namespace App\Services;

use App\Utilities\Contracts\RedisHelper;

class RedisService
{
    private RedisHelper $redisHelper;

    public function __construct(RedisHelper $redisHelper)
    {
        $this->redisHelper = $redisHelper;
    }

    /**
     * Store recent messages into redis
     *
     * @param array $storedEmails
     *
     * @return void
     */
    public function store(array $storedEmails): void
    {
        foreach ($storedEmails as $data) {
            $this->redisHelper->storeRecentMessage($data['id'], $data['messageSubject'], $data['toEmailAddress']);
        }
    }
    /**
     * Get cached by key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->redisHelper->get($key);
    }
    /**
     * Flush redis cache
     *
     * @return void
     */
    public function clear(): void
    {
        $this->redisHelper->clear();
    }
}
