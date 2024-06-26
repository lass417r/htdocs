<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<section class="flex flex-col items-center mx-auto container max-w-[500px] p-6">
  <div class="p-8 bg-50-shades text-soft-white rounded-md w-full">
    <div class="">
      <h1>Welcome</h1>
      <p>Sign up with email</p>
    </div>
    <form id="user_signup_form" class="flex flex-col gap-4 ">
      <div class="grid">
        <label for="user_name" class="flex">
          <span class="font-bold hidden text-sexyred">name</span>
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= out(USER_NAME_MIN) ?> to <?= out(USER_NAME_MAX) ?> characters</span>
        </label>
        <input id="user_name" placeholder="First name" name="user_name" type="text" data-validate="str" data-min="<?= out(USER_NAME_MIN) ?>" data-max="<?= out(USER_NAME_MAX) ?>">
      </div>

      <div class="grid">
        <label for="user_last_name" class="flex">
          <span class="font-bold hidden text-sexyred">last name</span>
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= out(USER_LAST_NAME_MIN) ?> to <?= out(USER_LAST_NAME_MAX) ?> characters</span>
        </label>
        <input id="user_last_name" name="user_last_name" placeholder="Last name" type="text" data-validate="str" data-min="<?= out(USER_LAST_NAME_MIN) ?>" data-max="<?= out(USER_LAST_NAME_MAX) ?>">
      </div>

      <div class="grid">
        <label id="msg_email_not_available" for="user_email" class="flex opacity-0">
          <span class="ml-auto mr-2 text-xs">Email is not available</span>
        </label>
        <input id="userEmail" name="user_email" type="text" placeholder="Email" data-validate="email">

      </div>

      <div class="grid" class="flex">
        <label for="user_name" class="flex">
          <span class="ml-auto pb-0.5 mr-2 text-xs"><?= out(USER_PASSWORD_MIN) ?> to <?= out(USER_PASSWORD_MAX) ?> characters</span>
        </label>
        <input name="user_password" type="password" placeholder="Password" data-validate="str" data-min="<?= out(USER_PASSWORD_MIN) ?>" data-max="<?= out(USER_PASSWORD_MAX) ?>">
      </div>

      <div class="grid">
        <span class="ml-auto text-xs opacity-0">x</span>
        <input name="user_confirm_password" type="password" placeholder="Confirm password" data-validate="match" data-match-name="user_password">
      </div>

      <div class="grid">
        <span class="text-xs py-2 text-grey-100">By clicking 'Create Account', you consent to our Terms of Service. Discover how we handle your information in our Privacy Policy and our use of cookies in our Cookie Policy.
        </span>
        <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Create account</button>
      </div>
    </form>
  </div>

  <a class="mt-8" href="/login">Already have an account? <span class="text-sexyred">Login</span></a>

</section>


<?php
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    const msg_email_not_available = document.querySelector("#msg_email_not_available");
    document.getElementById('userEmail').addEventListener('focus', function() {
      msg_email_not_available.classList.add("opacity-0");
    });
    document.getElementById('userEmail').addEventListener('blur', function() {
      is_email_available();
    });
    document.getElementById('user_signup_form').addEventListener('submit', function() {
      validate(signup);
      return false
    });
  </script>
<?php endif; ?>

<?php require_once __DIR__ . '/_footer.php'  ?>