(function () {
  "use strict";

  function showToast(message, type) {
    var toast = document.createElement("div");
    toast.className = "toast toast-top toast-end z-50 animate-fade-in";

    var alertClass = "alert-success";
    var icon = "fas fa-check-circle";

    if (type === "error") {
      alertClass = "alert-error";
      icon = "fas fa-exclamation-circle";
    } else if (type === "warning") {
      alertClass = "alert-warning";
      icon = "fas fa-exclamation-triangle";
    } else if (type === "info") {
      alertClass = "alert-info";
      icon = "fas fa-info-circle";
    }

    toast.innerHTML =
      '<div class="alert ' + alertClass + ' shadow-lg">' +
      '<div><i class="' + icon + '"></i><span>' + message + '</span></div>' +
      '<button class="btn btn-sm btn-circle btn-ghost" data-action="toast-close">' +
      '<i class="fas fa-times"></i></button></div>';

    document.body.appendChild(toast);

    setTimeout(function () {
      var alert = toast.querySelector(".alert");
      if (alert) {
        alert.style.transform = "translateX(0)";
      }
    }, 100);

    setTimeout(function () {
      var alert = toast.querySelector(".alert");
      if (alert) {
        alert.style.transform = "translateX(100%)";
        setTimeout(function () {
          if (toast.parentElement) {
            toast.remove();
          }
        }, 300);
      }
    }, 5000);
  }

  function confirmDelete(message) {
    return new Promise(function (resolve) {
      var modal = document.createElement("div");
      modal.className = "modal modal-open";
      modal.innerHTML =
        '<div class="modal-box">' +
        '<h3 class="font-bold text-lg text-error mb-4">' +
        '<i class="fas fa-exclamation-triangle mr-2"></i>Confirmation de suppression</h3>' +
        '<p class="py-4">' + message + '</p>' +
        '<div class="modal-action">' +
        '<button class="btn btn-error" data-action="confirm-delete">' +
        '<i class="fas fa-trash mr-2"></i>Supprimer</button>' +
        '<button class="btn btn-ghost" data-action="cancel-delete">Annuler</button>' +
        '</div></div>';

      document.body.appendChild(modal);

      modal.addEventListener("click", function (event) {
        var action = event.target.closest("[data-action]");
        if (!action) {
          return;
        }

        if (action.dataset.action === "confirm-delete") {
          resolve(true);
        } else if (action.dataset.action === "cancel-delete") {
          resolve(false);
        } else {
          return;
        }

        modal.remove();
      });
    });
  }

  function setupFileDropZone(element, callback) {
    element.addEventListener("dragover", function (event) {
      event.preventDefault();
      element.classList.add("drag-over");
    });

    element.addEventListener("dragleave", function (event) {
      event.preventDefault();
      if (!element.contains(event.relatedTarget)) {
        element.classList.remove("drag-over");
      }
    });

    element.addEventListener("drop", function (event) {
      event.preventDefault();
      element.classList.remove("drag-over");
      var files = event.dataTransfer.files;
      if (callback && files.length > 0) {
        callback(files);
      }
    });
  }

  function previewImage(input, previewElement) {
    if (!input.files || !input.files[0]) {
      return;
    }

    var file = input.files[0];
    if (!file.type.match("image.*")) {
      showToast("Veuillez sélectionner un fichier image valide", "error");
      return;
    }

    if (file.size > 5 * 1024 * 1024) {
      showToast("La taille de l'image ne doit pas dépasser 5MB", "error");
      return;
    }

    var reader = new FileReader();
    reader.onload = function (event) {
      previewElement.src = event.target.result;
      previewElement.classList.remove("hidden");
      previewElement.style.opacity = "0";
      setTimeout(function () {
        previewElement.style.transition = "opacity 0.3s ease";
        previewElement.style.opacity = "1";
      }, 100);
    };
    reader.readAsDataURL(file);
  }

  function setupLiveSearch(inputElement, targetSelector) {
    var searchTimeout;
    inputElement.addEventListener("input", function () {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(function () {
        var query = inputElement.value.toLowerCase();
        var targets = document.querySelectorAll(targetSelector);
        targets.forEach(function (target) {
          var text = target.textContent.toLowerCase();
          var shouldShow = text.includes(query);
          target.style.display = shouldShow ? "" : "none";
          if (shouldShow) {
            target.style.animation = "fadeIn 0.3s ease";
          }
        });
      }, 300);
    });
  }

  function showLoading() {
    var overlay = document.getElementById("loadingOverlay");
    if (!overlay) {
      return;
    }
    var loader = overlay.querySelector(".loader");
    overlay.classList.remove("hidden");
    if (loader) {
      loader.style.display = "block";
    }
  }

  function hideLoading() {
    var overlay = document.getElementById("loadingOverlay");
    if (!overlay) {
      return;
    }
    var loader = overlay.querySelector(".loader");
    overlay.classList.add("hidden");
    if (loader) {
      loader.style.display = "none";
    }
  }

  function ajaxRequest(url, options) {
    showLoading();
    var defaultOptions = {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    };

    var finalOptions = Object.assign({}, defaultOptions, options || {});

    return fetch(url, finalOptions)
      .then(function (response) {
        hideLoading();
        if (!response.ok) {
          throw new Error("HTTP error! status: " + response.status);
        }
        return response.json();
      })
      .catch(function (error) {
        hideLoading();
        console.error("AJAX Error:", error);
        showToast("Une erreur est survenue: " + error.message, "error");
        throw error;
      });
  }

  function setupAutoSave(formId, interval) {
    var form = document.getElementById(formId);
    if (!form) {
      return;
    }

    var lastSave = "";
    var delay = interval || 30000;

    function autoSave() {
      var formData = new FormData(form);
      var currentData = Array.from(formData.entries())
        .map(function (pair) {
          return pair[0] + "=" + pair[1];
        })
        .join("&");

      if (currentData === lastSave) {
        return;
      }

      lastSave = currentData;
      formData.append("auto_save", "1");

      fetch(form.action || "", {
        method: "POST",
        body: formData
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          if (data.success) {
            showToast("Sauvegarde automatique effectuée", "info");
          }
        })
        .catch(function (error) {
          console.error("Auto-save failed:", error);
        });
    }

    setInterval(autoSave, delay);
    window.addEventListener("beforeunload", autoSave);
  }

  function setupDataTable(tableId) {
    var table = document.getElementById(tableId);
    if (!table) {
      return;
    }

    var headers = table.querySelectorAll("th[data-sortable]");
    headers.forEach(function (header) {
      header.style.cursor = "pointer";
      header.addEventListener("click", function () {
        sortTable(table, Array.from(headers).indexOf(header));
      });
    });
  }

  function sortTable(table, columnIndex) {
    var tbody = table.querySelector("tbody");
    var rows = Array.from(tbody.querySelectorAll("tr"));

    var sortedRows = rows.sort(function (a, b) {
      var aText = a.cells[columnIndex].textContent.trim();
      var bText = b.cells[columnIndex].textContent.trim();
      var aNum = parseFloat(aText);
      var bNum = parseFloat(bText);

      if (!isNaN(aNum) && !isNaN(bNum)) {
        return aNum - bNum;
      }

      return aText.localeCompare(bText);
    });

    sortedRows.forEach(function (row) {
      tbody.appendChild(row);
    });
  }

  function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var overlay = document.getElementById("sidebarOverlay");
    if (!sidebar || !overlay) {
      return;
    }
    sidebar.classList.toggle("sidebar-hidden");
    overlay.classList.toggle("hidden");
  }

  function changePassword() {
    var modal = document.createElement("div");
    modal.className = "modal modal-open";
    modal.innerHTML =
      '<div class="modal-box">' +
      '<h3 class="font-bold text-lg mb-4">Changer le mot de passe</h3>' +
      '<form id="changePasswordForm">' +
      '<div class="form-control">' +
      '<label class="label"><span class="label-text">Nouveau mot de passe</span></label>' +
      '<input type="password" name="newPassword" class="input input-bordered" required minlength="6">' +
      '</div>' +
      '<div class="form-control mt-4">' +
      '<label class="label"><span class="label-text">Confirmer le mot de passe</span></label>' +
      '<input type="password" name="confirmPassword" class="input input-bordered" required minlength="6">' +
      '</div>' +
      '<div class="modal-action">' +
      '<button type="submit" class="btn btn-primary">Changer</button>' +
      '<button type="button" class="btn" data-action="close-modal">Annuler</button>' +
      '</div></form></div>';

    document.body.appendChild(modal);

    var form = modal.querySelector("#changePasswordForm");
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      var newPassword = form.newPassword.value;
      var confirmPassword = form.confirmPassword.value;
      if (newPassword !== confirmPassword) {
        showToast("Les mots de passe ne correspondent pas", "error");
        return;
      }
      showToast("Mot de passe mis à jour avec succès", "success");
      modal.remove();
    });

    modal.addEventListener("click", function (event) {
      var action = event.target.closest("[data-action]");
      if (action && action.dataset.action === "close-modal") {
        modal.remove();
      }
    });
  }

  function backupData() {
    showToast("Fonctionnalité de sauvegarde en développement", "info");
  }

  function initSidebarLinks() {
    var sidebarLinks = document.querySelectorAll(".sidebar-link");
    var currentPath = window.location.pathname;

    sidebarLinks.forEach(function (link) {
      link.addEventListener("click", function () {
        if (window.innerWidth < 768) {
          toggleSidebar();
        }
      });

      var href = link.getAttribute("href");
      if (href === currentPath || (currentPath.includes(href) && href !== "/admin/")) {
        link.classList.add("bg-primary", "text-white");
      }
    });
  }

  function initLoginPage() {
    var usernameInput = document.querySelector('input[name="username"]');
    if (usernameInput) {
      usernameInput.focus();
    }

    var card = document.querySelector(".admin-login-card");
    if (card) {
      card.classList.add("admin-login-animate");
    }

    var errorAlert = document.querySelector(".alert-error");
    if (errorAlert) {
      setTimeout(function () {
        errorAlert.style.transform = "scale(1.05)";
        setTimeout(function () {
          errorAlert.style.transform = "scale(1)";
        }, 200);
      }, 100);
    }
  }

  document.addEventListener("click", function (event) {
    var action = event.target.closest("[data-action]");
    if (!action) {
      return;
    }

    if (action.dataset.action === "toggle-sidebar") {
      toggleSidebar();
    } else if (action.dataset.action === "change-password") {
      event.preventDefault();
      changePassword();
    } else if (action.dataset.action === "backup-data") {
      backupData();
    } else if (action.dataset.action === "toast-close") {
      var toast = action.closest(".toast");
      if (toast) {
        toast.remove();
      }
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    initSidebarLinks();

    var searchInput = document.querySelector("[data-live-search]");
    if (searchInput) {
      setupLiveSearch(searchInput, searchInput.dataset.liveSearch);
    }

    var dropzones = document.querySelectorAll("[data-dropzone]");
    dropzones.forEach(function (zone) {
      setupFileDropZone(zone, function (files) {
        console.log("Files dropped:", files);
      });
    });

    var page = document.body.dataset.page;
    if (page === "login") {
      initLoginPage();
    }

    if (window.__flashMessage) {
      showToast(window.__flashMessage.message, window.__flashMessage.type || "success");
    }
  });

  window.AdminUI = {
    showToast: showToast,
    confirmDelete: confirmDelete,
    setupFileDropZone: setupFileDropZone,
    previewImage: previewImage,
    setupLiveSearch: setupLiveSearch,
    showLoading: showLoading,
    hideLoading: hideLoading,
    ajaxRequest: ajaxRequest,
    setupAutoSave: setupAutoSave,
    setupDataTable: setupDataTable
  };
})();
