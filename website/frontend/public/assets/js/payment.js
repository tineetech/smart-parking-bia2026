(function() {
    var BTN = document.getElementById('btn-bayar');
    if (!BTN) return;

    var METHOD = BTN.dataset.method;
    var SNAP_TOKEN = BTN.dataset.snap;
    var PEMESANAN_ID = BTN.dataset.pemesanan;
    var SUCCESS_URL = BTN.dataset.successUrl;
    var CALLBACK_URL = BTN.dataset.callbackUrl;
    var BCA_VA_URL = BTN.dataset.bcaVaUrl;
    var CHECK_STATUS_URL = BTN.dataset.checkStatusUrl;

    function getCSRF() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    window.handlePayment = function() {
        if (!METHOD) return;
        if (METHOD === 'bca') {
            startBcaFlow();
        } else if (METHOD === 'qris' || ['gopay', 'ovo', 'dana'].includes(METHOD)) {
            startMidtransFlow();
        }
    };

    function startMidtransFlow() {
        if (!SNAP_TOKEN) {
            alert('Token pembayaran tidak ditemukan. Silakan muat ulang halaman.');
            return;
        }
        snap.pay(SNAP_TOKEN, {
            onSuccess: function(result) {
                fetch(CALLBACK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCSRF()
                    },
                    body: JSON.stringify({
                        pemesanan_id: PEMESANAN_ID,
                        transaction_id: result.transaction_id,
                        payment_type: result.payment_type,
                        status: 'sukses'
                    })
                }).then(function() {
                    onPaymentSuccess();
                });
            },
            onPending: function(result) {
                console.log('Pending', result);
            },
            onError: function(result) {
                console.error('Error', result);
            },
            onClose: function() {
                console.log('Midtrans popup ditutup');
            }
        });
    }

    var bcaPollInterval = null;

    function startBcaFlow() {
        showOverlay('bca-overlay');
        setState('loading');

        fetch(BCA_VA_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCSRF()
            },
            body: JSON.stringify({
                pemesanan_id: PEMESANAN_ID
            })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success && data.va_number) {
                document.getElementById('bca-va-num').textContent = formatVA(data.va_number);
                document.getElementById('bca-va-exp').textContent = 'Berlaku hingga: ' + (data.expired_at || '24 jam');
                setState('va-ready');
                startPolling();
            } else {
                setState('error');
            }
        })
        .catch(function() { setState('error'); });
    }

    function startPolling() {
        var attempts = 0;
        var MAX = 120;
        bcaPollInterval = setInterval(function() {
            attempts++;
            if (attempts > MAX) {
                clearInterval(bcaPollInterval);
                return;
            }

            fetch(CHECK_STATUS_URL + '?pemesanan_id=' + PEMESANAN_ID, {
                headers: { 'X-CSRF-TOKEN': getCSRF() }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 'sukses') {
                    clearInterval(bcaPollInterval);
                    setState('success');
                }
            })
            .catch(function() {});
        }, 5000);
    }

    window.retryBca = function() {
        startBcaFlow();
    };

    window.closeBcaOverlay = function() {
        clearInterval(bcaPollInterval);
        hideOverlay('bca-overlay');
    };

    window.copyVA = function() {
        var num = document.getElementById('bca-va-num').textContent.replace(/\s/g, '');
        if (navigator.clipboard) {
            navigator.clipboard.writeText(num).then(function() {
                var btn = document.getElementById('copy-va-btn');
                if (!btn) return;
                btn.classList.add('copied');
                btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Tersalin!';
                setTimeout(function() {
                    btn.classList.remove('copied');
                    btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Salin Nomor VA';
                }, 2500);
            });
        }
    };

    function formatVA(num) {
        return String(num).replace(/(\d{4})(?=\d)/g, '$1 ');
    }

    function setState(state) {
        var loadingEl = document.getElementById('bca-loading-state');
        var vaEl = document.getElementById('bca-va-state');
        var successEl = document.getElementById('bca-success-state');
        var errorEl = document.getElementById('bca-error-state');
        if (loadingEl) loadingEl.style.display = state === 'loading' ? 'block' : 'none';
        if (vaEl) vaEl.style.display = state === 'va-ready' ? 'block' : 'none';
        if (successEl) successEl.style.display = state === 'success' ? 'block' : 'none';
        if (errorEl) errorEl.style.display = state === 'error' ? 'block' : 'none';
    }

    function showOverlay(id) {
        var el = document.getElementById(id);
        if (el) el.classList.add('show');
    }

    function hideOverlay(id) {
        var el = document.getElementById(id);
        if (el) el.classList.remove('show');
    }

    window.onPaymentSuccess = function() {
        window.location.href = SUCCESS_URL;
    };
})();
