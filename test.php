<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
										  
(new PrintTree)->output($TMNT, true);
?>
</body>
</html>