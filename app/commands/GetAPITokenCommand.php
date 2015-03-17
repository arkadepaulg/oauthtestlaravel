<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetAPITokenCommand extends Command
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'api:token:get';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Requests an access token from the API.';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

			$client = new GuzzleHttp\Client();


			$api_url    = 'http://localhost:8000';
			$client_id  = 'abcd1234';
			$secret     = '1234';
			$redirect   = 'http://localhost:8000/reflect';


			$scope      = 'master_all'; // Use only the first available scope.
			$state      = rand(1, 1000000);

			$res = $client->get(
				$api_url . '/api/v1/oauth/authorize',
				[
					'query' => [
						'client_id'     => $client_id,
						'redirect_uri'  => $redirect,
						'response_type' => 'code',
						'scope'         => $scope,
						'state'         => $state,
					]
				]
			);

			//$this->line("Authorize Status Code: " . $res->getStatusCode() . " " . $res->getReasonPhrase());


			$reply = $res->json();
			$code = $reply['code'];

			//$this->line("The code retrieved is " . $code);



			$res = $client->post(
				$api_url . '/api/v1/oauth/access-token',
				[
					'body' => [
						'grant_type' => 'authorization_code',
						'client_id' => $client_id,
						'client_secret' => $secret,
						'redirect_uri' => $redirect,
						'code' => $code,
						'scope' => $scope,
					]
				]
			);




			$reply = $res->json();

			var_dump($reply);

			$access_token = $reply['access_token'];

			$this->line("---------------------------");
			$this->line("Generating Access Token.");
			$this->line("Your access token is: ");
			$this->line("");
			$this->line($access_token);
			$this->line("");
			$this->line("You may use this access token for 1 hour. Your scope is: ".$scope.". ");
			$this->line("");
			sleep(1);
			echo ".";
			sleep(1);
			echo ".";
			sleep(1);
			echo ".";
			sleep(1);
			echo "*sound of bubbling water*";
			sleep(1);
			echo ".";
			sleep(1);
			echo ".";
			sleep(1);
			echo "nice.";
			sleep(1);

			$this->line("");
			$this->line("---------------------------");

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		];
	}

}