<?php
// Simple script to run the fix_session_checks.php script

// Set maximum execution time to 5 minutes
ini_set('max_execution_time', 300);

// Increase memory limit
ini_set('memory_limit', '256M');

echo "<h1>Running Session Checks Fix</h1>";

// Include the fix_session_checks.php script
include_once('fix_session_checks.php');

// The included script will handle the output
?>