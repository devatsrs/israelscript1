<?php

class FTPGateway{


    public function __construct(){


        $host = getenv("REMOTE_HOST");
        $ssl = getenv("REMOTE_SSL");
        $user = getenv("REMOTE_USER");
        $pass = getenv("REMOTE_PASS");
        $port = getenv("REMOTE_PORT");
        $passive = getenv("REMOTE_PASSIVE");

        $production = array(
            'host'      => $host,
            'username'  => $user,
            'password'  => $pass,
            'key'       => '',
            'keyphrase' => '',
        );

        Config::set('remote.connections.production', $production);


    }


    public static function put($local_full_path, $server_full_path){

        //$status =  RemoteFacade::put($local_full_path, $server_full_path);

        $status = \Illuminate\Support\Facades\SSH::into('production')->put($local_full_path, $server_full_path);

        return $status;
    }

}