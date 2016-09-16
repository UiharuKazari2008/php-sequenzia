<div style="margin-right: 0.0em;">
  <?= $this->formTag('post#index', array('method' => 'get', 'accept-charset' => 'UTF-8'), function(){ ?>
    <div style="margin:0;padding:0;display:inline"></div>
    <div>
      <?= $this->textFieldTag("tags", $this->h($this->params()->tags), array('size' => '38', 'autocomplete' => 'off', 'style' => 'font-size: 20pt; padding: 1px; margin: 4px 0 0 8px; border-style: none; background: #2b0000;')) ?>
      <?= $this->submitTag($this->t('.search'), array('style' => 'display: none;', 'name' => '')) ?>
    </div>
  <?php }) ?>
</div>
<?= $this->tag_completion_box('$("tags")', ['$("tags").up("form")', '$("tags")', null], true) ?> 
