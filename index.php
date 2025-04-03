<?php
include("./config/net.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./template/meta.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <?php
    include("./template/header.php");
    include("./config/router.php");
    include("./template/footer.php");
    ?>
</body>
</html>