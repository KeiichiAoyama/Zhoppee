function changeUrl(event) {
  event.preventDefault();
  const newUrl = event.target.getAttribute("href");
  window.history.pushState(null, null, newUrl);
  window.location.reload();
}

function submitForm(event, formID) {
  event.preventDefault();
  let form = document.getElementById(formID);
  console.log(form);
  form.action = "/Task_2/src/Controller/Router.php/product/index";
  console.log(form.action);
  form.submit();
}

function checkout(event, formID) {
  event.preventDefault();
  let form = document.getElementById(formID);
  console.log(form);
  console.log(form.action);
  form.submit();
}

function addToCart(type, id, event) {
  event.preventDefault();
  const effectValue = document.getElementById("qty").value;
  const data = {
    type: type,
    id: id,
    effectValue: effectValue,
  };

  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/Task_2/src/Controller/Router.php/function/addToCart",
    true
  );
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      alert(this.responseText);
      window.location.reload();
    }
  };
  xhr.send(JSON.stringify(data));
}

function removeRow(index) {
  const data = {
    id: index,
  };
  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/Task_2/src/Controller/Router.php/function/removeRow",
    true
  );
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert(this.responseText);
      window.location.reload();
    }
  };
  xhr.send(JSON.stringify(data));
}
