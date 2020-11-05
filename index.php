<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<title>phpMyAI</title>
</head>
<body class="bg-gray-300">
<form method="POST" action="/">
<div class="max-w-sm m-4 lg:max-w-lg mx-auto rounded m-12 bg-white border-t-8 border-pink-400 p-6">
	<div class="prompt-container">
		<h2 class="font-semibold text-2xl">Prompt:</h2>
		<p class="w-3/4 py-3 hidden">
			<!-- <?= file_get_contents('./src/prompt.txt'); ?> -->
		</p>
		<input name="input" class="w-3/4 py-3" type="text" placeholder="Write something..">
	</div>
	<div class="ai-container max-w-sm lg:max-w-lg mx-auto">
		<h2 class="font-semibold text-2xl">AI answer:</h2>
		<p class="completions py-3">
			<?php include('./app.php'); ?>	
		</p>
	</div>
</div>
<div class="max-w-sm mx-auto flex justify-end lg:max-w-lg">
	<input type="submit" value="Send" class="rounded py-3 hover:bg-pink-800 px-6 bg-pink-600 text-white font-semibold">
</div>
</form>


</body>
</html>
