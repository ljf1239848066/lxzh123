<?php
//获取URL字符串:
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//1.0 用parse_url解析URL
$arr = parse_url($url);

//2.0 将URL中的参数取出来放到数组里
$queryParts = explode('&',$arr['query']); 
$params = array();
$count=0;
$key="12345678";

foreach ($queryParts as $param) 
{ 
	$item = explode('=', $param);
	//$miwen=encrypt($item[1],$key);
	//$mingwen=decrypt($miwen,$key);
	$params[$count++] = $item[1]; 
} 
//echo $count;

if($count==3){
	$pwd=decrypt($params[0],$key);
	$cmd=decrypt($params[1],$pwd);
	$path=decrypt($params[2],$pwd);
	$text=$cmd."*".$path;
	//echo $pwd;
	//echo $cmd;
	//echo $path;
	
	$storage = new SaeStorage();
	$domain = 'lxzhfiles';
	$destFileName = 'cmd.txt';
	//$resul=$storage->delete($domain,$destFileName);
	$attr = array('encoding'=>'txt');
	$result = $storage->write($domain,$destFileName, $text, strlen($text));
	//echo $result;
	$text=$storage->read($domain,$destFileName);
	echo $text;
}

function do_mencrypt($input, $key)
{
	$input = str_replace("\n", "", $input);
	$input = str_replace("\t", "", $input);
	$input = str_replace("\r", "", $input);
	$key = substr(md5($key), 0, 24);
	$td = mcrypt_module_open('tripledes', '', 'ecb', '');
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	mcrypt_generic_init($td, $key, $iv);
	$encrypted_data = mcrypt_generic($td, $input);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return trim(chop(base64_encode($encrypted_data)));
}

function do_mdecrypt($input, $key)
{
	$input = str_replace("\n", "", $input);
	$input = str_replace("\t", "", $input);
	$input = str_replace("\r", "", $input);
	$input = trim(chop(base64_decode($input)));
	$td = mcrypt_module_open('tripledes', '', 'ecb', '');
	$key = substr(md5($key), 0, 24);
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	mcrypt_generic_init($td, $key, $iv);
	$decrypted_data = mdecrypt_generic($td, $input);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return trim(chop($decrypted_data));
}   

function encrypt($str, $key) {
	//加密，返回大写十六进制字符串
	$size = mcrypt_get_block_size (MCRYPT_DES, MCRYPT_MODE_CBC );
	$str = pkcs5Pad ( $str, $size );
	return strtoupper( bin2hex( mcrypt_cbc(MCRYPT_DES, $key, $str, MCRYPT_ENCRYPT, $key ) ) );
}

function decrypt($str, $key) {
	 //解密    
	$strBin = hex2bin( strtolower( $str ) );    
	$str = mcrypt_cbc( MCRYPT_DES, $key, $strBin, MCRYPT_DECRYPT, $key );  
	$str = pkcs5Unpad( $str );  
	return $str;  
}

function hex2bin($hexData) {  
	$binData = "";  
	for($i = 0; $i  < strlen ( $hexData ); $i += 2) {  
		$binData .= chr ( hexdec ( substr ( $hexData, $i, 2 ) ) );  
	}
	return $binData;
}

function pkcs5Pad($text, $blocksize) {
	$pad = $blocksize - (strlen ( $text ) % $blocksize);
	return $text . str_repeat ( chr ( $pad ), $pad );
}

function pkcs5Unpad($text) {
	$pad = ord ( $text {strlen ( $text ) - 1} );  
	if ($pad > strlen ( $text )) return false;

	if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)   return false;  

	return substr ( $text, 0, - 1 * $pad );
}

