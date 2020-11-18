<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h1>Enter in your game details.</h1>
    <form id = "game" action="proccess_registration.php" method="post">

        <label for="name">Name of Item</label>
        <input type="text" id = "name" name="name">

        <label for="genre">Genre</label>
        <input type="text" id = "genre" name="genre">

        <label for="platform">Platform</label>
        <input type="text" id = "platform" name="platform">

        <label for="condition">Condition</label>
        <input type="text" id = "condition" name="condition">
        
        <button type="submit">Submit Game</button>
    </form>
</body>
</html>