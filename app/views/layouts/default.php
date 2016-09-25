<!DOCTYPE html>
<html class="action-<?= $this->request()->controller() ?> action-<?= $this->request()->controller() ?>-<?= $this->request()->action() ?> hide-advanced-editing">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <title><?= $this->html_title() ?></title>
  <meta name="description" content="<?= CONFIG()->app_name ?>">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="top" title="<?= CONFIG()->app_name ?>" href="/">
  <?php # The javascript-hide class is used to hide elements (eg. blacklisted posts) from JavaScript. ?>
  <script type="text/javascript">
    var css = ".javascript-hide { display: none !important; }";
    var style = document.createElement("style"); style.type = "text/css";
    if(style.styleSheet) // IE
      style.styleSheet.cssText = css;
    else
      style.appendChild(document.createTextNode(css));
    document.getElementsByTagName("head")[0].appendChild(style);
  </script>

  <?= $this->content('html_header') ?> 
  <?= $this->autoDiscoveryLinkTag('atom', 'post#atom', array('tags' => $this->h($this->params()->tags))) ?> 

  <?php foreach (CONFIG()->asset_stylesheets as $asset) : ?> 
  <?= $this->stylesheetLinkTag($asset) ?>
  <?php endforeach ?>
  <?php foreach (CONFIG()->asset_javascripts as $asset) : ?> 
  <?= $this->javascriptIncludeTag($asset) ?>
  <?php endforeach ?>
  
  <!--[if lt IE 8]>
  <script src="/IE8.js" type="text/javascript"></script>
  <![endif]-->
  <?php // iTODO: echo $this->tag('link', array('rel' => 'search', 'type' => 'Mime':'OPENSEARCH', 'href' => 'opensearch_path'('xml'), 'title' => 'CONFIG'()->app_name) ?>
  <?= CONFIG()->custom_html_headers ?>
  <!--[if lt IE 7]>
    <style type="text/css">
      body div#post-view > div#right-col > div > div#note-container > div.note-body {
        overflow: visible;
      }
    </style>
    <script src="<?= $this->request()->protocol() ?>ie7-js.googlecode.com/svn/trunk/lib/IE7.js" type="text/javascript"></script>
  <![endif]-->
  <?php // echo csrf_meta_tag ?>
</head>
<body>
	<script>
(function() {
  var cookieName = 'disclaimer_accepted';

  if (Cookie.get(cookieName)) {
    return;
  }

  var $      = jQuery;
  var notice = 'WARNING! THIS SITE HAS MIXED CONTENT AND IS NOT SAFE FOR WORK OR PUBLIC!\nThis site contains mixed content and has images containing erotic, grotesque acts, or acts of violence. NO content portrays any real life events or content illegal in the United States of America. This database is well regulated by its moderators and all posts are pending until approval. Please see SERVICE USE POLICY on ACR Docs too other policies that apply to this site.\nContent such as cate2, cate3, guro, loli, rape, and other are NOT accessible to the public or any bot unless you have an account, you must wait for a OPEN ACCESS day to register or view such content.';
  
  notice = notice.replace(/\n/g, "<br />");
  var accept = 'YES, I fully understand what content I will see!';
  var cancel = 'EXIT, Take me to somewhere normal';

  var container = $('<div>')
    .css({
      backgroundColor: 'rgba(66, 0, 0, 0.96)',
      width: '100%',
      height: '100%',
      position: 'absolute',
      left: 0,
      top: 0,
      zIndex: 999,
    });

container
    .append(
      $('<div>')
        .css({
          display: 'flex',
          width: '100%',
          height: '100%',
          justifyContent: 'center',
          alignItems: 'center',
        })
        .append(
          $('<div>')
            .css({
              backgroundColor: '#a90000',
              display: 'flex',
              padding: 8,
              minWidth: 350,
              flexDirection: 'column',
            })
            .append(
              $('<div>')
                .css({
                  margin: 8,
                  color: 'white',
				  
                })
                .html(notice)
            )
            .append(
              $('<div>')
                .css({
                  margin: 8,
                  textAlign: 'right'
                })
                .append(
                  $('<button>')
                    .css({
                      marginRight: 5
                    })
                    .html(accept)
                    .click(function() {
                      Cookie.put(cookieName, true);
                      container.remove();
                    })
                )
                .append(
                  $('<button>')
                    .html(cancel)
                    .click(function() {
                      window.location.href = 'https://plus.google.com/u/1/communities/114928521647105863223';
                    })
                )
            )
        )
    )
    .prependTo(
      $('body')
    )

})();
</script>
  <?= $this->partial('layouts/news') ?>
  <div id="header">
    <div id="title"><h2 id="site-title"><?= $this->linkTo($this->imageTag('images/logo_small.png', array('alt' => CONFIG()->app_name, 'size' => '195x40', 'id' => 'logo')), CONFIG()->url_base) ?><div style="margin-right: 0.0em;">
  <?= $this->formTag('post#index', array('method' => 'get', 'accept-charset' => 'UTF-8'), function(){ ?>
    <div style="margin:0;padding:0;display:inline"></div>
    <div>
	  <?php
		if ($this->request()->controller() == 'posts') : ?>
			<?= $this->textFieldTag("tags", $this->h($this->params()->tags), array('size' => '36', 'autocomplete' => 'off', 'placeholder' => 'Search', 'style' => 'font-size: 20pt; padding: 0 0 1px 4px; margin: 4px 0 0 8px; border-style: dotted; background: #2b0000;')) ?>
		 <?php endif ?>
    </div>
  <?php }) ?>
</div>
<?= $this->tag_completion_box('$("tags")', ['$("tags").up("form")', '$("tags")', null], true) ?> </h2></div>
    <?= $this->partial('layouts/menu') ?>
  </div>
  <?= $this->partial('layouts/login') ?>

  <?php if (CONFIG()->server_host == "yande.re") : ?>
    <div style="display: none;">Danbooru-based image board with a specialization in high-quality images.</div>
  <?php endif ?>

  <!--[if lt IE 7]>
  <div style="display: none;" id="old-browser"><?= $this->t('old_browser') ?>
    <?= $this->t('old_browser2') ?>
    <a href="http://www.mozilla.com/firefox/">Firefox</a>,
    <a href="http://www.opera.com/">Opera</a>,
    <a href="http://www.microsoft.com/windows/internet-explorer/download-ie.aspx">Internet Explorer</a>.
    <div style="text-align: right;" id="old-browser-hide">
      <a href="#" onclick='$("old-browser").hide(); Cookie.put("hide-ie-nag", "1");'><?= $this->t('old_browser3') ?></a>
    </div>
  </div>
  <![endif]-->
  <?= $this->partial('layouts/notice') ?>

  <div class="blocked" id="block-reason" style="display: none;">
  </div>

  <div id="content">
    <?= $this->content() ?>
    <?php if ($this->contentFor('subnavbar')) : ?>
      <div class="footer">
        <?= $this->content('above_footer') ?>
        <ul class="flat-list" id="subnavbar">
          <?= $this->content('subnavbar') ?>
        </ul>
      </div>
    <?php endif ?>
  </div>

  <script type="text/javascript">
    InitTextAreas();
    InitAdvancedEditing();
    Post.InitBrowserLinks();
    if(TagCompletion)
      TagCompletion.init(<?= json_encode(Tag::get_summary_version()) ?>);
  </script>

  <!--[if lt IE 7]>
    <script type="text/javascript">
      if(Cookie.get("hide-ie-nag") != "1")
        $("old-browser").show();
    </script>
  <![endif]-->
  
  <?= $this->content('post_cookie_javascripts') ?>
  <?php if (CONFIG()->ga_tracking_id) echo $this->partial('layouts/ga') ?>
</body>
</html>
