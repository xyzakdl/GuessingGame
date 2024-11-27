<!DOCTYPE html>
<html>
<!-- acopiado, alaban, bauzon, deleon, garcia -->
<head>
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>NUMBER GUESSING GAME</h1>
    <?php
    session_start();
    
    $secret_number = 4;
    
    if (!isset($_SESSION['number'])) {
        $_SESSION['number'] = $secret_number;
        $_SESSION['attempts'] = 4;
    }
    
    $show_form = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $guess = intval($_POST['guess']);
        if ($guess == $_SESSION['number']) {
            echo "<p>Congrats! You've guessed correctly.</p>";
            $show_form = false;
            session_destroy();
        } else {
            $_SESSION['attempts']--;
            if ($_SESSION['attempts'] > 0) {
                echo "<p>Wrong guess! You have " . $_SESSION['attempts'] . " attempts left.</p>";
            } else {
                echo "<p>Sorry, you've used all your attempts. The correct number was " . $_SESSION['number'] . ".</p>";
                $show_form = false;
                session_destroy();
            }
        }
    }
    ?>
    
    <?php if ($show_form) : ?>
    <form method="post">
        <label for="guess">Guess the number (between 1 and 10): </label>
        <input type="number" id="guess" name="guess" min="1" max="10" required>
        <button type="submit">Submit</button>
    </form>
    <?php endif; ?>
</body>
</html>