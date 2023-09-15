<?php

namespace myproject\traits;

/**
 * Wrapper around elements external to the application logic.
 */
trait Environment {

  /**
   * Mockable wrapper around getenv(), with exception handling.
   *
   * @param string $name
   *   Name of the environment variable.
   * @param bool $required
   *   Whether the environment variable is required or not.
   *
   * @return string
   *   The value of the environment variable.
   *
   * @throws \Exception
   */
  public function getEnv(string $name, bool $required = TRUE) : string {
    $return = getenv($name);
    if (!$return && $required) {
      throw new \Exception('Please make sure the environment variable ' . $name . ' is set.');
    }
    return (string) $return;
  }

  /**
   * Wrapper around the global $_GET array.
   */
  public function globalGet() : array {
    // @codingStandardsIgnoreStart
    return $_GET;
    // @codingStandardsIgnoreEnd
  }

  /**
   * Wrapper around the global $_POST array.
   */
  public function globalPost() : array {
    // @codingStandardsIgnoreStart
    return $_POST;
    // @codingStandardsIgnoreEnd
  }

  /**
   * Mockable wrapper around scandir(), with exception handling.
   *
   * @param string $directory
   *   Path to a directory.
   *
   * @return array
   *   List of files.
   *
   * @throws \Exception
   */
  public function scanDir(string $directory) : array {
    $candidates = @scandir($directory);
    $return = [];
    if (!is_array($candidates)) {
      throw new \Exception('Could not scan directory ' . $directory);
    }
    foreach ($candidates as $candidate) {
      if (!in_array($candidate, ['.', '..'])) {
        $return[] = $candidate;
      }
    }
    return $return;
  }

  /**
   * Mockable wrapper around print().
   */
  public function print($string) {
    print($string);
  }

}
