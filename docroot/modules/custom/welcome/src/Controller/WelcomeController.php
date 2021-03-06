<?php

namespace Drupal\welcome\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WelcomeController.
 *
 * @package Drupal\welcome\Controller
 */
class WelcomeController extends ControllerBase {
  /**
   * Welcome.
   *
   * @return string
   *   Return Hello string.
   */
  public function welcome() {
    $title = "The Social Network";
    $url_title = urlencode($title);
    $siteUrl = "http://www.omdbapi.com/?t=$url_title";
    $client = \Drupal::httpClient();
    $request = $client->get($siteUrl);
    $response = $request->getBody();
    $json_data = json_decode($request->getBody());
    kint($json_data);
    $imdbID = $json_data->imdbID;
    $imbd_url = "http://www.imdb.com/title/$imdbID";


    return [
      '#type' => 'markup',
      '#markup' => $this->t("$imbd_url")
    ];
  }

}
