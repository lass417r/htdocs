<?php
require_once __DIR__ . '/../_.php';
// Initialize the profile picture from the SESSION
$profilePictureUrl = isset($_SESSION['user']['profile_picture']) && !empty($_SESSION['user']['profile_picture']) ? $_SESSION['user']['profile_picture'] : null;

// Generate a unique nonce for this request
$nonce = base64_encode(random_bytes(16));
$GLOBALS['nonce'] = $nonce;
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-$nonce'; object-src 'none'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;");

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
          <svg class="open_icon" width="20" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 2L21 2" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M1 18L21 18" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M1 10L21 10" stroke="white" stroke-width="2" stroke-linecap="round" />
          </svg>
          <svg class="close_icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 2L17.92 17.92" stroke="white" stroke-width="2" stroke-linecap="round" />
            <path d="M2.08008 18L18.0001 2.07998" stroke="white" stroke-width="2" stroke-linecap="round" />
          </svg>
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
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.2818 14.2731L21 21M16.5556 8.77778C16.5556 13.0733 13.0733 16.5556 8.77778 16.5556C4.48223 16.5556 1 13.0733 1 8.77778C1 4.48223 4.48223 1 8.77778 1C13.0733 1 16.5556 4.48223 16.5556 8.77778Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
        <a href="/account" class="flex items-center">
          <?php if ($profilePictureUrl) : ?>
            <img src="<?= htmlspecialchars($profilePictureUrl) ?>" alt="Profile Picture" class="w-8 h-8 object-cover rounded-full">
          <?php else : ?>
            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.66675 21V19.8235C1.66675 16.5748 4.30037 13.9412 7.5491 13.9412H12.255C15.5037 13.9412 18.1373 16.5748 18.1373 19.8235V21M14.6079 5.70588C14.6079 8.30487 12.501 10.4118 9.90204 10.4118C7.30305 10.4118 5.19616 8.30487 5.19616 5.70588C5.19616 3.10689 7.30305 1 9.90204 1C12.501 1 14.6079 3.10689 14.6079 5.70588Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
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
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.33325 17V16.0588C1.33325 13.4599 3.44015 11.3529 6.03913 11.3529H9.80384C12.4028 11.3529 14.5097 13.4599 14.5097 16.0588V17M11.6862 4.76471C11.6862 6.8439 10.0006 8.52941 7.92149 8.52941C5.8423 8.52941 4.15678 6.8439 4.15678 4.76471C4.15678 2.68552 5.8423 1 7.92149 1C10.0006 1 11.6862 2.68552 11.6862 4.76471Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Login
          </div>
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1L12 8L5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      <?php else : ?>
        <div class="flex flex-col gap-4">
          <a href=/account class="flex justify-between items-center bg-mr-grey p-4 rounded-2xl">
            <div class="flex items-center gap-4">
              <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.33325 17V16.0588C1.33325 13.4599 3.44015 11.3529 6.03913 11.3529H9.80384C12.4028 11.3529 14.5097 13.4599 14.5097 16.0588V17M11.6862 4.76471C11.6862 6.8439 10.0006 8.52941 7.92149 8.52941C5.8423 8.52941 4.15678 6.8439 4.15678 4.76471C4.15678 2.68552 5.8423 1 7.92149 1C10.0006 1 11.6862 2.68552 11.6862 4.76471Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              Account
            </div>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 1L12 8L5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
          <a href=/logout class="flex justify-between items-center bg-mr-grey p-4 rounded-2xl">
            <div class="flex items-center gap-4">
              <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.33325 17V16.0588C1.33325 13.4599 3.44015 11.3529 6.03913 11.3529H9.80384C12.4028 11.3529 14.5097 13.4599 14.5097 16.0588V17M11.6862 4.76471C11.6862 6.8439 10.0006 8.52941 7.92149 8.52941C5.8423 8.52941 4.15678 6.8439 4.15678 4.76471C4.15678 2.68552 5.8423 1 7.92149 1C10.0006 1 11.6862 2.68552 11.6862 4.76471Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              Logout
            </div>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 1L12 8L5 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </div>
      <?php endif ?>
    </div>
  </nav>
  <main class="flex-1 flex flex-col gap-8 pb-8 [&_input]:w-full [&_input]:outline-none [&_input]:bg-soft-white [&_input]:text-black [&_input]:px-4 [&_input]:py-3 [&_input]:rounded-2xl [&_input]:placeholder:text-transparent-50 [&_select]:bg-soft-white [&_select]:px-4 [&_select]:py-3 [&_select]:rounded-2xl [&_select]:text-transparent-50 [&_select]:h-full">