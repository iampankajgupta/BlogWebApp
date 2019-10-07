<html>
<head>
<title></title>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
</head>
<body>
    <div class="d flex ">
    <label for="Category">Category:</label>
<select class="js-example-basic-multiple" " name="states[]" multiple="multiple">
  <option value="AL">Alabama</option>
  <option value="WY">Wyoming</option>
</select>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
</body>


</html>