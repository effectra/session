<?php

declare(strict_types=1);

namespace Effectra\Session;

use Effectra\Config\ConfigCookie;
use Effectra\Session\Contracts\SessionInterface;

/**
 * Class Session
 *
 * This class represents a session and provides methods for session management.
 */
class Session extends ConfigCookie implements SessionInterface
{

    /**
     * Starts the session.
     *
     * @throws SessionException If the session has already been started or if headers have already been sent.
     */
    public function start(): void
    {
        if ($this->isActive()) {
            throw new SessionException('Session has already been started');
        }

        if (headers_sent($fileName, $line)) {
            throw new SessionException('Headers have already been sent by ' . $fileName . ':' . $line);
        }

        session_set_cookie_params(
            [
                'secure'   => $this->getSecure(),
                'httponly' => $this->getHttpOnly(),
                'samesite' => 'lax'
            ]
        );

        if (!empty($this->getName())) {
            session_name($this->getName());
        }

        if (!session_start()) {
            throw new SessionException('Unable to start the session');
        }
    }

    /**
     * Saves and closes the session.
     */
    public function save(): void
    {
        session_write_close();
    }

    /**
     * Checks if the session is active.
     *
     * @return bool True if the session is active, false otherwise.
     */
    public function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Retrieves the value for the given key from the session.
     *
     * @param string $key     The key to retrieve the value for.
     * @param mixed  $default (optional) The default value to return if the key doesn't exist.
     *
     * @return mixed The value for the given key, or the default value if the key doesn't exist.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    /**
     * Checks if the given key exists in the session.
     *
     * @param string $key The key to check.
     *
     * @return bool True if the key exists, false otherwise.
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Regenerates the session ID.
     *
     * @return bool True on success, false on failure.
     */
    public function regenerate(): bool
    {
        return session_regenerate_id();
    }

    /**
     * Sets a value in the session for the given key.
     *
     * @param string $key   The key to set the value for.
     * @param mixed  $value The value to set.
     */
    public function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Removes the value for the given key from the session.
     *
     * @param string $key The key to remove.
     */
    public function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Sets a flash message in the session for the given key.
     *
     * @param string $key      The key to set the flash message for.
     * @param array  $messages The flash messages to set.
     */
    public function flash(string $key, array $messages): void
    {
        $_SESSION[$this->getPrefix()][$key] = $messages;
    }

    /**
     * Retrieves the flash message for the given key from the session.
     * The flash message is removed from the session after retrieval.
     *
     * @param string $key The key to retrieve the flash message for.
     *
     * @return array The flash message for the given key.
     */
    public function getFlash(string $key): array
    {
        $messages = $_SESSION[$this->getPrefix()][$key] ?? [];

        unset($_SESSION[$this->getPrefix()][$key]);

        return $messages;
    }
}
