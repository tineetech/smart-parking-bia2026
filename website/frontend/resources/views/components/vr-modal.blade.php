{{--
  ╔══════════════════════════════════════════════════════════════╗
  ║  PARKIFY — VR VISUALISASI PARKIRAN                          ║
  ║  Blade Partial: resources/views/partials/vr-modal.blade.php  ║
  ║                                                              ║
  ║  Cara pakai di lokasi-detail.blade.php:                      ║
  ║  @include('partials.vr-modal', ['lokasi' => $lokasi, ...])   ║
  ╚══════════════════════════════════════════════════════════════╝

  Variabel yang diperlukan dari controller:
  - $lokasi          → LokasiParkir model
  - $slotData        → array hasil map (disiapkan di controller, BUKAN di Blade)
  - $foto360Url      → string|null  (Storage::url atau null)
  - $totalMotor      → int
  - $tersediaMotor   → int
  - $totalMobil      → int
  - $tersediaMobil   → int
--}}

{{-- ══ TOMBOL TRIGGER (taruh di dalam content-inner, sebelum CTA) ══ --}}
<div style="margin-top:22px">
  <button class="btn-vr-trigger" onclick="VRModal.open()">
    <div class="btn-vr-icon-wrap">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M2 8h20v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8z"/>
        <path d="M2 8l3-4h14l3 4"/>
        <circle cx="8.5" cy="13" r="1.5"/>
        <circle cx="15.5" cy="13" r="1.5"/>
      </svg>
    </div>
    <div>
      <div class="btn-vr-label">Lihat Visualisasi Parkiran</div>
      <div class="btn-vr-sub">3D Interaktif · 360° Photo</div>
    </div>
    <svg class="btn-vr-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <polyline points="9 18 15 12 9 6"/>
    </svg>
  </button>
</div>

<style>
/* ── TRIGGER BUTTON ── */
.btn-vr-trigger{
  display:flex;align-items:center;gap:14px;width:100%;
  padding:15px 18px;border-radius:16px;
  background:linear-gradient(135deg,#0d1728 0%,#162236 60%,#1a2e4a 100%);
  border:1px solid rgba(37,99,235,0.4);
  cursor:pointer;text-align:left;
  transition:border-color .2s,box-shadow .2s,transform .12s;
  box-shadow:0 4px 20px rgba(37,99,235,.18),inset 0 1px 0 rgba(255,255,255,.05);
}
.btn-vr-trigger:hover{
  border-color:rgba(59,130,246,0.7);
  box-shadow:0 6px 28px rgba(37,99,235,.3),inset 0 1px 0 rgba(255,255,255,.07);
}
.btn-vr-trigger:active{transform:scale(.99)}
.btn-vr-icon-wrap{
  width:44px;height:44px;border-radius:13px;
  background:rgba(37,99,235,0.25);border:1px solid rgba(37,99,235,0.4);
  display:flex;align-items:center;justify-content:center;
  color:#93c5fd;flex-shrink:0;
  box-shadow:0 0 16px rgba(37,99,235,0.3);
}
.btn-vr-label{font-size:14px;font-weight:700;color:#f1f5f9;margin-bottom:2px;font-family:'Space Grotesk',sans-serif}
.btn-vr-sub{font-size:11px;color:#64748b;font-weight:500}
.btn-vr-arrow{color:#475569;margin-left:auto;flex-shrink:0}

/* ════════════════════════════════════════════
   VR MODAL
════════════════════════════════════════════ */
#vrModal{
  display:none;position:fixed;inset:0;z-index:99999;
  background:rgba(0,0,0,.88);backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  align-items:center;justify-content:center;padding:12px;
}
#vrModal.open{display:flex}

.vr-shell{
  width:100%;max-width:920px;height:min(90vh,660px);
  background:#0a0e1a;border-radius:22px;overflow:hidden;
  display:flex;flex-direction:column;
  box-shadow:0 32px 100px rgba(0,0,0,.7);
  border:1px solid rgba(255,255,255,.07);position:relative;
}

/* ── HEADER ── */
.vr-header{
  display:flex;align-items:center;gap:12px;
  padding:13px 18px;
  background:linear-gradient(90deg,rgba(37,99,235,.12),rgba(255,255,255,.03));
  border-bottom:1px solid rgba(255,255,255,.07);flex-shrink:0;z-index:10;
}
.vr-title{
  display:flex;align-items:center;gap:9px;
  font-size:13.5px;font-weight:700;color:#e2e8f0;
  font-family:'Space Grotesk',sans-serif;letter-spacing:.01em;flex:1;min-width:0;
}
.vr-title-name{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.vr-badge{
  font-size:9.5px;font-weight:800;padding:3px 9px;border-radius:999px;
  letter-spacing:.07em;text-transform:uppercase;white-space:nowrap;flex-shrink:0;
}
.vr-badge-3d{background:rgba(37,99,235,.3);color:#93c5fd;border:1px solid rgba(93,168,252,.3)}
.vr-badge-360{background:rgba(16,185,129,.28);color:#6ee7b7;border:1px solid rgba(110,231,183,.3)}

/* Mode tabs */
.mode-tabs{
  display:flex;background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.09);border-radius:10px;overflow:hidden;flex-shrink:0;
}
.mode-tab{
  padding:7px 13px;font-size:11.5px;font-weight:600;color:#64748b;
  cursor:pointer;border:none;background:none;display:flex;align-items:center;gap:5px;
  transition:all .2s;white-space:nowrap;
}
.mode-tab.active{background:rgba(37,99,235,.5);color:#fff}
.mode-tab:hover:not(.active){background:rgba(255,255,255,.06);color:#cbd5e1}

.vr-close{
  width:32px;height:32px;border-radius:9px;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.09);
  color:#64748b;display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:all .15s;flex-shrink:0;
}
.vr-close:hover{background:rgba(239,68,68,.2);color:#fca5a5;border-color:rgba(239,68,68,.3)}

/* ── BODY ── */
.vr-body{flex:1;position:relative;overflow:hidden}

/* ═══ 360° VIEW ═══ */
.view-360{position:absolute;inset:0;display:none}
.view-360.active{display:block}
.view-360 canvas{width:100%;height:100%;display:block;cursor:grab}
.view-360 canvas:active{cursor:grabbing}

.no-photo-fallback{
  position:absolute;inset:0;display:flex;flex-direction:column;
  align-items:center;justify-content:center;gap:14px;
  background:linear-gradient(135deg,#0d1728,#1a2e4a);
}
.no-photo-fallback .nf-icon{opacity:.2}
.no-photo-fallback .nf-title{font-size:14px;font-weight:600;color:#94a3b8;font-family:'Space Grotesk',sans-serif}
.no-photo-fallback .nf-sub{font-size:11.5px;color:#475569;max-width:220px;text-align:center;line-height:1.5}
.nf-btn{
  margin-top:4px;padding:10px 20px;border-radius:10px;
  background:rgba(37,99,235,.35);color:#93c5fd;
  border:1px solid rgba(93,168,252,.3);font-size:12px;font-weight:700;
  cursor:pointer;transition:all .15s;
}
.nf-btn:hover{background:rgba(37,99,235,.5)}

.hint-360{
  position:absolute;bottom:18px;left:50%;transform:translateX(-50%);
  background:rgba(0,0,0,.65);backdrop-filter:blur(8px);
  color:#cbd5e1;font-size:11.5px;padding:7px 16px;border-radius:999px;
  display:flex;align-items:center;gap:8px;pointer-events:none;
  border:1px solid rgba(255,255,255,.09);
  animation:fadeHint360 5s ease forwards;
}
@keyframes fadeHint360{0%,65%{opacity:1}100%{opacity:0}}

/* ═══ 3D VIEW ═══ */
.view-3d{position:absolute;inset:0;display:none}
.view-3d.active{display:block}
.view-3d canvas{width:100%;height:100%;display:block;cursor:grab}
.view-3d canvas:active{cursor:grabbing}

/* Stats overlay */
.vr-stats{position:absolute;top:12px;left:12px;display:flex;flex-direction:column;gap:5px}
.vr-stat{
  background:rgba(0,0,0,.6);backdrop-filter:blur(8px);
  border:1px solid rgba(255,255,255,.09);border-radius:999px;
  padding:5px 12px;font-size:11px;font-weight:600;
  display:flex;align-items:center;gap:7px;color:#cbd5e1;
}

/* Legend */
.vr-legend{
  position:absolute;top:12px;right:12px;
  background:rgba(0,0,0,.6);backdrop-filter:blur(8px);
  border:1px solid rgba(255,255,255,.09);border-radius:12px;
  padding:10px 14px;display:flex;flex-direction:column;gap:7px;
}
.leg-item{display:flex;align-items:center;gap:8px;font-size:11px;color:#94a3b8;font-weight:500}
.leg-dot{width:10px;height:10px;border-radius:3px;flex-shrink:0}

/* Crosshair */
.vr-crosshair{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:18px;height:18px;pointer-events:none;display:none;
}
.vr-crosshair::before,.vr-crosshair::after{
  content:'';position:absolute;background:rgba(255,255,255,.55);border-radius:1px;
}
.vr-crosshair::before{width:2px;height:100%;left:50%;transform:translateX(-50%)}
.vr-crosshair::after{height:2px;width:100%;top:50%;transform:translateY(-50%)}
.vr-crosshair.fp-on{display:block}

/* FP hint */
.fp-hint{
  position:absolute;bottom:68px;left:50%;transform:translateX(-50%);
  background:rgba(0,0,0,.6);backdrop-filter:blur(8px);
  border:1px solid rgba(255,255,255,.09);border-radius:10px;
  padding:7px 14px;font-size:11px;color:#64748b;
  display:none;align-items:center;gap:8px;pointer-events:none;white-space:nowrap;
}
.fp-hint.on{display:flex}

/* Bottom controls */
.vr-ctrl-bar{
  position:absolute;bottom:14px;left:50%;transform:translateX(-50%);
  display:flex;align-items:center;gap:5px;
  background:rgba(0,0,0,.68);backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,.09);border-radius:999px;padding:5px 9px;
}
.vr-ctrl-sep{width:1px;height:18px;background:rgba(255,255,255,.1);margin:0 2px}
.vr-ctrl-btn{
  display:flex;align-items:center;gap:5px;padding:6px 11px;border-radius:999px;
  font-size:11px;font-weight:600;cursor:pointer;border:none;
  color:#64748b;background:none;transition:all .15s;white-space:nowrap;
}
.vr-ctrl-btn:hover{background:rgba(255,255,255,.09);color:#e2e8f0}
.vr-ctrl-btn.on{background:rgba(37,99,235,.38);color:#93c5fd}

@media(max-width:500px){
  .vr-header{padding:10px 12px;gap:8px}
  .vr-title{font-size:12px}
  .mode-tab{padding:6px 10px;font-size:10.5px}
  .vr-ctrl-btn span{display:none}
  .vr-shell{border-radius:16px;height:min(92vh,560px)}
}
</style>

{{-- ══ VR MODAL ══ --}}
<div id="vrModal" role="dialog" aria-modal="true" aria-label="Visualisasi Parkiran">
  <div class="vr-shell">

    {{-- Header --}}
    <div class="vr-header">
      <div class="vr-title">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.5">
          <path d="M2 8h20v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8z"/>
          <path d="M2 8l3-4h14l3 4"/>
          <circle cx="8.5" cy="13" r="1.5"/><circle cx="15.5" cy="13" r="1.5"/>
        </svg>
        <span class="vr-title-name">{{ $lokasi->nama }}</span>
        <span class="vr-badge vr-badge-3d" id="vrBadge">3D</span>
      </div>

      <div class="mode-tabs">
        <button class="mode-tab" id="tab360" onclick="VRModal.switchMode('360')" aria-label="Mode 360 derajat">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/>
            <path d="M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/>
          </svg>
          360°
        </button>
        <button class="mode-tab" id="tab3d" onclick="VRModal.switchMode('3d')" aria-label="Mode 3D">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          </svg>
          3D
        </button>
      </div>

      <button class="vr-close" onclick="VRModal.close()" aria-label="Tutup">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    {{-- Body --}}
    <div class="vr-body">

      {{-- 360° View --}}
      <div class="view-360" id="vrView360">
        @if($lokasi->foto_360)
          <canvas id="vrCanvas360"></canvas>
          <div class="hint-360" id="vrHint360">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0v10M10 10.5a2 2 0 0 0-2 2v1.5a2 2 0 0 0-2 2v4h12v-4a2 2 0 0 0-2-2V11a2 2 0 0 0-2-2v0"/>
            </svg>
            Seret untuk melihat sekeliling
          </div>
        @else
          <div class="no-photo-fallback">
            <div class="nf-icon">
              <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"/><path d="M2 12h20"/>
                <path d="M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/>
              </svg>
            </div>
            <div class="nf-title">Foto 360° Belum Tersedia</div>
            <div class="nf-sub">Admin belum mengunggah foto panorama untuk lokasi ini</div>
            <button class="nf-btn" onclick="VRModal.switchMode('3d')">→ Beralih ke Visualisasi 3D</button>
          </div>
        @endif
      </div>

      {{-- 3D View --}}
      <div class="view-3d" id="vrView3d">
        <canvas id="vrCanvas3d"></canvas>
        <div class="vr-crosshair" id="vrCrosshair"></div>

        {{-- Stats --}}
        <div class="vr-stats">
          <div class="vr-stat" style="color:#6ee7b7;border-color:rgba(110,231,183,.2)">
            <div style="width:7px;height:7px;border-radius:50%;background:#10b981"></div>
            Tersedia: <strong>{{ $tersediaMotor + $tersediaMobil }}</strong>
          </div>
          <div class="vr-stat" style="color:#fca5a5;border-color:rgba(252,165,165,.2)">
            <div style="width:7px;height:7px;border-radius:50%;background:#ef4444"></div>
            Terisi: <strong>{{ ($totalMotor - $tersediaMotor) + ($totalMobil - $tersediaMobil) }}</strong>
          </div>
        </div>

        {{-- Legend --}}
        <div class="vr-legend">
          <div class="leg-item"><div class="leg-dot" style="background:#10b981"></div>Tersedia</div>
          <div class="leg-item"><div class="leg-dot" style="background:#ef4444"></div>Terisi</div>
          <div class="leg-item"><div class="leg-dot" style="background:#f59e0b"></div>Motor</div>
          <div class="leg-item"><div class="leg-dot" style="background:#3b82f6"></div>Mobil</div>
        </div>

        {{-- FP hint --}}
        <div class="fp-hint" id="vrFpHint">WASD / ↑↓←→ untuk bergerak · Seret untuk melihat</div>

        {{-- Controls --}}
        <div class="vr-ctrl-bar">
          <button class="vr-ctrl-btn" id="ctrlBird" onclick="VRModal.setCam('bird')">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5z"/>
              <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            <span>Bird's Eye</span>
          </button>
          <button class="vr-ctrl-btn" id="ctrlFp" onclick="VRModal.setCam('fp')">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/>
            </svg>
            <span>First Person</span>
          </button>
          <div class="vr-ctrl-sep"></div>
          <button class="vr-ctrl-btn" onclick="VRModal.resetCam()">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
            </svg>
            <span>Reset</span>
          </button>
        </div>
      </div>

    </div>{{-- /vr-body --}}
  </div>{{-- /vr-shell --}}
</div>{{-- /vrModal --}}

<script>
/* ══════════════════════════════════════════
   PARKIFY VR — CONTROLLER
   Slot data dari Blade (PHP → JS)
══════════════════════════════════════════ */
{{--
  $slotData disiapkan di controller (array/collection sudah di-map),
  bukan di-map di sini karena Blade salah parse arrow function + array literal.
--}}
const SLOT_DATA = @json($slotData);

const FOTO_360_URL = @json(
    $lokasi->foto_360
        ? url(Storage::url($lokasi->foto_360))
        : null
);
console.log(FOTO_360_URL)

/* ─────────────────────────────────────────
   360° EQUIRECTANGULAR VIEWER
───────────────────────────────────────── */

/* ─────────────────────────────────────────
   360° EQUIRECTANGULAR VIEWER — WebGL/Three.js
   GPU-rendered, smooth, HD quality
───────────────────────────────────────── */
const Viewer360 = (() => {
  let renderer, scene, camera, sphere;
  let isDragging = false, lastX = 0, lastY = 0;
  let yaw = 0, pitch = 0;   // derajat; pitch=0 → horizon
  let raf = null;
  let mountedCanvas = null;
    let velYaw = 0, velPitch = 0;
  let _onDown, _onUp, _onMove, _onTouchStart, _onTouchMove, _onResize;


  function init(container, url) {
    // Three.js renderer — pakai container div, bukan canvas manual
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setPixelRatio(window.devicePixelRatio);

    const w = container.clientWidth  || container.offsetWidth  || 800;
    const h = container.clientHeight || container.offsetHeight || 500;
    renderer.setSize(w, h);
    renderer.domElement.style.cssText = 'width:100%;height:100%;display:block;cursor:grab';
    container.innerHTML = ''; // bersihkan canvas lama jika ada
    container.appendChild(renderer.domElement);
    mountedCanvas = renderer.domElement;

    // Camera — FOV 90, pitch=0 = lurus ke horizon
    camera = new THREE.PerspectiveCamera(90, w / h, 0.1, 1000);
    camera.position.set(0, 0, 0);

    // Scene + sphere dalam-out
    scene = new THREE.Scene();
    const geo = new THREE.SphereGeometry(500, 64, 32);
    geo.scale(-1, 1, 1); // balik normal agar texture terlihat dari dalam

    const tex = new THREE.TextureLoader().load(url, () => {
      // texture loaded — update renderer sekali lagi
    });
    tex.mapping = THREE.EquirectangularReflectionMapping;

    const mat = new THREE.MeshBasicMaterial({ map: tex });
    sphere = new THREE.Mesh(geo, mat);
    scene.add(sphere);

    // Events
    const el = renderer.domElement;
    el.addEventListener('mousedown',  onDown);
    el.addEventListener('touchstart', onTouchStart, { passive: true });
    window.addEventListener('mousemove',  onMove);
    window.addEventListener('mouseup',    onUp);
    window.addEventListener('touchmove',  onTouchMove, { passive: true });
    window.addEventListener('touchend',   onUp);
    window.addEventListener('resize',     onResize);

function onDown(e) {
  isDragging = true;
  lastX = e.clientX; lastY = e.clientY;
  velYaw = 0; velPitch = 0;          // reset inertia saat mulai drag
  el.style.cursor = 'grabbing';
}
function onUp() {
  isDragging = false;
  el.style.cursor = 'grab';
  // velYaw & velPitch tetap ada → inertia berlanjut setelah lepas
}
function onTouchStart(e) {
  isDragging = true;
  const t = e.touches[0];
  lastX = t.clientX; lastY = t.clientY;
  velYaw = 0; velPitch = 0;
}
function onTouchMove(e) {
  if(!isDragging) return;
  const t = e.touches[0];
  const dx = t.clientX - lastX, dy = t.clientY - lastY;
  velYaw   = dx * 0.25;
  velPitch = dy * 0.25;
  yaw   -= velYaw;
  pitch  = Math.max(-85, Math.min(85, pitch - velPitch));
  lastX = t.clientX; lastY = t.clientY;
}
function onMove(e) {
  if(!isDragging) return;
  const dx = e.clientX - lastX, dy = e.clientY - lastY;
  velYaw   = dx * 0.25;
  velPitch = dy * 0.25;
  yaw   -= velYaw;
  pitch  = Math.max(-85, Math.min(85, pitch - velPitch));
  lastX = e.clientX; lastY = e.clientY;
}
function onResize() {
  if(!renderer) return;
  const c = renderer.domElement.parentElement;
  if(!c) return;
  const nw = c.clientWidth, nh = c.clientHeight;
  renderer.setSize(nw, nh);
  camera.aspect = nw / nh;
  camera.updateProjectionMatrix();
}
    loop();
  }


function loop() {
  raf = requestAnimationFrame(loop);
  if(!renderer || !camera) return;

  // Inertia — saat tidak drag, pelambatan bertahap
  if(!isDragging) {
    velYaw   *= 0.90;
    velPitch *= 0.90;
    yaw   -= velYaw;
    pitch  = Math.max(-85, Math.min(85, pitch - velPitch));
  }

  const yR = THREE.MathUtils.degToRad(yaw);
  const pR = THREE.MathUtils.degToRad(pitch);
  camera.rotation.order = 'YXZ';
  camera.rotation.y = yR;
  camera.rotation.x = pR;

  renderer.render(scene, camera);
}

function stop() {
  if(raf) { cancelAnimationFrame(raf); raf = null; }
  if(renderer) {
    const el = renderer.domElement;
    el.removeEventListener('mousedown',  _onDown);
    el.removeEventListener('touchstart', _onTouchStart);
    window.removeEventListener('mousemove', _onMove);
    window.removeEventListener('mouseup',   _onUp);
    window.removeEventListener('touchmove', _onTouchMove);
    window.removeEventListener('touchend',  _onUp);
    window.removeEventListener('resize',    _onResize);
    renderer.dispose();
    if(el.parentElement) el.parentElement.innerHTML = '';
    renderer = null;
  }
  scene = camera = sphere = null;
  isDragging = false;
}

  return { init, stop };
})();

/* ─────────────────────────────────────────
   3D PARKIRAN RENDERER (Canvas2D)
───────────────────────────────────────── */
const Renderer3D = (() => {
  let canvas, ctx, W, H;
  let raf;
  let mode='bird'; // 'bird'|'fp'
  // Bird cam
  let camYaw=35, camPitch=52, camDist=20;
  // FP cam
  let fpX=0, fpZ=9, fpYaw=180, fpPitch=-10;
  let isDragging=false, lastX=0, lastY=0;
  const keys={};

  // Build slot geometry from SLOT_DATA
  const MOTOR_COLS = SLOT_DATA.filter(s=>s.type==='motor').length;
  const CAR_COLS   = SLOT_DATA.filter(s=>s.type==='mobil').length;

  // Layout slots in a grid
  const slotObjs = (() => {
    const motors = SLOT_DATA.filter(s=>s.type==='motor');
    const cars   = SLOT_DATA.filter(s=>s.type==='mobil');
    const perRow = 6, gap=2.4;
    const out = [];

    motors.forEach((s,i) => {
      const col=i%perRow, row=Math.floor(i/perRow);
      out.push({...s, x:(col-perRow/2+0.5)*gap, z:(row-Math.ceil(motors.length/perRow)/2)*3.0-2, available:s.status==='tersedia'});
    });
    cars.forEach((s,i) => {
      const col=i%perRow, row=Math.floor(i/perRow);
      out.push({...s, x:(col-perRow/2+0.5)*gap, z:(row+Math.ceil(motors.length/perRow)/2)*3.2+1.5, available:s.status==='tersedia'});
    });
    return out;
  })();

  function proj(x,y,z){
    const yr = camYaw  * Math.PI/180;
    const pr = camPitch * Math.PI/180;

    // Rotate around Y axis (yaw)
    const rx =  x*Math.cos(yr) - z*Math.sin(yr);
    const rz =  x*Math.sin(yr) + z*Math.cos(yr);

    // Rotate around X axis (pitch) — y ke atas, rz ke depan
    const ry2 = -y*Math.cos(pr) + rz*Math.sin(pr);
    const rz2 =  y*Math.sin(pr) + rz*Math.cos(pr);

    // Perspective divide — clamp rz2 agar tidak flip
    const depth = Math.max(rz2 + camDist, 0.5);
    const scale = camDist / depth;

    return {
      sx: W/2 + rx  * scale * (W/20),
      sy: H/2 + ry2 * scale * (H/20),
      s:  scale
    };
  }

  function projFP(x,y,z){
    const yr=fpYaw*Math.PI/180, pr=fpPitch*Math.PI/180;
    const dx=x-fpX, dy=y-1.6, dz=z-fpZ;
    const rx2=dx*Math.cos(-yr)-dz*Math.sin(-yr);
    const rz2=dx*Math.sin(-yr)+dz*Math.cos(-yr);
    if(rz2<=0.1) return null;
    const ry3=dy*Math.cos(-pr)-rz2*Math.sin(-pr);
    const rz3=dy*Math.sin(-pr)+rz2*Math.cos(-pr);
    if(rz3<=0.01) return null;
    const f=(H/2)/Math.tan((60*Math.PI/180)/2);
    return {sx:W/2+(rx2/rz3)*f, sy:H/2-(ry3/rz3)*f, s:1/rz3};
  }

  function getProj(x,y,z){ return mode==='bird'?proj(x,y,z):projFP(x,y,z); }

  function drawSlot(sl){
    const hw=sl.type==='mobil'?1.0:0.7, hd=sl.type==='mobil'?1.5:1.0;
    const clr=sl.available?(sl.type==='motor'?'#f59e0b':'#3b82f6'):'#ef4444';
    const corners=[
      [sl.x-hw,0,sl.z-hd],[sl.x+hw,0,sl.z-hd],
      [sl.x+hw,0,sl.z+hd],[sl.x-hw,0,sl.z+hd]
    ].map(([x,y,z])=>getProj(x,y,z));
    if(corners.some(p=>!p)) return;

    ctx.beginPath();
    corners.forEach((p,i)=>i===0?ctx.moveTo(p.sx,p.sy):ctx.lineTo(p.sx,p.sy));
    ctx.closePath();
    ctx.fillStyle=clr+'2a';ctx.fill();
    ctx.strokeStyle=clr;ctx.lineWidth=1.2;ctx.stroke();

    if(mode==='bird'){
      const ctr=proj(sl.x,0.08,sl.z);
      // Glow
      const g=ctx.createRadialGradient(ctr.sx,ctr.sy,0,ctr.sx,ctr.sy,9);
      g.addColorStop(0,clr+'66');g.addColorStop(1,clr+'00');
      ctx.beginPath();ctx.arc(ctr.sx,ctr.sy,9,0,Math.PI*2);
      ctx.fillStyle=g;ctx.fill();
      // Dot
      ctx.beginPath();ctx.arc(ctr.sx,ctr.sy,4,0,Math.PI*2);
      ctx.fillStyle=sl.available?'#10b981':'#ef4444';ctx.fill();
    }
  }

  function drawFrame(){
    if(!canvas) return;
    const rect=canvas.getBoundingClientRect();
    if(rect.width===0) return;
    canvas.width=rect.width*devicePixelRatio;
    canvas.height=rect.height*devicePixelRatio;
    ctx.scale(devicePixelRatio,devicePixelRatio);
    W=rect.width; H=rect.height;

    // FP movement
    if(mode==='fp'){
      const spd=0.07, yr=fpYaw*Math.PI/180;
      // Forward = ke arah yang "ditunjuk" kamera (sin yaw, -cos yaw di space ini)
      const fwdX =  Math.sin(yr), fwdZ = -Math.cos(yr);
      const rgtX =  Math.cos(yr), rgtZ =  Math.sin(yr);
      if(keys['w']||keys['ArrowUp'])    {fpX-=fwdX*spd; fpZ-=fwdZ*spd;}
      if(keys['s']||keys['ArrowDown'])  {fpX+=fwdX*spd; fpZ+=fwdZ*spd;}
      if(keys['a']||keys['ArrowLeft'])  {fpX-=rgtX*spd; fpZ-=rgtZ*spd;}
      if(keys['d']||keys['ArrowRight']) {fpX+=rgtX*spd; fpZ+=rgtZ*spd;}
    }

    // Background
    const bg=ctx.createLinearGradient(0,0,0,H);
    bg.addColorStop(0,'#090d1a');bg.addColorStop(1,'#141e30');
    ctx.fillStyle=bg;ctx.fillRect(0,0,W,H);

    // Grid floor
    ctx.strokeStyle='rgba(37,99,235,0.1)';ctx.lineWidth=0.5;
    for(let i=-10;i<=10;i++){
      const a=getProj(i*1.8,0,-12),b=getProj(i*1.8,0,12);
      const c=getProj(-12,0,i*1.8),d=getProj(12,0,i*1.8);
      if(a&&b){ctx.beginPath();ctx.moveTo(a.sx,a.sy);ctx.lineTo(b.sx,b.sy);ctx.stroke();}
      if(c&&d){ctx.beginPath();ctx.moveTo(c.sx,c.sy);ctx.lineTo(d.sx,d.sy);ctx.stroke();}
    }

    // Walls
    const wallH=0.6;
    [[-14,0,-11],[14,0,-11],[14,0,11],[-14,0,11]].forEach((_,i,a)=>{
      const next=a[(i+1)%a.length];
      const c=[getProj(...a[i]),getProj(a[i][0],wallH,a[i][2]),getProj(next[0],wallH,next[2]),getProj(...next)];
      if(c.some(p=>!p)) return;
      ctx.beginPath();c.forEach((p,j)=>j===0?ctx.moveTo(p.sx,p.sy):ctx.lineTo(p.sx,p.sy));
      ctx.closePath();ctx.fillStyle='rgba(37,99,235,0.07)';ctx.fill();
      ctx.strokeStyle='rgba(37,99,235,0.28)';ctx.lineWidth=0.8;ctx.stroke();
    });

    // Sort & draw slots
    const sorted=[...slotObjs].sort((a,b)=>{
      if(mode==='bird') return getProj(a.x,0,a.z).sy-getProj(b.x,0,b.z).sy;
      return Math.hypot(b.x-fpX,b.z-fpZ)-Math.hypot(a.x-fpX,a.z-fpZ);
    });
    sorted.forEach(drawSlot);

    // Entrance labels
    [['MASUK',0,0,-11],['KELUAR',0,0,11]].forEach(([lbl,,x,y,z])=>{
      // Fix arg order
    });
    [['MASUK',0,-11],['KELUAR',0,11]].forEach(([lbl,x,z])=>{
      const p=getProj(x,0.05,z);if(!p) return;
      ctx.fillStyle='rgba(245,158,11,0.85)';
      ctx.font=`bold ${Math.max(9,Math.min(14,(mode==='bird'?p.s*55:12)))}px monospace`;
      ctx.textAlign='center';ctx.fillText(lbl,p.sx,p.sy);
    });

    raf=requestAnimationFrame(drawFrame);
  }

  function initEvents(){
    canvas.addEventListener('mousedown',e=>{isDragging=true;lastX=e.clientX;lastY=e.clientY;});
    window.addEventListener('mousemove',e=>{
      if(!isDragging) return;
      const dx=e.clientX-lastX,dy=e.clientY-lastY;
      if(mode==='bird'){camYaw+=dx*0.35;camPitch=Math.max(-80,Math.min(89,camPitch-dy*0.28));}
      else {fpYaw+=dx*0.28;fpPitch=Math.max(-45,Math.min(35,fpPitch-dy*0.22));}
      lastX=e.clientX;lastY=e.clientY;
    });
    window.addEventListener('mouseup',()=>isDragging=false);
    canvas.addEventListener('wheel',e=>{
      if(mode==='bird') camDist=Math.max(7,Math.min(42,camDist+e.deltaY*0.03));
      e.preventDefault();
    },{passive:false});
    canvas.addEventListener('touchstart',e=>{
      isDragging=true;const t=e.touches[0];lastX=t.clientX;lastY=t.clientY;
    },{passive:true});
    canvas.addEventListener('touchmove',e=>{
      if(!isDragging) return;const t=e.touches[0];
      const dx=t.clientX-lastX,dy=t.clientY-lastY;
      if(mode==='bird'){camYaw+=dx*0.4;camPitch=Math.max(10,Math.min(89,camPitch-dy*0.3));}
      else {fpYaw+=dx*0.35;fpPitch=Math.max(-45,Math.min(35,fpPitch-dy*0.25));}
      lastX=t.clientX;lastY=t.clientY;
    },{passive:true});
    window.addEventListener('touchend',()=>isDragging=false);
    window.addEventListener('keydown',e=>{keys[e.key]=true;});
    window.addEventListener('keyup',e=>{delete keys[e.key];});
  }

  function init(c){
    canvas=c; ctx=canvas.getContext('2d');
    initEvents(); drawFrame();
  }

  function setMode(m){
    mode=m;
    document.getElementById('vrCrosshair').classList.toggle('fp-on',m==='fp');
    document.getElementById('vrFpHint').classList.toggle('on',m==='fp');
    document.getElementById('ctrlBird').classList.toggle('on',m==='bird');
    document.getElementById('ctrlFp').classList.toggle('on',m==='fp');
    if(m==='fp'){fpX=0;fpZ=9;fpYaw=180;fpPitch=-10;}
  }

  function resetCam(){
    if(mode==='bird'){camYaw=35;camPitch=52;camDist=20;}
    else {fpX=0;fpZ=9;fpYaw=180;fpPitch=-10;}
  }

  function stop(){ if(raf)cancelAnimationFrame(raf);raf=null; }

  return {init, setMode, resetCam, stop};
})();

/* ─────────────────────────────────────────
   VR MODAL CONTROLLER
───────────────────────────────────────── */
const VRModal = (() => {
  let curMode = FOTO_360_URL ? '360' : '3d';
  let r3Init=false, r360Init=false;

  function open(){
    document.getElementById('vrModal').classList.add('open');
    document.body.style.overflow='hidden';
    switchMode(curMode);
  }

  function close(){
    document.getElementById('vrModal').classList.remove('open');
    document.body.style.overflow='';
    Renderer3D.stop();
    Viewer360.stop();
    r3Init=false;
    r360Init = false;
  }

  function switchMode(m){
    curMode=m;
    const v360=document.getElementById('vrView360');
    const v3d =document.getElementById('vrView3d');
    const badge=document.getElementById('vrBadge');
    document.getElementById('tab360').classList.toggle('active',m==='360');
    document.getElementById('tab3d').classList.toggle('active',m==='3d');

    if(m==='360'){
      v360.classList.add('active'); v3d.classList.remove('active');
      badge.textContent='360°';badge.className='vr-badge vr-badge-360';
      Renderer3D.stop();
     // BARU — cek canvas dulu sebelum init
        if(FOTO_360_URL && !r360Init){
            const container = document.getElementById('vrView360');
            if(container){
                Viewer360.init(container, FOTO_360_URL);
                r360Init=true;
            }
            }
    } else {
      v3d.classList.add('active'); v360.classList.remove('active');
      badge.textContent='3D';badge.className='vr-badge vr-badge-3d';
      Renderer3D.stop();

        // Selalu stop dulu lalu reinit agar event listener fresh
        Viewer360.stop();
        r360Init = false;

      document.getElementById('ctrlBird').classList.add('on');
      setTimeout(()=>{
        Renderer3D.init(document.getElementById('vrCanvas3d'));
        r3Init=true;
      },60);
    }
  }

  function setCam(m){ Renderer3D.setMode(m); }
  function resetCam(){ Renderer3D.resetCam(); }

  // Backdrop close
  document.getElementById('vrModal').addEventListener('click',function(e){
    if(e.target===this) close();
  });
  // ESC close
  document.addEventListener('keydown',e=>{ if(e.key==='Escape') close(); });

  return {open, close, switchMode, setCam, resetCam};
})();
</script>