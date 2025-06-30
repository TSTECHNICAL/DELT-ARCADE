<?php
/**
 * Fix All Admin Issues Script
 * This script addresses various issues in the admin folder:
 * 1. Fixes session checks for $_SESSION['userid']
 * 2. Adds null checks for array access in navigation.inc.php
 * 3. Prevents division by zero in manage_parityhistory.php
 * 4. Improves mysqli error handling in validateAdmin.php
 * 5. Enhances error handling in connection.php
 */

// Define the directory to scan
$directory = __DIR__;

// Set maximum execution time to 5 minutes
ini_set('max_execution_time', 300);

// Increase memory limit
ini_set('memory_limit', '256M');

echo "<h1>Admin Issues Fix Results</h1>";


// 1. Fix session checks in all PHP files
function fixSessionChecks() {
    global $directory;
    
    // Get all PHP files in the directory and subdirectories
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    $fixedCount = 0;
    
    echo "<h2>1. Fixing Session Checks</h2>";
    echo "<ul>";
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $filePath = $file->getPathname();
            
            // Skip the current script
            if (basename($filePath) === basename(__FILE__)) {
                continue;
            }
            
            $content = file_get_contents($filePath);
            $original = $content;
            
            // Replace the session check pattern using string replacement instead of regex
            $searchPatterns = [
                'if($_SESSION["userid"]=="")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                "if(\$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                'if ($_SESSION["userid"]=="")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                "if (\$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                'if( $_SESSION["userid"]=="")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                "if( \$_SESSION['userid']=='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                'if($_SESSION["userid"] =="")' => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
                "if(\$_SESSION['userid'] =='')" => 'if(!isset($_SESSION["userid"]) || $_SESSION["userid"] == "")',
            ];
            
            // Apply all pattern replacements
            foreach ($searchPatterns as $search => $replace) {
                $content = str_replace($search, $replace, $content);
            }
            
            // Only write if changes were made
            if ($content !== $original) {
                file_put_contents($filePath, $content);
                echo "<li>Fixed session check in: " . basename($filePath) . "</li>";
                $fixedCount++;
            }
        }
    }
    
    echo "</ul>";
    echo "<p>Completed! Fixed session checks in {$fixedCount} files.</p>";
}

// 2. Fix null array access in header.inc.php
function fixHeaderIncPhp() {
    $filePath = $directory . '/include/header.inc.php';
    
    if (!file_exists($filePath)) {
        echo "<h2>2. Fixing header.inc.php</h2>";
        echo "<p>File not found: header.inc.php</p>";
        return;
    }
    
    $content = file_get_contents($filePath);
    $original = $content;
    
    // Replace direct $_SESSION['admin_name'] access with isset() check using string replacement
    $searchStrings = [
        'echo ucfirst($_SESSION["admin_name"]);' => 'echo isset($_SESSION["admin_name"]) ? ucfirst($_SESSION["admin_name"]) : "Admin";',
        "echo ucfirst(\$_SESSION['admin_name']);" => 'echo isset($_SESSION["admin_name"]) ? ucfirst($_SESSION["admin_name"]) : "Admin";',
        'echo  ucfirst($_SESSION["admin_name"]);' => 'echo isset($_SESSION["admin_name"]) ? ucfirst($_SESSION["admin_name"]) : "Admin";',
        "echo  ucfirst(\$_SESSION['admin_name']);" => 'echo isset($_SESSION["admin_name"]) ? ucfirst($_SESSION["admin_name"]) : "Admin";',
    ];
    
    // Apply all string replacements
    foreach ($searchStrings as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Only write if changes were made
    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "<h2>2. Fixing header.inc.php</h2>";
        echo "<p>Fixed null array access in header.inc.php</p>";
    } else {
        echo "<h2>2. Fixing header.inc.php</h2>";
        echo "<p>No issues found or already fixed in header.inc.php</p>";
    }
}

// 3. Fix division by zero in manage_parityhistory.php
function fixDivisionByZero() {
    $filePath = $directory . '/manage_parityhistory.php';
    
    if (!file_exists($filePath)) {
        echo "<h2>3. Fixing Division by Zero</h2>";
        echo "<p>File not found: manage_parityhistory.php</p>";
        return;
    }
    
    $content = file_get_contents($filePath);
    $original = $content;
    
    // Replace division that could cause division by zero using string replacement
    $searchStrings = [
        '$percentprofit = $netprofit*100/$total;' => '$percentprofit = ($total != 0) ? ($netprofit*100/$total) : 0;',
        '$percentprofit=$netprofit*100/$total;' => '$percentprofit = ($total != 0) ? ($netprofit*100/$total) : 0;',
        '$percentprofit = $netprofit * 100 / $total;' => '$percentprofit = ($total != 0) ? ($netprofit*100/$total) : 0;',
        '$percentprofit=$netprofit * 100 / $total;' => '$percentprofit = ($total != 0) ? ($netprofit*100/$total) : 0;',
    ];
    
    // Apply all string replacements
    foreach ($searchStrings as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Only write if changes were made
    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "<h2>3. Fixing Division by Zero</h2>";
        echo "<p>Fixed division by zero in manage_parityhistory.php</p>";
    } else {
        echo "<h2>3. Fixing Division by Zero</h2>";
        echo "<p>No division by zero issues found or already fixed in manage_parityhistory.php</p>";
    }
}

// 4. Improve mysqli error handling in validateAdmin.php
function fixValidateAdmin() {
    $filePath = $directory . '/validateAdmin.php';
    
    if (!file_exists($filePath)) {
        echo "<h2>4. Improving mysqli Error Handling</h2>";
        echo "<p>File not found: validateAdmin.php</p>";
        return;
    }
    
    $content = file_get_contents($filePath);
    $original = $content;
    
    // Look for specific code patterns to replace
    $searchReplace = [
        // Add error handling for mysqli_query
        '$result = mysqli_query($con,$sql);' => 
            '$result = mysqli_query($con,$sql);\n\tif(!$result) {\n\t\terror_log("SQL Error in validateAdmin.php: ".mysqli_error($con));\n\t\theader("location:index.php?err=dberror");\n\t\texit;\n\t}',
        
        // Add null check before mysqli_fetch_assoc (various patterns)
        '$num = mysqli_num_rows($result);\n\t$line = mysqli_fetch_assoc($result);' => 
            '$num = mysqli_num_rows($result);\n\tif($num >= 1) {\n\t\t$line = mysqli_fetch_assoc($result);\n\t} else {\n\t\t$line = null;\n\t}',
        
        '$num = mysqli_num_rows($result);\r\n\t$line = mysqli_fetch_assoc($result);' => 
            '$num = mysqli_num_rows($result);\r\n\tif($num >= 1) {\n\t\t$line = mysqli_fetch_assoc($result);\n\t} else {\n\t\t$line = null;\n\t}',
        
        '$num=mysqli_num_rows($result);\n\t$line=mysqli_fetch_assoc($result);' => 
            '$num=mysqli_num_rows($result);\n\tif($num >= 1) {\n\t\t$line = mysqli_fetch_assoc($result);\n\t} else {\n\t\t$line = null;\n\t}'
    ];
    
    // Apply all replacements
    foreach ($searchReplace as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Only write if changes were made
    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "<h2>4. Improving mysqli Error Handling</h2>";
        echo "<p>Fixed mysqli error handling in validateAdmin.php</p>";
    } else {
        echo "<h2>4. Improving mysqli Error Handling</h2>";
        echo "<p>No mysqli error handling issues found or already fixed in validateAdmin.php</p>";
    }
}

// 5. Fix null array access in connection.php
function fixConnectionPhp() {
    $filePath = $directory . '/include/connection.php';
    
    if (!file_exists($filePath)) {
        echo "<h2>5. Fixing connection.php</h2>";
        echo "<p>File not found: connection.php</p>";
        return;
    }
    
    $content = file_get_contents($filePath);
    $original = $content;
    
    // Replace direct $_SESSION['role_id'] access with isset() check using string replacement
    $searchReplace = [
        '$session_roles = $_SESSION["role_id"];' => '$session_roles = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        "$session_roles = \$_SESSION['role_id'];" => '$session_roles = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        '$session_roles=$_SESSION["role_id"];' => '$session_roles = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        "$session_roles=\$_SESSION['role_id'];" => '$session_roles = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
    ];
    
    // Apply all replacements
    foreach ($searchReplace as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Only write if changes were made
    if ($content !== $original) {
        file_put_contents($filePath, $content);
        echo "<h2>5. Fixing connection.php</h2>";
        echo "<p>Fixed null array access in connection.php</p>";
    } else {
        echo "<h2>5. Fixing connection.php</h2>";
        echo "<p>No issues found or already fixed in connection.php</p>";
    }
}

// 6. Fix navigation.inc.php to add null checks for array access
function fixNavigationIncPhp() {
    $filePath = $directory . '/include/navigation.inc.php';
    
    if (!file_exists($filePath)) {
        echo "<h2>6. Fixing navigation.inc.php</h2>";
        echo "<p>File not found: navigation.inc.php</p>";
        return;
    }
    
    // Check if the file already has the isset check
    $content = file_get_contents($filePath);
    
    if (strpos($content, 'isset($_SESSION[\'role_id\'])') !== false) {
        echo "<h2>6. Fixing navigation.inc.php</h2>";
        echo "<p>No issues found or already fixed in navigation.inc.php</p>";
        return;
    }
    
    // Add isset check for $_SESSION['role_id'] using string replacement
    $searchReplace = [
        '$session_role = $_SESSION["role_id"];' => '$session_role = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        "$session_role = \$_SESSION['role_id'];" => '$session_role = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        '$session_role=$_SESSION["role_id"];' => '$session_role = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
        "$session_role=\$_SESSION['role_id'];" => '$session_role = isset($_SESSION["role_id"]) ? $_SESSION["role_id"] : 0;',
    ];
    
    // Apply all replacements
    foreach ($searchReplace as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Write the updated content
    file_put_contents($filePath, $content);
    
    echo "<h2>6. Fixing navigation.inc.php</h2>";
    echo "<p>Fixed null array access in navigation.inc.php</p>";
}

// Run all fixes
fixSessionChecks();
fixHeaderIncPhp();
fixDivisionByZero();
fixValidateAdmin();
fixConnectionPhp();
fixNavigationIncPhp();

echo "<h2>All fixes completed!</h2>";
echo "<p><a href='desktop.php'>Return to Dashboard</a></p>";
?>