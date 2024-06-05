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
    <form action="" class="text-mr-grey flex flex-col gap-4">
        <h2 class="uppercase pl-2 text-white">Send us a message</h2>
        <label for="name" class="flex gap-4 items-center px-4 py-3 bg-soft-white rounded-2xl">
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.33337 17V16.0588C1.33337 13.4599 3.44027 11.3529 6.03926 11.3529H9.80396C12.4029 11.3529 14.5098 13.4599 14.5098 16.0588V17M11.6863 4.76471C11.6863 6.8439 10.0008 8.52941 7.92161 8.52941C5.84242 8.52941 4.1569 6.8439 4.1569 4.76471C4.1569 2.68552 5.84242 1 7.92161 1C10.0008 1 11.6863 2.68552 11.6863 4.76471Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="text" id="name" name="name" class="!rounded-none !p-0" placeholder="Full name">
        </label>
        <label for="email" class="flex gap-4 items-center px-4 py-3 bg-soft-white rounded-2xl">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.8008 15.4C12.4636 16.4046 10.8013 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1C13.4183 1 17 4.58172 17 9V10.3333C17 11.5606 16.0051 12.5556 14.7778 12.5556C13.5505 12.5556 12.5556 11.5606 12.5556 10.3333V5.44444M12.5556 9C12.5556 10.9636 10.9636 12.5556 9 12.5556C7.03632 12.5556 5.44444 10.9636 5.44444 9C5.44444 7.03632 7.03632 5.44444 9 5.44444C10.9636 5.44444 12.5556 7.03632 12.5556 9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="text" id="email" name="email" class="!rounded-none !p-0" placeholder="Full name">
        </label>
        <textarea name="message" id="message" rows="6" class="rounded-2xl bg-soft-white p-4 w-full flex-1" placeholder="Message"></textarea>
        <input type="submit" value="Send message" class="font-semibold mt-4 cursor-pointer hover:opacity-50">
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
<?php require_once __DIR__ . '/_footer.php'; ?>