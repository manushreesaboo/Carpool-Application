<?php
require_once 'conn.php';

if(!empty($_GET["poolid"])) {
	$ = "INSERT INTO request (fromid,toid,poolid,ondays) VALUES (?,?,?,?)";
	try {
		$stmt=$pdo->prepare($);
		$fromid=GetAccId($pdo);

		$x = "SELECT * FROM pools where poolid=" . $_GET['poolid'] . ";";
		$xstmt = $pdo->query($x);
		$zxrow = $xstmt->fetch();
		$toid=$zxrow['createdlid'];

		$ins= $stmt->execute([$fromid,$toid,$_GET['poolid'],$_GET['ondays']]);
		if($ins)
		{
			AddNoti($pdo,GetAccName($pdo,$fromid)." has requested to join your pool.",$toid);
			redirect("dashboard.php?msg=Request Sent");
		}		
	} catch (PDOException $e) {
		die($e->getMessage());
	}

	
	
}

	



?>