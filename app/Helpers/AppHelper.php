<?php

namespace App\Helpers;

/**
 * App Helper - Common functions
 */

/**
 * Format date to Indonesian format
 */
function formatDateID($date, $format = 'd M Y')
{
    if (!$date) return '-';

    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $formatted = date($format, strtotime($date));
    foreach ($months as $en => $id) {
        $formatted = str_replace($en, $id, $formatted);
    }

    return $formatted;
}

/**
 * Format time difference (e.g., "2 hours ago")
 */
function timeAgo($date)
{
    $time = strtotime($date);
    $diff = time() - $time;

    if ($diff < 60) {
        return 'Baru saja';
    } elseif ($diff < 3600) {
        $mins = floor($diff / 60);
        return $mins . ' menit lalu';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' jam lalu';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' hari lalu';
    } else {
        return formatDateID($date);
    }
}

/**
 * Get badge color by status
 */
function getBadgeColor($status)
{
    $colors = [
        'aktif' => 'success',
        'nonaktif' => 'danger',
        'pending' => 'warning',
        'selesai' => 'info',
        'dibatalkan' => 'secondary',
        'menang' => 'success',
        'kalah' => 'danger',
        'seri' => 'warning'
    ];

    return $colors[strtolower($status)] ?? 'secondary';
}

/**
 * Get icon by notification type
 */
function getNotificationIcon($type)
{
    $icons = [
        'event' => 'bx-calendar-event',
        'pertandingan' => 'bx-play-circle',
        'hasil' => 'bx-check-circle',
        'ranking' => 'bx-chart-line',
        'sistem' => 'bx-cog'
    ];

    return $icons[$type] ?? 'bx-bell';
}

/**
 * Get rating category label
 */
function getRatingCategoryLabel($category)
{
    $labels = [
        'teknik' => 'Teknik',
        'kecepatan' => 'Kecepatan',
        'ketahanan' => 'Ketahanan',
        'mental' => 'Mental',
        'sportivitas' => 'Sportivitas'
    ];

    return $labels[$category] ?? $category;
}

/**
 * Generate star rating HTML
 */
function renderStars($rating, $size = 'md')
{
    $sizes = [
        'sm' => '0.8rem',
        'md' => '1rem',
        'lg' => '1.5rem'
    ];

    $fontSize = $sizes[$size] ?? '1rem';
    $html = '';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= round($rating)) {
            $html .= "<i class='bx bxs-star' style='color: #ffc107; font-size: {$fontSize};'></i>";
        } else {
            $html .= "<i class='bx bx-star' style='color: #e2e8f0; font-size: {$fontSize};'></i>";
        }
    }

    return $html;
}

/**
 * Check if user is logged in
 */
function isLoggedIn()
{
    return session()->get('logged_in') === true;
}

/**
 * Get current user ID
 */
function getCurrentUserId()
{
    return session()->get('user_id');
}

/**
 * Get current user role
 */
function getCurrentUserRole()
{
    return session()->get('role');
}

/**
 * Check if user has role
 */
function hasRole($role)
{
    return getCurrentUserRole() === $role;
}

/**
 * Format currency (IDR)
 */
function formatCurrency($amount)
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

/**
 * Generate random string
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $string;
}

/**
 * Validate email
 */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number
 */
function isValidPhone($phone)
{
    return preg_match('/^(\+62|0)[0-9]{9,12}$/', $phone);
}

/**
 * Get file size in human readable format
 */
function formatFileSize($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));

    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Truncate text
 */
function truncateText($text, $length = 100, $suffix = '...')
{
    if (strlen($text) <= $length) {
        return $text;
    }

    return substr($text, 0, $length) . $suffix;
}

/**
 * Get initials from name
 */
function getInitials($name)
{
    $parts = explode(' ', $name);
    $initials = '';

    foreach ($parts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }

    return substr($initials, 0, 2);
}
