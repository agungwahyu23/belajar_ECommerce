<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir extends CI_Controller 
{
    private $api_key = 'f7ce1c4aaf5bab64c5cc1d433eb37c25';
    public function provinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array( CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => "",
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 30,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => "GET",
                                        CURLOPT_HTTPHEADER => array(
                                            "key: $this->api_key"
                                        ),
                        )              );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            // echo '<pre>';
            // print_r($array_response['rajaongkir']['results']);
            // echo '</pre>';
            $data_provinsi = $array_response['rajaongkir']['results'];
            foreach ($data_provinsi as $key => $value) {
                echo"<option value = '" . $value['province_id'] . "'>" . $value['province'] . "  </optoin>";
            }
        }
    }
}