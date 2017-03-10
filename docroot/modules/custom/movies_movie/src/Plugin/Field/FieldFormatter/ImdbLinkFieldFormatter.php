<?php

namespace Drupal\movies_movie\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Plugin implementation of the 'imdb_link_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "imdb_link_field_formatter",
 *   label = @Translation("IMDB Link"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class ImdbLinkFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $title = "The Social Network";
    $url_title = urlencode($title);
    $siteUrl = "http://www.omdbapi.com/?t=$url_title";
    $client = \Drupal::httpClient();
    $request = $client->get($siteUrl);
    $response = $request->getBody();
    $json_data = json_decode($request->getBody());
    $imdbID = $json_data->imdbID;
    $imbd_url = "http://www.imdb.com/title/$imdbID";

    // Just in case, sanitize entered URL.
    $url =  UrlHelper::filterBadProtocol($imbd_url);

    foreach ($items as $delta => $item) {
      $elements[$delta] = array('#markup' => $this->t("$url"));
      // $movie = $item->getEntity();
    }
    return $elements;
  }

}
