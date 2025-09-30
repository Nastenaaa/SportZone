<?php
/*Таймінг генерації на сервері*/
$t0 = microtime(true);

/*Дані сайту */
$x = "SportZone — твій простір сили й енергії";
$y = "2025 SportZone • Instagram: @sportzone.ua";

/* 5 сторінок */
$pages = [
  "home"      => ["title" => "Головна"],
  "workouts"  => ["title" => "Тренування"],
  "nutrition" => ["title" => "Харчування"],
  "tips"      => ["title" => "Поради"],
  "contacts"  => ["title" => "Контакти"],
];

/* активна сторінка з URL */
$page = $_GET["page"] ?? "home";
if (!array_key_exists($page, $pages)) { $page = "home"; }

/* меню (у блоці 2) */
$menuBlock = 2;
$menu = [];
foreach ($pages as $slug => $meta) {
  $menu[] = [
    "title" => $meta["title"],
    "href"  => "?page=".$slug,
    "active"=> ($slug === $page)
  ];
}

/* контент по сторінках*/
function contentFor($page){
  $plate = "images/healthy_plate.jpg";
  $map   = "images/fitness_map.jpg";

  switch($page){
    case "workouts":
      return [
        1 => [
          "Плануй тренування на тиждень і слідкуй за прогресом у SportZone.",
          "Кожне тренування має розминку, основну частину та відновлення."
        ],
        3 => ["«Сьогодні — найкращий день, щоб почати рухатися!»"],
        4 => [
          "Програма тренувань на день:",
          "<ol>
             <li>Розминка — 10 хв.</li>
             <li>Присідання — 3×15</li>
             <li>Віджимання — 3×12</li>
             <li>Планка — 3×1 хв.</li>
           </ol>",
        ],
        5 => [
          "Тренування тижня: кругова сесія 20 хв (4 вправи × 5 кіл).",
          "Додай 10–15 хв ходьби або легкого бігу для відновлення."
        ],
        6 => [
          "Питання? Пиши: <a href='mailto:sportzone.ua@gmail.com'>sportzone.ua@gmail.com</a>.",
          "Разом тримати темп легше!"
        ],
      ];

    case "nutrition":
      return [
        1 => [
          "Збалансоване харчування — половина успіху.",
          "Плануй прийоми їжі та пий достатньо води."
        ],
        3 => ["«Їжа — це паливо. Обирай якісне!»"],
        4 => [
          "Приклад корисної тарілки:",
          "<a href='https://patelnya.com.ua/category/retsepty/zdorove-harchuvannya-retsepty/' target='_blank' rel='noopener'>
             <img src='{$plate}' alt='Здорова тарілка' width='320'>
           </a>",
        ],
        5 => [
          "Порада: 1.5–2 л води на день. Додавай склянку перед кожним прийомом їжі.",
          "Уникай надлишку цукру, обирай цільні продукти."
        ],
        6 => [
          "Залишай свої улюблені рецепти — додамо до розділу спільноти.",
          "© 2025 SportZone"
        ],
      ];

    case "tips":
      return [
        1 => [
          "Мотивація з'являється в процесі — головне почати.",
          "Веди нотатки про настрій, сон і тренування."
        ],
        3 => ["«Маленькі звички щодня = великі зміни з часом.»"],
        4 => [
          "Натискай на частини картинки:",
          "<img src='{$map}' usemap='#fitmap' width='480' alt='Фітнес-карта'>
           <map name='fitmap'>
             <!-- Ліва частина (тарілка) → Харчування -->
             <area shape='rect' coords='0,0,240,240' href='?page=nutrition' alt='Харчування'>
             <!-- Права частина (спорт) → Тренування -->
             <area shape='rect' coords='240,0,480,240' href='?page=workouts' alt='Тренування'>
           </map>",
        ],
        5 => [
          "Сон 7–8 годин — ключ до відновлення.",
          "Плануй відпочинок так само уважно, як і тренування."
        ],
        6 => [
          "Є питання або ідеї? Пиши на <a href='mailto:sportzone.ua@gmail.com'>sportzone.ua@gmail.com</a>.",
          "Підписуйся на наш Instagram: <a href='https://instagram.com/sportzone.ua' target='_blank' rel='noopener'>@sportzone.ua</a>"
        ],
      ];

    case "contacts":
      return [
        1 => [
          "Зв'яжись із командою SportZone — будемо раді допомогти.",
          "Працюємо щодня з 9:00 до 18:00."
        ],
        3 => ["«Ми поруч, щоб підтримати твій рух уперед.»"],
        4 => [
          "Наші контакти:",
          "<ul>
            <li>Email: <a href='mailto:sportzone.ua@gmail.com'>sportzone.ua@gmail.com</a></li>
            <li>Instagram: <a href='https://instagram.com/sportzone.ua' target='_blank' rel='noopener'>@sportzone.ua</a></li>
            <li>Адреса: Київ, вул. Спортивна, 10</li>
          </ul>",
        ],
        5 => [
          "Співпраця: брендам і тренерам — напишіть нам на email.",
          "Зворотний зв’язок важливий — поділись враженнями!"
        ],
        6 => [
          "2025 SportZone",
          "Чекаємо на твій фідбек!"
        ],
      ];

    default: // home
      return [
        1 => [
          "Ласкаво просимо до SportZone — місця, де щоденна активність стає звичкою.",
          "Слідкуй за прогресом, плануй тренування та отримуй натхнення щодня."
        ],
        3 => ["«Маленькі кроки щодня приводять до великих результатів.»"],
        4 => [
          "Чому обирають SportZone?",
          "<ul>
             <li>Програми для всіх рівнів</li>
             <li>Корисні поради з харчування</li>
             <li>Підтримка спільноти</li>
           </ul>",
        ],
        5 => [
          "Тренування тижня: поєднання бігу та базових силових вправ.",
          "Корисний факт: 20–30 хв активності щодня вже покращують самопочуття."
        ],
        6 => [
          "Зворотний зв’язок: <a href='mailto:sportzone.ua@gmail.com'>sportzone.ua@gmail.com</a>.",
          "Приєднуйся до спільноти — разом тримати темп легше!"
        ],
      ];
  }
}

/* рендер абзаців/HTML-шматків */
function render_chunks($chunks){
  if (!$chunks) return;
  foreach ($chunks as $chunk){
    if (is_string($chunk) && preg_match('/^\s*</', $chunk)){
      echo $chunk; // HTML
    } else {
      echo "<p>{$chunk}</p>"; // звичайний <p>
    }
  }
}

$texts = contentFor($page);

/* блоки макета */
$blocks = [
  1 => ['area'=>'top',    'bg'=>'bg-blue',  'badge'=>'x'],
  2 => ['area'=>'left',   'bg'=>'bg-peach'              ],
  3 => ['area'=>'strip',  'bg'=>'bg-green'              ],
  4 => ['area'=>'center', 'bg'=>'bg-white'              ],
  5 => ['area'=>'right',  'bg'=>'bg-peach'              ],
  6 => ['area'=>'bottom', 'bg'=>'bg-blue',  'badge'=>'y'],
];

/* підрахунок часу серверної генерації */
$serverGenMs = round((microtime(true) - $t0) * 1000, 2);
?>
<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title>SportZone — <?= htmlspecialchars($pages[$page]['title']) ?></title>
  <link rel="stylesheet" href="styles.css">
  <style>.menu a.active{background:#e8f0ff;border-color:#c7d7ff;color:#0f3b9d;}</style>
</head>
<body data-page="<?= htmlspecialchars($page) ?>">
  <div class="page">
    <?php foreach ($blocks as $num => $b): ?>
      <section class="block area-<?= $b['area'] ?> <?= $b['bg'] ?>" aria-label="Блок <?= $num ?>">
        <?php if (($b['badge'] ?? null) === 'x'): ?>
          <div class="badge badge-x"><?= htmlspecialchars($x) ?></div>
          <div class="content"><?php render_chunks($texts[1] ?? []); ?></div>

        <?php elseif (($b['badge'] ?? null) === 'y'): ?>
          <div class="content"><?php render_chunks($texts[6] ?? []); ?></div>
          <div class="badge badge-y"><?= htmlspecialchars($y) ?></div>

        <?php elseif ($num === $menuBlock): ?>
          <nav class="menu" aria-label="Головне меню">
            <ul>
              <?php foreach ($menu as $item): ?>
                <li><a class="<?= $item['active']?'active':'' ?>" href="<?= htmlspecialchars($item['href']) ?>">
                       <?= htmlspecialchars($item['title']) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </nav>

        <?php else: ?>
          <div class="content"><?php render_chunks($texts[$num] ?? []); ?></div>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  </div>

  <!-- Дані для JS (час сервера, активна сторінка) -->
  <script>
    window.SZ_BOOT = {
      page: document.body.getAttribute('data-page'),
      serverGenMs: <?= json_encode($serverGenMs) ?>
    };
  </script>

  <!-- JS: редагування елементів, localStorage, заміри часу -->
  <script>
  (function () {
    const { page = 'home', serverGenMs = 0 } = window.SZ_BOOT || {};

    // "візуально спостережувані" елементи
    const SELECTORS = [
      '.content p', '.content li',
      '.content h1', '.content h2', '.content h3', '.content h4', '.content h5', '.content h6',
      '.content span', '.content small', '.content strong', '.content em',
      '.content img',
      '.menu a',
      '.badge' // X та Y
    ];

    // стилі підсвітки та модалки
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

    // збір цілей
    const targets = [];
    SELECTORS.forEach(sel => document.querySelectorAll(sel).forEach(el => targets.push(el)));

    // ключ для localStorage
    function keyFor(el, idx) {
      const role = el.tagName.toLowerCase();
      const inMenu = el.closest('.menu') ? 'menu' : '';
      const inBadge = el.classList.contains('badge') ? 'badge' : '';
      const inImg = el.tagName === 'IMG' ? 'img' : '';
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

    // позначити та проставити ключі
    targets.forEach((el, i) => {
      el.classList.add('sz-editable');
      el.dataset.szKey = keyFor(el, i);
    });

    // відновлення з localStorage + замір часу
    const t0 = performance.now();
    let restored = 0;
    targets.forEach(el => {
      const saved = localStorage.getItem(el.dataset.szKey);
      if (saved != null) {
        if (el.tagName === 'IMG') el.setAttribute('src', saved);
        else el.textContent = saved;
        restored++;
      }
    });
    const lsMs = Math.round((performance.now() - t0) * 100) / 100;

    // бейдж часу
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
            ? `<input type="text" placeholder="URL або відносний шлях (напр. images/pic.jpg)" value="${current ?? ''}">`
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
        if (isImg) { if (val) el.setAttribute('src', val); }
        else { el.textContent = val; }
        localStorage.setItem(el.dataset.szKey, val);
        close();
      };
      back.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
      field.focus(); field.select && field.select();
    }

    // форма редагування 
    targets.forEach(el => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        openModal(el);
      });
    });
  })();
  </script>
</body>
</html>
