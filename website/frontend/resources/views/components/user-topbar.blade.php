@php
 $user = Auth::user();
 $notifUnread = \App\Models\Notifikasi::where('user_id', $user->id)->belumDibaca()->count();
@endphp
<!-- ════════ TOP HEADER ════════ -->
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="{{ route('user.dashboard') }}">
      <img style="width:30px" src="{{ asset('assets/img/logo-round.png') }}" alt="">
      <span class="logo-text">Parki<span>fy</span></span>
    </a>

    <nav class="desktop-nav">
      <a class="active" href="{{ route('user.dashboard') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a href="{{ route('user.kendaraan') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a href="{{ route('user.riwayat') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Riwayat
      </a>
      <a href="{{ route('user.pengaturan') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
        Pengaturan
      </a>
    </nav>

    <div style="display:flex;align-items:center;gap:10px;margin-left:auto">
      <div style="position:relative" id="notifWrap">
        <div class="map-ctrl-btn" onclick="toggleNotifPopup()" style="cursor:pointer">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div id="notifBadge" style="position:absolute;top:7px;right:7px;width:8px;height:8px;background:var(--red);border-radius:50%;border:2px solid #fff;{{ $notifUnread === 0 ? 'display:none' : '' }}"></div>
      </div>
      <div class="header-user">
        <div class="user-avatar" onclick="window.location.href = '{{ route('user.pengaturan') }}'">
          @if($user->foto_profil_url)
            <img src="{{ $user->foto_profil_url }}" alt="">
          @else
            {{ strtoupper(substr($user->name, 0, 2)) }}
          @endif
        </div>
        <span class="user-name-text">{{ $user->name }}</span>
      </div>
    </div>
  </div>
</header>

<style>
.notif-item {
  display:flex;gap:10px;padding:10px 14px;cursor:pointer;
  transition:background 0.15s;border-bottom:1px solid #f0f4f9;
}
.notif-item:hover { background:#f5f8ff; }
.notif-item.unread { background:#eff6ff; }
.notif-dot {
  width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-top:5px;
}
.notif-dot.unread { background:#2563eb; }
.notif-dot.read { background:#d1d5db; }
.notif-content { flex:1;min-width:0; }
.notif-judul { font-size:12px;font-weight:600;color:#0f1e36; }
.notif-judul.unread { font-weight:700; }
.notif-pesan { font-size:11px;color:#4a6080;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
.notif-waktu { font-size:10px;color:#94a3b8;margin-top:3px; }
.notif-empty {
  padding:32px 24px;text-align:center;
}
.notif-empty svg { color:#94a3b8;margin-bottom:8px; }
.notif-empty-text { font-size:12px;color:#94a3b8; }
@media (max-width: 600px) {
  #notifPopup { top:64px !important; left:12px !important; right:12px !important; width:auto !important; }
}
</style>

<script>
let notifOpen = false;

function toggleNotifPopup() {
  notifOpen = !notifOpen;
  const popup = document.getElementById('notifPopup');
  if (notifOpen) {
    const bell = document.querySelector('.map-ctrl-btn');
    if (bell) {
      const rect = bell.getBoundingClientRect();
      if (window.innerWidth > 600) {
        popup.style.right = (window.innerWidth - rect.right + 2) + 'px';
      }
    }
    popup.style.display = 'block';
    loadNotif();
  } else {
    popup.style.display = 'none';
  }
}

document.addEventListener('click', function(e) {
  const wrap = document.getElementById('notifWrap');
  if (notifOpen && wrap && !wrap.contains(e.target)) {
    notifOpen = false;
    document.getElementById('notifPopup').style.display = 'none';
  }
});

function loadNotif() {
  const list = document.getElementById('notifList');
  list.innerHTML = '<div style="padding:24px;text-align:center;font-size:12px;color:#94a3b8">Memuat notifikasi...</div>';

  fetch('{{ route('user.notifikasi.index') }}')
    .then(r => r.json())
    .then(data => {
      if (data.notifikasi.length === 0) {
        list.innerHTML = '<div class="notif-empty"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg><div class="notif-empty-text">Tidak ada notifikasi</div></div>';
        return;
      }
      let html = '';
      data.notifikasi.forEach(n => {
        const isUnread = !n.sudah_dibaca;
        const date = new Date(n.created_at);
        const waktu = date.toLocaleDateString('id-ID', { day:'numeric', month:'short', hour:'2-digit', minute:'2-digit' });
        html += `
          <div class="notif-item ${isUnread ? 'unread' : ''}" onclick="markReadNotif(${n.id}, this)">
            <div class="notif-dot ${isUnread ? 'unread' : 'read'}"></div>
            <div class="notif-content">
              <div class="notif-judul ${isUnread ? 'unread' : ''}">${escapeHtml(n.judul)}</div>
              <div class="notif-pesan">${escapeHtml(n.pesan)}</div>
              <div class="notif-waktu">${waktu}</div>
            </div>
          </div>
        `;
      });
      list.innerHTML = html;
      updateBadge(data.unread_count);
    })
    .catch(() => {
      list.innerHTML = '<div style="padding:24px;text-align:center;font-size:12px;color:#ef4444">Gagal memuat notifikasi.</div>';
    });
}

function markReadNotif(id, el) {
  fetch('{{ url('/user/notifikasi') }}/' + id + '/read', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} })
    .then(r => r.json())
    .then(() => {
      el.classList.remove('unread');
      el.querySelector('.notif-dot').className = 'notif-dot read';
      el.querySelector('.notif-judul').classList.remove('unread');
      const badge = document.getElementById('notifBadge');
      const count = document.querySelectorAll('.notif-item.unread').length - 1;
      if (count <= 0) badge.style.display = 'none';
    })
    .catch(() => {});
}

function markAllReadNotif() {
  fetch('{{ route('user.notifikasi.markAllRead') }}', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} })
    .then(r => r.json())
    .then(() => {
      document.querySelectorAll('.notif-item').forEach(el => {
        el.classList.remove('unread');
        el.querySelector('.notif-dot').className = 'notif-dot read';
        el.querySelector('.notif-judul').classList.remove('unread');
      });
      document.getElementById('notifBadge').style.display = 'none';
    })
    .catch(() => {});
}

function updateBadge(count) {
  const badge = document.getElementById('notifBadge');
  badge.style.display = count > 0 ? '' : 'none';
}

function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}
</script>