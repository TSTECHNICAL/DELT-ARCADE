<?php
/**
 * CLI Session Checks Fix Script
 * This script addresses the most critical issue in the admin folder:
 * - Fixes session checks for $_SESSION['userid'] to prevent undefined index errors
 * 
 * Run this script from the command line: php cli_fix_sessions.php
 */

// Set maximum execution time to 5 minutes
ini_set('max_execution_time', 300);

// Increase memory limit
ini_set('memory_limit', '256M');

// Define the directory to scan
$directory = __DIR__;

echo "Session Checks Fix Results\n";
echo "========================\n";

// Get all PHP files in the directory (non-recursive for better performance)
$files = glob($directory . '/*.php');

// Add include directory files
$include_files = glob($directory . '/include/*.php');

// Combine all files
$all_files = array_merge($files, $include_files);

$fixedCount = 0;

// Define all the patterns we want to replace
$patterns = [
    'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    "if(\$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    "if (\$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    "if( \$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    "if(\$_SESSION['userid'] =='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    'if ($_SESSION["userid"] =="")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
    "if (\$_SESSION['userid'] =='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
];

foreach ($all_files as $filePath) {
    // Skip the current script
    if (basename($filePath) === basename(__FILE__) || 
        basename($filePath) === 'fix_all_admin_issues.php' ||
        basename($filePath) === 'fix_session_checks.php' ||
        basename($filePath) === 'run_fix.php' ||
        basename($filePath) === 'run_fix_script.bat') {
        continue;
    }
    
    $content = file_get_contents($filePath);
    $original = $content;
    
    // Apply all pattern replacements
    foreach ($patterns as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Only write if changes were made
    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "Fixed session checks in: " . basename($filePath) . "\n";
        $fixedCount++;
    }
}

echo "\nCompleted! Fixed session checks in {$fixedCount} files.\n";
?>