
// Start the session
session_start();

// Unset the cart session
unset($_SESSION['cart']);

// Redirect back to the previous page or any desired location
header("Location: index.php");
exit;
