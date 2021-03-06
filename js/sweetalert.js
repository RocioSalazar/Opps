function MostrarAlertaImg(titulo, desc, ruta) {
  Swal.fire({
    title: titulo,
    text: desc,
    imageUrl: ruta,
    imageWidth: 400,
    imageHeight: 400,
    imageAlt: desc,
    confirmButtonText: "Volver",
    showClass: {
      popup: "animate__animated animate__fadeInDown",
    },
    hideClass: {
      popup: "animate__animated animate__fadeOutUp",
    },
  });
}

function AlertaCerrarSesion() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "Gracias por su visita.",
    showConfirmButton: false,
    timer: 1500,
  });
}

function VerPedidos() {
  Swal.fire({
    title: "¡ Aviso !",
    text: "Necesitas iniciar sesión para poder ver tus pedidos.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Iniciar Sesión",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "iniciar_sesion.php";
    }
  });
}

function VerAlarmas() {
  Swal.fire({
    title: "¡ Aviso !",
    text: "Necesitas iniciar sesión para poder ver tus alrmas.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Iniciar Sesión",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "iniciar_sesion.php";
    }
  });
}

function ComprarProductos() {
  Swal.fire({
    title: "¡ Aviso !",
    text: "Necesita Iniciar Sesión para poder comprar algún producto.",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Iniciar Sesión",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "iniciar_sesion.php";
    }
  });
}

function ProductoAgotado() {
  Swal.fire({
    title: "¡ Aviso !",
    text: "Producto agotado",
    icon: "warning",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "productos.php";
    }
  });
}
