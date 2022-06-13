<?php

declare(strict_types=1);

namespace Firehead996\SessionHelper;

class SessionHelper implements SessionInterface
{
    /**
     * {@inheritdoc}
     */
    public function exists(string $key): bool {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Magic method for exists
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return $this->exists($key);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, mixed $default = null): mixed {
        return $this->exists($key) ? $_SESSION[$key] : $default;
    }

    /**
     * Magic method for get
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get(string $key): mixed
    {
        return $this->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }

    /**
     * Magic method for set
     *
     * @param string $key
     * @param mixed $value
     */
    public function __set(string $key, mixed $value): void
    {
        $this->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $key): void {
        if (!$this->exists($key))
            return;

        unset($_SESSION[$key]);
    }

    /**
     * Magic method for delete
     *
     * @param string $key
     */
    public function __unset(string $key): void
    {
        $this->delete($key);
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $_SESSION = [];
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return count($_SESSION);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        return new \ArrayIterator($_SESSION);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        $this->delete($offset);
    }
}