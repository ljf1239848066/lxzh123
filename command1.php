<?php
#������ַ:     http://localhost/blog/testurl.php?id=5

//��ȡ������������ַ 
echo $_SERVER['HTTP_HOST']."<br>"; #localhost

//��ȡ��ҳ��ַ 
echo $_SERVER['PHP_SELF']."<br>"; #/blog/testurl.php

//��ȡ��ַ���� 
echo $_SERVER["QUERY_STRING"]."<br>"; #id=5

//��ȡ�û����� 
echo $_SERVER['HTTP_REFERER']."<br>"; 

//��ȡ������url
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
#http://localhost/blog/testurl.php?id=5

//�����˿ںŵ�����url
echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
#http://localhost:80/blog/testurl.php?id=5

//ֻȡ·��
$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
echo dirname($url);
#http://localhost/blog