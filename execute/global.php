<?php
function showAlert($text) {
    echo '<script>alert("'. $text  .'")</script>';
}
function header_page() {
	header('location:'. $_SERVER['PHP_SELF']);

}
?>