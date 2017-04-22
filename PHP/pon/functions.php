<?php
	include "query.php";
	
	// Call a query function. args[0] holds function name, args[1] and up hold function arguments. Make sure they're in order!
	function call($args)
	{
		switch ($args[0])
		{
			// Account
			case "AccountList(name)":
				echo query("SELECT name FROM account WHERE name='$args[1]';");
				break;
			case "AccountList(name,password)":
				echo query("SELECT name FROM account WHERE name='$args[1]' AND password='$args[2]';");
				break;
			case "AccountCreate(name,password,email)":
				echo query("INSERT INTO account VALUES ('$args[1]', '$args[2]', '$args[3]');");
				break;

			// Friend Request
			case "FriendRequestMake(requester,receiver)":
				echo query("REPLACE INTO friend_request_pending (requester, receiver) VALUES ('$args[1]', '$args[2]');");
				break;
			case "FriendRequestCancel(requester,receiver)":
				echo query("DELETE FROM friend_request_pending WHERE requester='$args[1]' AND receiver='$args[2]';");
				break;
			case "FriendRequestReject(receiver,requester)":
				echo query("DELETE FROM friend_request_pending WHERE receiver='$args[1]' AND requester='$args[2]';");
				break;
			case "FriendRequestAccept(receiver,requester)":
				query("DELETE FROM friend_request_pending WHERE receiver='$args[1]' AND requester='$args[2]';");
				echo query("INSERT INTO friends_with VALUES ('$args[1]', '$args[2]');");
				break;

			case "FriendRequestListRequester(requester)":
				echo query("SELECT receiver name FROM friend_request_pending WHERE requester='$args[1]';");
				break;
			case "FriendRequestListReceiver(receiver)":
				echo query("SELECT requester name FROM friend_request_pending WHERE receiver='$args[1]';");
				break;

			// Friends
			case "FriendList(myname)":
				echo query("(SELECT name1 name FROM friends_with WHERE name2='$args[1]') UNION (SELECT name2 FROM friends_with WHERE name1='$args[1]') ORDER BY name;");
				break;
			case "FriendDelete(myname,other)":
				echo query("DELETE FROM friends_with WHERE (name1='$args[1]' AND name2='$args[2]') OR (name1='$args[2]' AND name2='$args[1]');");
				break;
				
		}
	}
?>
