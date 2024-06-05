async function getItems() {
  const frm = document.querySelector("#frm_search");
  const url = frm.getAttribute("data-url");
  const conn = await fetch(`/api/${url}`, {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.json();
  return data;
}

document.querySelector("#frm_search").addEventListener("input", handleSearch);

var timer_search_items = "";
async function handleSearch() {
  clearTimeout(timer_search_items);
  timer_search_items = setTimeout(async function () {
    const items = await getItems();
    displayItems(items);
  }, 500);
}

function displayItems(items) {
  let currentPartner = "";
  let html = items
    .map((item) => {
      let card = "";
      if (item.user_partner_id !== currentPartner) {
        card += currentPartner ? "</div></div></div>" : "";
        currentPartner = item.user_partner_id;
        card += `<div class='p-4 bg-50-shades rounded-lg overflow-hidden text-center'><div class='p-5'><h1 class='text-xl font-bold text-white p-4'>${item.partner_name}</h1><div>`;
      }
      card += `<div class='flex justify-between p-2'><p class='text-white'>${item.item_name}</p><p class='font-normal text-gray-700'>${item.item_price} $</p></div>`;
      return card;
    })
    .join("");
  html += currentPartner ? "</div></div></div>" : "";
  document.querySelector("#results").innerHTML = html;
}

document.addEventListener("DOMContentLoaded", async () => {
  const items = await getItems();
  displayItems(items);
});
