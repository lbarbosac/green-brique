function ajustarAlturaHeader() {
    const header = document.querySelector('header');
    const primeiraSecao = document.getElementById('apresentacao');
    
    if (header && primeiraSecao) {
        const alturaHeader = header.offsetHeight; 
        primeiraSecao.style.scrollMarginTop = `${alturaHeader + 20}px`; 
        document.body.style.paddingTop = `${alturaHeader}px`;
    }
}

window.addEventListener('load', ajustarAlturaHeader);
window.addEventListener('resize', ajustarAlturaHeader);

function configurarAnimacaoEntrada() {
    const elementosAnimados = document.querySelectorAll('.animacao-entrada');
    
    const opcoesObserver = {
        root: null,
        rootMargin: '0px 0px -10% 0px',
        threshold: 0.01 
    };

    const observador = new IntersectionObserver((entradas) => {
        entradas.forEach(entrada => {
            if (entrada.isIntersecting) {
                entrada.target.classList.add('visivel');
            }
        });
    }, opcoesObserver);

    elementosAnimados.forEach(secao => {
        observador.observe(secao);
    });
}

document.addEventListener('DOMContentLoaded', configurarAnimacaoEntrada);

function configurarParallax() {
    const imagem = document.querySelector('.imagem-principal');
    if (!imagem) return;

    const FORCA_PARALLAX = 0.1; 
    const secao = imagem.closest('section');
    if (!secao) return;

    const secaoTopo = secao.offsetTop;

    window.addEventListener('scroll', () => {
        const posicaoScroll = window.scrollY;
        const deslocamento = (posicaoScroll - secaoTopo); 
        imagem.style.transform = `translateY(${deslocamento * FORCA_PARALLAX * -1}px)`;
    });
}

window.addEventListener('load', configurarParallax);

document.querySelectorAll('a[href^="#"]').forEach(ancora => {
    ancora.addEventListener('click', function (e) {
        e.preventDefault(); 

        const idAlvo = this.getAttribute('href');
        const elementoAlvo = document.querySelector(idAlvo);

        if (elementoAlvo) {
            elementoAlvo.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});