<html>
	<head>
		<title>All Locations</title>
		<style>
			table {border-collapse: collapse; align: center; width: 100%;}
			td {width: 100%; height: 40em; background-color: #fbffdf; background-repeat:repeat; background-position: center;}
			tr {border: solid 2px;}
			.address {font-size: 2em; text-align: center; position: inherit;}
			.neighborhood {font-size: 1.0em; text-align: center; position: inherit;}
			.city {font-size: 1.0em; text-align: center; position: inherit;}
			.more {font-size: 1.0em; text-align: center; position: inherit;}
		</style>
	</head>
<body>
<a href="index.php">Home</a> | <a href="findLoc.html">Search</a>
<?php
include "../helpers/conn.php";

if ($_GET["isSearch"])
{
	echo "<h1>Location Search Results</h1>";
	echo "You searched for: ";
	if ($_GET["sAddress"])
	{
		echo "Address contains ";
		echo $_GET["sAddress"];
	}
	else
		echo "ANY Address";
	echo ", ";
	if ($_GET["sBlock"])
	{
		echo "Block contains ";
		echo $_GET["sBlock"];
	}
	else
		echo "ANY Block";
	echo ", ";
	if ($_GET["sLot"])
	{
		echo "Lot contains ";
		echo $_GET["sLot"];
	}
	else
		echo "ANY Lot";
	echo ", ";
	if ($_GET["sZip"])
	{
		echo "Zip Code contains ";
		echo $_GET["sZip"];
	}
	else
		echo "ANY Zip Code";
	echo ", ";
	if ($_GET["sCity"])
	{
		echo "City contains ";
		echo $_GET["sCity"];
	}
	else
		echo "ANY City";
	echo ", ";
	if ($_GET["sNeighborhood"])
	{
		echo "Neighborhood contains ";
		echo $_GET["sNeighborhood"];
	}
	else
		echo "ANY Neighborhood";
	echo ", ";
	if ($_GET["sPoliceDistrict"])
	{
		echo "Police District contains ";
		echo $_GET["sPoliceDistrict"];
	}
	else
		echo "ANY Police District";
	echo ", ";
	if ($_GET["sCouncilDistrict"])
	{
		echo "Council District contains ";
		echo $_GET["sCouncilDistrict"];
	}
	else
		echo "ANY Council District";
	echo ", ";
	if ($_GET["sLongitude"])
	{
		echo "Longitude contains ";
		echo $_GET["sLongitude"];
	}
	else
		echo "ANY Longitude";
	echo ", ";
	if ($_GET["sLatitude"])
	{
		echo "Latitude contains ";
		echo $_GET["sLatitude"];
	}
	else
		echo "ANY Latitude";
	echo ", ";
	if ($_GET["sOwner"])
	{
		echo "Owner contains ";
		echo $_GET["sOwner"];
	}
	else
		echo "ANY Owner";
	echo ", ";
	if ($_GET["sUse"])
	{
		echo "Use contains ";
		echo $_GET["sUse"];
	}
	else
		echo "ANY Use";
	echo ", ";
	if ($_GET["sMailingAddr"])
	{
		echo "Mailing Address contains ";
		echo $_GET["sMailingAddr"];
	}
	else
		echo "ANY Mailing Address";
}
else
{
	echo "<h1>All Locations</h1>" ;
}

echo "<p align=center>";
echo "<table width=1>";

$theQuery = "";
$result = null;

if ($_GET["isSearch"])
{
	$theQuery = "SELECT * FROM `locations` WHERE `building_address` LIKE '%{$_GET["sAddress"]}%' AND `building_address` LIKE '%{$_GET["sAddress"]}%' AND `block` LIKE '%{$_GET["sBlock"]}%' AND `lot` LIKE '%{$_GET["sLot"]}%' AND `zip_code` LIKE '%{$_GET["sZip"]}%' AND `city` LIKE '%{$_GET["sCity"]}%' AND `neighborhood` LIKE '%{$_GET["sNeighborhood"]}%' AND `police_district` LIKE '%{$_GET["sPoliceDistrict"]}%' AND `council_district` LIKE '%{$_GET["sCouncilDistrict"]}%' AND `longitude` LIKE '%{$_GET["sLongitude"]}%' AND `latitude` LIKE '%{$_GET["sLatitude"]}%' AND `owner` LIKE '%{$_GET["sOwner"]}%' AND `use` LIKE '%{$_GET["sUse"]}%' AND `mailing_address` LIKE '%{$_GET["sMailingAddr"]}%'";
}
else
{
$theQuery = "SELECT * FROM locations";
}
$result = $conn->query($theQuery);
while ($row = @mysqli_fetch_array($result))
  echo "<tr><td style=\"background-image:url(../helpers/location_images/{$row["image"]})\">
 <div class=\"address\">{$row["building_address"]}</div><br/>
 <div class=\"neighborhood\">{$row["neighborhood"]}</div><br/>
 <div class=\"city\">{$row["city"]}</div><br/>
 <div class=\"more\"><a href=\"propertyInfo.php?id={$row["id"]}\">(more)</a></div><br/>
 </td></tr>
 ";

?>
</table>
</body>
</html>