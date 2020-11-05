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
	/**
	 * Use this if you manually want to paste text into /src/prompt.txt file
	 */
	// $file = file_get_contents('./src/prompt.txt');
	// $file = trim($file);
	// $file = filter_var($file,FILTER_SANITIZE_SPECIAL_CHARS);
	
	if(!isset($_POST['input'])) {
		return;
	}
	$input = filter_var($_POST['input'],FILTER_SANITIZE_SPECIAL_CHARS);

	
	$url = 'https://api.openai.com/v1/engines/'.$ENGINE.'/completions';
	$response = $client->request('POST', $url, [
	    'headers' => [
			"Content-Type" => "application/json",
			"Authorization" => "Bearer " . $API_KEY,
    	],
    	'json' => [
    	  	"prompt" => $input, // Change this to $file if you want to paste in /src/prompt.txt
    	  	"max_tokens" => 100,
    	  	"temperature" => 0.9,
  			"top_p" => 1,
  			"presence_penalty" => 0,
  			"frequency_penalty" => 0,
  			"n" => 1,
  			"stream" => false,
  			"logprobs" => null,
  			"stop" => ["\n"]
    	]
	]);
	$contents = $response->getBody()->getContents();
	$contents = json_decode($contents, true);

	foreach ($contents['choices']  as $choices) {
		echo $choices['text'];
		// dd($choices);
	}
} catch (Exception $e) {
	echo $e->getMessage();
}


