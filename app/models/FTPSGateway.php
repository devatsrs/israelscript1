<?php



class FTPSGateway{

    var $config = array();
    var $ftp  = "";

    var $DEFAULT_FILENAME = ".csv";

    var $DEFAULT_GATEWAYNAME = "FTP";

    public function __construct(){

        $this->ftp = new \FtpClient\FtpClient();

        $host = getenv("REMOTE_HOST");
        $ssl = getenv("REMOTE_SSL");
        $user = getenv("REMOTE_USER");
        $pass = getenv("REMOTE_PASS");
        $port = getenv("REMOTE_PORT");
        $passive = getenv("REMOTE_PASSIVE");

        $this->ftp->connect($host, boolval($ssl), $port);
        if($this->ftp->login($user,$pass)) {
            if($passive){
                $this->ftp->pasv(true);
            }
        }
   }


    public function put($local_full_path, $server_full_path){

        $dirname = dirname($server_full_path);

        $this->ftp->mkdir($dirname , true);
        $this->ftp->chmod(0777, $dirname);

        $status = $this->ftp->put($local_full_path, $server_full_path, FTP_ASCII  );

        return $status;
    }

}