<?php

namespace Drupal\custom_http_client;

use GuzzleHttp\Client;

/**
 * Class ClientFactory.
 *
 * @package Drupal\custom_http_client
 */
class ClientFactory {

  /**
   * Return a configured Client object.
   */

  public function get() {
    $config = [
      'base_uri' => 'https://example.com',
    ];

    $client = new Client($config);

    return $client;
  }


  /**
   * Return a configured Client object.
   */
  /**
   * GuzzleHttp\Client definition.
   *
   * @var GuzzleHttp\Client
   */
  protected $custom_http_client_client;

  public function __construct(
    Client $custom_http_client_client
  ) {
    parent::__construct();
    $this->custom_http_client_client = $custom_http_client_client;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_http_client.client')
    );
  }


}
