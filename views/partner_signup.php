<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>


<section class="flex flex-col items-center mx-auto container max-w-[500px] p-6">
  <div class="p-8 bg-50-shades text-soft-white rounded-md w-full">
    <div class="">
      <h1>Sign up as a partner today!</h1>
    </div>
    <form id="partner_signup_form" class="flex flex-col gap-4">
      <div class="grid">
        <h2 class="text-base pb-2 pt-4">Owner information</h2>
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_NAME_MIN ?> to <?= USER_NAME_MAX ?> characters</span>
        <label for="user_name">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="user_name" placeholder="First name" name="user_name" type="text" data-validate="str" data-min="<?= USER_NAME_MIN ?>" data-max="<?= USER_NAME_MAX ?>">
        </label>
      </div>

      <div class="grid">
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_LAST_NAME_MIN ?> to <?= USER_LAST_NAME_MAX ?> characters</span>
        <label for="user_last_name">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="user_last_name" name="user_last_name" placeholder="Last name" type="text" data-validate="str" data-min="<?= USER_LAST_NAME_MIN ?>" data-max="<?= USER_LAST_NAME_MAX ?>">
        </label>
      </div>

      <div class="grid">
        <h2 class="text-base pb-2 pt-4">Restaurant information</h2>
        <span class="ml-auto pb-0.5 mr-2 text-xs">2 to 60 characters</span>
        <label for="partner_name">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " id="partner_name" placeholder="Restaurant name" name="partner_name" type="text" data-validate="str" data-min="2" data-max="60">
        </label>
      </div>

      <div class="grid">
        <label id="msg_email_not_available" for="user_email" class="flex opacity-0">
          <span class="ml-auto mr-2 text-xs">Email is not available</span>
        </label>
        <input id="userEmail" class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_email" type="text" placeholder="Email" data-validate="email">

      </div>

      <div class="grid">
        <h2 class="text-base pb-2 pt-4">Restaurant password</h2>
        <span class="ml-auto pb-0.5 mr-2 text-xs"><?= USER_PASSWORD_MIN ?> to <?= USER_PASSWORD_MAX ?> characters</span>
        <label for="user_password">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_password" type="password" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
        </label>
      </div>

      <div class="grid">
        <span class="ml-auto text-xs opacity-0">x</span>
        <label for="user_confirm_password">
          <input class="pl-2 bg-transparent placeholder:text-transparent-50 focus:outline-none w-full " name="user_confirm_password" type="password" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
        </label>
      </div>

      <div class="grid gap-6">
        <span class="text-xs pt-2 text-grey-100">By clicking 'Create partner account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
        </span>
        <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Create partner account</button>
      </div>

    </form>
  </div>

  <a class="mt-8" href="/login">Already have an account? <span class="text-sexyred">Login</span></a>
</section>

<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    const msg_email_not_available = document.querySelector("#msg_email_not_available");
    document.getElementById('userEmail').addEventListener('focus', function() {
      msg_email_not_available.classList.add("opacity-0");
    });
    document.getElementById('userEmail').addEventListener('blur', function() {
      is_email_available();
    });
    document.getElementById('partner_signup_form').addEventListener('submit', function() {
      validate(partner_signup);
      return false;
    });
  </script>
<?php endif; ?>

<?php require_once __DIR__ . '/_footer.php'  ?>