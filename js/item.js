async function add_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("add_item" + frm);

  fetch("/api/api-partner-add-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function load_item() {
  const selectedOption = event.target.selectedOptions[0].value;
  console.log("update_item called with form: ", selectedOption);
  event.preventDefault();

  fetch(`/api/api-partner-load-item.php?item_id=${selectedOption}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Data received from server: ", data);
      if (data.item) {
        document.querySelector('input[name="item_id"]').value = data.item.item_id || "";
        document.querySelector('input[name="item_name"]').value = data.item.item_name || "";
        document.querySelector('input[name="item_price"]').value = data.item.item_price || "";
      }
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function update_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("update_item" + frm);

  fetch("/api/api-partner-update-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

// ##############################

async function delete_item() {
  const frm = event.target;
  event.preventDefault();
  console.log("delete_item" + frm);

  fetch("/api/api-partner-delete-item.php", {
    method: "POST",
    body: new FormData(frm),
  })
    .then((response) => response.json())
    .then((data) => {
      location.reload();
    })
    .catch((error) => {
      console.error("error:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll('form[onsubmit="private_item(event); return false;"]');

  forms.forEach((form) => {
    const item_id = form.querySelector('input[name="item_id"]').value;
    const private_status = form.querySelector('input[name="private_status"]').value;

    const button = form.querySelector("button");
    const eyeIcon = document.createElement("span");
    const eyeSlashIcon = document.createElement("span");

    eyeIcon.className = "material-symbols-outlined";
    eyeIcon.id = `eyeIcon-${item_id}`;
    eyeIcon.textContent = "visibility";

    eyeSlashIcon.className = "material-symbols-outlined";
    eyeSlashIcon.id = `eyeSlashIcon-${item_id}`;
    eyeSlashIcon.textContent = "visibility_off";

    if (private_status == 1) {
      eyeIcon.style.display = "none";
    } else {
      eyeSlashIcon.style.display = "none";
    }

    button.appendChild(eyeIcon);
    button.appendChild(eyeSlashIcon);
  });
});

async function private_item(event) {
  event.preventDefault();
  const frm = event.target.closest("form");
  const item_id = frm.querySelector('input[name="item_id"]').value;
  const private_status = frm.querySelector('input[name="private_status"]').value;

  try {
    const response = await fetch("/api/api-partner-private-item.php", {
      method: "POST",
      body: new FormData(frm),
    });

    if (response.ok) {
      const data = await response.json();
      console.log("Success:", data);

      // Toggle the private_status value
      const newStatus = private_status == 1 ? 0 : 1;
      frm.querySelector('input[name="private_status"]').value = newStatus;

      // Toggle icons immediately
      const eyeIcon = document.getElementById(`eyeIcon-${item_id}`);
      const eyeSlashIcon = document.getElementById(`eyeSlashIcon-${item_id}`);
      if (newStatus == 1) {
        eyeIcon.style.display = "none";
        eyeSlashIcon.style.display = "inline";
      } else {
        eyeIcon.style.display = "inline";
        eyeSlashIcon.style.display = "none";
      }
    } else {
      console.error("HTTP error:", response.status);
    }
  } catch (error) {
    console.error("Error:", error);
  }
}
