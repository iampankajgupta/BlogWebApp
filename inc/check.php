<!DOCTYPE html>
<html>
<head>
	<title>Check</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div id = "loadData"><h1>Something</h1></div>
	<button id = "link">Click Me</button>
	<script type="text/javascript">
		$(document).ready(function(event){
			$('#link').click(function(){
				$.get('this.php',function(data,status){
					$('#loadData').html(data);
					alert(status);
				});
			})
		});
	</script>

</body>
</html>