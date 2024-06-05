<?php
require_once __DIR__ . '/_header.php';
?>
<div class="h-[250px] relative rounded-b-2xl overflow-hidden -mt-16">
  <img src="/assets/ivan-torres-MQUqbmszGGM-unsplash.jpg" alt="pizza" class="object-cover w-full h-full">
  <div class="absolute inset-0 bg-transparent-50 flex items-end w-full">
    <div class="flex flex-col p-6 mx-auto container">
      <p class="opacity-75">Browse</p>
      <h1 class="font-semibold text-3xl">FIND A MEAL</h1>
    </div>
  </div>
</div>
<div class="flex justify-center px-6 mx-auto container">
  <?php
  $frm_search_value = $_POST['search'] ?? '';
  $frm_search_url = 'api-search-items.php';
  $frm_search_placeholder = 'Search for restaurants, cities & more';
  include_once __DIR__ . '/_form_search.php';
  ?>
</div>
<div class="container mx-auto px-6">
  <div class="bg-hot-noir shadow rounded-lg">
    <div class="flex justify-between items-center">
      <h1 class="text-lg leading-6 font-medium text-white mb-4">Resturants</h1>
      <!-- <?php
            $frm_search_url = 'api-search-items.php';
            include_once __DIR__ . '/_form_search.php';
            ?> -->
    </div>
    <div id="results" class="grid grid-cols-1 md:grid-cols-3 gap-4"></div>
  </div>
</div>
<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/browse.js"></script>
<?php endif; ?>
<?php require_once __DIR__ . '/_footer.php'; ?>