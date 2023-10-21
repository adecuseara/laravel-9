<?php

namespace App\Utilities\Contracts;

interface RedisHelper
{
    /**
     * Store the id of a message along with a message subject in Redis.
     *
     * @param  mixed  $id
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     *
     * @return void
     */
    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void;

    /**
     * Retrieve data from cache.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key): mixed;

    /**
     * Clear all cache data.
     *
     * @return void
     */
    public function clear(): void;
}
