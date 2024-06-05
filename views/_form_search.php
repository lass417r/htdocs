<form data-url="<?= $frm_search_url ?>" id="frm_search" onsubmit="return false" class="flex items-center gap-4 bg-soft-white px-4 py-3 rounded-2xl text-mr-grey w-full max-w-[390px]">
  <label for="query">
    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M11.6254 11.6185L17 17M13.4444 7.22222C13.4444 10.6587 10.6587 13.4444 7.22222 13.4444C3.78579 13.4444 1 10.6587 1 7.22222C1 3.78579 3.78579 1 7.22222 1C10.6587 1 13.4444 3.78579 13.4444 7.22222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
  </label>
  <input id="query" name="query" type="text" placeholder="<?= $frm_search_placeholder ?? "" ?>" value="<?= $frm_search_value ?? "" ?>" class="w-full !p-0 !rounded-none bg-transparent placeholder:text-transparent-50 focus:outline-none">
</form>