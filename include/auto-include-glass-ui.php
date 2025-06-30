<?php
$glassUiPath = __DIR__ . '/apply-glass-ui.php';
if (file_exists($glassUiPath)) {
    // Include the file
    include_once($glassUiPath);
} else {
    // Log an error if the file doesn't exist
    error_log('Error: apply-glass-ui.php file not found at ' . $glassUiPath);
}