<?php
// models/AuthService.php

require_once __DIR__ . '/../vendor/autoload.php'; // Load Delight classes

use Delight\Auth\Auth;

/**
 * AuthService handles user authentication using Delight Auth.
 */
class AuthService {
    private $auth;

    public function __construct() {
        $db = require __DIR__ . '/../config/database.php';
        $this->auth = new Auth($db);
    }

    public function getAuth() {
        return $this->auth;
    }
}
