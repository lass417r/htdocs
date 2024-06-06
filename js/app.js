const menu = document.getElementById("mobile");
const menuWhitespace = document.getElementById("menu_whitespace");
const openMenu = document.getElementById("open_menu");

openMenu.addEventListener("click", clickMenu);
menuWhitespace.addEventListener("click", clickMenu);

function clickMenu() {
  menu.classList.toggle("-translate-x-full");
  if (openMenu.getAttribute("open") === null) {
    openMenu.setAttribute("open", "");
  } else {
    openMenu.removeAttribute("open");
  }
}

// ##############################
async function is_email_available() {
  const frm = event.target.form;
  const conn = await fetch("/api/api-is-email-available.php", {
    method: "POST",
    body: new FormData(frm),
  });
  if (!conn.ok) {
    // everything that is not a 2xx
    document.querySelector("#msg_email_not_available").classList.remove("opacity-0");
    return;
  }
}

// ##############################
async function delete_user() {
  event.preventDefault();
  const frm = event.target;
  const conn = await fetch("/api/api-delete-user.php", {
    method: "POST",
    body: new FormData(frm),
  });
  //const response = await conn.json();
  // frm.parentElement.remove();
}

// ##############################
async function admin_delete_user() {
  const frm = event.target;
  const conn = await fetch("/api/api-admin-delete-user.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const response = await conn.json();
  // frm.parentElement.remove();
}

// ##############################
async function toggle_blocked(user_id, user_is_blocked) {
  if (user_is_blocked == 0) {
    event.target.innerHTML = "BLOCKED";
  } else {
    event.target.innerHTML = "UNBLOCKED";
  }
  const conn = await fetch(`/api/api-toggle-user-blocked.php?user_id=${user_id}&user_is_blocked=${user_is_blocked}`);
  const data = await conn.text();
}

// ##############################

function toogle_menu() {
  if (document.querySelector("#menu").classList.contains("left-0")) {
    document.querySelector("#menu").classList.add("-left-60");
    document.querySelector("#menu").classList.remove("left-0");
    document.querySelector("#menu").classList.remove("left-0");
    document.querySelector("#menu_background").classList.add("hidden");
    return;
  }
  document.querySelector("#menu").classList.remove("-left-60");
  document.querySelector("#menu").classList.add("left-0");
  document.querySelector("#menu_background").classList.remove("hidden");
}

// ########################################

async function signup() {
  event.preventDefault();
  const frm = event.target;
  const conn = await fetch("/api/api-signup.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.text();
  if (!conn.ok) {
    return;
  }
  // TODO: redirect to the login page
  location.href = "/login";
}

async function partner_signup() {
  event.preventDefault();
  const frm = event.target;
  const conn = await fetch("/api/api-partner-signup.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.text();
  if (!conn.ok) {
    return;
  }

  // // TODO: redirect to the login page
  location.href = "/login";
}

// ##############################

async function login() {
  const frm = event.target;
  event.preventDefault();
  const conn = await fetch("/api/api-login.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.json();

  if (!conn.ok) {
    document.querySelector("#login_error").innerText = data.info || "Invalid credentials";
    return;
  }

  location.href = "/";
}

// ##############################

async function update_user() {
  event.preventDefault();
  const errorElement = document.getElementById("user_error");
  errorElement.innerHTML = "";
  const frm = event.target;

  const response = await fetch("/api/api-update-user.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await response.json();

  if (response.ok) {
    location.reload();
  } else {
    errorElement.innerHTML = data.info;
    frm.reset();

    setTimeout(() => {
      errorElement.innerHTML = "";
    }, 5000);
  }
}

// ##############################

async function update_user_password() {
  event.preventDefault();
  const errorElement = document.getElementById("password_error");
  errorElement.innerHTML = "";
  const frm = event.target;

  const response = await fetch("/api/api-update-user-password.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await response.json();

  if (response.ok) {
    location.reload();
  } else {
    errorElement.innerHTML = data.info;
    frm.reset();

    setTimeout(() => {
      errorElement.innerHTML = "";
    }, 5000);
  }
}

// ######################
// COMMENTS

async function order_comment_post() {
  event.preventDefault();
  const frm = event.target;
  const conn = await fetch("/api/api-add-comment.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const data = await conn.text();
  if (!conn.ok) {
    return;
  }

  // // TODO: redirect to the login page
  location.reload();
}

// ######################
// PROFILE PICTURE

// profile.js

function update_user_picture() {
  const errorElement = document.getElementById("user_profile_picture_error");
  const profilePictureElement = document.getElementById("currentProfilePicture");
  const removeProfilePictureButton = document.getElementById("removeProfilePicture");
  errorElement.innerText = "";
  errorElement.classList.remove("text-green-500", "text-red-500"); // Remove both green and red classes
  const formData = new FormData();
  const fileInput = document.getElementById("user_profile_picture");
  const file = fileInput.files[0];

  if (!file) {
    errorElement.innerText = "Please select a file.";
    errorElement.classList.add("text-red-500");
    return;
  }

  formData.append("user_profile_picture", file);

  fetch("/api/api-upload-profile-picture.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.message) {
        location.reload(); // Refresh the page after updating the profile picture
      } else {
        errorElement.innerText = data.info || "Failed to upload the profile picture.";
        errorElement.classList.add("text-red-500");
      }
    })
    .catch((error) => {
      errorElement.innerText = "An error occurred while uploading the profile picture.";
      errorElement.classList.add("text-red-500");
      console.error("Error:", error);
    });
}

function remove_user_picture() {
  const errorElement = document.getElementById("user_profile_picture_error");
  const profilePictureElement = document.getElementById("currentProfilePicture");
  const removeProfilePictureButton = document.getElementById("removeProfilePicture");
  errorElement.innerText = "";
  errorElement.classList.remove("text-green-500", "text-red-500"); // Remove both green and red classes

  fetch("/api/api-remove-profile-picture.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.message) {
        location.reload(); // Refresh the page after removing the profile picture
      } else {
        errorElement.innerText = data.info || "Failed to remove the profile picture.";
        errorElement.classList.add("text-red-500");
      }
    })
    .catch((error) => {
      errorElement.innerText = "An error occurred while removing the profile picture.";
      errorElement.classList.add("text-red-500");
      console.error("Error:", error);
    });
}
