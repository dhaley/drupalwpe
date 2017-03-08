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


    // try {
    //   kint($siteUrl);
    //   // $res = $client->get($siteUrl, ['http_errors' => false]);
    //   $response = $client->get($siteUrl);
    //   kint($response);
    //   $content = $response->getBody();
    //   kint($content);
    //   // $output = $client->getBody();
    //   // return $response->json();

    //   // kint($output);
    // //   return($res->getStatusCode());
    // } catch (RequestException $e) {
    //   return($this->t('Error'));
    // }

    // $json_data = json_decode($res);
    // $imdbID = $json_data->imdbID;

    return [
      '#type' => 'markup',
      // '#markup' => $this->t('Implement method: welcome')
      '#markup' => $this->t("$imbd_url")
    ];
  }

}
