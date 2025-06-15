function addProducto(id, token) {
  let url = "cart/carrito.php";
  /*esto nos va ayudar a emviar los parametros por medio de post */
  let formData = new FormData();
  formData.append("id", id);
  formData.append("token", token);

  fetch(url, {
    method: "POST",
    body: formData,
    mode: "cors",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        let elemento = document.getElementById("num_cart");
        elemento.innerHTML = data.numero;
      }
    });
}

let eliminaModal = document.getElementById("eliminaModal");
eliminaModal.addEventListener("show.bs.modal", function (event) {
  let button = event.relatedTarget;
  let id = button.getAttribute("data-bs-id");
  let buttonElimina = eliminaModal.querySelector(".modal-footer #btn-elimina");
  buttonElimina.value = id;
});

function actualizaCantidad(cantidad, id) {
  let url = "cart/actualizar_carrito.php";
  /*esto nos va ayudar a emviar los parametros por medio de post */
  let formData = new FormData();
  formData.append("action", "agregar");
  formData.append("id", id);
  formData.append("cantidad", cantidad);

  fetch(url, {
    method: "POST",
    body: formData,
    mode: "cors",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        let divsubtotal = document.getElementById("subtotal_" + id);
        divsubtotal.innerHTML = data.sub;

        let total = 0.0;
        let list = document.getElementsByName("subtotal[]");

        for (let i = 0; i < list.length; i++) {
          total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ""));
        }

        total = new Intl.NumberFormat("en-US", {
          minimumFractionDigits: 2,
        }).format(total);

        document.getElementById("total").innerHTML =
          " <?php echo MONEDA; ?> " + total;
      }
    });
}
function elimina() {
  let buttonElimina = document.getElementById("btn-elimina");
  let id = buttonElimina.value;
  let url = "cart/actualizar_carrito.php";
  /*esto nos va ayudar a emviar los parametros por medio de post */
  let formData = new FormData();
  formData.append("action", "eliminar");
  formData.append("id", id);

  fetch(url, {
    method: "POST",
    body: formData,
    mode: "cors",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        location.reload();
      }
    });
}
const preload = document.querySelector(".preload");
setTimeout(function () {
  preload.classList.add("cerrar");
  window.addEventListener("load", () => {
    preload.style.display = "none";
  });
}, 3000);
