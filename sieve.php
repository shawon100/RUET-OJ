<?php

$n=200000;

 $a=array();
 $p=array();

   
function sieve()
{
   $k=1;
   global $n;
   global $a;
   global $p;

    for($i=1;$i<=$n;$i++)
    {
    	$a[$i]=0;
    }

    for($i=1;$i<=$n;$i++)
    {
    	$p[$i]=0;
    }



        
	$a[0]=1;
	$a[1]=1;
    



	for($i=2;$i<=$n;$i=$i+2)
	{
		$a[$i]=1;
	}
	for($i=3;$i<=sqrt($n);$i=$i+2)
	{
		for($j=$i*$i; $j<=$n;$j=$j+$i*2)
		{
			$a[$j]=1;
		}
	}
	for($i=2;$i<=$n;$i++)
	{
		if($a[$i]== 0)
		{
			$p[$k]=$i;
			
			$k++;

		}
	}
}

sieve();

echo("Generated Prime Numbers (1 to n) By Sieve Algorithm <br><br>");

for($m=1;$m<=$n;$m++)
{

   if($p[$m]==0)
   {

      break;
      //error_reporting(0);
   }
   echo($p[$m]."<br>");
   

}





?>