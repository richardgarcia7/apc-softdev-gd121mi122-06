<?php
/**
* @copyright Copyright (C) 2010 Pixel Praise LLC. All rights reserved.
*/
// no direct access
defined('_JEXEC') or die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<?php // Detecting Home
$menu = & JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
$siteHome = 1;
} else {
$siteHome = 0;
}

// Detecting Active Variables
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
$layout = JRequest::getCmd('layout', '');
$task = JRequest::getCmd('task', '');
$itemid = JRequest::getCmd('Itemid', '');
$templateTheme = $this->params->get('templateTheme');
$bgColor = $this->params->get('bgColor');
$fontFamily = $this->params->get('fontFamily');
$switchSidebar = $this->params->get('switchSidebar');
$menuType = $this->params->get('menuType');
$headingFontFamily = "heading-" . $this->params->get('headingFontFamily');
if($this->params->get('siteTitle')){
$siteTitle = $this->params->get('siteTitle');
} else {
$siteTitle = JFactory::getApplication()->getCfg('sitename');
}
// set custom template theme for user
$user = &JFactory::getUser();
if( !is_null( JRequest::getCmd('templateTheme', NULL) ) ) {
$user->setParam($this->template.'_theme', JRequest::getCmd('templateTheme'));
$user->save(true);
}
if($user->getParam($this->template.'_theme')) {
$this->params->set('templateTheme', $user->getParam($this->template.'_theme'));
}
if($task == "edit" || $layout == "form" ) {
$fullWidth = 1;
} else {
$fullWidth = 0;
}
?>
<jdoc:include type="head" />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/<?php echo $this->params->get('templateTheme'); ?>.css" type="text/css" />
<style type="text/css">
<?php if(($this->countModules('left') == 0) && ($this->countModules('right') == 0)) { ?>
#mainbody{width:100%; background:none;} #content{width:100%;}
<?php } ?>
<?php if(($this->countModules('left') >= 1) && ($this->countModules('right') == 0)) { ?>
#mainbody{width:100%;}#content{width:700px;}
<?php } ?>
<?php if(($this->countModules('left') == 0) && ($this->countModules('right') >= 1)) { ?>
#mainbody{background:none;} #content{width:100%;}
<?php } ?>
<?php if($this->params->get('fontColor')){ ?>
body{color:<?php echo $this->params->get('fontColor'); ?>}
<?php } ?>
<?php if($this->params->get('headingColor')){ ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{color:<?php echo $this->params->get('headingColor'); ?>}
<?php } ?>
<?php if($this->params->get('linkColor')){ ?>
a:link, a:active, a:visited{color:<?php echo $this->params->get('linkColor'); ?>}
<?php } ?>
<?php if($this->params->get('linkHoverColor')){ ?>
a:hover{color:<?php echo $this->params->get('linkHoverColor'); ?>}
<?php } ?>
<?php if($fullWidth){ ?>
#mainbody{width:100%; background:none;} #content{width:100%;} #sidebar{display:none;} #sidebar2{display:none;}
<?php } ?>
<?php if($this->params->get('topMenuColor')){ ?>
#topmenu{background-color:<?php echo $this->params->get('topMenuColor'); ?>}
<?php } ?>
<?php if($this->params->get('headerColor')){ ?>
#header{background-color:<?php echo $this->params->get('headerColor'); ?>}
<?php } ?>
<?php if($this->params->get('mainMenuColor')){ ?>
#mainmenu{background-color:<?php echo $this->params->get('mainMenuColor'); ?>}
<?php } ?>
<?php if($this->params->get('bannerColor')){ ?>
#banner{background-color:<?php echo $this->params->get('bannerColor'); ?>}
<?php } ?>
<?php if($this->params->get('pathwayColor')){ ?>
#pathway{background-color:<?php echo $this->params->get('pathwayColor'); ?>}
<?php } ?>
<?php if($this->params->get('insetColor')){ ?>
.inset-container{background-color:<?php echo $this->params->get('insetColor'); ?>}
<?php } ?>
<?php if($this->params->get('posColor')){ ?>
.pos-container{background-color:<?php echo $this->params->get('posColor'); ?>}
<?php } ?>
<?php if($this->params->get('elementsColor')){ ?>
.elements-container{background-color:<?php echo $this->params->get('elementsColor'); ?>}
<?php } ?>
<?php if($this->params->get('searchColor')){ ?>
#search{background-color:<?php echo $this->params->get('searchColor'); ?>}
<?php } ?>
<?php if($this->params->get('footerColor')){ ?>
#footer{background-color:<?php echo $this->params->get('footerColor'); ?>}
<?php } ?>
</style>
</head>
<body class="<?php echo $option . " " . $view . " " . $layout . " " . $task . " " . $itemid . " " . $fontFamily . " " . $headingFontFamily;?>  <?php if($siteHome){ echo "homepage";}?> sidebar-<?php echo $switchSidebar;?>">
<?php if (($this->countModules('user3')) || ($this->countModules('syndicate'))) { ?>
<div id="topmenu">
  <div class="width">
    <div class="inside">
      <?php if ($this->countModules('user3')) { ?>
      <div class="topmenu">
        <jdoc:include type="modules" name="user3" />
      </div>
      <?php } ?>
      <?php if ($this->countModules('syndicate')) { ?>
      <div id="syndicate"> 
        <jdoc:include type="modules" name="syndicate" />
      </div>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<div id="header">
  <div class="width">
    <div class="inside">
      <a href="<?php echo JFactory::getApplication()->getCfg('live_site'); ?>" id="logo" title="<?php echo JFactory::getApplication()->getCfg('sitename'); ?>">
      <h1><?php echo JFactory::getApplication()->getCfg('sitename'); ?></h1>
      </a>
      <?php if ($this->countModules('user5')) { ?>
      <div id="bannerad">
        <jdoc:include type="modules" name="user5" />
      </div>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php if ($this->countModules('user6')) { ?>
<div id="mainmenu">
  <div class="width">
    <div class="inside">
      <jdoc:include type="modules" name="user6" />
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if ($this->countModules('banner')) { ?>
<div id="banner">
  <div class="width">
    <div class="inside">
      <jdoc:include type="modules" name="banner" style="xhtml" />
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if ($this->countModules('breadcrumb')) { ?>
<div id="pathway">
  <div class="width">
    <div class="inside">
      <jdoc:include type="modules" name="breadcrumb" />
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('user7')) || ($this->countModules('user8')) || ($this->countModules('user9')) || ($this->countModules('user10'))) { ?>
<div class="inset-container">
  <div class="width">
    <div class="inside">
      <table class="inset">
        <tr>
          <?php if ($this->countModules('user7')) { ?><td class="inset1"><jdoc:include type="modules" name="user7" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user8')) { ?><td class="inset2"><jdoc:include type="modules" name="user8" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user9')) { ?><td class="inset3"><jdoc:include type="modules" name="user9" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user10')) { ?><td class="inset4"><jdoc:include type="modules" name="user10" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('user11')) || ($this->countModules('user12')) || ($this->countModules('user13'))) { ?>
<div class="pos-container">
  <div class="width">
    <div class="inside">
      <table class="pos">
        <tr>
          <?php if ($this->countModules('user11')) { ?><td class="pos1"><jdoc:include type="modules" name="user11" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user12')) { ?><td class="pos2"><jdoc:include type="modules" name="user12" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user13')) { ?><td class="pos3"><jdoc:include type="modules" name="user13" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('user1')) || ($this->countModules('user2'))) { ?>
<div class="elements-container">
  <div class="width">
    <div class="inside">
      <table class="elements">
        <tr>
          <?php if ($this->countModules('user1')) { ?><td class="elements1"><jdoc:include type="modules" name="user1" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user2')) { ?><td class="elements2"><jdoc:include type="modules" name="user2" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<div id="container">
  <div class="width">
    <div class="inside">
      <div id="mainbody">
        <jdoc:include type="modules" name="top" style="xhtml" />
        <div class="clr"></div>
		<div id="content">
          <jdoc:include type="message" />
          <div class="clr"></div>
          <jdoc:include type="component" />
          <jdoc:include type="modules" name="bottom" style="xhtml" />
          <div class="clr"></div>
        </div>
        <?php if ($this->countModules('left')) { ?>
		<div id="sidebar">
          <jdoc:include type="modules" name="left" style="xhtml" />
          <div class="clr"></div>
        </div>
        <?php } ?>
        <div class="clr"></div>
      </div>
      <?php if ($this->countModules('right')) { ?>
      <div id="sidebar2">
        <jdoc:include type="modules" name="right" style="xhtml" />
        <div class="clr"></div>
      </div>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php if (($this->countModules('user16')) || ($this->countModules('user17'))) { ?>
<div class="elements-container">
  <div class="width">
    <div class="inside">
      <table class="elements">
        <tr>
          <?php if ($this->countModules('user16')) { ?><td class="elements1"><jdoc:include type="modules" name="user16" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user17')) { ?><td class="elements2"><jdoc:include type="modules" name="user17" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('user18')) || ($this->countModules('user19')) || ($this->countModules('user20'))) { ?>
<div class="pos-container">
  <div class="width">
    <div class="inside">
      <table class="pos">
        <tr>
          <?php if ($this->countModules('user18')) { ?><td class="pos1"><jdoc:include type="modules" name="user18" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user19')) { ?><td class="pos2"><jdoc:include type="modules" name="user19" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user20')) { ?><td class="pos3"><jdoc:include type="modules" name="user20" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('user21')) || ($this->countModules('user22')) || ($this->countModules('user23')) || ($this->countModules('user24'))) { ?>
<!-- div class="inset-container" -->
<div id="footer">
  <div class="width">
    <div class="inside">
      <table class="inset">
        <tr>
          <?php if ($this->countModules('user21')) { ?><td class="inset1"><jdoc:include type="modules" name="user21" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user22')) { ?><td class="inset2"><jdoc:include type="modules" name="user22" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user23')) { ?><td class="inset3"><jdoc:include type="modules" name="user23" style="xhtml" /></td><?php } ?>
          <?php if ($this->countModules('user24')) { ?><td class="inset4"><jdoc:include type="modules" name="user24" style="xhtml" /></td><?php } ?>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php } ?>
<?php if ($this->countModules('user4')) { ?>
<div id="search">
  <div class="width">
    <div class="inside">
      <jdoc:include type="modules" name="user4" />
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if (($this->countModules('footer')) || ($this->countModules('user25'))) { ?>
<div id="footer">
  <div class="width">
    <div class="inside">
      <?php if ($this->countModules('footer')) { ?>
      <div id="copy">
        <jdoc:include type="modules" name="footer" />
        <a href="http://www.joomlapraise.com" title="Joomla! Templates and Extensions" target="_blank">Joomla! Templates &amp; Extensions</a> by <a href="http://www.joomlapraise.com" title="Joomla! Templates and Extensions" target="_blank">JoomlaPraise</a> 
		<div class="clr"></div>
      </div>
      <?php } ?>
      <?php if ($this->countModules('user25')) { ?>
      <div id="link">
        <jdoc:include type="modules" name="user25" style="xhtml" />
        <div class="clr"></div>
      </div>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
</div>
<?php } ?>
<?php if ($this->countModules('debug')) { ?>
<div id="debug">
  <div class="width">
    <div class="inside">
      <jdoc:include type="modules" name="debug" style="xhtml" />
    </div>
  </div>
</div>
<?php } ?>
</body>
</html>
