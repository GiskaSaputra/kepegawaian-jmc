/* SIDEBAR ACTIVE */

// $(function () {
//   let firstLink;
//   let currentLink;

//   $("#navbar-menu")
//     .find("a")
//     .each(function () {
//       if (!firstLink) {
//         firstLink = this;
//       }
//       if (!currentLink && this.href === window.location.href) {
//         currentLink = this;
//         console.log(window.location.href);
//       }
//       if (!currentLink && window.location.href.indexOf(this.href) != -1) {
//         currentLink = this;
//       }
//     });

//   if (!currentLink) {
//     currentLink = firstLink;
//   }

//   if (currentLink) {
//     $(currentLink).addClass("active");

//     if ($(currentLink).hasClass("dropdown-item")) {
//       $(currentLink)
//         .parents(".dropdown-menu")
//         .each(function () {
//           $(this)
//             .prev("a.dropdown-toggle")
//             .addClass("active")
//             .dropdown("toggle");
//         });
//     }
//   }
// });

// Active Menu
if (!!document.querySelector(".page-wrapper")) {
  const menuActive = document
    .querySelector(".page-wrapper")
    .getAttribute("data-menu-active");
  const subMenuActive = document
    .querySelector(".page-wrapper")
    .getAttribute("data-submenu-active");

  if (menuActive) {
    const menu = (element) => element.textContent == menuActive;
    const menus = Array.from(
      document.querySelectorAll("#sidebar-menu .nav-link > span")
    );
    menus.filter(menu)[0].parentElement.classList.add("active");

    if (subMenuActive) {
      menus
        .filter(menu)[0]
        .parentNode.parentNode.querySelector(".dropdown-menu")
        .classList.add("show");
      const submenu = (element) => element.textContent == subMenuActive;
      const submenus = Array.from(
        menus
          .filter(menu)[0]
          .parentNode.parentNode.querySelectorAll(".dropdown-item")
      );
      submenus.filter(submenu)[0].classList.add("active");
    }
  }
}

// Input Password
var togglePassword = document.querySelectorAll(".toggle-password");
Array.prototype.forEach.call(togglePassword, function (el, i) {
  el.addEventListener("click", function () {
    if (
      this.parentNode.previousElementSibling.getAttribute("type") == "password"
    ) {
      this.querySelector(".bi").classList.remove("bi-eye-fill");
      this.querySelector(".bi").classList.add("bi-eye-slash-fill");

      this.parentNode.previousElementSibling.setAttribute("type", "text");
    } else {
      this.querySelector(".bi").classList.add("bi-eye-fill");
      this.querySelector(".bi").classList.remove("bi-eye-slash-fill");
      this.parentNode.previousElementSibling.setAttribute("type", "password");
    }
  });
});

// floating header
let floatNavbar = {
  init: function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > 0) {
      document.querySelector("#navbar").classList.add("float");
    } else {
      document.querySelector("#navbar").classList.remove("float");
    }
  },
};

if (!!document.querySelector("#navbar")) {
  floatNavbar.init();
  window.onscroll = function (e) {
    floatNavbar.init();
  };
}

// Check All
if (!!document.querySelector(".checkall")) {
  document.querySelector(".checkall").addEventListener("click", function () {
    var checkboxes = document.querySelectorAll(
      'td:first-child input[type="checkbox"]'
    );
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != document.querySelector(".checkall"))
        checkboxes[i].checked = document.querySelector(".checkall").checked;
    }
  });
}

if (!!document.querySelector(".sidebar-toggler")) {
  const body = document.querySelector("body");
  const sidebarToggler = document.querySelector(".sidebar-toggler");
  sidebarToggler.addEventListener("click", function () {
    if (body.classList.contains("sidebar-collapse")) {
      body.classList.remove("sidebar-collapse");
    } else {
      body.classList.add("sidebar-collapse");
    }
  });
}

if (!!document.querySelector(".btn-toggle-theme")) {
  const body = document.querySelector("body");
  const toggler = document.querySelectorAll(".btn-toggle-theme");
  const theme = localStorage.getItem("theme");
  body.dataset.bsTheme = theme;
  toggler.forEach((item) => {
    item.addEventListener("click", function () {
      if (body.dataset.bsTheme != "dark") {
        body.dataset.bsTheme = "dark";
        localStorage.setItem("theme", "dark");
      } else {
        body.dataset.bsTheme = "light";
        localStorage.setItem("theme", "light");
      }
    });
  });
}

// Breadcrumb Active
$(function () {
  $(".breadcrumb-item:last").addClass("active");
});
