<?php
	include "query.php";
	
	// Call a query function. args[0] holds function name, args[1] and up hold function arguments. Make sure they're in order!
	function call($args)
	{
		switch ($args[0])
		{
			// Account
			case "AccountSetActive(name)":
				echo query("UPDATE account SET active=NOW() WHERE name='$args[1]';");
				break;
			case "AccountSearch(name)":
				echo query("SELECT name FROM account WHERE name LIKE '$args[1]%';");
				break;
			case "AccountList(name)":
				echo query("SELECT name FROM account WHERE name='$args[1]';");
				break;
			case "AccountList(name,password)":
				echo query("SELECT name FROM account WHERE name='$args[1]' AND password='$args[2]';");
				break;
			case "AccountCreate(name,password,email)":
				echo query("INSERT INTO account (name, password, email) VALUES ('$args[1]', '$args[2]', '$args[3]');");
				break;








			// Friend Request
			case "FriendRequestMake(requester,receiver)":
				echo query("REPLACE INTO friend_request (requester, receiver) VALUES ('$args[1]', '$args[2]');");
				break;
			case "FriendRequestCancel(requester,receiver)":
				echo query("DELETE FROM friend_request WHERE requester='$args[1]' AND receiver='$args[2]';");
				break;
			case "FriendRequestReject(receiver,requester)":
				echo query("DELETE FROM friend_request WHERE receiver='$args[1]' AND requester='$args[2]';");
				break;
			case "FriendRequestAccept(receiver,requester)":
				query("DELETE FROM friend_request WHERE receiver='$args[1]' AND requester='$args[2]';");
				query("DELETE FROM friend_request WHERE receiver='$args[2]' AND requester='$args[1]';");
				echo query("INSERT INTO friend_base VALUES ('$args[1]', '$args[2]');");
				break;

			case "FriendRequestListRequester(requester)":
				echo query("SELECT receiver name FROM friend_request WHERE requester='$args[1]';");
				break;
			case "FriendRequestListReceiver(receiver)":
				echo query("SELECT requester name FROM friend_request WHERE receiver='$args[1]';");
				break;










			// Friends
			case "FriendList(myname)":
				echo query("SELECT friend FROM friend WHERE name='$args[1]' ORDER BY name;");
				break;
			case "FriendListOnline(name)":
				echo query("SELECT friend FROM friend f INNER JOIN account a ON f.friend=a.name WHERE f.name='$args[1]' AND DATE_SUB(NOW(), INTERVAL 2 SECOND) < a.active ORDER BY f.friend;");
				break;
			case "FriendListOffline(name)":
				echo query("SELECT friend FROM friend f INNER JOIN account a ON f.friend=a.name WHERE f.name='$args[1]' AND DATE_SUB(NOW(), INTERVAL 2 SECOND) >= a.active ORDER BY f.friend;");
				break;
			case "FriendDelete(myname,other)":
				echo query("DELETE FROM friend_base WHERE (name1='$args[1]' AND name2='$args[2]') OR (name1='$args[2]' AND name2='$args[1]');");
				break;
				



			// Matches
			case "MatchList()":
				echo query("SELECT * from matches;");
				break;
			case "MatchAdd(6)":
				echo query("INSERT INTO matches (name, externalIP, internalIP, externalIPv6, internalIPv6, guid) VALUES ('$args[1]', '$args[2]', '$args[3]', '$args[4]', '$args[5]', '$args[6]');");
				break;
			case "MatchRemove(name)":
				echo query("DELETE FROM matches WHERE name='$args[1]';");




			// Party Invite
			case "PartyInviteListSender(sender)":
				echo query("SELECT receiver FROM party_invite WHERE sender='$args[1]'");
				break;
			case "PartyInviteListReceiver(receiver)":
				echo query("SELECT sender FROM party_invite WHERE receiver='$args[1]'");
				break;
			case "PartyInviteMake(sender,receiver)":
				echo query("INSERT INTO party_invite (sender, receiver) VALUES ('$args[1]', '$args[2]')");
				break;
			case "PartyInviteRemove(sender,receiver)":
				echo query("DELETE FROM party_invite WHERE sender='$args[1]' AND receiver='$args[2]'");
				break;
			






			// Party
			case "PartyList(name)":
				echo query("SELECT p2.* FROM party p1, party p2 WHERE p1.name='$args[1]' AND p1.name <> p2.name AND p1.leader=p2.leader ORDER BY p2.name;");
				break;
			case "PartyChangeLeaderSingle(name,leader)":
				echo query("UPDATE party SET leader='$args[2]' WHERE name='$args[1]';");
				break;
			case "PartyChangeLeaderParty(old,new)":
				echo query("UPDATE party SET leader='$args[2]' WHERE leader='$args[1]';");
				break;
			case "PartyJoin(name,other)":
				echo query("UPDATE party p1, party p2 SET p1.leader=p2.leader WHERE p1.name='$args[1]' AND p2.name='$args[2]';");
				break;

		}
	}
?>
