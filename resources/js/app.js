import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

function iniciarEscutaReverb(userId) {
    console.log("🔊 ESCUTANDO REVERB NO CANAL: notificacoes." + userId);

    window.Echo.channel(`notificacoes.${userId}`).listen(
        ".mensagem.enviada",
        (data) => {
            console.log("🚨 EVENTO CAPTURADO NO FRONT!", data);

            if (!window.location.pathname.includes("/chat")) {
                const toastMsg = document.getElementById("reverb-toast-msg");
                // ALTERADO AQUI: De data.mensagem para data.content
                if (toastMsg && data.content) {
                    toastMsg.textContent = data.content;
                }

                const toastLink = document.querySelector("#reverb-toast a");
                if (toastLink && data.sender_id) {
                    toastLink.setAttribute("href", `/chat/${data.sender_id}`);
                }

                const toast = document.getElementById("reverb-toast");
                if (toast) {
                    toast.classList.remove(
                        "opacity-0",
                        "translate-y-20",
                        "pointer-events-none",
                    );
                    toast.classList.add("opacity-100", "translate-y-0");

                    setTimeout(() => {
                        toast.classList.remove("opacity-100", "translate-y-0");
                        toast.classList.add(
                            "opacity-0",
                            "translate-y-20",
                            "pointer-events-none",
                        );
                    }, 6000);
                }

                const badge = document.getElementById("notificacao-badge");
                if (badge) {
                    badge.style.setProperty("display", "flex", "important");
                    badge.classList.remove("hidden");
                }
            }
        },
    );
}

const verificarProntidao = setInterval(() => {
    const userId = document
        .querySelector('meta[name="user-id"]')
        ?.getAttribute("content");

    if (typeof window.Echo !== "undefined" && userId) {
        clearInterval(verificarProntidao);
        iniciarEscutaReverb(userId);
    }
}, 100);

setTimeout(() => clearInterval(verificarProntidao), 5000);
