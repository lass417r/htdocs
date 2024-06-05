<form data-url="<?= $frm_search_url ?>" id="frm_search" onsubmit="return false" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey w-full max-w-[390px]">
  <label for="query">
    <img src="../assets/svgs/search_black.svg" alt="Delete icon">
  </label>
  <input id="query" name="query" type="text" placeholder="<?= $frm_search_placeholder ?? "" ?>" value="<?= $frm_search_value ?? "" ?>" class="w-full !p-0 !rounded-none bg-transparent placeholder:text-transparent-50 focus:outline-none">
</form>