
<script src="js/vendor/moment.min.js"></script>
<script> 
     function set(){

         document.getElementById('tx').innerHTML="<b>Server Time : "+ moment().format('h:mm:ss a') +"</b>";
         var t=setTimeout(set,1000);
      }
      

     
</script>


<body onload="set()">
<div class="area">
<div class="well foot">
<div class="row area">
<div class="col-sm-3">
<!-- BEGIN: Powered by Supercounters.com -->
<center><script type="text/javascript" src="http://widget.supercounters.com/online_i.js"></script><script type="text/javascript">sc_online_i(1360839,"ffffff","e61c1c");</script><br><noscript><a href="http://www.supercounters.com/">Free Online Counter</a></noscript>
</center>
<!-- END: Powered by Supercounters.com -->

</div>

<div class="col-sm-5">


<div class="">

<b>Beta Version-2016</b><br>
<b>Developed By Ashadullah Shawon</b>

</div>
</div>


<div class="col-sm-4">

<div id="tx"></div>

</div>
</div>
</div>
</div>
</body>