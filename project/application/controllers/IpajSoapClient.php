<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class IpajSoapClient extends CI_Controller {

    private $wsdl, $client;

    public function __construct() {
        parent::__construct();
        global $wsdl, $client;

        $this->load->library("Nusoap_lib");
        $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
        $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
        $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
        $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

        $wsdl = base_url() . 'SOAP/IpajSoapServer?wsdl';
        $client = new nusoap_client($wsdl, 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        }
    }

    public function index($func = NULL) {
        global $wsdl, $client;

        try {
            switch ($func) {
                case 'InfoPartida':
                    $result = $client->call('InfoPartida', array("ID"=>$_GET['id']), '', '', false, true);
                    //handle errors
                    if ($client->fault) {
                        //check faults
                        echo $client->getError();
                    } else {
                        //handle errors
                        echo $result;
                    }
                    break;

                case 'ApostaJogo':
                    if (isset($_GET['value'])){
                        $value = $_GET['value'];
                    }else{
                        $value = NULL;
                    }
                    $param  = array(
                            'ID'       => $_GET['id'],
                            'username' => $_GET['username'],
                            'password' => $_GET['password'],
                            'jogada'   => $_GET['play'],
                            'valor'    => $value
                        );
                    $result = $client->call("ApostaJogo", $param,  '', '', false, true);
                    //handle errors
                    if ($client->fault) {
                        //check faults
                        echo $client->getError();
                    } else {
                        //handle errors
                        echo $result;
                    }
                    break;

                default:
                    echo '<h2>Função Inexistente</h2><pre>';
                    echo '</pre>';
                    break;
            }
        } catch (SoapFault $exception) {
            echo $exception;
        }

        // echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        // echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        //echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>'; //this generates a lot of text!
    }

}
