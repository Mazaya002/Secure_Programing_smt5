<?php
$input = "<script>alert('xss');</script>This is a test.";
$sanitized = filter_var($input, FILTER_SANITIZE_STRING);
echo $sanitized;
?>

