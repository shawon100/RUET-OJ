
<script src="js/vendor/moment.min.js"></script>
<script> 
     function set(){

         document.getElementById('tx').innerHTML="<b>Server Time : "+ moment().format('h:mm:ss a') +"</b>";
         var t=setTimeout(set,1000);
      }
      

     
</script>


<body onload="set()">

<script> 
     function set(){

     
     

         //document.getElementById('tx').innerHTML= hour + ":" + min +":" + sec;
         document.getElementById('tx').innerHTML="<b>Server Time : "+ moment().format('h:mm:ss a') +"</b>";
         var t=setTimeout(set,1000);
      }
      

     
</script>

<div id="tx"></div>
</body>