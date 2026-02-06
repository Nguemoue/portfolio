<?php
// ...existing code...
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['flash_message'])) {
    $flashMessage = addslashes($_SESSION['flash_message']);
    $flashType = $_SESSION['flash_type'] ?? 'success';
    unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    echo "<script>window.__flashMessage = {message: '{$flashMessage}', type: '{$flashType}'};</script>";
}
?>

</body>
</html>
