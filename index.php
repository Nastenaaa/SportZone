<?php
$x = "SportZone — твій простір сили й енергії";
$y = "2025 SportZone • Instagram: @sportzone.ua";

/*5 сторінок*/
$pages = [
  "home"      => ["title" => "Головна"],
  "workouts"  => ["title" => "Тренування"],
  "nutrition" => ["title" => "Харчування"],
  "tips"      => ["title" => "Поради"],
  "contacts"  => ["title" => "Контакти"],
];

/*активна сторінка з URL*/
$page = $_GET["page"] ?? "home";
if (!array_key_exists($page, $pages)) { $page = "home"; }

/*меню з масиву сторінок */
$menuBlock = 2;
$menu = [];
foreach ($pages as $slug => $meta) {
  $menu[] = [
    "title" => $meta["title"],
    "href"  => "?page=".$slug,
    "active"=> ($slug === $page)
  ];
}

/* контент по сторінках (змінні з UL/OL/LI/IMG/A/MAP)*/
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
          // OL/LI
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

    case "nutrition": /*IMG + A */
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
          "SportZone, 2025"
        ],
      ];

case "tips":      /* IMG + MAP */
  return [
    1 => [
      "Мотивація з'являється в процесі — головне почати.",
      "Веди нотатки про настрій, сон і тренування."
    ],
    3 => ["«Маленькі звички щодня = великі зміни з часом.»"],
    4 => [
      "Натискай на частини картинки:",
      // Зображення з картою посилань
      "<img src='images/fitness_map.jpg' usemap='#fitmap' width='480' alt='Фітнес-карта'>
       <map name='fitmap'>
         <!-- Ліва частина (тарілка) → Харчування -->
         <area shape='rect' coords='0,0,240,240' href='?page=nutrition' alt='Харчування'>
         
         <!-- Права частина (жінка у спорті) → Тренування -->
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



    case "contacts":  /* UL / LI + A */
      return [
        1 => [
          "Зв'яжись із командою SportZone — будемо раді допомогти.",
          "Працюємо щодня з 9:00 до 18:00."
        ],
        3 => ["«Ми поруч, щоб підтримати твій рух уперед.»"],
        4 => [
          "Наші контакти:",
          // ненумерований список (UL/LI)
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

    default:          /* home — UL / LI */
      return [
        1 => [
          "Ласкаво просимо до SportZone — місця, де щоденна активність стає звичкою.",
          "Слідкуй за прогресом, плануй тренування та отримуй натхнення щодня."
        ],
        3 => ["«Маленькі кроки щодня приводять до великих результатів.»"],
        4 => [
          "Чому обирають SportZone?",
          // маркований список (UL/LI)
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

/* рендер: якщо елемент починається з '<', виводимо як HTML; інакше — <p>…</p> */
function render_chunks($chunks){
  if (!$chunks) return;
  foreach ($chunks as $chunk){
    if (is_string($chunk) && preg_match('/^\s*</', $chunk)){
      echo $chunk;             
    } else {
      echo "<p>{$chunk}</p>";  
    }
  }
}

$texts = contentFor($page);

/* опис блоків для рендеру */
$blocks = [
  1 => ['area'=>'top',    'bg'=>'bg-blue',  'badge'=>'x'],
  2 => ['area'=>'left',   'bg'=>'bg-peach'              ],
  3 => ['area'=>'strip',  'bg'=>'bg-green'              ],
  4 => ['area'=>'center', 'bg'=>'bg-white'              ],
  5 => ['area'=>'right',  'bg'=>'bg-peach'              ],
  6 => ['area'=>'bottom', 'bg'=>'bg-blue',  'badge'=>'y'],
];
?>
<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title>SportZone — <?= htmlspecialchars($pages[$page]['title']) ?></title>
  <link rel="stylesheet" href="styles.css">
  <style>.menu a.active{background:#e8f0ff;border-color:#c7d7ff;color:#0f3b9d;}</style>
</head>
<body>
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
                <li><a class="<?= $item['active']?'active':'' ?>"
                       href="<?= htmlspecialchars($item['href']) ?>">
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
</body>
</html>
