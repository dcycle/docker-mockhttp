<?php

namespace myproject\MockResponse;

use myproject\Request\RequestInterface;
use myproject\Response\ResponseInterface;
use myproject\traits\DependencyInjection;
use myproject\traits\Environment;
use myproject\traits\Singleton;

/**
 * MockResponse factory.
 */
class MockResponseFactory {

  use DependencyInjection;
  use Environment;
  use Singleton;

  const MOCK_REQUEST_DIR = '/example-responses';

  /**
   * Makes a formatter object from a formatter name.
   *
   * @param \myproject\Request\RequestInterface $request
   *   A request.
   *
   * @return null|\myproject\Response\ResponseInterface
   *   A response, if possible.
   */
  public function getIfExists(RequestInterface $request) {
    try {
      $subdirs = $this->scandir(self::MOCK_REQUEST_DIR);
      foreach ($subdirs as $subdir) {
        if ($candidate = $this->getIfMatches($request, $subdir)) {
          return $candidate;
        }
      }
    }
    catch (\Throwable $t) {
      $message = $t->getMessage();
      if (!str_starts_with($message, 'Could not scan directory')) {
        print_r($t->getMessage() . ' ' . $t->getFile() . ':' . $t->getLine());
      }
      return NULL;
    }
  }

  /**
   * Get the contents of the subdirectory.
   */
  public function fileContents(string $subdir) : string {
    $extensions = [
      'html',
      'json',
      'css',
      'js',
    ];

    $base = self::MOCK_REQUEST_DIR . '/' . $subdir . '/response.';

    foreach ($extensions as $extension) {
      $candidate = $base . $extension;

      if (file_exists($candidate)) {
        return file_get_contents($candidate);
      }
    }

    throw new \Exception('No file is present for ' . $base . '/*');
  }

  /**
   * Makes a formatter object from a formatter directory if it matches.
   *
   * @param \myproject\Request\RequestInterface $request
   *   A request.
   * @param string $subdir
   *   A subdirectory.
   *
   * @return null|\myproject\Response\ResponseInterface
   *   A response, if possible.
   */
  public function getIfMatches(RequestInterface $request, string $subdir) {
    $ymlAsString = file_get_contents(self::MOCK_REQUEST_DIR . '/' . $subdir . '/info.yml');

    $parsed = yaml_parse($ymlAsString);

    $candidate = $this
      ->requestFactory()
      ->fromGetAndPost($parsed['get'], array_key_exists('post', $parsed) ? $parsed['post'] : []);

    if ($candidate->toStruct() == $request->toStruct()) {
      return new MockResponse($request, $parsed, $this->fileContents($subdir));
    }

    return NULL;
  }

}
