<?php

session_start();
require_once("config.php");

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['un']))
{
  header("Location:login.php");
}
if(isset($_SESSION['un']))
{
  $username=$_SESSION['un'];
}

$mysql="SELECT  status from user WHERE name='$username'";
$snd=mysqli_query($con,$mysql);
$arrow=mysqli_fetch_array($snd);

$st=$arrow['status'];

$access=0;


if($st=="Teacher" || $st=="Problem Setter" || $st=="Developer")
{
   $access=1;
}

?>

<!DOCTYPE html>
<html>
<head>
  
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Contest</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="img/ruet.png">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js" </script>
        <script src="bootstrap-3.3.7/js/bootstrap.js" </script>


        <script>
        // Set the date we're counting down to

        function call(d,val,st){

        //console.log(d);
        //console.log(val);
        //console.log(st);
        var countDownDate = new Date(d).getTime();
        var start =new Date(st).getTime();

        //console.log(start);

        var result;
       

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();
            
            // Find the distance between now an the count down date
            
            
           
           

            if(start>now)
            {

               var distance = start - now;

                // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);


              // Output the result in an element with id="demo"
              var result=days + "d " + hours + "h "
              + minutes + "m " + seconds + "s ";

              //console.log(result);

               document.getElementById(val).innerHTML = "Contest Countdown : "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            }
            else if(countDownDate>=now)
            {
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                 
                // Output the result in an element with id="demo"
                var result=days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

              //console.log(result);
                document.getElementById(val).innerHTML = "Running : "+ days + "d " + hours + "h "
               + minutes + "m " + seconds + "s " +" ";
            }
            
            // If the count down is over, write some text 
            else if (now>countDownDate) {
                clearInterval(x);
                document.getElementById(val).innerHTML = "Status : Finished";
            }


            
        }, 1000);

          return x;
        }


        </script>





</head>
<body>
<div class="main">
 <div class="row">
  <div class="col-sm-12">
  <nav class="shadow navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="navbar-brand lspace" href="home.php">RUET OJ</a>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
    <ul class="nav navbar-nav">
      <li class="space"><a href="compiler.php"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="contest.php"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="#"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
    </div>
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-10">
<div class="ctm"><h3 style="text-align:center;">All Contest</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>

<div class="row cspace">
<div class="col-sm-2">
</div>
<div class="col-sm-6 pbs">

<?php

require_once("connection.php");

date_default_timezone_set("Asia/Dhaka");

if(isset($_POST['cn']))
{

$contest=$_POST['cn'];
$cid=$_POST['ci'];
$date=$_POST['cd'];
$start=$_POST['ct'];
$end=$_POST['ce'];
$owner=$username;


$q1="INSERT into rapl_oj_contest  VALUES('$cid','$contest','$start','$end','$date','$owner')";
$q3="SELECT * FROM rapl_oj_contest ORDER BY date_on DESC";

/*$sq1=mysqli_query($con,$q1);*/
$sq2=mysqli_query($con,$q1);

if(!$sq2)
{
  echo "not";
}

$sq3=mysqli_query($con,$q3);

      $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";

      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
      



      $i=0;


      
   
  while($row=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];
      $nv=$row['start_at'];


      $i++;
      $demo="demo".$i;
      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

   ?>
      
    <script type="text/javascript">
    var end=<?php print json_encode($en);?>; 
    var val=<?php print json_encode($i);?>; 
    var nv=<?php print json_encode($nv);?>; 

    //console.log("Start" +nv);

    call(end,val,nv);


   </script>
      
    <?php

     if($access==1)
     {
         echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br><a href=\"editcontest.php?name=$row[cname]\">Edit</a><br><br></div>");
     }
     else
     {
          echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br></div>");

     }

   

/*while($row=mysqli_fetch_array($sq3))
{
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];

      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);

      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');
      

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

     


      

     
      


     
     
        if($row['date_on']==$d && $seconds>=0 && $ss>=0 )
        {
             echo("<div class=\"xm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br> Status: <b>Running</b> <br><br>Time Remaining:  $h hour $mt miniute $scnd second <br><br></div>");
         }
         else if($d>$row['date_on'] || ($d==$row['date_on'] && $t>$en))
         {
            echo("<div class=\"xm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date:  $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br>Status:<b>Finished</b><br><br></div>");
         }
         else
         {
            echo("<div class=\"xm\">Contest Name: $row[cname]<br><br>Contest ID: $row[id]<br><br>Contest Date:  $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br>Status:<b>Not Started Yet</b><br><br></div>");
         }*/
    }
}

if(isset($_POST['update']))
{

    

    $contest=$_POST['ucn'];
    $cid=$_POST['uci'];
    $date=$_POST['ucd'];
    $start=$_POST['uct'];
    $end=$_POST['uce'];




    $eft="UPDATE rapl_oj_contest SET cname='$contest',start_at='$start',end_at='$end',date_on='$date' WHERE  id=$cid";

    $sft=mysqli_query($con,$eft);


    if($sft)
    {

    $q3="SELECT * FROM rapl_oj_contest ORDER BY date_on DESC";
    $sq3=mysqli_query($con,$q3);

      $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";

      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
       


      $i=0;


      
   
  while($row=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];
      $nv=$row['start_at'];


      $i++;
      $demo="demo".$i;
      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

   ?>
      
    <script type="text/javascript">
    var end=<?php print json_encode($en);?>; 
    var val=<?php print json_encode($i);?>; 
    var nv=<?php print json_encode($nv);?>; 

    //console.log("Start" +nv);

    call(end,val,nv);


   </script>
      
    <?php
    

     if($access==1)
     {
         echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br><a href=\"editcontest.php?name=$row[cname]\">Edit</a><br><br></div>");
     }
     else
     {
          echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br></div>");

     }

      
    
    }

    }
    else
    {
       echo "Failed";
    }
}


if(isset($_POST['delete']))
{

   
    $contest=$_POST['ucn'];
    $cid=$_POST['uci'];
    $date=$_POST['ucd'];
    $start=$_POST['uct'];
    $end=$_POST['uce'];




    $efetch="DELETE FROM rapl_oj_contest WHERE id=$cid";
    $sendfetch=mysqli_query($con,$efetch);

    if($sendfetch)
    {

      $q3="SELECT * FROM rapl_oj_contest ORDER BY date_on DESC";
      $sq3=mysqli_query($con,$q3);

      $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";

      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
       


      $i=0;


      
   
  while($row=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];
      $nv=$row['start_at'];


      $i++;
      $demo="demo".$i;
      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

   ?>
      
    <script type="text/javascript">
    var end=<?php print json_encode($en);?>; 
    var val=<?php print json_encode($i);?>; 
    var nv=<?php print json_encode($nv);?>; 

    //console.log("Start" +nv);

    call(end,val,nv);


   </script>
      
    <?php
    

     if($access==1)
     {
         echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br><a href=\"editcontest.php?name=$row[cname]\">Edit</a><br><br></div>");
     }
     else
     {
          echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br></div>");

     }

      
    
    }

    }
    else
    {
       echo "Failed";
    }
}






if(!isset($_POST['cn']) && !isset($_POST['update']) && !isset($_POST['delete']))
{

    /*$q3="SELECT table_name FROM information_schema.tables where table_schema='problem' AND table_name<>'element'";*/

    $q3="SELECT * FROM rapl_oj_contest ORDER BY date_on DESC";
    $sq3=mysqli_query($con,$q3);

      $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";

      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
       


      $i=0;


      
   
  while($row=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];
      $nv=$row['start_at'];


      $i++;
      $demo="demo".$i;
      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

   ?>
      
    <script type="text/javascript">
    var end=<?php print json_encode($en);?>; 
    var val=<?php print json_encode($i);?>; 
    var nv=<?php print json_encode($nv);?>; 

    //console.log("Start" +nv);

    call(end,val,nv);


   </script>
      
    <?php
    

     if($access==1)
     {
         echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br><a href=\"editcontest.php?name=$row[cname]\">Edit</a><br><br></div>");
     }
     else
     {
          echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest ID: $row[id]<br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br><div id=$demo></div> <br><br></div>");

     }

      
    
    }

}







?>

</div>
<div class="col-sm-4">

</div>
</div>
</div>
</div><br><br><br>

<div class="area">
<div class="well foot">
<div class="row area">
<div class="col-sm-3">
</div>

<div class="col-sm-5">


<div class="">

<b>Beta Version-2016</b><br>
<b>Developed By Ashadullah Shawon</b>

</div>
</div>


<div class="col-sm-4">
<?php

require_once("time.php");

?>
</div>
</div>
</div>
</div>



</body>
</html>
