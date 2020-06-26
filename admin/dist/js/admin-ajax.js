$(document).ready(function () {
  $("#guardar-registro").on("submit", function (e) {
    e.preventDefault();
    const datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        const resultado = data;
        if (resultado.respuesta == "exito") {
          Swal.fire(
            "¡Enhorabuena!",
            "El registro se ha guardado correctamente",
            "success"
          );
          $("#guardar-registro.reset").trigger("reset");
        } else {
          Swal.fire({
            icon: "error",
            title: "Error...",
            text: "¡Hubo un error!",
          });
        }
      },
    });
  });
  $("#guardar-registro-archivo").on("submit", function (e) {
    e.preventDefault();
    const datos = new FormData(this);
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        const resultado = data;
        if (resultado.respuesta == "exito") {
          Swal.fire("¡Enhorabuena!", "Se guardó correctamente", "success");
          $("#guardar-registro-archivo.reset").trigger("reset");
        } else {
          Swal.fire({
            icon: "error",
            title: "Error...",
            text: "¡Hubo un error!",
          });
        }
      },
    });
  });
  $(".borrar-registro").on("click", function (e) {
    e.preventDefault();
    const id = $(this).attr("data-id"),
      tipo = $(this).attr("data-tipo");
    Swal.fire({
      title: "¿Estas seguro?",
      text: "Un registro eliminado no se puede recuperar",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Si, eliminar!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          data: {
            id: id,
            registro: "eliminar",
          },
          url: "modelo-" + tipo + ".php",
          success: function (data) {
            const resultado = JSON.parse(data);
            if (resultado.respuesta == "exito") {
              Swal.fire(
                "Eliminado",
                "El registro fue eliminado satisfactoriamente",
                "success"
              );
              jQuery('[data-id="' + resultado.id_eliminado + '"]')
                .parents("tr")
                .remove();
            } else if (resultado.respuesta == "error") {
              Swal.fire({
                icon: "error",
                title: "¡Error!",
                text: "No se pudo eliminar...",
              });
            }
          },
        });
      }
    });
  });
});
