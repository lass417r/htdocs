<?php
require_once __DIR__ . '/../_.php';
if (!_is_partner()) {
  header('Location: /login');
  exit();
};
require_once __DIR__ . '/_header.php';

$db = _db();
$q = $db->prepare('
        SELECT * FROM `items`
        WHERE `item_created_by_user_fk` = :user_id
        AND `item_deleted_at` = 0');
$q->bindValue(':user_id', $_SESSION['user_id']);
$q->execute();
$items = $q->fetchAll();

?>
<div class="grid md:grid-cols-2 gap-6 mx-auto container p-6 ">
  <div class="flex flex-col gap-5 ">
    <div class="flex flex-col gap-4  top-10  sticky">
      <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
        <div class="font-bold">
          <h2>Add a new product</h2>
        </div>
        <form id="partner_add_item_form" class="flex flex-col gap-6 w-full h-full pt-4">
          <label for="add_item_name">
            <input type="text" name="add_item_name" placeholder="Item Name" required data-validate="str" data-min="2" data-max="60">
          </label>
          <label for="add_item_price">
            <input type="number" name="add_item_price" placeholder="Item Price" required data-validate="str" data-min="1" data-max="10">
          </label>
          <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Add Item</button>
        </form>
      </div>

      <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
        <div class="font-bold">
          <h2>Update a product</h2>
        </div>
        <form id="partner_update_item_form" class="flex flex-col gap-6 w-full h-full pt-4">
          <label class="hidden" for="item_id">
            <input class="" type="text" name="item_id" value="">
          </label>
          <!-- ... -->
          <label for="item_id">
            <select id="itemSelect" class="w-full" name="item_id" required data-validate="str" data-min="1" data-max="60">
              <option hidden>Select a product</option>
              <?php foreach ($items as $item) : ?>
                <option value="<?= $item['item_id'] ?>" data-name="<?= $item['item_name'] ?>"><?= $item['item_name'] ?></option>
              <?php endforeach ?>
            </select>
          </label>
          <label for="item_name">
            <input type="text" name="item_name" placeholder="Item name" required data-validate="str" data-min="1" data-max="50">
          </label>
          <label for="item_price">
            <input type="number" name="item_price" placeholder="Item Price" required data-validate="str" data-min="1" data-max="10">
          </label>
          <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Update Item</button>
        </form>
      </div>
    </div>
  </div>
  <section>
    <div class="flex flex-col py-8 px-8 bg-50-shades rounded-md text-soft-white">
      <div class="font-bold">
        <h2>Items</h2>
      </div>

      <div class="pt-1 flex flex-col gap-4">
        <div class="grid grid-cols-[1fr_2fr_1fr_1fr]  items-center gap-4 border-b border-b-slate-200">
          <p class="text-lg">ID:</p>
          <p class="text-lg">Name:</p>
          <p class="text-lg">Price:</p>
          <p class="text-lg text-right">Options:</p>
        </div>
        <?php if (!$items) : ?>
          <div class="w-full text-center">
            <h2>No items in the system</h2>
          </div>
        <?php endif ?>
        <?php foreach ($items as $item) : ?>

          <div class="grid grid-cols-[1fr_2fr_1fr_1fr]  items-center gap-4 border-b border-b-slate-200">
            <p class="text-lg"><?= $item['item_id'] ?></p>
            <p class="text-lg"><?= $item['item_name'] ?></p>
            <p class="text-lg"><?= $item['item_price'] ?></p>
            <div id="options" class="flex align-between justify-end gap-2">
              <form class="partner_hide_item_form">
                <input type="text" name="item_id" class="hidden" value="<?= $item['item_id'] ?>">
                <input type="hidden" name="private_status" value="<?= $item['item_private'] ? 0 : 1 ?>">
                <button id="toggleButton-<?= $item['item_id'] ?>" class="float-right hover:cursor-pointer" type="submit">
                  <img id="visibleIcon-<?= $item['item_id'] ?>" src="../assets/svgs/visible_eye.svg" alt="Visible icon" class="icon <?= $item['item_private'] ? 'hidden' : 'visible' ?>">
                  <img id="hiddenIcon-<?= $item['item_id'] ?>" src="../assets/svgs/hidden_eye.svg" alt="Hidden icon" class="icon <?= $item['item_private'] ? 'visible' : 'hidden' ?>">
                </button>
              </form>
              <form id="partner_delete_item_form">
                <input type="text" name="item_id" class="hidden" value="<?= $item['item_id'] ?>">
                <button class="float-right hover:cursor-pointer " type="submit" value="">
                  <img src="../assets/svgs/delete.svg" alt="Delete icon">
                </button>
              </form>
            </div>
          </div>

        <?php endforeach ?>

      </div>
  </section>
</div>

<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/item.js"></script>

  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('partner_add_item_form').addEventListener('submit', function() {
      validate(add_item);
      return false
    });
  </script>

  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('partner_update_item_form').addEventListener('submit', function() {
      validate(update_item);
      return false
    });
  </script>

  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('itemSelect').addEventListener('change', function() {
      load_item()
    });
  </script>

  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('partner_hide_item_form').addEventListener('submit', function() {
      private_item();
      return false;
    });
  </script>

  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('partner_delete_item_form').addEventListener('submit', function() {
      if (confirm('You are about to permanently deleted this product from our system. Do you want to continue?')) {
        delete_item();
        return false;
      }
    });
  </script>

<?php endif; ?>

<?php require_once __DIR__ . '/_footer.php'  ?>