<?php

session_start();
session_destroy();

?>

<?php

echo "You are logged out!  Grow and prosper. Please come again soon. \n In fact, ";
echo "<a href = Login.php>Login Right Now.</a>";

?>