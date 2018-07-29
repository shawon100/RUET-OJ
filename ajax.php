<!DOCTYPE html>
<html>
<head>
	<title>Ajax</title>
</head>
<body>
<h2>AJAX</h2>

<button type="button" onclick="loadDoc()">Request data</button>

<p id="demo"></p>
 
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "sieve.php", true);
  xhttp.send();
}
</script>

</body>
</html>