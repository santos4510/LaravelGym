// public/js/dashboard.js
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('btn-checkin');
    const streakNum = document.getElementById('streak-number');
    const flame = document.getElementById('streak-flame');
    const today = new Date().getDay(); // 0=D, 1=L, etc.

    btn.addEventListener('click', () => {
        // Activar el día visualmente
        const dot = document.getElementById(`day-${today}`);
        if(dot) dot.classList.add('active-neon');

        // Efecto llama y contador
        flame.style.opacity = "1";
        streakNum.innerText = parseInt(streakNum.innerText) + 1;

        // Desactivar botón
        btn.innerText = "TREINO CONCLUÍDO!";
        btn.disabled = true;
        btn.style.opacity = "0.5";
    });
});