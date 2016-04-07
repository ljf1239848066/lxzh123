<?php
	//»ñÈ¡URL×Ö·û´®:
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	$arr = parse_url($url);

	$queryParts = explode('&',$arr['query']); 
	$params = array();
	$count=0;
	$key="12345678";

	foreach ($queryParts as $param) 
	{ 
		$item = explode('=', $param);
		$params[$count++] = $item[1]; 
	} 
	$storage = new SaeStorage();
	$domain = 'lxzhfiles';
	$destFileName = 'cmd.txt';
	$text="";
	//echo $count;
	if($count==1){
		//echo $params[0];
		if($params[0]=="read"){
			$text=$storage->read($domain,$destFileName);
			echo $text;
		}else if($params[0]=="clear"){
			$result = $storage->write($domain,$destFileName, $text, strlen($text));
		}else if($params[0]=="cmdlist"){
			$destFileName = 'cmdlist.txt';
			$text=$storage->read($domain,$destFileName);
			echo $text;
		}
	}else if($count>1){
		if($params[0]=="add"){
			$destFileName = 'cmdlist.txt';
			$text=$storage->read($domain,$destFileName);
			$m=0;
			for($i=1;$i<$count;$i++){
				$tmp=$params[$i];
				if(strpos( $text,$tmp)!==false){
					
				}else{
					$text=$text."-";
					$text=$text.$tmp;
					$m++;
				}
			}
			if($m>0){
				$result = $storage->write($domain,$destFileName, $text, strlen($text));
			}
		}
	}
