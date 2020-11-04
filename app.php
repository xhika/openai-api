<?php
require_once __DIR__ .'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;


/**
 * Api key from .env
 * @var string
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$API_KEY = $_ENV['API_KEY'];
$ENGINE = $_ENV['ENGINE_ID'];


/**
 * Post request to API
 */
try {
	$client = new Client();
	$file = file_get_contents('./src/prompt.txt');
	$url = 'https://api.openai.com/v1/engines/'.$ENGINE.'/completions';

	$response = $client->request('POST', $url, [
	    'headers' => [
			"Content-Type" => "application/json",
			"Authorization" => "Bearer " . $API_KEY,
    	],
    	'json' => [
    	  	"prompt" => $file,
    	  	"max_tokens" => 5,
    	  	"temperature" => 0.9,
  			"top_p" => 1,
  			"presence_penalty" => 0,
  			"frequency_penalty" => 0,
  			"n" => 1,
  			"stream" => false,
  			"logprobs" => null,
  			"stop" => "\n"
    	]
	]);
	
	$contents = $response->getBody()->getContents();
	$contents = json_decode($contents, true);

	foreach ($contents['choices']  as $choices) {
		echo $choices['text'];
	}
} catch (Exception $e) {
	echo $e->getMessage();
}



