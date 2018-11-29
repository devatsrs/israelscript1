<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestingCommand extends Command {



	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'tempcommand';

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

		$did = "2222222";
		$rangeDate1 = '2018-11-01 10:00:00';
		$rangeDate2 = '2018-11-02 11:00:00';

		//$recordingfiles = Cdr::get_by_did($did,$rangeDate1,$rangeDate2);
		//$recordingfiles = json_decode(json_encode($recordingfiles),true);


		$full_localpath = RecordingFile::get_full_path("2018-11-02 11:00:00","rec4.log");



		$full_localpath = RecordingFile::get_full_path("2018-11-02 11:00:00","rec4.log.txt");

		$this->info( getenv("RECORDING_FILE_LOCATION1") . '/' . basename($full_localpath) );
		$this->info( $full_localpath);

		RemoteServer::put( getenv("RECORDING_FILE_LOCATION1") . '/' . basename($full_localpath) , $full_localpath );

		//print_r($recordingfiles);

	}




}
