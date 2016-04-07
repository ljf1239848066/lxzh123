<?php
mysql_connect("115.239.229.249","a1007225618","67912333");
mysql_select_db("a1007225618");
  $q=mysql_query("SELECT * subwayservice WHERE birthyear");
  while($e=mysql_fetch_assoc($q))
        $output[]=$e; 
print(json_encode($output)); 
mysql_close();
?>