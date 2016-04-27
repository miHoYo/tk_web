<?php
 
namespace Weixin\Controller;
 
use Think\Controller;
 
/**
 * 定义微信链接TOKEN
 */
define("TOKEN", "xcoderstudio");
 
class IndexController extends Controller {
 
    public function index() {
        $echoStr = $_GET["echostr"];
 
        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }
 
    private function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
 
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
 
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}
?>
