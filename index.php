<?php 
session_start();
include 'shared.php';
?>

<html>
<head />
<body>
<style>
table { text-align: left; border-collapse: collapse; }
tr:hover { background: lightblue; color: black; }
.nohover { background: white !important; color: black !important; }
</style>



<table>
<tr class="nohover">
<td class="nohover">
	<table>
	<tr height="17px"><th> Game </th><th> SOW </th><th style="padding:8px;"> </th><th> NOW </th><th style="padding-right:35px;"> </th></tr>

	<?php
	foreach ($games as $game) {
		$c = 1;
		$pos = 1;
		foreach ($oldgames as $check) {
			if ($game['name'] == $check['name']) {
				$pos = $c;
			}
			$c++;
		}
		
		echo '<tr><td>' . substr($game['name'], 0, 30) . '</td><td>$' . $oldgames[$pos]['price'] . '</td>';
		if ($game['price'] > $oldgames[$pos]['price']) {
			echo '</td><td style="background-image:url(up.PNG);"></td>';
		} elseif ($game['price'] < $oldgames[$pos]['price']) {
			echo '</td><td style="background-image:url(down.PNG);"></td>';
		} else {
			echo '</td><td style="background-image:url(no.PNG);"></td>';
		}
		if ($game['sale']) {
			echo '<td style="background:yellow;">$' . $game['price'] . '</td><td style="background:red;"> sale </td></tr>';
		} else {
			echo '<td>$' . $game['price'] . '</td>';
		}

	}

	?>
	</table>
</td>
<td width="100%" valign="top" align="left" class="nohover">
		<table align="right">
			<tr>				
			<td class="nohover">
				<?php
				$login = '<form method="post" action="login.php">' .
					'<input style="border:1px solid gray;" name="logname" type="text">' .
					'<input style="border:1px solid gray;" name="logpass" type="password">' .
					'<input type="submit" value="login">' .
				'</form>';
				
				$loggedin = '<form method="get" action="login.php?logout=true">' .
					'Greetings ' . $_SESSION['logname'] . ': ' .
					'<a href="usercp.php">usercp</a> - ' .
					'<input type="submit" value="logout">' .
				'</form>';
				
				if ($_SESSION['loggedin'] == true) {
					echo $loggedin;
				} else {
					echo $login;
				}
				?>
			</td>
			</tr>
		</table>
		<table>
			<tr align="left">
			<th align="center" colspan="5">
				<u>Games being tracked</u>
			</td>
			</tr>
			<tr height="17px"><th> Game </th><th> SOW </th><th style="padding:8px;"> </th><th> NOW </th><th style="padding-right:35px;"> </th></tr>
			<?php
				if ($tracked) {
					foreach ($games as $game) {
						$match = false;
						foreach ($tracked as $track) {
							if ($game['name'] == trim($track)) {
								$match = true;
							}
						}
						if ($match) {
							echo '<tr><td>' . substr($game['name'], 0, 30) . '</td><td>$' . $oldgames[$pos]['price'] . '</td>';
							if ($game['price'] > $oldgames[$pos]['price']) {
								echo '</td><td style="background-image:url(up.PNG);"></td>';
							} elseif ($game['price'] < $oldgames[$pos]['price']) {
								echo '</td><td style="background-image:url(down.PNG);"></td>';
							} else {
								echo '</td><td style="background-image:url(no.PNG);"></td>';
							}
							if ($game['sale']) {
								echo '<td style="background:yellow;">$' . $game['price'] . '</td><td style="background:red;"> sale </td></tr>';
							} else {
								echo '<td>$' . $game['price'] . '</td>';
							}
						}
					}
				}
			?>
		</table>
		<br><br>	
</td>
</tr>
</table>
</body>
</html>













