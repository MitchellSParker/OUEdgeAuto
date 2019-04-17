<?php
include 'VMInfo.php'; //import global Variables

$db = new PDO("mysql:host=localhost;dbname=EdgeAuto", 'edgeauto', 'edgeauto19!');
$result = $db->query("Select * from message");
$outArray = array();
$comma_sep = "";
$LastMsg_ID=0;

//Extract data from the DB and put it into a string to be sent.
foreach($result as $row) {
	$LastMsg_ID = $row['message_id'];
        $outArray[] = $row['arb_id'];
        $outArray[] = $row['message'];
        $outArray[] = $row['latitude'];
        $outArray[] = $row['longitude'];
        $outArray[] = $row['cantime'];
        $outArray[] = $row['session_id'];
	$LastSess_ID = $row['session_id'];
	$comma_sep .= implode(",",$outArray);
	$comma_sep .= ";";
	$outArray = array();
} 
//Create a socket and connect to it. Then connect to the port on the datacenter and write the data.
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
socket_connect($socket, $DC, $DCport);
socket_write($socket, $comma_sep);

// Delete all of the data sent to the Datacenter
$db->query("delete from message where message_id <= $LastMsg_ID");
socket_close($socket);
?>