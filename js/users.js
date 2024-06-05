async function getUsers() {
  const frm = document.querySelector("#frm_search");
  const url = frm.getAttribute("data-url");
  const conn = await fetch(`/api/${url}`, {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.json();
  return data;
}

document.querySelector("#sort_name").addEventListener("click", sortName);
document.querySelector("#sort_last_name").addEventListener("click", sortLastName);
document.querySelector("#sort_email").addEventListener("click", sortEmail);
document.querySelector("#sort_role").addEventListener("click", sortRole);
document.querySelector("#sort_status").addEventListener("click", sortStatus);
document.querySelector("#frm_search").addEventListener("input", handleSearch);

var timer_search_users = "";
async function handleSearch() {
  clearTimeout(timer_search_users);
  timer_search_users = setTimeout(async function () {
    document.querySelectorAll("#direction").forEach((el) => {
      el.innerHTML = "";
    });
    const users = await getUsers();
    displayUsers(users);
  }, 500);
}

let sortNameDirection = -1;
async function sortName() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortNameDirection == 1 ? "▲" : "▼";
  const users = await getUsers();
  users.sort((a, b) => {
    return a.user_name.localeCompare(b.user_name) * sortNameDirection;
  });
  sortNameDirection *= -1;
  displayUsers(users);
}

let sortLastNameDirection = -1;
async function sortLastName() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortLastNameDirection == 1 ? "▲" : "▼";
  const users = await getUsers();
  users.sort((a, b) => {
    return a.user_last_name.localeCompare(b.user_last_name) * sortLastNameDirection;
  });
  sortLastNameDirection *= -1;
  displayUsers(users);
}

let sortEmailDirection = -1;
async function sortEmail() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortEmailDirection == 1 ? "▲" : "▼";
  const users = await getUsers();
  users.sort((a, b) => {
    return a.user_email.localeCompare(b.user_email) * sortEmailDirection;
  });
  sortEmailDirection *= -1;
  displayUsers(users);
}

let sortRoleDirection = -1;
async function sortRole() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortRoleDirection == 1 ? "▲" : "▼";
  const users = await getUsers();
  users.sort((a, b) => {
    return a.user_role_name.localeCompare(b.user_role_name) * sortRoleDirection;
  });
  sortRoleDirection *= -1;
  displayUsers(users);
}

let sortStatusDirection = -1;
async function sortStatus() {
  document.querySelectorAll("#direction").forEach((el) => {
    el.innerHTML = "";
  });
  this.querySelector("#direction").innerHTML = sortStatusDirection == 1 ? "▲" : "▼";
  const users = await getUsers();
  users.sort((a, b) => {
    return a.user_is_blocked.localeCompare(b.user_is_blocked) * sortStatusDirection;
  });
  sortStatusDirection *= -1;
  displayUsers(users);
}
function displayUsers(users) {
  const nonce = window.getNonce();
  const styleTag = document.createElement("style");
  styleTag.setAttribute("nonce", nonce);
  document.head.appendChild(styleTag);
  const styles = [];

  document.querySelector("#results").innerHTML = "";
  users.forEach((user) => {
    const userClass = `user-${user.user_id}`;
    let profilePicture =
      user.profile_picture && user.profile_picture !== "/path/to/default-placeholder.png"
        ? `<img src="${user.profile_picture}" alt="Profile Picture" class="w-8 h-8 object-cover rounded-full">`
        : `<div class="w-8 h-8 flex items-center justify-center text-white text-sm rounded-full ${userClass}">
            ${user.user_name[0]}
          </div>`;

    let div_user = `
      <a href="user/${
        user.user_id
      }" class="grid grid-cols-[auto_1fr_1fr_1fr] items-center md:grid-cols-[auto_1fr_1fr_1fr_2fr_1fr] gap-4 border-b border-b-slate-200 py-2">
        <div class="hidden">${user.user_id}</div>
        ${profilePicture}
        <div>${user.user_name}</div>
        <div>${user.user_last_name}</div>
        <div>${user.user_role_name}</div>
        <div class="hidden md:block">${user.user_email}</div>
        <button class="text-right hidden md:block">
          ${user.user_is_blocked == 0 ? "unblocked" : "blocked"}
        </button>
      </a>
    `;
    document.querySelector("#results").insertAdjacentHTML("afterbegin", div_user);

    if (!user.profile_picture || user.profile_picture === "/path/to/default-placeholder.png") {
      styles.push(`.${userClass} { background-color: ${user.user_tag_color}; }`);
    }
  });

  if (users.length == 0) {
    document.querySelector("#results").innerHTML = `
      <div class="flex items-center gap-4 border-b border-b-slate-200 py-2">
        <div class="w-8 h-8 flex items-center justify-center text-white text-sm rounded-full"></div>
        <div class="w-full text-center">No results</div>
      </div>
    `;
  }

  styleTag.innerHTML = styles.join(" ");
}

document.addEventListener("DOMContentLoaded", async () => {
  const users = await getUsers();
  displayUsers(users);
});
