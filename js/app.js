$(document).ready(function(){

    $.ajax({

    	url:"http://localhost/roj/stat.php",
    	method:"GET",
    	success:function(data){
               //console.log(data);
               

               var verdicts=[];
               var ac=[];
               var wa=[];
               var tle=[];
               var obj;
               

              console.log(data);

              verdicts.push("User's Statistics");
              //verdicts.push("Wrong Answer");
              //verdicts.push("Time Limit Exceed");

              
              
              //console.log(data);
              

               
               	  
              ac.push(data[0].verdict);
              wa.push(data[1].verdict);
              tle.push(data[2].verdict);
                   //console.log(data[i].verdict);

               
               
               

               

               var chartdata={
               	    labels:verdicts,
               	    datasets:[
                      {
                      	  label:'AC',
                      	  backgroundColor:'green',
                      	  borderColor:'green',
                      	  hoverBackgroundColor:'green',
                      	  data:ac,
                      },
                      
                      {
                          label:'WA',
                          backgroundColor:'red',
                          borderColor:'red',
                          hoverBackgroundColor:'red',
                          data:wa,
                      },
                      
                      {
                          label:'TLE',
                          backgroundColor:'blue',
                          borderColor:'blue',
                          hoverBackgroundColor:'blue',
                          data:tle,
                      }



               	    ]
               };

               var ctx=$('#mycanvas');
               var barGraph=new Chart(ctx,{

                     type:'bar',
                     responsive:true,
                     data:chartdata

               });
    	},
    	error:function(data){
    		console.log(data);
    	}

    });

});