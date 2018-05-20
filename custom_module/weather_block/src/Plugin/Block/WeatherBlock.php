<?php

namespace Drupal\weather_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use GuzzleHttp\Exception\ClientException;

/**
 * Provides a 'WeatherBlock' block.
 *
 * @Block(
 *  id = "weather_block",
 *  admin_label = @Translation("Weather block"),
 * )
 */
class WeatherBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $client = \Drupal::httpClient();
    $url = 'http://api.openweathermap.org/data/2.5/weather?id=4463523&appid=17944aa71a109929d3da70d9e6451d4f';
    $contents = '';

    try {
      $request = $client->get($url);
      $response = $request->getBody()->getContents();
      $response = json_decode($response, TRUE);

      $temp = !empty($response['main']['temp']) ? $response['main']['temp'] : 0;
      $conditions = !empty($response['weather'][0]['main']) ? $response['weather'][0]['main'] : '';

      $contents = 'Current weather in Denver: <br>';
      $contents .= 'Temperature: ' . $temp . '° Kelvin<br>';
      $contents .= 'Conditions: ' . $conditions;

    } catch (ClientException $e) {
      $contents = 'Call to OpenWeatherMap API failed';
    }


    $build = [];
    $build['weather_block']['#markup'] = $contents;

    return $build;
  }

}
