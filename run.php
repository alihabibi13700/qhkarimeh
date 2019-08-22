<?php 
if(isset($_GET['file']))
{
	$file = file_get_contents($_GET['file']);
	require_once('default.php');
}
else
{


	$page = glob(__DIR__. "/page/*");
	$allPage = [];

	foreach ($page as $key => $value) 
	{
		$myList = glob($value. '/*');
		$allPage = array_merge($allPage, $myList);
	}
	foreach ($allPage as $key => $value) {
		
		echo "<a href='http://localhost/qhkarimeh/run.php?file=$value'>$value</a><br>";
	}

}
?>