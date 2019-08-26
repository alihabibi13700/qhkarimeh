<?php 
if(isset($_GET['file']))
{
	$file = file_get_contents($_GET['file']);
	require_once('default.php');
}
else
{
	$allPage = [];

	$folder = ['page', 'news'];

	foreach ($folder as  $folder_name) 
	{
		$page = glob(__DIR__. "/$folder_name/*");

		foreach ($page as $key => $value) 
		{
			$myList = glob($value. '/*');
			$allPage = array_merge($allPage, $myList);
		}
	}

	$show = [];
	foreach ($allPage as $key => $value) 
	{
		$name = basename($value);
		$folderName = str_replace('/'.$name, '', $value);
		$folderName = explode('/', $folderName);
		$endFoldr = end($folderName);
		array_pop($folderName);
		$masterFolder = end($folderName);
		
		if(!isset($show[$masterFolder]))
		{
			$show[$masterFolder] = [];
		}

		if(!isset($show[$masterFolder][$endFoldr]))
		{
			$show[$masterFolder][$endFoldr] = [];
		}

		$show[$masterFolder][$endFoldr][] = ['name' => $name, 'folder' => $endFoldr, 'addr' => $value];

	}

	foreach ($show as $key => $value) 
	{
		echo "<h2>$key</h2>";
		echo "<hr>";
		foreach ($value as $k => $v) 
		{
			echo "<hr>";
			echo "<h4>$k</h4>";
			foreach ($v as $a => $b) 
			{
				echo "<a target='_blank' href='http://localhost/qhkarimeh/run.php?file=$b[addr]'>$b[name]</a><br>";
			}
			
		}
	
	}

}
?>