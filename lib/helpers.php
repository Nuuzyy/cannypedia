<?php

spl_autoload_register(function (string $class) {
    $path = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) require_once $path;
});

function escape(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): never {
    header('Location: ' . $path);
    exit;
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}

function verify_csrf(): void {
    if (($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) {
        http_response_code(419);
        exit('Sesi formulir tidak valid. Muat ulang halaman.');
    }
}

function is_admin(): bool {
    return ($_SESSION['user']['role'] ?? '') === 'admin';
}

function require_login(): void {
    if (empty($_SESSION['user'])) redirect('/login');
}

function require_admin(): void {
    require_login();
    if (!is_admin()) redirect('/');
}

function rupiah(float|int $amount): string {
    return 'Rp ' . number_format((float) $amount, 0, ',', '.');
}
