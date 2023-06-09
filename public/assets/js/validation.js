$(document).ready(function () {
    $("form").submit(function (event) {
      var formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        email: $("#email").val(),

      };

      $.ajax({
        type: "POST",
        url: "process.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
      });

      event.preventDefault();
    });
  });
