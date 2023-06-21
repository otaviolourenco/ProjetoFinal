function formatarCodigoPostal(input) {
  var codigoPostal = input.value.replace(/\D/g, "");

  codigoPostal = codigoPostal.replace(/^(\d{4})(\d)/, "$1-$2");

  input.value = codigoPostal;
}

// scroll para o topo
let mybutton = document.getElementById("topBtn");
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0; // No Safari
  document.documentElement.scrollTop = 0; // No Chrome, Firefox, IE...
}

// Selecione o botão "Adicionar ao carrinho"
const btnsAdicionarCarrinho = document.querySelectorAll(".btn-add-car");

// Selecione a div para exibir a mensagem de sucesso
const divMensagem = document.querySelector("#msg-sucesso");

// Adicione um ouvinte de eventos de clique a cada botão
btnsAdicionarCarrinho.forEach((btn) => {
  btn.addEventListener("click", () => {
    // Envie uma solicitação AJAX para adicionar_carrinho.php
    fetch("adicionar_carrinho.php", {
      method: "POST",
    })
      .then((response) => {
        // Verifique se a resposta tem um código de status 204 (sem conteúdo)
        if (response.status === 204) {
          // Exiba a mensagem de sucesso na página
          divMensagem.style.display = "block";

          // Oculte a mensagem após 3 segundos
          setTimeout(() => {
            divMensagem.style.display = "none";
          }, 4000);
        } else {
          console.error("Erro ao adicionar produto ao carrinho");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  });
});

// Mobile Menu
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

// define all UI variable
const navToggler = document.querySelector(".nav-toggler");
const navMenu = document.querySelector(".site-navbar ul");
const navLinks = document.querySelectorAll(".site-navbar a");

// load all event listners
allEventListners();

// functions of all event listners
function allEventListners() {
  // toggler icon click event
  navToggler.addEventListener("click", togglerClick);
  // nav links click event
  navLinks.forEach((elem) => elem.addEventListener("click", navLinkClick));
}

// togglerClick function
function togglerClick() {
  navToggler.classList.toggle("toggler-open");
  navMenu.classList.toggle("open");
}

// navLinkClick function
function navLinkClick() {
  if (navMenu.classList.contains("open")) {
    navToggler.click();
  }
}

$(document).ready(function () {
  if ($(window).width() <= 575) {
    // Função a ser executada apenas em dispositivos móveis
    function mobileBreadcrumb() {
      // Seu código aqui
      $(".mobile-bc").css("padding-top", "6rem");
    }
    // Chame a função
    mobileBreadcrumb();
  }
});
