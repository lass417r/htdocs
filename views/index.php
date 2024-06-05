<?php
require_once __DIR__ . '/_header.php';

$db = _db();
$q = $db->prepare('SELECT items.*, partners.partner_name FROM items 
                   INNER JOIN users ON items.item_created_by_user_fk = users.user_id 
                   INNER JOIN partners ON users.user_id = partners.user_partner_id 
                   ORDER BY partners.partner_name');
$q->execute();
$items = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="h-[500px] relative rounded-b-2xl overflow-hidden -mt-16">
    <img src="/assets/ivan-torres-MQUqbmszGGM-unsplash.jpg" alt="pizza" class="object-cover w-full h-full">
    <div class="absolute inset-0 p-6 bg-transparent-50 grid grid-rows-3 grid-cols-1 justify-between w-full">
        <div class="row-start-2 flex flex-col gap-2 justify-center items-center">
            <form method="post" action="/browse" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey w-full max-w-[390px]">
                <label for="search">
                    <img src="../assets/svgs/search_black.svg" alt="Account icon" class="w-18 h-18 object-cover rounded-full">
                </label>
                <input type="text" name="search" id="search" placeholder="Search for restaurants, cities & more" class="w-full bg-transparent placeholder:text-transparent-50 focus:outline-none !rounded-none !p-0">
            </form>
            <a href="/browse" class="underline">See all restaurants</a>
        </div>
        <div class="row-start-3 flex flex-col justify-end">
            <p class="opacity-75">Delight in every bite!</p>
            <h1 class="font-semibold text-3xl italic">YumHub</h1>
        </div>
    </div>
</div>

<div class="container mx-auto grid sm:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4 justify-center px-6">
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <img src="../assets/svgs/pin.svg" alt="Account icon" class="w-32 h-32 max-w-[64px] max-h-[64px] object-cover ">
        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Tell us where you are</h2>
            <p class="text-sm">We'll show you our stores and resturants close to you that you can order from.</p>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <img src="../assets/svgs/fastfood.svg" alt="Account icon" class="w-32 h-32 max-w-[64px] max-h-[64px] object-cover ">

        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Find what you want</h2>
            <p class="text-sm">Search for items or dishes, businesses or cuisines.</p>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <img src="../assets/svgs/bike.svg" alt="Account icon" class="w-32 h-32 max-w-[64px] max-h-[64px] object-cover ">

        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Order for delivery or pickup</h2>
            <p class="text-sm">We'll keep you updated on the progress of your order.</p>
        </div>
    </div>
</div>
<div class="flex flex-col gap-4 items-center text-black">
    <div class="bg-sexyred-light px-6 py-16 w-full rounded-2xl flex justify-center items-center">
        <div class="flex">
            <p class="font-semibold text-5xl italic">YumHub</p>
            <p class="text-xl">(partner)</p>
        </div>
    </div>
    <div class="px-6 w-full max-w-[400px]">
        <a href="/partner_signup" class="flex bg-sexyred hover:bg-sexyred-light rounded-2xl px-4 py-3 w-full justify-center font-bold">Become a partner now</a>
    </div>
</div>
<div class="container mx-auto grid sm:grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4 justify-center px-6">
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <img src="../assets/svgs/guarantee.svg" alt="Account icon" class="w-32 h-32 max-w-[64px] max-h-[64px] object-cover rounded-full">

        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">We guarantee</h2>
            <ul class="text-sm text-left list-disc ml-4">
                <li>Excellent service</li>
                <li>Authentic user reviews</li>
            </ul>
        </div>
    </div>
    <div class="bg-50-shades flex w-full flex-wrap rounded-2xl overflow-hidden">
        <div class="bg-mr-grey flex justify-center items-center p-4 rounded-2xl overflow-hidden min-w-[200px] flex-1">
            <img src="../assets/svgs/smiley.svg" alt="Account icon" class="w-32 h-32 max-w-[64px] max-h-[64px] object-cover rounded-full">

        </div>
        <div class="flex flex-col gap-2 items-center justify-center text-center p-4 min-w-[200px] flex-1">
            <h2 class="text-xl font-bold">Your benefits</h2>
            <ul class="text-sm text-left list-disc ml-4">
                <li>420 places to choose from</li>
                <li>Pay online or in cash</li>
                <li>Order anytime, anywhere, on any device</li>
            </ul>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/_footer.php';
?>