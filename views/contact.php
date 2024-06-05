<?php
require_once __DIR__ . '/_header.php';
?>
<div class="h-[250px] relative rounded-b-2xl overflow-hidden -mt-16">
    <img src="/assets/burger.png" alt="pizza" class="object-cover w-full h-full">
    <div class="absolute inset-0 bg-transparent-50 flex items-end w-full">
        <div class="flex flex-col p-6 mx-auto container uppercase">
            <p class="opacity-75">Page</p>
            <h1 class="font-semibold text-3xl">Contact</h1>
        </div>
    </div>
</div>
<div class="px-5 container mx-auto grid md:grid-cols-2 gap-4">
    <form action="" id="contactForm" class="text-mr-grey flex flex-col gap-4">
        <h2 class="uppercase pl-2 text-white">Send us a message</h2>
        <label for="name" class="flex gap-4 items-center px-4 py-3 bg-soft-white rounded-2xl">
            <img src="../assets/svgs/person.svg" alt="Account icon" class="w-6 h-6 object-cover rounded-full">
            <input type="text" id="name" name="name" class="!rounded-none !p-0" placeholder="Full name">
        </label>
        <label for="email" class="flex gap-4 items-center px-4 py-3 bg-soft-white rounded-2xl">
            <img src="../assets/svgs/email.svg" alt="Account icon" class="w-6 h-6 object-cover rounded-full">
            <input type="text" id="email" name="email" class="!rounded-none !p-0" placeholder="Full name">
        </label>
        <textarea name="message" id="message" rows="6" class="rounded-2xl bg-soft-white p-4 w-full flex-1" placeholder="Message"></textarea>
        <input type="submit" value="Send message" class="font-semibold mt-4 cursor-pointer hover:opacity-50" disabled>
    </form>
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-4">
            <h2 class="uppercase pl-2">Contact information</h2>
            <address class="rounded-2xl bg-50-shades flex flex-col gap-4 p-4 not-italic">
                <div class="flex flex-col">
                    <h3 class="font-semibold">Address:</h3>
                    <p class="italic">1234 Sunset Boulevard</p>
                    <p class="italic">Los Angeles, CA 90028</p>
                    <p class="italic">USA</p>
                </div>
                <p class="font-semibold">Phone: <a href="tel:2135557890" class="font-normal">(213) 555-7890</a></p>
                <p class="font-semibold">Email: <a href="mailto:info@yumhub.com" class="underline font-normal">info@yumhub.com</a></p>
            </address>
        </div>
        <div class="flex flex-col gap-4">
            <h2 class="uppercase pl-2">Customer support hours</h2>
            <div class="rounded-2xl bg-50-shades flex flex-col gap-4 p-4 font-semibold">
                <p>Monday - Friday: <span class="font-normal italic">9:00 AM - 6:00 PM</span></p>
                <p>Saturday: <span class="font-normal italic">10:00 AM - 4:00 PM</span></p>
                <p>Sunday: <span class="font-normal italic">Closed</span></p>
                <div class="flex flex-col">
                    <p>Feedback & inquiries:</p> <a href="mailto:info@yumhub.com" class="underline font-normal">info@yumhub.com</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-4 items-center text-black mx-auto container px-5">
    <img src="/assets/partner.png" alt="pizza" class="object-cover w-full h-full rounded-2xl">
    <div class="w-full max-w-[400px]">
        <a href="/partner_signup" class="flex bg-sexyred hover:bg-sexyred-light rounded-2xl px-4 py-3 w-full justify-center font-bold">Become a partner now</a>
    </div>
</div>
<?php global $nonce;
if (isset($nonce)) : ?>
    <script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
        document.getElementById('contactForm').addEventListener('submit', function() {
            return false
        });
        document.querySelector('contactForm').onsubmit = function() {
            return false;
        };
    </script>
<?php endif; ?>
<?php require_once __DIR__ . '/_footer.php'; ?>