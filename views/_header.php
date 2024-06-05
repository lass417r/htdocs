<?php
require_once __DIR__ . '/../_.php';
// Initialize the profile picture from the SESSION
$profilePictureUrl = isset($_SESSION['user']['profile_picture']) && !empty($_SESSION['user']['profile_picture']) ? $_SESSION['user']['profile_picture'] : null;

// Generate a unique nonce for this request
// $nonce = base64_encode(random_bytes(16));
// $GLOBALS['nonce'] = $nonce;
// header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-$nonce'; object-src 'none'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;");

// Generate a unique nonce for this request + nonce to style-src
$nonce = base64_encode(random_bytes(16));
$GLOBALS['nonce'] = $nonce;
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-$nonce'; object-src 'none'; style-src 'self' 'nonce-$nonce' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="/index.css">
  <link rel="stylesheet" href="/app.css">

  <title>YumHub</title>
</head>

<body class="flex flex-col w-full min-h-screen bg-hot-noir text-white">
  <header class="sticky top-0 left-0 right-0 z-20 ">
    <nav class="grid grid-cols-[1fr_auto_1fr] px-6 py-4">

      <div class="flex gap-4">
        <div id="open_menu" class="flex items-center">
          <img class="open_icon" src="../assets/svgs/menu.svg" alt="Menu icon">
          <img class="close_icon" src="../assets/svgs/close.svg" alt="Close menu icon">
        </div>
      </div>
      <div>
        <a href="/" class="relative">
          <p class=" font-semibold text-2xl italic">YumHub</p>
          <p class="absolute text-xs top-0 left-full">
            <?php if (_is_admin()) : ?>
              (admin)
            <?php endif ?>
            <?php if (_is_partner()) : ?>
              (partner)
            <?php endif ?>
            <?php if (_is_employee()) : ?>
              (employee)
            <?php endif ?>
          </p>
        </a>
      </div>
      <div class="flex justify-end gap-6">
        <a href="/browse" class="flex items-center">
          <img src="../assets/svgs/search.svg" alt="Account icon">
        </a>
        <a href="/account" class="flex items-center">
          <?php if ($profilePictureUrl) : ?>
            <img src="<?= htmlspecialchars($profilePictureUrl) ?>" alt="Profile Picture" class="w-8 h-8 object-cover rounded-full">
          <?php else : ?>
            <img src="../assets/svgs/account.svg" alt="Account icon">
          <?php endif; ?>
        </a>
      </div>
    </nav>
  </header>
  <nav id="mobile" class="fixed inset-0 z-10 -translate-x-full duration-300">
    <div id="menu_whitespace" class="relative w-full h-full"></div>
    <div class="absolute inset-0 bg-50-shades p-6 pt-16 md:max-w-[390px] flex flex-col justify-between uppercase">
      <div class="flex flex-col gap-6">
        <?php if (_is_admin()) : ?>
          <a href="/all_users" class="flex items-center">
            All users
          </a>
          <a href="/all_orders" class="flex items-center">
            All orders
          </a>
        <?php endif ?>
        <?php if (_is_partner()) : ?>
          <a href="/partner_orders" class="flex items-center">
            Orders
          </a>
          <a href="/partner_items" class="flex items-center">
            Products
          </a>
          <!-- TODO: Orders made for partner store -->
        <?php endif ?>
        <?php if (_is_employee()) : ?>
          <a href="/employee_orders" class="flex items-center">
            Orders
          </a>
        <?php endif ?>
        <?php if (_is_customer()) : ?>
          <a href="/user_orders">Your orders</a>
        <?php endif ?>
        <a href="/browse">Browse</a>
        <a href="/contact">Contact</a>
        <a href="/about-us">About us</a>
      </div>
      <?php
      if (!isset($_SESSION['user']) || !$_SESSION['user']) : ?>
        <a href=/login class="flex justify-between items-center bg-mr-grey p-4 rounded-2xl">
          <div class="flex items-center gap-4">
            <img src="../assets/svgs/login.svg" alt="Login icon">
            Login
          </div>
        </a>
      <?php else : ?>
        <div class="flex flex-col gap-4">
          <a href=/account class="flex justify-between items-center bg-mr-grey p-4 rounded-2xl">
            <div class="flex items-center gap-4">
              <img src="../assets/svgs/account.svg" alt="Account icon">
              Account
            </div>
            <img src="../assets/svgs/arrow.svg" alt="Arrow icon">
          </a>
          <a href=/logout class="flex justify-between items-center bg-mr-grey p-4 rounded-2xl">
            <div class="flex items-center gap-4">
              <img src="../assets/svgs/logout.svg" alt="Logout icon">
              Logout
            </div>
          </a>
        </div>
      <?php endif ?>
    </div>
  </nav>
  <main class="flex-1 flex flex-col gap-8 pb-8 [&_input]:w-full [&_input]:outline-none [&_input]:bg-soft-white [&_input]:text-black [&_input]:px-4 [&_input]:py-3 [&_input]:rounded-2xl [&_input]:placeholder:text-transparent-50 [&_select]:bg-soft-white [&_select]:px-4 [&_select]:py-3 [&_select]:rounded-2xl [&_select]:text-transparent-50 [&_select]:h-full">