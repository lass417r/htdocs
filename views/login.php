<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<section class="flex flex-col items-center mx-auto container max-w-[500px] p-6">
  <div class="p-8 bg-50-shades text-soft-white rounded-md w-full">
    <h1>Welcome back</h1>
    <p>Login with email</p>
    <form id="user_login_form" class="flex flex-col gap-6 w-full h-full m-auto pt-8">
      <label for="user_email">
        <input name="user_email" type="email" id="user_email" placeholder="Email" data-validate="email">
      </label>
      <label for="user_password">
        <input name="user_password" type="password" id="password" placeholder="Password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>">
      </label>
      <div class="text-sexyred" id="login_error"></div>
      <button class="w-full px-4 py-3 bg-sexyred text-white font-bold rounded-2xl">Login</button>
    </form>
  </div>
  <a class="mt-8" href="/signup">Don't have an account? <span class="text-sexyred">Sign up</span></a>
</section>

<?php global $nonce;
if (isset($nonce)) : ?>
  <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
    document.getElementById('user_login_form').addEventListener('submit', function() {
      validate(login);
      return false
    });
  </script>
<?php endif; ?>

<?php
require_once __DIR__ . '/_footer.php';
?>