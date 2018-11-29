<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ScriptCommand extends Command {

	//protected $remoteBasePath = '/Aamar/write';
	//protected $baseLocalPath='E:\\Aamar\\Projects\\neon\\Support\\read';


	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ScriptCommand';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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

		$this->info("Start");

		$arguments = $this->argument();

		$did = $arguments["did"];
		$rangeDate1= $arguments["rangeDate1"];
		$rangeDate2= $arguments["rangeDate2"];

		$this->info("Start" . $did);
		$this->info('rangeDate1 ' . $rangeDate1);
		$this->info('rangeDate2 ' . $rangeDate2);

		$recordingfiles = Cdr::get_by_did($did,$rangeDate1,$rangeDate2);

		$recordingfiles = json_decode(json_encode($recordingfiles),true);

		$this->info("File found " . count($recordingfiles));

		foreach($recordingfiles as $recordingfile) {

				$full_localpath = RecordingFile::get_full_path($recordingfile["calldate"],$recordingfile["recordingfile"]);

				RemoteServer::put($full_localpath, getenv("RECORDING_FILE_LOCATION2") . '/' . basename($full_localpath));


				$this->info("File copied" . $full_localpath );

		}

		$this->info("All File Copied");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('did', InputArgument::REQUIRED, 'An example argument.'),
			array('rangeDate1', InputArgument::REQUIRED, 'An example argument.'),
			array('rangeDate2', InputArgument::OPTIONAL, ''),
		);
	}


}
