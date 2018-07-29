<?php
//Import the SDK 
require_once __DIR__.'\path\sdk\index.php';

//Setting up the Hackerearth API
$hackerearth = Array(
		'client_secret' => '2a7b2db3e53f28d8dfef3192532018f91c73ee47', //(REQUIRED) Obtain this by registering your app at http://www.hackerearth.com/api/register/
        'time_limit' => '5',   //(OPTIONAL) Time Limit (MAX = 5 seconds )
        'memory_limit' => '262144'  //(OPTIONAL) Memory Limit (MAX = 262144 [256 MB])
	);

//Feeding Data Into Hackerearth API
$config = Array();
$config['time']='5';	 	//(OPTIONAL) Your time limit in integer and in unit seconds
$config['memory']='262144'; //(OPTIONAL) Your memory limit in integer and in unit kb
$config['source']='#include <bits/stdc++.h>
using namespace std;
int main()
{
  int a,b;

  while(1)
  {
  	
  	 cin>>a>>b;
  	 if(a==0 && b==0)
  	 {
  	 	break;
  	 }
     cout<<a+b<<endl;
  }
 
  printf("Hello Shawon");
  return 0;


}';    	//(REQUIRED) Your properly formatted source code for which you want to use hackerEarth api
$config['input']='1 2 5 6 7 8 0 0';     	//(OPTIONAL) Properly Formatted Input against which you have to test your source code, leave this empty if you are using file
$config['language']='CPP';   //(REQUIRED) Choose any one of the below
						 	// C, CPP, CPP11, CLOJURE, CSHARP, JAVA, JAVASCRIPT, HASKELL, PERL, PHP, PYTHON, RUBY

//Sending request to the API to compile and run and record JSON responses
$response = compile($hackerearth,$config); // Use this $response the way you want , it consists data in PHP Array
//Printing the response
echo"<pre>".print_r($response,1)."</pre>";
?>