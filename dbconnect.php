<?
$con = mysql_connect("mysql-shared-02.phpfog.com","Custom App-28464","18hjI08O");
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
mysql_select_db("justinrhodes_phpfogapp_com", $con);