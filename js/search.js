function $(uid){return document.getElementById(uid);}
function  searchB()  
{  
	var s= $("searchGroupInput");
	s.name="word";
    document.searchGroupForm.action="http://www.baidu.com/baidu";  
    document.searchGroupForm.submit();            
}  
function  searchG()  
{ 
	var s= $("searchGroupInput");
	s.name="q";
    document.searchGroupForm.action="http://www.google.com.hk/search";  
	document.searchGroupForm.method="get";
    document.searchGroupForm.submit();           
} 