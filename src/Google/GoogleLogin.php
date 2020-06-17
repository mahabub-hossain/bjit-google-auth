<?php
namespace BJIT\Google;

class GoogleLogin
{
    protected $config;
    protected $client_id;
    protected $client_secret;
    Protected $redirect_url;
    protected $auth_url = "https://accounts.google.com/o/oauth2/v2/auth";
    protected $accesstoken_url = "https://accounts.google.com/o/oauth2/token";
    public function __construct($config)
    {
        $this->config = $config;
        $this->client_id = $config['google']['app_id'];
        $this->client_secret = $config['google']['app_secret'];
        $this->redirect_url = $config['google']['callback'];
    }

    //Getting url for user permission
    public function getUrl(){
        $url = $this->auth_url.'?scope=openid&include_granted_scopes=true&access_type=offline&response_type=code&client_id='.$this->client_id.'&redirect_uri='.$this->redirect_url;
        return $url;
    }
    //This will provide  access tokent with expiry time
    public function getAccesstoken($code){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->accesstoken_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id=".$this->client_id."&client_secret=".$this->client_secret."&code=".$code."&redirect_uri=".$this->redirect_url,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }

    //After expiry time will get new access token
    public function getRefreshtoken($refreshtoken){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->accesstoken_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=refresh_token&client_id=".$this->client_id."&client_secret=".$this->client_secret."&refresh_token=".$refreshtoken,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }
}