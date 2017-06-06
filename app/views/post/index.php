<?php $this->provide('title', '/' . str_replace('_', ' ', $this->params()->tags)) ?>
<div id="post-list">
<?php if (current_user()->is_privileged_or_higher()) : ?>
        <?= $this->partial('tag_script') ?>
    <?php endif ?>
  <?php
    if ($this->tag_suggestions) :
      $total = count($this->tag_suggestions);
      $count = 0;
  ?>
    <div class="status-notice">
      <?= $this->t('.maybe_you_meant') ?>: <?= implode(', ', array_map(function($x)use($total, &$count){
          $count++;
          $or = $count == $total && $total > 1 ? 'or ' : '';
          return $or.$this->tag_link($x);
        }, $this->tag_suggestions)) ?> 
    </div>
  <?php
      unset($total, $count);
    endif
  ?>
<center>
  <div class="content">
    <div class="sidebar" style="display: none;">
    <?php if ($this->showing_holds_only) : ?>
      <?php if (!$this->posts->blank()) : ?>
        <div style="margin-bottom: .5em;">
          <?= $this->linkToFunction($this->t('.activate'), "Post.activate_all_posts()") ?>
        </div>
      <?php endif ?>
    <?php else: ?>
      <div id="held-posts" style="display: none; margin-bottom: .5em;"><?= $this->t(['.held_html', 'count' => $this->contentTag('span', '', ['id' => 'held-posts-count'])]) ?> (<a href="#"><?= $this->t('.held_view') ?></a>).</div>
    <?php endif ?>

    <?= $this->partial('blacklists') ?>
  </div>
  <?php if (!current_user()->is_member_or_higher()) : ?>
        <div class="status-notice">You are required to have an account to access sensitive or <a href="/wiki/show?title=restricted_content">restricted content</a>!</div>
    <?php endif ?>
  <?php if ($this->searching_pool) : ?>
        <div class="status-notice">
        <?= $this->t(['.pool_view_html', 'pool' => $this->linkTo($this->h($this->searching_pool->pretty_name()), array('pool#show', 'id' => $this->searching_pool->id))]) ?>
        </div>
    <?php endif ?>

    <?php if (!empty($this->ambiguous_tags)) : ?>
      <div class="status-notice">
        <?= $this->t('.ambiguous') ?>: <?= implode(', ', array_map(function($x){ return $this->linkTo($this->h($x), ['wiki#show', 'title' => $x]); }, $this->ambiguous_tags)) ?>
      </div>
    <?php endif ?>
    <?php if (CONFIG()->can_show_ad('post#index-top', current_user())) : ?>
      <?= $this->partial('horizontal', ['position' => 'top']) ?>
    <?php endif ?>

    <div id="quick-edit" style="display: none;" class="top-corner-float">
      <?= $this->formTag('#update', function(){ ?>
        <?= $this->textAreaTag("post[tags]", "", array('size' => '60x2', 'id' => 'post_tags')) ?>
        <?= $this->submitTag($this->t('buttons.update')) ?>
        <?= $this->tag('input', array('type' => 'button', 'value' => $this->t('buttons.cancel'), 'class' => 'cancel')) ?>
      <h4 style="float: right;"><?= $this->t('.edit_tags') ?></h4>
      <?php }) ?>
    </div>

    <?= $this->partial("hover") ?>
    <?= $this->partial('posts', array('posts' => $this->posts)) ?>

    <div id="paginator">
      <?= $this->willPaginate($this->posts) ?>
    </div>
    
    <?php if (CONFIG()->can_show_ad('post#index-bottom', current_user())) : ?>
      <?= $this->partial('horizontal', ['position' => 'bottom', 'center' => true]) ?>
    <?php endif ?>
  </div>
  </center>
</div>

<?= $this->contentFor('post_cookie_javascripts', function() { ?>
<script type="text/javascript">
  post_quick_edit = new PostQuickEdit($("quick-edit"));

  PostModeMenu.init(<?= $this->searching_pool && $this->searching_pool->id ?>)
  <?php foreach ($this->preload as $post) : ?>
  Preload.preload('<?= $post->preview_url() ?>');
  <?php endforeach ?>

  var held_posts = Cookie.get("held_post_count");
  if(held_posts && held_posts > 0)
  {
    var e = $("held-posts");
    if(e)
    {
      var a = e.down("A");
      var cnt = e.down("#held-posts-count");
      cnt.update("" + held_posts + " " + (held_posts == 1? "post":"posts"));
      a.href = "/post/index?tags=holds%3Aonly%20user%3A" + Cookie.get("login") + "%20limit%3A100"
      e.show();
    }
  }
  Post.cache_sample_urls();
  <?= $this->tag_completion_box('$("post_tags")') ?>
  if($("tag-script")) {<?= $this->tag_completion_box('$("tag-script")') ?>}
</script>
<?php }) ?>

<?= $this->contentFor('html_header', function() { ?>
  <?= $this->auto_discovery_link_tag_with_id('rss', array('post#piclens', 'tags' => $this->params()->tags, 'page' => $this->params()->page), array('id' => 'pl')) ?> 
  <?= $this->navigation_links($this->posts) ?> 
<?php }) ?>

<?= $this->partial('footer') ?>

<?php if ($this->contentFor('subnavbar')) : ?>
  <!-- Align the links to the content, not the window. -->
  <div style="clear: both;">
    <div class="footer" style="clear: none;">
      <ul class="flat-list" id="subnavbar">
        <?= $this->content('subnavbar') ?>
      </ul>
    </div>
  </div>
  <?php $this->clear_content_for('subnavbar') ?>
<?php endif ?>
