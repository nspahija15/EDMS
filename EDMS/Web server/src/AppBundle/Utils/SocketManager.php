<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.05.18
 * Time: 03:32
 */

namespace AppBundle\Utils;


class SocketManager
{

    public function __construct($_path,$socket_address,$socket_port)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        try {
            $this->result = socket_connect($this->socket, $socket_address, $socket_port);
        }catch (\Exception $e){
            $this->result = null;
        }
        $this->images_path = $_path;
    }


    private $socket;

    private $result;

    private $images_path;


    public function checkConnection(){

        if(!$this->result || !$this->socket)
            return false;

        return true;
    }

    public function closeSocket(){
        socket_shutdown($this->socket);
    }


    public function manageStudentsToCameraServer($mode,$name,$surname,$image_name) {
        
        if(!$this->checkConnection())
            return false;

        $msg = base64_encode("type:$mode;st_name:$name;st_surname:$surname;img_name:$image_name");

        try {
            socket_write($this->socket, $msg, strlen($msg));
            $this->closeSocket();
        }catch (\Exception $e){
            return false;
        }

        // $message = socket_read($this->socket,1024);

        // if($message!='success'){
        //     return false;
        // }

        if($mode === 'save') {
            $enc = $this->encodeImage($this->images_path . '/' . $image_name);

            socket_write($this->socket, $enc, strlen($enc));
//        $ts = chunk_split($enc,1024);
            $this->closeSocket();
        }

        return true;

    }


    public function requestLogs($files_mode){

        if(!$this->checkConnection())
            return false;


        $msg = base64_encode("date:$files_mode;type:logs");

        try {
            socket_write($this->socket, $msg, strlen($msg));
            $this->closeSocket();
        }catch (\Exception $e)
        {
            return false;
        }

//        $message = socket_read($this->socket,1024);
//        $message = base64_decode($message);
//        if($message!='success')
//            return false;

        return true;

    }


    private function encodeImage($image_path){
        $path = $image_path;
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        return $base64;
    }

}