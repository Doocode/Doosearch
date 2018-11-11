<html>
<head>
	<title>Test</title>
  <!-- Chargement des fichiers JavaScript -->
  <script src="./res/js/jquery-3.3.0.min.js"></script>
  <script src="./res/js/header.js"></script>
  <script src="./res/js/hub.js"></script>
  <script src="./res/js/modernizr-custom.js"></script>
  <script src="./res/js/utils.js"></script>
  <script src="./res/js/search-engine.js"></script>
  <script src="./res/js/list-engines.js.php"></script> 
  <script src="./res/js/selected-engines.js.php"></script>
	<script src="./res/js/search.js" type="text/javascript"></script>
</head>
<body>
<?php
  $search = $_GET['search'];
?>
  <script type="text/javascript">validateUrlSearch('<?php echo($search);?>');</script>
</body>
</html>
