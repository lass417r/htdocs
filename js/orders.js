async function getOrders() {
  const frm = document.querySelector("#frm_search");
  const url = frm.getAttribute("data-url");
  const conn = await fetch(`/api/${url}`, {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.json();
  return data;
}

//make for sort_created_at, sort_id, sort_created_by, sort_delivered, sort_delivered_by
document.querySelector("#sort_created_at").addEventListener("click", sortCreatedAt);
document.querySelector("#sort_id").addEventListener("click", sortId);
document.querySelector("#sort_created_by").addEventListener("click", sortCreatedBy);
document.querySelector("#sort_delivered").addEventListener("click", sortDelivered);
document.querySelector("#sort_delivered_by").addEventListener("click", sortDeliveredBy);

document.querySelector("#frm_search").addEventListener("input", handleSearch);

var timer_search_orders = "";
async function handleSearch() {
  clearTimeout(timer_search_orders);
  timer_search_orders = setTimeout(async function () {
    document.querySelectorAll("#direction").forEach((el) => {
      el.textContent = "";
    });
    const orders = await getOrders();
    displayorders(orders);
  }, 500);
}

let sortCreatedAtDirection = -1;
async function sortCreatedAt() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.textContent = "";
  });
  this.querySelector("#direction").textContent = sortCreatedAtDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (a.order_created_at - b.order_created_at) * sortCreatedAtDirection;
  });
  sortCreatedAtDirection *= -1;
  displayorders(orders);
}

let sortIdDirection = -1;
async function sortId() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.textContent = "";
  });
  this.querySelector("#direction").textContent = sortIdDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (Number(a.order_id) - Number(b.order_id)) * sortIdDirection;
  });
  sortIdDirection *= -1;
  displayorders(orders);
}

let sortCreatedByDirection = -1;
async function sortCreatedBy() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.textContent = "";
  });
  this.querySelector("#direction").textContent = sortCreatedByDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (
      (Number(a.order_created_by_user_fk) - Number(b.order_created_by_user_fk)) *
      sortCreatedByDirection
    );
  });
  sortCreatedByDirection *= -1;
  displayorders(orders);
}

let sortDeliveredDirection = -1;
async function sortDelivered() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.textContent = "";
  });
  this.querySelector("#direction").textContent = sortDeliveredDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (a.order_delivered_at - b.order_delivered_at) * sortDeliveredDirection;
  });
  sortDeliveredDirection *= -1;
  displayorders(orders);
}

let sortDeliveredByDirection = -1;
async function sortDeliveredBy() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.textContent = "";
  });
  this.querySelector("#direction").textContent = sortDeliveredByDirection == 1 ? "▲" : "▼";
  const orders = await getOrders();
  orders.sort((a, b) => {
    return (
      (Number(a.order_delivered_by_user_fk) - Number(b.order_delivered_by_user_fk)) *
      sortDeliveredByDirection
    );
  });
  sortDeliveredByDirection *= -1;
  displayorders(orders);
}

function displayorders(orders) {
  document.querySelector("#results").textContent = "";
  orders.forEach((order) => {
    let div_order = `
    <a href="order/${
      order.order_id
    }" class="grid grid-cols-[2fr_1fr_2fr] md:grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2"> 
    <div>${new Date(Number(order.order_created_at + "000")).toLocaleDateString("en-GB", {
      day: "2-digit",
      month: "short",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    })}</div>
    <div>${order.order_id}</div>
    <div class="hidden md:block">${order.order_created_by_user_fk}</div>
    <div>${order.order_delivered_at > 0 ? "Delivered" : "Pending"}</div>
    <div class="hidden md:block">${order.order_delivered_by_user_fk}</div>
  </a>
        `;
    document.querySelector("#results").insertAdjacentHTML("afterbegin", div_order);
  });
  if (orders.length == 0) {
    document.querySelector("#results").innerHTML = `
        <div class="grid grid-cols-5 items-center gap-4 border-b border-b-slate-200 py-2">
          <div class="w-full text-center">No results</div>
        `;
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  const orders = await getOrders();
  displayorders(orders);
});
