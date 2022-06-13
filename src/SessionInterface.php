<?php

declare(strict_types=1);

namespace Firehead996\SessionHelper;

interface SessionInterface extends \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * Check if a session variable exists under given key
     *
     * @param string $key
     *
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * Get session variable stored under given key
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Store variable in session under given key
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function set(string $key, mixed $value): void;

    /**
     * Delete session variable stored under given key
     *
     * @param string $key
     *
     * @return void
     */
    public function delete(string $key): void;

    /**
     * Clear all variables stored in session
     * 
     * @return void
     */
    public function clear(): void;
}