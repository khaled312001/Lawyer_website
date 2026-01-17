<?php

// Create database if it doesn't exist
try {
    $conn = new PDO("mysql:host=127.0.0.1;port=3306", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $conn->exec("CREATE DATABASE IF NOT EXISTS `law` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database 'law' created or already exists\n";
    
    $conn = null;
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\nPlease make sure:\n";
    echo "1. MySQL is running\n";
    echo "2. You have proper credentials\n";
    echo "3. Or import the law.sql file manually using phpMyAdmin\n";
    exit(1);
}
