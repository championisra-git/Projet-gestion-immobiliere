<?php

class Auth {

    public static function require(): void {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?ctrl=auth&action=login');
            exit();
        }
    }

    public static function requireRole(array $roles): void {
        self::require();
        if (!in_array($_SESSION['user_role'], $roles)) {
            http_response_code(403);
            require 'app/views/403.php';
            exit();
        }
    }

    public static function user(): ?array {
        return $_SESSION['user'] ?? null;
    }

    public static function role(): string {
        return $_SESSION['user_role'] ?? '';
    }
}