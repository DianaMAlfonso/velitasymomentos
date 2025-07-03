<?php
require_once __DIR__ . '/../config/database.php';

class UserController {

    /**
     * Show the registration form
     */
    public function showRegisterForm() {
        require __DIR__ . '/../views/auth/register.php';
    }

    /**
     * Handle user registration with SweetAlert feedback
     */
    public function register() {
        $pdo = require __DIR__ . '/../config/database.php';

        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'] ?? '';

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existing = $stmt->fetch();

        if ($existing) {
            $_SESSION['register_error'] = true;
            header('Location: index.php?action=register');
            exit;
        }

        // Insert new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $roles_mask = 1; // default client role

        $stmt = $pdo->prepare("INSERT INTO users (email, password, username, roles_mask) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $hashedPassword, $username, $roles_mask]);

        $_SESSION['register_success'] = true;
        header('Location: index.php?action=register');
        exit;
    }

    /**
     * Show the login form
     */
    public function showLoginForm() {
        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Handle login with SweetAlert on failure
     */
    public function login() {
        $pdo = require __DIR__ . '/../config/database.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, password, roles_mask FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['roles_mask'];

            if ($user['roles_mask'] == 2) {
                header('Location: index.php?action=admin_dashboard');
            } else {
                header('Location: index.php?action=client_dashboard');
            }
            exit;
        } else {
            $_SESSION['login_error'] = true;
            header('Location: index.php?action=login');
            exit;
        }
    }

    /**
     * Handle logout
     */
    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm() {
        require __DIR__ . '/../views/auth/forgot_password.php';
    }

    /**
     * Handle forgot password: sends email and shows SweetAlert
     */
    public function forgotPassword() {
        $pdo = require __DIR__ . '/../config/database.php';
        $email = $_POST['email'];

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $pdo->prepare("INSERT INTO password_resets (email, token, expires_at, created_at) VALUES (?, ?, ?, NOW())")
                ->execute([$email, hash('sha256', $token), $expires_at]);

            $link = "http://localhost/velitasymomentos/public/index.php?action=reset_password&token=$token";
            $body = "
                <p>Hello,</p>
                <p>Click the link below to reset your password:</p>
                <p><a href='$link'>$link</a></p>
                <p>This link will expire in 1 hour.</p>
            ";

            require_once __DIR__ . '/../core/EmailService.php';
            EmailService::sendResetLink($email, "Reset your password", $body);
        }

        $_SESSION['forgot_success'] = true;
        header('Location: index.php?action=forgot_password');
        exit;
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm() {
        require __DIR__ . '/../views/auth/reset_password.php';
    }

    /**
     * Handle password reset with SweetAlert on success/failure
     */
    public function resetPassword() {
        $pdo = require __DIR__ . '/../config/database.php';

        $token = $_POST['token'] ?? '';
        $hashedToken = hash('sha256', $token);
        $newPassword = $_POST['new_password'];

        $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$hashedToken]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reset) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $pdo->prepare("UPDATE users SET password = ? WHERE email = ?")
                ->execute([$hashedPassword, $reset['email']]);

            $pdo->prepare("DELETE FROM password_resets WHERE email = ?")
                ->execute([$reset['email']]);

            $_SESSION['reset_success'] = true;
            header('Location: index.php?action=login');
            exit;
        } else {
            $_SESSION['reset_error'] = true;
            header('Location: index.php?action=reset_password');
            exit;
        }
    }
}






