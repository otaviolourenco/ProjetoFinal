function formatarCodigoPostal(input) {
  // Remove todos os caracteres não numéricos do valor do input
  var codigoPostal = input.value.replace(/\D/g, "");

  // Verifica se a quantidade de dígitos é suficiente para inserir o hífen
  if (codigoPostal.length >= 4) {
    // Insere o hífen após os primeiros 4 dígitos
    codigoPostal = codigoPostal.substr(0, 4) + "-" + codigoPostal.substr(4);
  }

  // Define o valor formatado no input
  input.value = codigoPostal;
}
