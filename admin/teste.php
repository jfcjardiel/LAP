<!DOCTYPE html>
<html>
<body>

<div id="demo">
<h1>The XMLHttpRequest Object</h1>
<button type="button" onclick="loadDoc()">Change Content</button>
</div>
<div id="oi"> </div>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("oi").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "register_success.php", true);
  xhttp.send();
}
</script>

</body>
</html>
