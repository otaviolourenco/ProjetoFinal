const dataAtual = new Date();
const dataEscolhida = new Date(dataAtual.getTime() + 3 * 24 * 60 * 60 * 1000);

const intervaloContagem = setInterval(() => {
  const agora = new Date().getTime();
  const tempoRestante = dataEscolhida - agora;

  const dias = Math.floor(tempoRestante / (1000 * 60 * 60 * 24));
  const horas = Math.floor(
    (tempoRestante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
  );
  const minutos = Math.floor((tempoRestante % (1000 * 60 * 60)) / (1000 * 60));
  const segundos = Math.floor((tempoRestante % (1000 * 60)) / 1000);

  // Atualize os elementos HTML com os valores calculados
  document.getElementById("dias").innerHTML = dias + " dias";
  document.getElementById("horas").innerHTML = horas + " hrs";
  document.getElementById("minutos").innerHTML = minutos + " min";
  document.getElementById("segundos").innerHTML = segundos + " seg";

  // Se o contador regressivo terminar, limpe o intervalo e exiba uma mensagem
  if (tempoRestante < 0) {
    clearInterval(intervaloContagem);
    document.getElementById("countdown").innerHTML =
      "O contador regressivo terminou!";
  }
}, 1000);
