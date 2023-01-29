<!-- <?php
//session_start();

?>

<div id="response"></div>


<script type="text/javascript">
    setInterval (function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","response.php",false);
        xmlhttp.send(null);
        document.getElementById("response").innerHTML = xmlhttp.responseText;
    }, 1000);
</script> -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link href=
	"https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
		rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-1.10.2.js">
	</script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js">
	</script>

	<!-- Javascript -->
	<script>
		$(function () {
			$("#gfg").datepicker({
				// minDate: new Date(2022, 1 - 1, 1)
                minDate: 0
			});
		});
	</script>
</head>

<body>
	<h1>GeeksforGeeks</h1>
	<h3>jQuery UI Datepicker minDate Option</h3>

	<div>Enter Date: <input type="text" id="gfg" /></div>
</body>

</html>
