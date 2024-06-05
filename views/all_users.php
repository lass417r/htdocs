<?php
require_once __DIR__ . '/../_.php';
if (!_is_admin()) {
  header('Location: /login');
  exit();
};
require_once __DIR__ . '/_header.php';

?>

<section class="flex flex-col container mx-auto gap-8 p-6">
  <div class="flex justify-center">
    <?php
    $frm_search_url = 'api-search-all-users.php';
    $frm_search_placeholder = 'Search for users';
    include_once __DIR__ . '/_form_search.php'
    ?>
  </div>
  <div class="p-6 bg-50-shades rounded-md text-soft-white">

    <div class="flex pb-4 text-xl">
      <h1 class="text-soft-white">
        All users
      </h1>

    </div>
    <div class="grid grid-cols-[auto_1fr_1fr_1fr] md:grid-cols-[auto_1fr_1fr_1fr_2fr_1fr] items-center gap-4 border-b border-b-slate-200 py-2">
      <div class="w-8 rounded-full"></div>
      <div class="cursor-pointer" id="sort_name">Name <span id="direction"></span></div>
      <div class="cursor-pointer" id="sort_last_name">Last name <span id="direction"></span></div>
      <div class="cursor-pointer" id="sort_role">Role <span id="direction"></span></div>
      <div class="cursor-pointer hidden md:block" id="sort_email" class="hidden md:block">Email <span id="direction"></span></div>
      <div class="cursor-pointer text-right hidden md:block" id="sort_status" class="hidden md:block text-right">Status <span id="direction"></span></div>
    </div>
    <div id="results"></div>

  </div>
</section>
<?php global $nonce; ?>
<script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
  (function() {
    const nonce = "<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>";
    window.getNonce = function() {
      return nonce;
    };
  })();
</script>
<script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/users.js"></script>
<?php
require_once __DIR__ . '/_footer.php';
?>