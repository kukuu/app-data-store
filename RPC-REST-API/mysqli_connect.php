
<?php
//Author: Alexander Adu-Sarkodie
// Application Type : Web Service:  

	DEFINE ('DB_USER' ,'studentweb');
	DEFINE ('DB_PASSWORD' ,'mywizzardbabes');
	DEFINE ('DB_HOST' ,'localhost');
	DEFINE ('DB_NAME' ,'testdb');

//Make connection or manage error handling
	$dbc = @mysqli_connect(DB_USER, DB_PASSWORD, DB_HOST, DB_NAME) 
	OR die('Could not connect to MySQL' . mysqli_connect_error());

?>