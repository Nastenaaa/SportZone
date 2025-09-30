(function () {
  const { page = 'home', serverGenMs = 0 } = window.SZ_BOOT || {};

  // які елементи вважаємо "візуально спостережуваними" для редагування
  const SELECTORS = [
    '.content p', '.content li',
    '.content h1', '.content h2', '.content h3', '.content h4', '.content h5', '.content h6',
    '.content span', '.content small', '.content strong', '.content em',
    '.content img',
    '.menu a',
    '.badge'
  ];

  // легка стилізація
  const style = document.createElement('style');
  style.textContent = `
    .sz-editable { cursor:pointer; outline:1px dashed rgba(0,0,0,.12); outline-offset:2px; }
    .sz-editable:hover { outline-color: rgba(0,0,0,.35); background: rgba(255,255,0,.06); }

    .sz-modal-backdrop { position:fixed; inset:0; background:rgba(0,0,0,.35);
      display:flex; align-items:center; justify-content:center; z-index:9999; }
    .sz-modal { background:#fff; width:min(520px,92vw); border-radius:10px;
      box-shadow:0 12px 40px rgba(0,0,0,.2); padding:16px; }
    .sz-modal h3 { margin:0 0 8px; font:600 16px/1.3 system-ui,Segoe UI,Arial }
    .sz-modal textarea, .sz-modal input[type="text"] {
      width:100%; min-height:96px; padding:10px; border:1px solid #cbd5e1;
      border-radius:8px; font:14px/1.5 system-ui,Segoe UI,Arial; margin-bottom:10px;
    }
    .sz-modal .row { display:flex; gap:8px; justify-content:flex-end }
    .sz-btn { padding:8px 12px; border-radius:8px; border:1px solid #cbd5e1;
      background:#f8fafc; font-weight:600; cursor:pointer }
    .sz-btn.primary { background:#e8f0ff; border-color:#c7d7ff; color:#0f3b9d }
    .sz-badge-time { position:fixed; right:10px; bottom:10px; z-index:9998;
      background:#ffffffee; border:1px solid #dfe6f5; border-radius:8px;
      padding:6px 10px; font:12px/1.3 system-ui,Segoe UI,Arial; box-shadow:0 4px 16px rgba(0,0,0,.08); }
  `;
  document.head.appendChild(style);

  // зібрати всі цільові елементи
  const targets = [];
  SELECTORS.forEach(sel => document.querySelectorAll(sel).forEach(el => targets.push(el)));

  // унікальний ключ для localStorage:
  function keyFor(el, idx) {
    const role = el.tagName.toLowerCase();
    const inMenu = el.closest('.menu') ? 'menu' : '';
    const inBadge = el.classList.contains('badge') ? 'badge' : '';
    const inImg = el.tagName === 'IMG' ? 'img' : '';
    // шлях у DOM (стабілізація ключа)
    const path = [];
    let n = el;
    while (n && n !== document.body) {
      let i = 0, s = n;
      while (s.previousElementSibling) { s = s.previousElementSibling; i++; }
      path.push(`${n.tagName}:${i}`);
      n = n.parentElement;
    }
    path.reverse();
    return `SZ:${page}:${role}:${inMenu}${inBadge}${inImg}:${idx}:${path.join('/')}`;
  }

  // відмітити редагованими + прив'язати ключі
  targets.forEach((el, i) => {
    el.classList.add('sz-editable');
    el.dataset.szKey = keyFor(el, i);
  });

  // відновлення з localStorage + замір часу
  const t0 = performance.now();
  let restored = 0;
  targets.forEach(el => {
    const k = el.dataset.szKey;
    const saved = localStorage.getItem(k);
    if (saved != null) {
      if (el.tagName === 'IMG') {
        el.setAttribute('src', saved);
      } else {
        el.textContent = saved;
      }
      restored++;
    }
  });
  const lsMs = Math.round((performance.now() - t0) * 100) / 100;

  // бейдж часу в куті
  const info = document.createElement('div');
  info.className = 'sz-badge-time';
  info.textContent = `Server: ${serverGenMs} ms  •  localStorage: ${lsMs} ms  (restored: ${restored})`;
  document.body.appendChild(info);
  console.log(`[SZ] Server render: ${serverGenMs} ms, localStorage apply: ${lsMs} ms, restored: ${restored}`);

  // модалка редагування
  function openModal(el) {
    const isImg = el.tagName === 'IMG';
    const current = isImg ? el.getAttribute('src') : (el.textContent || '').trim();

    const back = document.createElement('div');
    back.className = 'sz-modal-backdrop';
    back.innerHTML = `
      <div class="sz-modal">
        <h3>Редагувати ${isImg ? 'зображення' : 'текст'}</h3>
        ${isImg
          ? `<input type="text" placeholder="URL або відносний шлях до зображення (наприклад images/pic.jpg)" value="${current ?? ''}">`
          : `<textarea placeholder="Введіть новий текст...">${current ?? ''}</textarea>`
        }
        <div class="row">
          <button class="sz-btn js-cancel">Скасувати</button>
          <button class="sz-btn primary js-save">Зберегти</button>
        </div>
      </div>
    `;
    document.body.appendChild(back);

    const field = back.querySelector('textarea, input');
    const btnSave = back.querySelector('.js-save');
    const btnCancel = back.querySelector('.js-cancel');

    function close() { back.remove(); }

    btnCancel.onclick = close;
    btnSave.onclick = () => {
      const val = (field.value || '').trim();
      const key = el.dataset.szKey;
      if (isImg) {
        if (val) el.setAttribute('src', val);
      } else {
        el.textContent = val;
      }
      localStorage.setItem(key, val);
      close();
    };

    back.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    field.focus();
    field.select && field.select();
  }

  // клік по будь-якому елементу  відкрити форму
  targets.forEach(el => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      openModal(el);
    });
  });
})();
