$(document).ready(function () {
  $("#login-admin").on("submit", function (e) {
    e.preventDefault();
    const datos = $(this).serializeArray();

    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        const resultado = data;
        if (resultado.respuesta == "exitoso") {
          Swal.fire(
            "Ha iniciado sesión",
            "¡Bienvenido(a) " + resultado.usuario + "!",
            "success"
          ).then((resultado) => {
            if (resultado.value) {
              window.location.href = "dashboard.php";
            }
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Hubo un error...",
            text: "Usuario y/o contraseña incorrecta(s)",
          });
        }
      },
    });
  });
});
