"use strict";

function burgerMenu() {
  const menuIcon = document.querySelector(".menu-burger");
  const aside = document.querySelector("aside");

  menuIcon.addEventListener("click", () => {
    // document.body.classList.toggle("_lock");
    aside.classList.toggle("_active");
    menuIcon.classList.toggle("_active");
  });
}
burgerMenu();

function dateTime() {
  function setTime() {
    const dateTimeWr = document.querySelector(".date-time");
    (dateTimeWr.innerHTML =
      "<b>" +
      new Date().toLocaleTimeString("ro-RO", {
        hour12: false,
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
      })),
      +"</b>";
  }
  setInterval(setTime, 1000);
}
dateTime();

function progresiveCircle() {
  const circle = document.querySelectorAll("circle.progresive");
  const circleTrack = document.querySelectorAll("circle.track");

  circle.forEach((element) => {
    let dataPrecent = element.getAttribute("data-precent");

    let circleRadius = element.getAttribute("r");
    let dasharray = 2 * Math.PI * circleRadius;
    element.setAttribute("stroke-dasharray", dasharray);
    let strokeDashArray = element.getAttribute("stroke-dasharray");
    let offset =
      strokeDashArray - strokeDashArray * (dataPrecent / 100);
    element.setAttribute("stroke-dashoffset", offset);
  });

  circleTrack.forEach((element) => {
    let circleRadius = element.getAttribute("r");
    let dasharray = 2 * Math.PI * circleRadius;
    element.setAttribute("stroke-dasharray", dasharray);
  });
}
progresiveCircle();

function themeChange() {
  const themeToggler = document.querySelector(".theme-toggler");
  const button = themeToggler.querySelectorAll("span");

  if (localStorage.getItem("nightMode")) {
    document.body.classList.toggle("dark-theme-variables");
    button.forEach((element) => {
      element.classList.toggle("_active");
    });
  }

  themeToggler.addEventListener("click", () => {
    if (
      themeToggler
        .querySelector("span:nth-child(1)")
        .classList.contains("_active")
    ) {
      document.body.classList.toggle("dark-theme-variables");
      localStorage.setItem("nightMode", 1);
      btnToggle();
    } else {
      localStorage.removeItem("nightMode");
      document.body.classList.toggle("dark-theme-variables");
      btnToggle();
    }

    function btnToggle() {
      button.forEach((element) => {
        element.classList.toggle("_active");
      });
    }
  });
}
themeChange();

function imagePreview() {
  const previewWrapper = document.querySelectorAll(
    ".img-upload-wrapper"
  );

  previewWrapper.forEach((element) => {
    const attr = element.getAttribute("data-prev");
    const input = document.querySelector("#" + attr);
    let preview = element.querySelector(".prev-area");
    let imagesArray = [];

    input.addEventListener("change", () => {
      let files = input.files;
      if (input.files.length > 0) {
        imagesArray = [];
      }
      for (let i = 0; i < files.length; i++) {
        imagesArray.push(files[i]);
      }
      displayImages();
    });

    function displayImages() {
      let images = "";
      console.log(images);
      imagesArray.forEach((image, index) => {
        images += `<div class="preview">
                                            <img id="img-upload-preview" class="img-upload-preview"
                                         src="${URL.createObjectURL(
                                           image
                                         )}">
                                           <p class="file-name-preview">${
                                             image.name
                                           }</p>
                                         </div>`;
      });
      preview.innerHTML = images;
    }
  });
}
imagePreview();

function textEditor() {
  const textarea = document.querySelectorAll(".txt-editor");

  if (textarea) {
    textarea.forEach((element) => {
      const editor = SUNEDITOR.create(element, {
        buttonList: [
          ["undo", "redo"],
          ["bold", "underline", "italic"],
          ["fontSize", "fontColor"],
          ["removeFormat"],
          ["image", "video"],
          ["link"],
          ["outdent", "indent"],
          ["align", "list"],
          ["table"],
          ["fullScreen", "showBlocks", "template"],
          ["codeView", "save"],
        ],
        fontSize: [
          10, 12, 14, 16, 18, 20, 21, 22, 24, 26, 28, 30, 32,
        ],
        colorList: [
          [
            "#ccc",
            "#dedede",
            "OrangeRed",
            "Orange",
            "RoyalBlue",
            "SaddleBrown",
            "#fff",
          ],
          [
            "SlateGray",
            "BurlyWood",
            "DeepPink",
            "FireBrick",
            "Gold",
            "SeaGreen",
            "#000",
          ],
        ],
      });

      window.addEventListener(
        "click",
        () => {
          element.value = editor.getContents();
        },
        false
      );
    });
  }
}
textEditor();

function linkActive() {
  const aside = document.querySelector("aside");
  const adminList = document.querySelectorAll("aside ul li");
  const pathName = window.location.pathname
    .toString()
    .trim()
    .split("/");

  const basePath = pathName[1] + "/" + pathName[2];

  adminList.forEach((item) => {
    if (item.querySelector("a").href.toString().includes(basePath)) {
      const linkTopOffset = item.offsetTop;
      item.classList.add("active");
      aside.scrollTo(0, linkTopOffset - 100);
    }
  });
}
linkActive();

function deleteRowTable() {
  const tableWrapper = document.querySelector(".table-area");
  document.addEventListener("click", (e) => {
    const target = e.target;
    if (target.classList.contains("delete-row-table")) {
      e.preventDefault();
      const loader = tableWrapper.querySelector(".loader-ajax");

      sendAjax({
        method: target.getAttribute("method"),
        url: target.href,
        csrfToken: document.querySelector('meta[name="csrf-token"]')[
          "content"
        ],
        data: "",
        beforeSendFunction: () => {
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        responseFunction: () => {
          const currentUrl = window.location.href;
          sendAjax({
            method: "GET",
            url: currentUrl,
            csrfToken: document.querySelector(
              'meta[name="csrf-token"]'
            )["content"],
            data: "",
            responseFunction: (data) => {
              history.replaceState({}, "", currentUrl);
              tableWrapper.innerHTML = data.response;
              tableWrapper.classList.toggle("active");
              loader.classList.toggle("active");
            },
            redirectFunction: (data) => {
              const linkRedirect =
                data.getResponseHeader("X-Redirect");
              sendAjax({
                method: "GET",
                url: linkRedirect,
                csrfToken: document.querySelector(
                  'meta[name="csrf-token"]'
                )["content"],
                data: "",
                responseFunction: (data) => {
                  history.replaceState({}, "", linkRedirect);
                  tableWrapper.innerHTML = data.response;
                  tableWrapper.classList.toggle("active");
                  loader.classList.toggle("active");
                },
                errorFunction: (data) => {
                  alertModal(data.response);
                },
              });
            },
            errorFunction: () => {
              alertModal(data.response);
            },
          });
        },
        errorFunction: (data) => {
          alertModal(data.response);
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
      });
    }
  });
}

deleteRowTable();

function deleteRecord() {
  const pageWrapper = document.querySelector(".it-wrp");
  document.addEventListener("click", (e) => {
    const target = e.target;
    if (target.classList.contains("delete-record-single")) {
      e.preventDefault();

      const loader = pageWrapper.querySelector(".loader-ajax");

      sendAjax({
        method: target.getAttribute("method"),
        url: target.href,
        csrfToken: document.querySelector('meta[name="csrf-token"]')[
          "content"
        ],
        data: "",
        beforeSendFunction: () => {
          pageWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        redirectFunction: (data) => {
          window.location.replace(
            data.getResponseHeader("X-Redirect")
          );
        },
        errorFunction: (data) => {
          alertModal(data.response);
          pageWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
      });
    }
  });
}

deleteRecord();

function changePage() {
  const tableWrapper = document.querySelector(".table-area");

  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("page-change")) {
      e.preventDefault();
      const loader = tableWrapper.querySelector(".loader-ajax");
      sendAjax({
        method: "GET",
        url: e.target.href,
        csrfToken: document.querySelector('meta[name="csrf-token"]')[
          "content"
        ],
        data: "",
        beforeSendFunction: () => {
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        completeFunction: () => {
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        responseFunction: (data) => {
          history.pushState({}, "", e.target.href);
          tableWrapper.innerHTML = data.response;
          tableWrapper.scrollIntoView({ behavior: "smooth" }, true);
        },
        redirectFunction: (data) => {
          const linkRedirect = data.getResponseHeader("X-Redirect");
          sendAjax({
            method: "GET",
            url: linkRedirect,
            csrfToken: document.querySelector(
              'meta[name="csrf-token"]'
            )["content"],
            data: "",
            responseFunction: (data) => {
              history.pushState({}, "", linkRedirect);
              tableWrapper.innerHTML = data.response;
              tableWrapper.scrollIntoView(
                { behavior: "smooth" },
                true
              );
            },
            errorFunction: () => {
              console.log("error");
            },
          });
        },
        errorFunction: () => {
          console.log("error");
        },
      });
    }
  });
}

changePage();

function confirmActionModal() {
  const modalWrapper = document.querySelector(
    ".modal-confirm-wrapper"
  );
  if (modalWrapper) {
    const modalWindow = document.querySelector(".modal-confirm");
    const closeModal = document.querySelector(".cancel-confirm");
    const confirmButton =
      modalWindow.querySelector(".accept-confirm");
    const confirmText = modalWindow.querySelector(".confirm-text");

    function toggleItem() {
      modalWrapper.classList.toggle("active");
      modalWindow.classList.toggle("active");
      document.body.classList.toggle("_lock");
    }

    function clearData() {
      confirmButton.href = "";
      confirmText.textContent = "";
    }

    document.addEventListener("click", (e) => {
      const target = e.target.parentElement;
      if (
        target.classList.contains("delete-record-modal") ||
        e.target.classList.contains("delete-record-modal")
      ) {
        e.preventDefault();

        confirmButton.href = e.target.href || target.href;
        confirmText.textContent =
          e.target.getAttribute("confirm") ||
          target.getAttribute("confirm");
        toggleItem();
      }
    });

    closeModal.addEventListener("click", () => {
      toggleItem();
      if (tableRow.tagName === "TR") {
        tableRow.style.opacity = "0.1";
      }
      setTimeout(() => {
        clearData();
      }, 600);
    });

    confirmButton.addEventListener("click", () => {
      toggleItem();
      setTimeout(() => {
        clearData();
      }, 600);
    });

    window.addEventListener("click", (event) => {
      if (event.target == modalWrapper) {
        toggleItem();
      }
    });
  }
}

confirmActionModal();

function alertModal(dataText) {
  const modalWrapper = document.querySelector(".modal-error-wrapper");
  if (modalWrapper) {
    const modalWindow = document.querySelector(".modal-error");
    const closeModal = document.querySelector(".cancel-error");
    const confirmText = modalWindow.querySelector(".error-text");

    function toggleItem() {
      modalWrapper.classList.toggle("active");
      modalWindow.classList.toggle("active");
      document.body.classList.toggle("_lock");
    }

    // function clearData() {
    //   confirmText.textContent = "";
    // }

    confirmText.textContent = dataText;
    toggleItem();
    console.log(closeModal);

    closeModal.addEventListener("click", () => {
      modalWrapper.classList.remove("active");
      modalWindow.classList.remove("active");
      document.body.classList.remove("_lock");
    });

    window.addEventListener("click", (event) => {
      if (event.target == modalWrapper) {
        modalWrapper.classList.remove("active");
        modalWindow.classList.remove("active");
        document.body.classList.remove("_lock");
      }
    });
  }
}

function actionSearch() {
  const form = document.querySelector(".search-form-admin");
  const tableWrapper = document.querySelector(".table-area");

  if (form) {
    form.onsubmit = (e) => {
      e.preventDefault();

      e.stopImmediatePropagation();

      const loader = tableWrapper.querySelector(".loader-ajax");

      let data = serialize(form);

      sendAjax({
        method: form.method,
        url: form.action,
        csrfToken: document.querySelector('meta[name="csrf-token"]')[
          "content"
        ],
        data: data,
        beforeSendFunction: () => {
          form.style.opacity = 0.6;
          form.style.pointerEvents = "none";
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        completeFunction: () => {
          form.style.opacity = 1;
          form.style.pointerEvents = "all";
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        responseFunction: (data) => {
          history.replaceState({}, "", data.responseURL);
          tableWrapper.scrollIntoView({ behavior: "smooth" }, true);
          tableWrapper.innerHTML = data.response;
        },
        errorFunction: () => {
          console.log("error");
        },
      });
    };
  }
}
actionSearch();

function hideFlash() {
  const errorFlash = document.querySelector(".error-flash");

  if (errorFlash) {
    setTimeout(() => {
      errorFlash.style.display = "none";
    }, 7000);
  }
}

hideFlash();

window.addEventListener("online", (event) => {
  alertModal("Acum sunteți conectat la rețea!");
});

addEventListener("offline", (event) => {
  alertModal("Conexiunea la rețea a fost pierdută!");
});

window.onpopstate = function (event) {
  console.log(window.location.href);
  const tableWrapper = document.querySelector(".table-area");

  if (tableWrapper) {
    event.preventDefault();
    const loader = tableWrapper.querySelector(".loader-ajax");
    sendAjax({
      method: "GET",
      url: window.location.href,
      csrfToken: document.querySelector('meta[name="csrf-token"]')[
        "content"
      ],
      data: "",
      beforeSendFunction: () => {
        tableWrapper.classList.toggle("active");
        loader.classList.toggle("active");
      },
      completeFunction: () => {
        tableWrapper.classList.toggle("active");
        loader.classList.toggle("active");
      },
      responseFunction: (data) => {
        tableWrapper.innerHTML = data.response;
        tableWrapper.scrollIntoView({ behavior: "smooth" }, true);
      },
      redirectFunction: (data) => {
        const linkRedirect = data.getResponseHeader("X-Redirect");

        sendAjax({
          method: "GET",
          url: linkRedirect,
          csrfToken: document.querySelector(
            'meta[name="csrf-token"]'
          )["content"],
          data: "",
          responseFunction: (data) => {
            history.pushState({}, "", linkRedirect);
            tableWrapper.innerHTML = data.response;
            tableWrapper.scrollIntoView({ behavior: "smooth" }, true);
          },
          errorFunction: () => {
            console.log("error");
          },
        });
      },
      errorFunction: () => {
        console.log("error");
      },
    });
  }
};

function verifyRow() {
  const tableWrapper = document.querySelector(".table-area");
  document.addEventListener("click", (e) => {
    const target = e.target;
    if (
      target.classList.contains("verify-record") ||
      target.parentElement.classList.contains("verify-record")
    ) {
      e.preventDefault();
      const loader = tableWrapper.querySelector(".loader-ajax");

      sendAjax({
        method: target.getAttribute("method"),
        url: target.href,
        csrfToken: document.querySelector('meta[name="csrf-token"]')[
          "content"
        ],
        data: "",
        beforeSendFunction: () => {
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
        responseFunction: () => {
          const currentUrl = window.location.href;
          sendAjax({
            method: "POST",
            url: currentUrl,
            csrfToken: document.querySelector(
              'meta[name="csrf-token"]'
            )["content"],
            data: "",
            responseFunction: (data) => {
              history.replaceState({}, "", currentUrl);
              tableWrapper.innerHTML = data.response;
              tableWrapper.classList.toggle("active");
              loader.classList.toggle("active");
            },
            errorFunction: () => {
              alertModal(data.response);
            },
          });
        },
        errorFunction: (data) => {
          alertModal(data.response);
          tableWrapper.classList.toggle("active");
          loader.classList.toggle("active");
        },
      });
    }
  });
}

verifyRow();

function modalImage() {
  const modalWrapper = document.querySelector(".modal-photo-wrapper");
  if (modalWrapper) {
    const modalWindow = document.querySelector(".modal-window");
    const modalImage = modalWindow.querySelector("img");
    const closeModal = modalWrapper.querySelector(
      ".close-modal-photo"
    );

    function toggleItem() {
      modalWrapper.classList.toggle("active");
      modalWindow.classList.toggle("active");
      document.body.classList.toggle("_lock");
    }

    document.addEventListener("click", (e) => {
      const target = e.target;
      if (target.classList.contains("modal-img-open")) {
        e.preventDefault();
        modalImage.src = target.src;
        toggleItem();
      }
    });

    window.addEventListener("click", (event) => {
      if (
        event.target == modalWrapper ||
        event.target == modalImage ||
        event.target == closeModal
      ) {
        toggleItem();
      }
    });
  }
}

modalImage();
