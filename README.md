# Effectra Session 

The `Session` class represents a session and provides methods for session management.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Methods](#methods)
- [Example](#example)

## Installation

You can install the `Session` class via Composer by running the following command:

```
composer require effectra/session
```

## Usage

To use the `Session` class, you need to include it in your PHP file:

```php
require_once 'vendor/autoload.php';

use Effectra\Session\Session;

// Create a new instance of the Session class
$session = new Session();

// Start the session
$session->start();

// Use session methods to manage session data
// ...

// Save and close the session
$session->save();
```

## Methods

The `Session` class provides the following methods:

- `start()`: Starts the session.
- `save()`: Saves and closes the session.
- `isActive()`: Checks if the session is active.
- `get(string $key, mixed $default = null)`: Retrieves the value for the given key from the session.
- `has(string $key): bool`: Checks if the given key exists in the session.
- `regenerate(): bool`: Regenerates the session ID.
- `put(string $key, mixed $value)`: Sets a value in the session for the given key.
- `forget(string $key)`: Removes the value for the given key from the session.
- `flash(string $key, array $messages)`: Sets a flash message in the session for the given key.
- `getFlash(string $key): array`: Retrieves the flash message for the given key from the session.

## Example

Here's an example of how to use the `Session` class:

```php
// Create a new instance of the Session class
$session = new Session();

// Start the session
$session->start();

// Set a value in the session
$session->put('username', 'john_doe');

// Get a value from the session
$username = $session->get('username');

// Check if a key exists in the session
if ($session->has('username')) {
    // Do something
}

// Regenerate the session ID
$session->regenerate();

// Set a flash message in the session
$session->flash('success', ['Logged in successfully!']);

// Retrieve and display the flash message
$successMessage = $session->getFlash('success');
echo $successMessage[0];

// Save and close the session
$session->save();
```
