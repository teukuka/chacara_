$(document).ready(function() {
  $('.method').on('click', function() {
    $('.method').removeClass('blue-border');
    $(this).addClass('blue-border');
  });

  var $cardInput = $('.input-fields input');

  $('.next-btn').on('click', function(e) {
    e.preventDefault();

    $cardInput.removeClass('warning');

    $cardInput.each(function() {
      var $this = $(this);
      if (!$this.val()) {
        $this.addClass('warning');
      }
    });

    // Redirecionar para a próxima página
    window.location.href = "consultar_reserva.php";
  });

  $('.back-btn').on('click', function(e) {
    e.preventDefault();

    // Voltar para a página reserva.php
    window.location.href = "reserva.php";
  });
});

$(document).ready(function() {
  console.log("payment.js foi carregado com sucesso!");

  // Resto do seu código...
});

