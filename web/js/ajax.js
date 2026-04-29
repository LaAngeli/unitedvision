function serialize(form) {
  // Setup our serialized data
  var serialized = [];

  // Loop through each field in the form
  for (var i = 0; i < form.elements.length; i++) {
    var field = form.elements[i];

    // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
    if (
      !field.name ||
      field.disabled ||
      field.type === "file" ||
      field.type === "reset" ||
      field.type === "submit" ||
      field.type === "button"
    )
      continue;

    // If a multi-select, get all selections
    if (field.type === "select-multiple") {
      for (var n = 0; n < field.options.length; n++) {
        if (!field.options[n].selected) continue;
        serialized.push(
          encodeURIComponent(field.name) +
            "=" +
            encodeURIComponent(field.options[n].value)
        );
      }
    }

    // Convert field data to a query string
    else if (
      (field.type !== "checkbox" && field.type !== "radio") ||
      field.checked
    ) {
      serialized.push(
        encodeURIComponent(field.name) +
          "=" +
          encodeURIComponent(field.value)
      );
    }
  }

  return serialized.join("&");
}

function sendAjax(options) {
  let xhr = new XMLHttpRequest();

  switch (options.method) {
    case "get":
    case "GET":
      if (options.data) {
        xhr.open(
          options.method,
          options.url + "?" + options.data,
          true
        );
      } else {
        xhr.open(options.method, options.url, true);
      }
      break;
    case "POST":
    case "post":
      xhr.open(options.method, options.url, true);
      break;
    default:
      console.log("undefined method");
  }
  xhr.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr.setRequestHeader("X-CSRF-Token", options.csrfToken);
  switch (options.method) {
    case "get":
    case "GET":
      xhr.send();
      break;
    case "POST":
    case "post":
      if (options.data) {
        xhr.send(options.data);
      } else {
        xhr.send();
      }
      break;
    default:
      console.log("undefined data to send");
  }

  if (options.beforeSendFunction) {
    options.beforeSendFunction();
  }

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (options.completeFunction) {
        options.completeFunction(xhr);
      }
      switch (xhr.status) {
        case 200:
          if (options.responseFunction) {
            options.responseFunction(xhr);
          }
          break;
        case 302:
          if (options.redirectFunction) {
            options.redirectFunction(xhr);
          }
          break;
        default:
          if (options.errorFunction) {
            options.errorFunction(xhr);
          }
          break;
      }
    }
  };
}
