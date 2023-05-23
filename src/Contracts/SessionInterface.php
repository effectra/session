<?php declare(strict_types=1);

namespace Effectra\Session\Contracts;

/**
 * Interface SessionInterface
 *
 * This interface defines the contract for session management.
 */
interface SessionInterface
{
    /**
     * Start the session.
     *
     * @return void
     */
    public function start(): void;

    /**
     * Save the session data.
     *
     * @return void
     */
    public function save(): void;

    /**
     * Check if the session is active.
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Get the value associated with the given key from the session.
     *
     * @param string $key     The key to retrieve the value for.
     * @param mixed  $default The default value to return if the key is not found.
     *
     * @return mixed The value associated with the key, or the default value if the key is not found.
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Regenerate the session ID.
     *
     * @return bool True if regeneration is successful, false otherwise.
     */
    public function regenerate(): bool;

    /**
     * Store a value in the session.
     *
     * @param string $key   The key to store the value under.
     * @param mixed  $value The value to store.
     *
     * @return void
     */
    public function put(string $key, mixed $value): void;

    /**
     * Remove the value associated with the given key from the session.
     *
     * @param string $key The key to remove.
     *
     * @return void
     */
    public function forget(string $key): void;

    /**
     * Check if a value exists in the session for the given key.
     *
     * @param string $key The key to check for.
     *
     * @return bool True if the key exists, false otherwise.
     */
    public function has(string $key): bool;

    /**
     * Flash an array of messages to the session.
     *
     * @param string $key      The key to store the messages under.
     * @param array  $messages The messages to flash.
     *
     * @return void
     */
    public function flash(string $key, array $messages): void;

    /**
     * Retrieve the flashed messages from the session for the given key.
     *
     * @param string $key The key to retrieve the messages for.
     *
     * @return array The array of flashed messages.
     */
    public function getFlash(string $key): array;
}
