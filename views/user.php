<?php
require_once __DIR__ . '/../_.php';


if (isset($_GET['id']) && _is_admin()) {
  $user_id = $_GET['id'];
  $db = _db();
  $q = $db->prepare(' SELECT * 
                          FROM users WHERE user_id = :user_id');
  $q->bindValue(':user_id', $user_id);
  $q->execute();
  $user = $q->fetch();
} else {
  header('Location: /login');
  exit();
}
require_once __DIR__ . '/_header.php';

?>


<section class=" gap-4 p-6 container mx-auto ">
  <div class="pb-5">
    <button id="goBackButton" class="text-left flex gap-2">
      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D0D0D0" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 299.021 299.021" xml:space="preserve">
        <g>
          <path d="M292.866,254.432c-2.288,0-4.443-1.285-5.5-3.399c-0.354-0.684-28.541-52.949-146.169-54.727v51.977    c0,2.342-1.333,4.48-3.432,5.513c-2.096,1.033-4.594,0.793-6.461-0.63L2.417,154.392C0.898,153.227,0,151.425,0,149.516    c0-1.919,0.898-3.72,2.417-4.888l128.893-98.77c1.87-1.426,4.365-1.667,6.461-0.639c2.099,1.026,3.432,3.173,3.432,5.509v54.776    c3.111-0.198,7.164-0.37,11.947-0.37c43.861,0,145.871,13.952,145.871,143.136c0,2.858-1.964,5.344-4.75,5.993    C293.802,254.384,293.34,254.432,292.866,254.432z" />
        </g>
      </svg>
      Go Back
    </button>
  </div>
  <div class=" flex flex-col gap-4">
    <div class="grid md:grid-cols-2 gap-4">
      <div class="flex  gap-2 flex-col p-4 bg-50-shades rounded-md text-soft-white">
        <h2 class="font-extrabold ">Profile</h2>
        <div class="hidden"><?= $user['user_id'] ?></div>
        <div class="grid grid-cols-2 ">
          <div>First name: </div>
          <div><?php out($user['user_name']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Last name: </div>
          <div><?php out($user['user_last_name']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Email: </div>
          <div><?php out($user['user_email']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Address: </div>
          <div><?php out($user['user_address']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>User ID: </div>
          <div><?php out($user['user_id']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Account created: </div>
          <div><?php echo date("d/m/Y H.i", $user['user_created_at']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Account updated: </div>
          <div><?php echo date("d/m/Y H.i", $user['user_updated_at']) ?></div>
        </div>
        <div class="grid grid-cols-2 ">
          <div>Account deleted: </div>
          <div>
            <?php
            if ($user['user_deleted_at'] != 0) {
              echo date("d/m/Y H.i", $user['user_deleted_at']);
            } else {
              echo "User not deleted";
            }
            ?>
          </div>
        </div>
      </div>
      <div id="update_account" class="flex flex-col  p-4 bg-50-shades rounded-md text-soft-white">
        <div class="pb-4">
          <h2 class="font-extrabold ">Update profile</h2>
        </div>
        <form class="flex flex-col gap-4" id="update_user_form_admin">
          <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
          <label class="flex flex-col" for="user_name">Name:
            <input class="pl-2" type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>">
          </label>
          <label class="flex flex-col" for="user_last_name">Last Name:
            <input class="pl-2" type="text" id="user_last_name" name="user_last_name" value="<?= $user['user_last_name'] ?>" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
          </label>
          <label class="flex flex-col" for="user_email">Email:
            <input class="pl-2" type="text" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" data-validate="email">
          </label>
          <label class="flex flex-col" for="user_address">Address:
            <input class="pl-2" type="text" id="user_address" name="user_address" value="<?= $user['user_address'] ?>" data-validate="str" data-max="255">
          </label>
          <label class="flex flex-col" for="user_tag_colo">Profile color:
            <input type="color" class="h-12" id="user_tag_color" name="user_tag_color" value="<?= $user['user_tag_color'] ?>">
          </label>
          <div id="user_error"></div>
          <input type="submit" value="Update profile">
        </form>
      </div>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
      <div id="block" class="flex flex-col p-8   bg-50-shades rounded-md text-soft-white">
        <div class="pb-4">
          <h2 class="font-extrabold ">Block <?= $user['user_name'] ?> <?= $user['user_last_name'] ?></h2>
          <p>
            This action will block <?php out($user['user_name']) ?> from accessing our system.
            Please proceed with caution.</p>
        </div>
        <div class="flex flex-row items-center">
          <span class="material-symbols-outlined mr-2">
            BLOCK
          </span>
          <button class="font-bold flex items-center" id="admin_block_user">
            <?= $user['user_is_blocked'] == 0 ? "USER NOT BLOCKED" : "USER BLOCKED"; ?>
          </button>
        </div>
      </div>

      <div id="delete" class="flex flex-col p-8   bg-50-shades rounded-md text-soft-white">
        <div class="text-red-500">
          <h2 class=" font-extrabold ">Delete <?php out($user['user_name']) ?>'s account. </h2>
          <p>
            This action is irreversible and will permanently remove <?php out($user['user_name']) ?>'s account from our system.
            Please proceed with caution.</p>
        </div>
        <form id="admin_delete_user_form">
          <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
          <button class="text-red-500 mt-6 font-bold flex items-center">
            <span class="material-symbols-outlined mr-2">
              delete
            </span>
            DELETE ACCOUNT
          </button>
        </form>
      </div>
    </div>
</section>
<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('update_user_form_admin').addEventListener('submit', function() {
      validate(update_user);
      return false
    });

    document.getElementById('admin_block_user').addEventListener('click', function() {
      toggle_blocked('<?= $user['user_id']; ?>', '<?= $user['user_is_blocked']; ?>')
    });

    document.getElementById('admin_delete_user_form').addEventListener('submit', function() {
      if (confirm('You are about to permanently remove the account from our system. Do you want to continue?')) {
        admin_delete_user();
        setTimeout(function() {
          location.reload();
        }, 1000);
      }
      return false;
    });
  </script>
<?php endif; ?>



<?php
require_once __DIR__ . '/_footer.php';
?>