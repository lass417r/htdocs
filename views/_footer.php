</main>
<footer class="bg-sexyred-light text-black grid md:grid-cols-2 justify-center md:justify-between gap-8 md:gap-y-4 py-4 px-6 rounded-t-3xl">
    <div class="md:col-span-2 flex justify-center md:justify-start">
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
    <div class="flex flex-col gap-4 md:gap-0 items-center md:items-start">
        <div class="text-center md:text-left">
            <p class="font-bold">Feedback & Inquiries</p>
            <a href="mailto:feedback@yumhub.com">feedback@yumhub.com</a>
        </div>
        <div class="flex md:flex-col gap-8 md:gap-0">
            <div class="text-center md:text-left">
                <p class="font-bold">Phone</p>
                <a href="tel:2135557890" class="underline">(213) 555-7890</a>
            </div>
            <div class="text-center md:text-left">
                <p class="font-bold">Email</p>
                <a href="mailto:info@yumhub.com" class="underline">info@yumhub.com</a>
            </div>
        </div>
    </div>
    <div class="flex max-w-[380px] place-self-end">
        <address class="pr-8 w-full">
            <p class="font-bold">Address</p>
            <p>1234 Sunset Boulevard</p>
            <p>Los Angeles, CA 90028</p>
            <p>USA</p>
        </address>
        <div class="text-right w-full min-w-max">
            <p class="font-bold">Monday - Friday</p>
            <p>9:00 AM - 6:00 PM</p>
            <p class="font-bold">Saturday</p>
            <p>10:00 AM - 4:00 PM</p>
            <p class="font-bold">Sunday</p>
            <p>Closed</p>
        </div>
    </div>
</footer>

<?php global $nonce;
if (isset($nonce)) : ?>
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/app.js"></script>
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>" src="../js/validator.js"></script>

    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
        document.getElementById('goBackButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>
<?php endif; ?>
</body>

</html>