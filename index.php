<?php
require 'config.php';

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'created_at';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$messages_per_page = 5;
$offset = ($page - 1) * $messages_per_page;

$sql = "SELECT * FROM messages ORDER BY $sort_by $order LIMIT $offset, $messages_per_page";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count_sql = "SELECT COUNT(*) FROM messages";
$total_messages = $pdo->query($count_sql)->fetchColumn();
$total_pages = ceil($total_messages / $messages_per_page);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Guestbook</title>
	<link rel="stylesheet" href="styles.css">
	<script src="validate.js"></script>
</head>

<body>
	<h1 class="header__main-text">Guestbook</h1>
	<form id="guestbook-form" action="add_message.php" method="POST">
		<p class="header__text">
			<label for="username">User Name:</label>
			<input type="text" id="username" name="username" required>
		</p>
		<p class="header__text">
			<label for="email">E-mail:</label>
			<input type="email" id="email" name="email" required>
		</p>
		<p class="header__text">
			<label for="message">Text:</label>
			<textarea id="message" name="message" required></textarea>
		</p>
		<button class="btn" type="submit">Submit</button>
	</form>
	<table>
		<thead>
			<tr>
				<th class="table__text"><a class="table__link" href="?sort_by=username&order=<?php echo ($sort_by == 'username' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">User Name</a></th>
				<th class="table__text"><a class="table__link" href="?sort_by=email&order=<?php echo ($sort_by == 'email' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">E-mail</a></th>
				<th class="table__text">Message</th>
				<th class="table__text"><a class="table__link" href="?sort_by=created_at&order=<?php echo ($sort_by == 'created_at' && $order == 'ASC') ? 'DESC' : 'ASC'; ?>">Date</a></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($messages as $message) : ?>
				<tr>
					<td class="message__text"><?php echo htmlspecialchars($message['username']); ?></td>
					<td class="message__text"><?php echo htmlspecialchars($message['email']); ?></td>
					<td class="message__text"><?php echo htmlspecialchars($message['message']); ?></td>
					<td class="message__text"><?php echo htmlspecialchars($message['created_at']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="pagination">
		<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
			<a class="pagination__link" href="?page=<?php echo $i; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</div>
</body>

</html>