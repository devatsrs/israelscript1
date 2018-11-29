<?php

/**
 * Created by PhpStorm.
 * User: DEVEN
 * Date: 29-11-2018
 * Time: 04:36 PM
 */
class RemoteServer
{

    const SSH = "SSH";
    const FTP = "FTP";

    public static function put($local_full_path, $server_full_path){


        if(getenv("REMOTE_TYPE") == self::FTP){

            (new FTPSGateway())->put($local_full_path, $server_full_path);

        }else if(getenv("REMOTE_TYPE") == self::SSH){

            (new FTPGateway())->put($local_full_path, $server_full_path);

        }

    }

}