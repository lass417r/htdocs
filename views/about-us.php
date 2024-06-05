<?php
require_once __DIR__ . '/_header.php';
?>
<div class="h-[250px] relative rounded-b-2xl overflow-hidden -mt-16">
    <img src="/assets/bacon.png" alt="bacon" class="object-cover w-full h-full">
    <div class="absolute inset-0 bg-transparent-50 flex items-end w-full">
        <div class="flex flex-col p-6 mx-auto container uppercase">
            <p class="opacity-75">Page</p>
            <h1 class="font-semibold text-3xl">About us</h1>
        </div>
    </div>
</div>
<div class="px-5 container mx-auto grid md:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="rounded-2xl bg-50-shades flex flex-col gap-4 p-4 font-semibold col-span-full md:order-1">
        <p>At YumHub, we believe that every meal should be a moment of joy, a burst of flavor that brings people together. Our mission is simple:</p>
        <p class="text-sexyred">To deliver delight in every bite!</p>
    </div>
    <div class="md:relative md:order-2 rounded-2xl overflow-hidden">
        <img src="/assets/yumhub.png" alt="yumhub" class="md:absolute inset-0 object-cover object-left w-full h-full">
    </div>
    <div class="justify-center rounded-2xl bg-50-shades flex flex-col gap-4 p-4 md:order-3">
        <p class="font-semibold">We envision a world where convenience meets culinary excellence.</p>
        <p class="text-right">Where families, friends, and individuals can savor a diverse range of delectable dishes, handpicked for their quality and taste.</p>
        <p>YumHub strives to be more than just a food delivery service; we're your partner in creating unforgettable dining experiences.</p>
    </div>
    <div class="md:relative md:order-5 xl:order-4 rounded-2xl overflow-hidden">
        <img src="/assets/delivery.png" alt="delivery" class="md:absolute inset-0 object-cover w-full h-full">
    </div>
    <div class="justify-center rounded-2xl bg-50-shades flex flex-col gap-4 p-4 md:order-4 xl:order-5">
        <p>YumHub was born out of a passion for good food and a desire to make it accessible to everyone, anytime, anywhere.</p>
        <p>Our journey began in a small kitchen with a big dream - to bring the finest cuisines from the heart of the city to your doorstep.</p>
    </div>
</div>
<?php require_once __DIR__ . '/_footer.php'; ?>