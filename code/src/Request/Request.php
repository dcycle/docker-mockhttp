<?php

namespace myproject\Request;

/**
 * A request.
 */
class Request implements RequestInterface {

  /**
   * The get parameters.
   *
   * @var array
   */
  protected $get;

  /**
   * The post parameters.
   *
   * @var array
   */
  protected $post;

  /**
   * Constructor.
   *
   * @param array $get
   *   The get parameters.
   * @param array $post
   *   The post parameters.
   */
  public function __construct(array $get, array $post) {
    $this->get = $get;
    $this->post = $post;
  }

  /**
   * {@inheritdoc}
   */
  public function path() : string {
    return '/' . $this->getParam('_mockhttp_path', '');
  }

  /**
   * Get a parameter from $_GET.
   *
   * @param string $name
   *   The name of the parameter.
   * @param string $default
   *   The default value if there is no value.
   *
   * @return string
   *   The value, or default.
   */
  public function getParam(string $name, string $default = '') : string {
    return $this->param($this->get, $name, $default);
  }

  /**
   * {@inheritdoc}
   */
  public function toStruct() : array {
    $return['get'] = $this->sorted($this->get);
    $return['post'] = $this->sorted($this->post);
    return $return;
  }

  /**
   * Sort elements in an array.
   */
  public function sorted(array $array) {
    ksort($array);
    return $array;
  }

  /**
   * Get a parameter from $_POST.
   *
   * @param string $name
   *   The name of the parameter.
   * @param string $default
   *   The default value if there is no value.
   *
   * @return string
   *   The value, or default.
   */
  public function postParam(string $name, string $default = '') : string {
    return $this->param($this->post, $name, $default);
  }

  /**
   * Get a parameter from an arbitrary array.
   *
   * @param array $params
   *   The array of params.
   * @param string $name
   *   The name of the parameter.
   * @param string $default
   *   The default value if there is no value.
   *
   * @return string
   *   The value, or default.
   */
  public function param(array $params, string $name, string $default = '') : string {
    return array_key_exists($name, $params) ? $params[$name] : $default;
  }

}
