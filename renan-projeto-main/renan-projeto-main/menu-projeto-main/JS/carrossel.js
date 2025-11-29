document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".sc-track");
    const slides = Array.from(document.querySelectorAll(".sc-slide"));
    const nextBtn = document.querySelector(".right");
    const prevBtn = document.querySelector(".left");
    const dotsContainer = document.querySelector(".sc-dots");
    let currentIndex = 0;

    /* Criar pontinhos */
    slides.forEach((_, i) => {
        const dot = document.createElement("div");
        if(i === 0) dot.classList.add("active");
        dotsContainer.appendChild(dot);
        dot.addEventListener("click", () => goToSlide(i));
    });

    const dots = Array.from(document.querySelectorAll(".sc-dots div"));

    function goToSlide(index) {
        currentIndex = index;
        track.style.transform = `translateX(${-currentIndex * 100}%)`;
        dots.forEach(dot => dot.classList.remove("active"));
        dots[currentIndex].classList.add("active");
    }

    /* Botões de navegação */
    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % slides.length;
        goToSlide(currentIndex);
    });

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        goToSlide(currentIndex);
    });

    // ❌ Remove auto-slide
    // setInterval(() => {
    //     currentIndex = (currentIndex + 1) % slides.length;
    //     goToSlide(currentIndex);
    // }, 4000);
});