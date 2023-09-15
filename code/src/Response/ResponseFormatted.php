<?php

namespace myproject\Response;

/**
 * A formatted response.
 */
abstract class ResponseFormatted extends Response {

  const DEFAULT_FORMATTER = 'json';

  /**
   * {@inheritdoc}
   */
  public function code() : int {
    return 200;
  }

  /**
   * {@inheritdoc}
   */
  public function remember() : bool {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function printBody() {
    $this->formatter()
      ->print($this->body());
  }

  /**
   * Return the body in array format, to be formatted.
   *
   * @return array
   *   The body in array format.
   */
  abstract public function body() : array;

  /**
   * Get a formatter.
   *
   * @return \myproject\Formatter\FormatterInterface
   *   A forrmatter.
   */
  public function formatter() {
    return $this
      ->formatterFactory()
      ->fromName($this->request->getParam('format', self::DEFAULT_FORMATTER));
  }

}
