<?php
/**
 * Fix Session Checks Script
 * This script addresses the most critical issue in the admin folder:
 * - Fixes session checks for $_SESSION['userid'] to prevent undefined index errors
 */

// Set maximum execution time to 5 minutes
ini_set('max_execution_time', 300);

// Increase memory limit
ini_set('memory_limit', '256M');

// Define the directory to scan
$directory = __DIR__;

echo "<h1>Session Checks Fix Results</h1>";

// Get all PHP files in the directory (non-recursive for better performance)
$files = glob($directory . '/*.php');

// Add include directory files
$include_files = glob($directory . '/include/*.php');

// Combine all files
$all_files = array_merge($files, $include_files);

$fixedCount = 0;

echo "<ul>";

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
        echo "<li>Fixed session checks in: " . basename($filePath) . "</li>";
        $fixedCount++;
    }
}

echo "</ul>";

echo "<p><strong>Completed!</strong> Fixed session checks in {$fixedCount} files.</p>";

echo "<p><a href='desktop.php' style='display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;'>Return to Dashboard</a></p>";

?>