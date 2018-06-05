<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Files;
use AppBundle\Exceptions\PageNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServerManageController extends Controller
{

    /**
     * @Route("/report/server", name="get_camera_info")
     */
    public function getDataAction(Request $request)
    {
            
        if($request->get('enc')=== md5("Te kam sjelle nje mesazh nga serveri!") ){

            $data = $request->get('data');
            // // if there are files

            $key = $this->container->getParameter('conn_key');

            $dec_data = $this->decrypt_3des($data, $key);

            return new Response("The text was received");
                            // return new JsonResponse();
            
        }



        // check if it was an image sent from the server
        if($request->get('enc')=== md5('Te kam sjelle nje foto!!')) {

            $files  = $request->files->all();

            $img_name = $this->saveTheImage($files['file']);

            $data_ts = new Files();
            $data_ts->setName($img_name);
//            $data_ts->setDate(date('yyyy-MM-dd hh:mm',new \DateTime('now')));
            $data_ts->setDate(new \DateTime('now'));
            $data_ts->setType('image');

            $em = $this->getDoctrine()->getManager();

            $em->persist($data_ts);
            $em->flush();

            return new Response(var_dump($files['file']));

        }



        if($request->get('enc')=== md5('Te kam sjelle nje log!!')) {

            /** @var UploadedFile $files */
            $files  = $request->files->all()['file'];

            $file_name = $request->get('filename');

            $em = $this->getDoctrine()->getManager();

            $files = $em->getRepository('AppBundle:Files')->searchFilesByName($file_name);

            $this->saveTheLogs($files,$file_name);


            if(count($files)===0) {
                $data_ts = new Files();
                $data_ts->setName($file_name);


                $data_ts->setDate(new \DateTime('now'));

                $data_ts->setType('log');

                $em->persist($data_ts);
                $em->flush();

            }else if(count($files)===1){

                $data_ts = $files[0];
                $data_ts->setDate(new \DateTime('now'));

                $em->persist($data_ts);
                $em->flush();


            }


            return new Response(var_dump($files['file']));

        }


        throw new PageNotFoundException("This page does not exists");

    }


    private function saveTheLogs(UploadedFile $file,$fileName){
        if(file_exists($this->getParameter('logs_dir').'/'.$fileName))
            unlink($this->getParameter('logs_dir').'/'.$fileName);

        $file->move(
            $this->getParameter('logs_dir'),
            $fileName
        );

        return $fileName;
    }



    private function saveTheImage($image){

        $imageName = $this->generateUniqueFileName().'.'.$image->guessExtension();

        $image->move(
            $this->getParameter('unathorizedPeople_images_directory'),
            $imageName
        );

        return $imageName;
        
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


    private function encrypt_3des($clear_text, $key) {
        $encrypt_text = openssl_encrypt($clear_text, "DES-EDE3", $key, OPENSSL_RAW_DATA, "");

        $data = base64_encode($encrypt_text);

        return $data;
    }

    
    private function decrypt_3des($data, $key) {
        $encrypt_text = base64_decode($data);

        $clear_text = openssl_decrypt($encrypt_text, "DES-EDE3", $key, OPENSSL_RAW_DATA, "");

        return $clear_text;
    }


}

