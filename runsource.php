<?php
//Import the SDK 
require_once("/path/sdk/index.php");



//Setting up the Hackerearth API
$hackerearth = Array(
		'client_secret' => '2a7b2db3e53f28d8dfef3192532018f91c73ee47', //(REQUIRED) Obtain this by registering your app at http://www.hackerearth.com/api/register/
        'time_limit' => '5',   //(OPTIONAL) Time Limit (MAX = 5 seconds )
        'memory_limit' => '262144'  //(OPTIONAL) Memory Limit (MAX = 262144 [256 MB])
	);

//Feeding Data Into Hackerearth API

$lang=$_POST['lan'];
$source=$_POST['code'];
$input=$_POST['input'];




$config = Array();
$config['time']='5';	 	//(OPTIONAL) Your time limit in integer and in unit seconds
$config['memory']='262144'; //(OPTIONAL) Your memory limit in integer and in unit kb
$config['source']=$source;    	//(REQUIRED) Your formatted source code for which you want to use hackerEarth api, leave this empty if you are using file
$config['input']=$input;     	//(OPTIONAL) formatted input against which you have to test your source code
$config['language']=$lang;  //(REQUIRED) Choose any one of the below
						 	// C, CPP, CPP11, CLOJURE, CSHARP, JAVA, JAVASCRIPT, HASKELL, PERL, PHP, PYTHON, RUBY

//Sending request to the API to compile and run and record JSON responses
$response = run($hackerearth,$config);     // Use this $response the way you want , it consists data in PHP Array
//Printing the response
//echo"<pre>".print_r($response,1)."</pre>";

$ch=1;
$str="";
if($response)
{
foreach ($response as $value) {

      if(isset($value['output']))
      {

         $str=$value['output'];

      

       
        if(error_reporting(1))
        {
          break;
        }
      }


      else
      {
                 echo "Compilation Error Or Submit Failed! Check Your Language And Submit Code Again.";
                 break;
                  
      }


     
      
     

     
}
}
else
{
          $ch=0;
          echo "Compilation Error Or Submit Failed! Check Internet Connection And Submit Code Again.";
}

if($ch==1)
{
  echo "$str";
}




?>