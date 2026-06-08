<style>
    .cb-fab {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 54px;
        height: 54px;
        background: var(--blue-main, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        z-index: 999;
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.35);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .cb-cursor {
    display: inline-block;
    width: 1px;
    background: #0f1e36;
    margin-left: 1px;
    animation: cbCursorBlink 0.7s infinite;
    font-weight: 100;
    color: #0f1e36;
    font-size: 13px;
}
@keyframes cbCursorBlink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

    .cb-fab:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 24px rgba(37, 99, 235, 0.45);
    }

    .cb-fab svg {
        color: #fff;
    }

    .cb-notif {
        position: absolute;
        top: 1px;
        right: 1px;
        width: 16px;
        height: 16px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid #fff;
        font-size: 8px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-family: 'Space Grotesk', sans-serif;
    }
    
    .cb-popup {
    position: fixed;
    bottom: 90px;
    right: 24px;
    width: 360px;
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e2e8f2;
    box-shadow: 0 12px 48px rgba(15, 30, 54, 0.15);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 99999;
    transform-origin: bottom right;
    transition: opacity 0.22s ease, transform 0.22s ease;
    height: 80vh;
    max-height: 580px;
    min-height: 300px;
}

    .cb-popup.cb-hidden {
        opacity: 0;
        transform: scale(0.92) translateY(10px);
        pointer-events: none;
    }

    .cb-head {
        background: #2563eb;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .cb-head-avatar {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cb-head-avatar svg {
        color: #fff;
    }

    .cb-head-info {
        flex: 1;
    }

    .cb-head-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #fff;
        font-family: 'Space Grotesk', sans-serif;
        line-height: 1.2;
    }

    .cb-head-status {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.75);
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
    }

    .cb-online-dot {
        width: 6px;
        height: 6px;
        background: #4ade80;
        border-radius: 50%;
        animation: livepulse 1.6s infinite;
    }

    .cb-close-btn {
        width: 28px;
        height: 28px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        color: #fff;
        transition: background 0.15s;
    }

    .cb-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    
    .cb-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f8fafc;
    min-height: 0; /* penting agar flex bisa shrink */
}

    .cb-messages::-webkit-scrollbar {
        width: 3px;
    }

    .cb-messages::-webkit-scrollbar-thumb {
        background: #e2e8f2;
        border-radius: 999px;
    }

    .cb-msg {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }

    .cb-msg.user {
        flex-direction: row-reverse;
    }

    .cb-bubble {
        max-width: 240px;
        padding: 9px 13px;
        border-radius: 14px;
        font-size: 12.5px;
        line-height: 1.55;
        font-family: 'Poppins', sans-serif;
    }

    .cb-msg.bot .cb-bubble {
        background: #fff;
        border: 1px solid #e2e8f2;
        color: #0f1e36;
        border-bottom-left-radius: 4px;
    }

    .cb-msg.user .cb-bubble {
        background: #2563eb;
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .cb-msg-icon {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: #dbeafe;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cb-msg-icon svg {
        color: #2563eb;
    }

    .cb-typing-bubble {
        display: flex;
        gap: 5px;
        align-items: center;
        padding: 10px 14px;
    }

    .cb-typing-bubble span {
        width: 7px;
        height: 7px;
        background: #cbd5e1;
        border-radius: 50%;
        animation: cbBounce 1.2s infinite;
        display: block;
    }

    .cb-typing-bubble span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .cb-typing-bubble span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes cbBounce {

        0%,
        60%,
        100% {
            transform: translateY(0);
        }

        30% {
            transform: translateY(-6px);
        }
    }

    .cb-quick-chips {
        display: flex;
        gap: 6px;
        padding: 10px 14px;
        overflow-x: auto;
        scrollbar-width: none;
        border-top: 1px solid #e2e8f2;
        background: #fff;
        flex-shrink: 0;
    }

    .cb-quick-chips::-webkit-scrollbar {
        display: none;
    }

    .cb-chip {
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 600;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.15s;
        font-family: 'Poppins', sans-serif;
        flex-shrink: 0;
    }

    .cb-chip:hover {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }

    .cb-input-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-top: 1px solid #e2e8f2;
        background: #fff;
        flex-shrink: 0;
    }

    .cb-text-input {
        flex: 1;
        border: 1px solid #e2e8f2;
        border-radius: 10px;
        padding: 9px 13px;
        font-size: 12.5px;
        outline: none;
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #0f1e36;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .cb-text-input:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .cb-send-btn {
        width: 38px;
        height: 38px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.15s;
    }

    .cb-send-btn:hover {
        background: #1d4ed8;
    }

    .cb-send-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
    }

    .cb-send-btn svg {
        color: #fff;
    }

    @media (max-width: 480px) {
    .cb-popup {
        width: calc(100vw - 24px);
        right: 12px;
        bottom: 76px;
        height: 80vh;
        max-height: none; /* full 80vh di mobile */
    }
    .cb-fab {
        right: 16px;
        bottom: 82px;
    }
}
</style>

{{-- FAB BUTTON --}}
<button class="cb-fab" id="cbFab" onclick="toggleChatbot()" aria-label="Buka chatbot Parkify">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
    </svg>
    <div class="cb-notif" id="cbNotif">1</div>
</button>

{{-- POPUP CHATBOT --}}
<div class="cb-popup cb-hidden" id="cbPopup">

    {{-- Header --}}
    <div class="cb-head">
        <div class="cb-head-avatar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="2" y="3" width="7" height="7" rx="1" />
                <rect x="15" y="3" width="7" height="7" rx="1" />
                <rect x="2" y="14" width="7" height="7" rx="1" />
                <rect x="15" y="14" width="7" height="7" rx="1" />
            </svg>
        </div>
        <div class="cb-head-info">
            <div class="cb-head-name">Parki Assistant</div>
            <div class="cb-head-status">
                <div class="cb-online-dot"></div>
                Online · Smart Parking AI
            </div>
        </div>
        <button class="cb-close-btn" onclick="toggleChatbot()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    {{-- Messages --}}
    <div class="cb-messages" id="cbMessages"></div>

    {{-- Quick Chips --}}
    <div class="cb-quick-chips" id="cbChips">
        <div class="cb-chip" onclick="sendQuick(this)">Cek slot tersedia</div>
        <div class="cb-chip" onclick="sendQuick(this)">Cara booking parkir</div>
        <div class="cb-chip" onclick="sendQuick(this)">Tarif parkir</div>
        <div class="cb-chip" onclick="sendQuick(this)">Perpanjang waktu</div>
        <div class="cb-chip" onclick="sendQuick(this)">Sensor IoT</div>
    </div>

    {{-- Input --}}
    <div class="cb-input-row">
        <input class="cb-text-input" id="cbInput" placeholder="Tanya sesuatu tentang parkir..."
            onkeydown="if(event.key==='Enter')sendMessage()" />
        <button class="cb-send-btn" id="cbSendBtn" onclick="sendMessage()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <line x1="22" y1="2" x2="11" y2="13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" />
            </svg>
        </button>
    </div>
</div>

<script>
    const CB_SYSTEM_PROMPT = `Kamu adalah Parki, asisten AI untuk aplikasi Parkify — sebuah sistem smart parking yang mengintegrasikan IoT dan web app untuk monitoring dan booking slot parkir secara real-time.

Tugas kamu:
- Membantu pengguna memahami cara menggunakan aplikasi Parkify (booking slot, cek ketersediaan, perpanjang waktu, lihat riwayat)
- Menjelaskan bagaimana sensor IoT bekerja untuk mendeteksi ketersediaan slot parkir secara otomatis
- Memberikan informasi tentang lokasi parkir, tarif, dan status slot
- Membantu troubleshooting umum (QR code tidak bisa scan, slot tidak ter-update, dll)
- Menjawab pertanyaan tentang fitur aplikasi Parkify

Aturan penting:
- Jawab dalam bahasa Indonesia, singkat dan ramah
- Jika ditanya di luar topik parkir/Parkify, tolak dengan sopan dan arahkan kembali ke topik parkir
- Jangan pernah menyebut model AI atau teknologi yang kamu pakai
- Panggil dirimu sebagai "Parki"
- Format jawaban: singkat, padat, maksimal 3-4 kalimat kecuali jika perlu lebih detail
- Gunakan emoji sesekali agar lebih ramah 🚗🅿️`;

    let cbHistory = [];
    let cbOpen = false;
    let cbGreeted = false;

    function toggleChatbot() {
        cbOpen = !cbOpen;
        const popup = document.getElementById('cbPopup');
        const notif = document.getElementById('cbNotif');
        if (cbOpen) {
            popup.classList.remove('cb-hidden');
            notif.style.display = 'none';
            document.getElementById('cbInput').focus();
            if (!cbGreeted) {
                cbGreeted = true;
                setTimeout(() => addBotMessage(
                    'Halo! Saya Parki, asisten smart parking Parkify 🚗🅿️\nAda yang bisa saya bantu hari ini? Kamu bisa tanya soal booking slot, tarif, cara pakai sensor IoT, atau fitur lainnya!'
                    ), 300);
            }
        } else {
            popup.classList.add('cb-hidden');
        }
    }
function addBotMessage(text) {
    const msgs = document.getElementById('cbMessages');
    const div = document.createElement('div');
    div.className = 'cb-msg bot';
    div.innerHTML = `
        <div class="cb-msg-icon">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="7" height="7" rx="1"/>
                <rect x="15" y="3" width="7" height="7" rx="1"/>
                <rect x="2" y="14" width="7" height="7" rx="1"/>
                <rect x="15" y="14" width="7" height="7" rx="1"/>
            </svg>
        </div>
        <div class="cb-bubble"></div>`;
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;

    const bubble = div.querySelector('.cb-bubble');
    typeMessage(bubble, text, msgs);
}

function typeMessage(el, text, scrollContainer) {
    // Pecah teks jadi array karakter (support emoji multi-byte)
    const chars = [...text];
    let idx = 0;
    let plain = '';

    const interval = setInterval(() => {
        if (idx >= chars.length) {
            clearInterval(interval);
            // Selesai — tampilkan teks final tanpa cursor
            el.innerHTML = plain.replace(/\n/g, '<br>');
            return;
        }

        const ch = chars[idx];
        if (ch === '\n') {
            plain += '\n';
        } else {
            plain += ch;
        }
        idx++;

        // Render + cursor
        el.innerHTML = plain.replace(/\n/g, '<br>') + '<span class="cb-cursor">|</span>';
        scrollContainer.scrollTop = scrollContainer.scrollHeight;

    }, 16);
}

    function addUserMessage(text) {
        const msgs = document.getElementById('cbMessages');
        const div = document.createElement('div');
        div.className = 'cb-msg user';
        div.innerHTML = `<div class="cb-bubble">${text}</div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function addTyping() {
        const msgs = document.getElementById('cbMessages');
        const div = document.createElement('div');
        div.className = 'cb-msg bot';
        div.id = 'cbTyping';
        div.innerHTML = `
        <div class="cb-msg-icon">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="7" height="7" rx="1"/>
                <rect x="15" y="3" width="7" height="7" rx="1"/>
                <rect x="2" y="14" width="7" height="7" rx="1"/>
                <rect x="15" y="14" width="7" height="7" rx="1"/>
            </svg>
        </div>
        <div class="cb-bubble" style="padding:8px 12px">
            <div class="cb-typing-bubble"><span></span><span></span><span></span></div>
        </div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
        return div;
    }

    function sendQuick(el) {
        const text = el.textContent;
        document.getElementById('cbInput').value = text;
        sendMessage();
    }

    async function sendMessage() {
        const input = document.getElementById('cbInput');
        const sendBtn = document.getElementById('cbSendBtn');
        const text = input.value.trim();
        if (!text) return;

        input.value = '';
        sendBtn.disabled = true;
        addUserMessage(text);

        cbHistory.push({
            role: 'user',
            content: text
        });

        const typing = addTyping();
        try {
            const geminiMessages = cbHistory.map(m => ({
                role: m.role === 'assistant' ? 'model' : 'user',
                parts: [{
                    text: m.content
                }]
            }));

            let response, data;
            let attempts = 0;

            while (attempts < 3) {
                response = await fetch(
                    'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=AQ.Ab8RN6LaQVH4VqLedfiEKCVL0imzcfxoWGZQOZe2cQxOJHJbUw', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            system_instruction: {
                                parts: [{
                                    text: CB_SYSTEM_PROMPT
                                }]
                            },
                            contents: geminiMessages,
                            generationConfig: {
                                maxOutputTokens: 500,
                                temperature: 0.7
                            }
                        })
                    }
                );

                if (response.status === 429) {
                    attempts++;
                    await new Promise(r => setTimeout(r, 2000 * attempts));
                    continue;
                }

                data = await response.json();
                break;
            }

            if (!data || response.status === 429) {
                typing.remove();
                addBotMessage('Permintaan terlalu banyak, tunggu sebentar lalu coba lagi ya 🙏');
                sendBtn.disabled = false;
                input.focus();
                return;
            }

            const reply = data.candidates?.[0]?.content?.parts?.[0]?.text ||
                'Maaf, ada gangguan. Coba lagi ya.';

            cbHistory.push({
                role: 'assistant',
                content: reply
            });
            if (cbHistory.length > 20) cbHistory = cbHistory.slice(-20);

            typing.remove();
            addBotMessage(reply);

        } catch (e) {
            typing.remove();
            addBotMessage('Maaf, koneksi bermasalah. Coba beberapa saat lagi ya 🙏');
        }

        sendBtn.disabled = false;
        input.focus();
    }
</script>
