<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>

<body>
<?php
require_once 'PrintTree.php';
$TMNT = array('Leonardo' 		=> array('weapon'	=>	'katana',
									  	 'color'	=>	'blue'),
			  'Donatello'		=>	array('weapon'	=>	'bo',
				  						  'color'	=>	'purple'),
			  'Michaelangelo'	=>	array('weapon'	=>	'nunchaku',
				  						  'color'	=>	'orange'),
			  'Raphael'			=>	array('weapon'	=>	'sai',
				  						  'color'	=>	'red'));
										  
(new PrintTree(true))->output($TMNT, true);
?>
</body>
</html>