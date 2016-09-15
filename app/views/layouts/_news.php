<?php if (!CONFIG()->enable_news_ticker) return; ?>
<div id="news-ticker" style="display: none">
  <ul>
    <li>Sequenzia @ <a href="https://code.acr.moe/kazari/myimouto">ACR Code</a>! Feel free to modify and fork your own server!!</li>
    <li>NEW! Ultra compact layout! More Content, Less Waste! More updates to colors! Please leave feedback!!</li>
  </ul>

  <a href="#" id="close-news-ticker-link"><?= $this->t('.close') ?></a>
</div>
