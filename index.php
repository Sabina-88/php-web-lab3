<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UI Components — Лабораторна робота</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #0E1420;
    --paper: #EEF1F5;
    --paper-2: #E3E8EE;
    --ink: #10141C;
    --ink-soft: #4A525E;
    --line: #3A6EA5;
    --line-soft: #B9C6D6;
    --accent: #E4572E;
    --accent-ink: #FFFFFF;
    --ok: #2E7D5B;
    --font-display: 'Space Grotesk', sans-serif;
    --font-body: 'IBM Plex Sans', sans-serif;
    --font-mono: 'IBM Plex Mono', monospace;
  }
  :root:not([data-theme="light"]){
    /* dark mode kept close to light since design is intentionally a paper/blueprint sheet */
  }
  @media (prefers-color-scheme: dark){
    :root:not([data-theme="light"]){
      --bg: #05080F;
    }
  }
  :root[data-theme="dark"]{ --bg: #05080F; }

  *{ box-sizing: border-box; }
  html,body{ margin:0; padding:0; }
  body{
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-body);
    -webkit-font-smoothing: antialiased;
  }
  ::selection{ background: var(--accent); color: var(--accent-ink); }
  a{ color: inherit; }
  :focus-visible{ outline: 2px solid var(--accent); outline-offset: 2px; }

  .sheet-bg{
    background-image:
      linear-gradient(var(--line-soft) 1px, transparent 1px),
      linear-gradient(90deg, var(--line-soft) 1px, transparent 1px);
    background-size: 28px 28px;
    background-color: var(--paper);
  }

  header.titleblock{
    max-width: 900px;
    margin: 0 auto;
    padding: 56px 24px 40px;
  }
  .eyebrow-row{
    display:flex; align-items:center; gap: 10px;
    font-family: var(--font-mono);
    font-size: 12px;
    color: var(--ink-soft);
    margin-bottom: 18px;
  }
  .eyebrow-row .dot{ width:6px; height:6px; border-radius:50%; background: var(--accent); }
  h1{
    font-family: var(--font-display);
    font-weight: 700;
    font-size: clamp(32px, 5vw, 52px);
    line-height: 1.05;
    margin: 0 0 14px;
    max-width: 14ch;
  }
  header.titleblock p.lede{
    font-size: 17px;
    line-height: 1.6;
    color: var(--ink-soft);
    max-width: 56ch;
    margin: 0 0 28px;
  }
  .meta-table{
    display: grid;
    grid-template-columns: repeat(3, auto);
    gap: 0 40px;
    border-top: 1px solid var(--line-soft);
    padding-top: 16px;
    font-family: var(--font-mono);
    font-size: 12px;
  }
  .meta-table div span{ display:block; }
  .meta-table .k{ color: var(--ink-soft); margin-bottom: 4px; }
  .meta-table .v{ color: var(--ink); font-weight: 500; }

  main{
    max-width: 900px;
    margin: 0 auto;
    padding: 8px 24px 100px;
  }

  .panel{
    background: #FFFFFF;
    border: 1px solid var(--line-soft);
    border-radius: 2px;
    margin-bottom: 28px;
    position: relative;
  }
  .panel::before{
    content: "";
    position: absolute; top: -1px; left: -1px;
    width: 14px; height: 14px;
    border-top: 2px solid var(--line);
    border-left: 2px solid var(--line);
  }
  .panel::after{
    content: "";
    position: absolute; bottom: -1px; right: -1px;
    width: 14px; height: 14px;
    border-bottom: 2px solid var(--line);
    border-right: 2px solid var(--line);
  }
  .panel-head{
    display:flex; align-items: baseline; gap: 14px;
    padding: 18px 22px;
    border-bottom: 1px solid var(--paper-2);
  }
  .panel-head .idx{
    font-family: var(--font-mono);
    font-size: 13px;
    color: var(--accent);
    border: 1px solid var(--accent);
    border-radius: 3px;
    padding: 2px 7px;
    flex-shrink: 0;
  }
  .panel-head h2{
    font-family: var(--font-display);
    font-size: 21px;
    font-weight: 600;
    margin: 0;
  }
  .panel-head .en{
    font-family: var(--font-mono);
    font-size: 12px;
    color: var(--ink-soft);
  }
  .panel-body{
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 0;
  }
  @media (max-width: 640px){
    .panel-body{ grid-template-columns: 1fr; }
  }
  .demo{
    padding: 26px 22px;
    background: var(--paper);
    display: flex;
    flex-direction: column;
    gap: 18px;
    justify-content: center;
  }
  .desc{
    padding: 22px 24px;
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--ink);
  }
  .desc p{ margin: 0 0 12px; }
  .desc ul{ margin: 0; padding-left: 18px; }
  .desc li{ margin-bottom: 6px; color: var(--ink-soft); }
  .desc li b{ color: var(--ink); font-weight: 500; }

  .group-label{
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--ink-soft);
    margin-bottom: 6px;
    display:block;
  }

  /* radio + checkbox */
  .opt-row{ display:flex; align-items:center; gap:8px; font-size: 14px; margin-bottom: 6px; }
  .opt-row:last-child{ margin-bottom:0; }
  input[type="radio"], input[type="checkbox"]{
    width: 16px; height: 16px;
    accent-color: var(--accent);
  }

  /* text input */
  .field{ margin-bottom: 14px; }
  .field:last-child{ margin-bottom: 0; }
  .field label{ font-size: 12px; color: var(--ink-soft); display:block; margin-bottom: 5px; font-family: var(--font-mono); }
  .field input[type="text"], .field input[type="email"]{
    width: 100%;
    padding: 9px 11px;
    border: 1px solid var(--line-soft);
    border-radius: 3px;
    font-family: var(--font-body);
    font-size: 14px;
    background: #fff;
    color: var(--ink);
  }
  .field input:focus{ border-color: var(--line); }

  /* tabs */
  .tabs-wrap{ background:#fff; border: 1px solid var(--line-soft); border-radius: 3px; overflow: hidden; }
  .tab-bar{ display:flex; border-bottom: 1px solid var(--line-soft); }
  .tab-btn{
    flex:1; padding: 10px 8px; background: var(--paper);
    border: none; border-right: 1px solid var(--line-soft);
    font-family: var(--font-body); font-size: 13px; color: var(--ink-soft);
    cursor: pointer;
  }
  .tab-btn:last-child{ border-right:none; }
  .tab-btn.active{ background: #fff; color: var(--ink); font-weight: 600; box-shadow: inset 0 -2px 0 var(--accent); }
  .tab-panel{ padding: 16px; font-size: 13.5px; color: var(--ink-soft); display:none; }
  .tab-panel.active{ display:block; }

  /* buttons */
  .btn-row{ display:flex; gap: 10px; flex-wrap: wrap; }
  .btn{
    font-family: var(--font-body);
    font-size: 13.5px;
    font-weight: 500;
    padding: 9px 16px;
    border-radius: 3px;
    border: 1px solid transparent;
    cursor: pointer;
  }
  .btn{ transition: transform .08s ease, box-shadow .08s ease, background .08s ease; }
  .btn{ transition: transform .06s ease, box-shadow .06s ease, background .06s ease; }
  .btn-primary{ background: var(--ink); color: #fff; }
  .btn-secondary{ background: transparent; border-color: var(--line-soft); color: var(--ink); }
  .btn-danger{ background: var(--accent); color: #fff; }
  .btn:active{ transform: translateY(1px) scale(0.97); box-shadow: inset 0 2px 4px rgba(0,0,0,.25); }
  .btn-primary:active{ background: #000; }
  .btn-secondary:active{ background: var(--paper-2); }
  .btn-danger:active{ background: #C6431C; }
  .btn:active{ transform: scale(0.96); box-shadow: inset 0 2px 4px rgba(0,0,0,.35); }
  .btn-primary:active{ background: #2b3140; }
  .btn-secondary:active{ background: var(--paper-2); }
  .btn-danger:active{ background: #c8451e; }
  .btn-status{ font-family: var(--font-mono); font-size: 12px; color: var(--ink-soft); margin-top: 12px; }
  .btn-status b{ color: var(--ink); font-weight: 500; }

  /* labels */
  .label-demo .status-ok{ color: var(--ok); font-size: 13px; }
  .label-demo .status-req{ color: var(--accent); font-size: 13px; }
  .label-demo .plain-label{ font-size: 13px; color: var(--ink-soft); font-family: var(--font-mono); }

  /* link */
  .link-demo a{
    display:block;
    color: var(--line);
    text-decoration: underline;
    text-decoration-color: var(--line-soft);
    text-underline-offset: 3px;
    font-size: 14px;
    margin-bottom: 8px;
  }
  .link-demo a:last-child{ margin-bottom:0; }

  /* tooltip */
  .tooltip-demo{ display:flex; gap: 20px; align-items:center; flex-wrap: wrap; }
  .tip{ position: relative; display:inline-block; cursor: help; }
  .tip .tip-trigger{
    border: 1px solid var(--line-soft); border-radius: 50%;
    width: 22px; height: 22px; display:flex; align-items:center; justify-content:center;
    font-family: var(--font-mono); font-size: 12px; color: var(--ink-soft); background:#fff;
  }
  .tip .tip-bubble{
    position:absolute; bottom: 130%; left: 50%; transform: translateX(-50%);
    background: var(--ink); color:#fff; font-size: 12px; padding: 6px 10px;
    border-radius: 4px; white-space: nowrap; opacity:0; pointer-events:none;
    transition: opacity .12s ease;
  }
  .tip:hover .tip-bubble, .tip:focus-within .tip-bubble{ opacity:1; }
  .tip-underline{ border-bottom: 1px dashed var(--ink-soft); font-size: 14px; }

  /* dropdown */
  select{
    width: 100%;
    padding: 9px 11px;
    border: 1px solid var(--line-soft);
    border-radius: 3px;
    font-family: var(--font-body);
    font-size: 14px;
    background: #fff;
    color: var(--ink);
  }

  /* data grid */
  table.grid{ width:100%; border-collapse: collapse; font-size: 13px; background:#fff; }
  table.grid th, table.grid td{ padding: 8px 10px; border-bottom: 1px solid var(--paper-2); text-align:left; }
  table.grid th{
    font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft);
    cursor:pointer; user-select:none; background: var(--paper);
  }
  table.grid th:hover{ color: var(--ink); }
  table.grid th .arrow{ margin-left:4px; color: var(--accent); }
  .grid-hint{ font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft); margin-top:8px; }

  footer{
    max-width: 900px; margin: 0 auto; padding: 30px 24px 60px;
    font-family: var(--font-mono); font-size: 11px; color: var(--ink-soft);
    border-top: 1px solid var(--line-soft);
  }
</style>
</head>
<body class="sheet-bg">

<header class="titleblock">
  <div class="eyebrow-row"><span class="dot"></span>Лабораторна робота · Компоненти програмної інженерії</div>
  <h1>Каталог базових UI-елементів</h1>
  <p class="lede">Десять інтерфейсних компонентів, які найчастіше зустрічаються у вебзастосунках. Кожен елемент показано у робочому вигляді та описано, яку задачу він вирішує для користувача.</p>
  <div class="meta-table">
    <div><span class="k">Елементів</span><span class="v">10</span></div>
    <div><span class="k">Тип роботи</span><span class="v">UI Controls</span></div>
    <div><span class="k">Формат</span><span class="v">Веб-сторінка</span></div>
  </div>
</header>

<main>

  <!-- 1. Radiobutton -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">01</span>
      <h2>Перемикач</h2>
      <span class="en">Radiobutton</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div>
          <span class="group-label">Спосіб доставки</span>
          <div class="opt-row"><input type="radio" name="delivery" id="d1" checked><label for="d1">Кур'єром</label></div>
          <div class="opt-row"><input type="radio" name="delivery" id="d2"><label for="d2">Поштомат</label></div>
          <div class="opt-row"><input type="radio" name="delivery" id="d3"><label for="d3">Самовивіз</label></div>
        </div>
        <div>
          <span class="group-label">Спосіб оплати</span>
          <div class="opt-row"><input type="radio" name="pay" id="p1"><label for="p1">Картка</label></div>
          <div class="opt-row"><input type="radio" name="pay" id="p2" checked><label for="p2">Готівка</label></div>
        </div>
      </div>
      <div class="desc">
        <p>Дає змогу обрати рівно один варіант із групи взаємовиключних. Вибір нового варіанта автоматично знімає позначку з попереднього.</p>
        <ul>
          <li><b>Коли використовувати:</b> варіанти виключають один одного (стать, тариф, спосіб оплати).</li>
          <li><b>Правило:</b> завжди групувати через спільний <code>name</code>, щоб клік по одній кнопці знімав вибір з інших.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 2. Checkbox -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">02</span>
      <h2>Прапорець</h2>
      <span class="en">Checkbox</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div>
          <span class="group-label">Додаткові опції замовлення</span>
          <div class="opt-row"><input type="checkbox" id="c1" checked><label for="c1">Подарункова упаковка</label></div>
          <div class="opt-row"><input type="checkbox" id="c2"><label for="c2">SMS-сповіщення</label></div>
          <div class="opt-row"><input type="checkbox" id="c3" checked><label for="c3">Отримати чек на пошту</label></div>
        </div>
        <div class="opt-row"><input type="checkbox" id="c4"><label for="c4">Погоджуюсь з умовами використання</label></div>
      </div>
      <div class="desc">
        <p>Дозволяє позначити один чи кілька варіантів незалежно один від одного — на відміну від перемикача, вибір одного не впливає на інші.</p>
        <ul>
          <li><b>Коли використовувати:</b> множинний вибір (інтереси, налаштування) або підтвердження згоди.</li>
          <li><b>Стани:</b> позначено / не позначено, іноді — проміжний стан <i>indeterminate</i> для батьківського чекбоксу.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 3. Text input -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">03</span>
      <h2>Текстове поле</h2>
      <span class="en">Text input</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div class="field">
          <label for="ti1">Ім'я</label>
          <input type="text" id="ti1" placeholder="Введіть ваше ім'я">
        </div>
        <div class="field">
          <label for="ti2">Електронна пошта</label>
          <input type="email" id="ti2" placeholder="name@example.com">
        </div>
        <div class="field">
          <label for="ti3">Пошук</label>
          <input type="text" id="ti3" value="ноутбук 15”">
        </div>
      </div>
      <div class="desc">
        <p>Приймає короткі текстові або числові дані, які вводить користувач — ім'я, e-mail, пошуковий запит тощо.</p>
        <ul>
          <li><b>Коли використовувати:</b> форми, поля пошуку, фільтри з довільним значенням.</li>
          <li><b>Важливо:</b> мати <code>placeholder</code> як підказку та видиму <code>label</code>, а не покладатися лише на нього.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 4. Tabs -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">04</span>
      <h2>Вкладки</h2>
      <span class="en">Tabs</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div class="tabs-wrap">
          <div class="tab-bar">
            <button class="tab-btn active" onclick="showTab(this,'t-desc')">Опис</button>
            <button class="tab-btn" onclick="showTab(this,'t-spec')">Характеристики</button>
            <button class="tab-btn" onclick="showTab(this,'t-rev')">Відгуки</button>
          </div>
          <div id="t-desc" class="tab-panel active">Компактний ноутбук для навчання та повсякденних задач.</div>
          <div id="t-spec" class="tab-panel">RAM: 16 ГБ · SSD: 512 ГБ · Екран: 15.6"</div>
          <div id="t-rev" class="tab-panel">4.6 з 5 · 128 відгуків</div>
        </div>
      </div>
      <div class="desc">
        <p>Об'єднує кілька розділів контенту в одному місці — видно лише активний, решта прихована до кліку на відповідний заголовок.</p>
        <ul>
          <li><b>Коли використовувати:</b> пов'язаний контент, який не потрібен користувачу одразу весь (профіль/налаштування, опис/характеристики).</li>
          <li><b>Перевага:</b> зменшує довжину сторінки без втрати вмісту.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 5. Button -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">05</span>
      <h2>Кнопка</h2>
      <span class="en">Button</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div class="btn-row">
          <button class="btn btn-primary" onclick="setBtnStatus('Зберегти')">Зберегти</button>
          <button class="btn btn-secondary" onclick="setBtnStatus('Скасувати')">Скасувати</button>
          <button class="btn btn-danger" onclick="setBtnStatus('Видалити')">Видалити</button>
        </div>
        <div class="btn-status">Востаннє натиснено: <b id="btnStatus">—</b></div>
      </div>
      <div class="desc">
        <p>Запускає дію одразу після кліку: відправку форми, збереження, перехід у новий режим редагування тощо.</p>
        <ul>
          <li><b>Primary</b> — головна дія на екрані (лише одна на форму).</li>
          <li><b>Secondary</b> — нейтральна дія (скасувати, назад).</li>
          <li><b>Danger</b> — незворотна дія (видалення), тому виділяється кольором.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 6. Text label -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">06</span>
      <h2>Текстова мітка</h2>
      <span class="en">Text label</span>
    </div>
    <div class="panel-body">
      <div class="demo label-demo">
        <span class="plain-label">Email адреса</span>
        <span class="status-req">* Обов'язкове поле</span>
        <span class="status-ok">✓ Дані успішно збережено</span>
      </div>
      <div class="desc">
        <p>Статичний текст, що описує інший елемент інтерфейсу або повідомляє про стан — не приймає взаємодії користувача.</p>
        <ul>
          <li><b>Коли використовувати:</b> підпис до поля, позначення обов'язковості, статус операції.</li>
          <li><b>Навіщо:</b> покращує зрозумілість форми та доступність (screen readers пов'язують мітку з полем).</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 7. Link -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">07</span>
      <h2>Посилання</h2>
      <span class="en">Link</span>
    </div>
    <div class="panel-body">
      <div class="demo link-demo">
        <a href="https://www.wikipedia.org" target="_blank" rel="noopener">Довідка на Wikipedia</a>
        <a href="#" onclick="event.preventDefault()">Політика конфіденційності</a>
        <a href="#top">Повернутися на початок сторінки</a>
      </div>
      <div class="desc">
        <p>Переносить користувача на іншу сторінку, розділ поточної сторінки або зовнішній ресурс після кліку.</p>
        <ul>
          <li><b>Коли використовувати:</b> навігація, а не запуск дії (для дії — кнопка).</li>
          <li><b>Стиль:</b> зазвичай підкреслений та кольоровий, щоб відрізнятись від звичайного тексту.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 8. Tooltip -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">08</span>
      <h2>Спливна підказка</h2>
      <span class="en">Tooltip</span>
    </div>
    <div class="panel-body">
      <div class="demo tooltip-demo">
        <span class="tip" tabindex="0">
          <span class="tip-trigger">?</span>
          <span class="tip-bubble">CVV — 3 цифри на звороті картки</span>
        </span>
        <span class="tip tip-underline" tabindex="0">
          Що таке SKU
          <span class="tip-bubble">Унікальний код товару на складі</span>
        </span>
      </div>
      <div class="desc">
        <p>Показує коротку додаткову інформацію при наведенні курсора або фокусі клавіатурою, не займаючи постійного місця на сторінці.</p>
        <ul>
          <li><b>Коли використовувати:</b> пояснення терміна, іконки без підпису, скороченого тексту.</li>
          <li><b>Важливо:</b> дублювати наведення мишею фокусом з клавіатури для доступності.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 9. Dropdown -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">09</span>
      <h2>Випадаючий список</h2>
      <span class="en">Dropdown list</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <div class="field">
          <label for="dd1">Країна</label>
          <select id="dd1">
            <option>Україна</option>
            <option>Польща</option>
            <option>Німеччина</option>
          </select>
        </div>
        <div class="field">
          <label for="dd2">Сортувати за</label>
          <select id="dd2">
            <option>Ціною ↑</option>
            <option>Ціною ↓</option>
            <option>Рейтингом</option>
          </select>
        </div>
      </div>
      <div class="desc">
        <p>Ховає список варіантів під одним полем — розкривається кліком, обраний варіант підставляється в поле.</p>
        <ul>
          <li><b>Коли використовувати:</b> вибір одного значення з довгого переліку (країна, категорія, сортування).</li>
          <li><b>Перевага:</b> економить місце порівняно з набором radiobutton.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 10. Data grid -->
  <section class="panel">
    <div class="panel-head">
      <span class="idx">10</span>
      <h2>Таблиця даних</h2>
      <span class="en">Data grid</span>
    </div>
    <div class="panel-body">
      <div class="demo">
        <table class="grid" id="dataGrid">
          <thead>
            <tr>
              <th data-key="name">Товар</th>
              <th data-key="price">Ціна</th>
              <th data-key="stock">На складі</th>
            </tr>
          </thead>
          <tbody id="gridBody"></tbody>
        </table>
        <span class="grid-hint">клікніть на заголовок стовпця для сортування</span>
      </div>
      <div class="desc">
        <p>Показує однорідні записи у вигляді рядків і стовпців — зазвичай з можливістю сортування, фільтрації чи редагування прямо в комірках.</p>
        <ul>
          <li><b>Коли використовувати:</b> списки замовлень, звіти, адмін-панелі.</li>
          <li><b>Типові функції:</b> сортування за стовпцем, пагінація, пошук, вибір рядків.</li>
        </ul>
      </div>
    </div>
  </section>

</main>

<footer>Лабораторна робота · Компоненти програмної інженерії · UI Controls</footer>

<script>
  function showTab(btn, panelId){
    var bar = btn.parentElement;
    var wrap = bar.parentElement;
    bar.querySelectorAll('.tab-btn').forEach(function(b){ b.classList.remove('active'); });
    wrap.querySelectorAll('.tab-panel').forEach(function(p){ p.classList.remove('active'); });
    btn.classList.add('active');
    document.getElementById(panelId).classList.add('active');
  }

  var gridData = [
    { name: 'Клавіатура', price: 850, stock: 12 },
    { name: 'Миша', price: 320, stock: 40 },
    { name: 'Монітор 24"', price: 5400, stock: 5 },
    { name: 'Навушники', price: 1200, stock: 18 }
  ];
  var sortState = { key: null, dir: 1 };

  function renderGrid(){
    var body = document.getElementById('gridBody');
    body.innerHTML = '';
    gridData.forEach(function(row){
      var tr = document.createElement('tr');
      tr.innerHTML = '<td>' + row.name + '</td><td>' + row.price + ' ₴</td><td>' + row.stock + '</td>';
      body.appendChild(tr);
    });
    document.querySelectorAll('#dataGrid th').forEach(function(th){
      var arrow = th.querySelector('.arrow');
      if (arrow) arrow.remove();
      if (th.dataset.key === sortState.key){
        var span = document.createElement('span');
        span.className = 'arrow';
        span.textContent = sortState.dir === 1 ? '↑' : '↓';
        th.appendChild(span);
      }
    });
  }

  document.querySelectorAll('#dataGrid th').forEach(function(th){
    th.addEventListener('click', function(){
      var key = th.dataset.key;
      if (sortState.key === key){ sortState.dir *= -1; }
      else { sortState.key = key; sortState.dir = 1; }
      gridData.sort(function(a,b){
        if (a[key] < b[key]) return -1 * sortState.dir;
        if (a[key] > b[key]) return 1 * sortState.dir;
        return 0;
      });
      renderGrid();
    });
  });

  renderGrid();
</script>

</body>
</html>
