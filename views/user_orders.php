<?php
require_once __DIR__ . '/../_.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: /login');
  exit();
}
require_once __DIR__ . '/_header.php';
?>


<section class="flex flex-col container mx-auto gap-8 p-6">

  <div class="flex justify-center">

    <?php
    $frm_search_url = 'api-search-user-orders.php';
    $frm_search_placeholder = 'Search for orders';
    include_once __DIR__ . '/_form_search.php'
    ?>

  </div>
  <div class="p-6 bg-50-shades rounded-md text-soft-white">
    <div class="flex pb-4 text-xl">
      <h1 class="text-soft-white">
        Your orders
      </h1>

    </div>
    <div class="grid grid-cols-[2fr_1fr_2fr] md:grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
      <div id="sort_created_at" class="cursor-pointer">Order created: <span id="direction"></span></div>
      <div id="sort_id" class="cursor-pointer">Order ID: <span id="direction"></span></div>
      <div id="sort_created_by" class="cursor-pointer hidden md:block">Order created by: <span id="direction"></span></div>
      <div id="sort_delivered" class="cursor-pointer">Order status: <span id="direction"></span></div>
      <div id="sort_delivered_by" class="cursor-pointer hidden md:block">Delivered by: <span id="direction"></span></div>
    </div>
    <div id="results"></div>
  </div>
</section>

<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/orders.js"></script>
<?php endif; ?>
<?php
require_once __DIR__ . '/_footer.php';
?>