<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateUser extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create user for authorization.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
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
		try
		{
			$username = $this->argument('username');
			$email = $this->argument('email');
			$password = $this->option('password') ?: Str::random(6);
			$activated = $this->confirm('Activating user? Y/n', true);

		    // Create the user
		    $user = Sentry::createUser(compact('username', 'email', 'password', 'activated'));
		}
		catch (Exception $e)
		{
			$this->error($e->getMessage());
		}

		$this->info($username.' has created.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('username', InputArgument::REQUIRED, 'Authorization username.'),
			array('email', InputArgument::REQUIRED, 'User email address.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('password', null, InputOption::VALUE_OPTIONAL, 'Generating 6 random strings if not supplied.', null),
			array('email', null, InputOption::VALUE_OPTIONAL, 'User email.', null),
		);
	}

}
