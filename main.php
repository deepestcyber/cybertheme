<?php
/**
 * DokuWiki Starter Template
 *
 * @link     http://dokuwiki.org/template:ipari
 * @author   Kwangyoung Lee <ipari@leaflette.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();
@require_once(dirname(__FILE__).'/tpl_functions.php');
header('X-UA-Compatible: IE=edge,chrome=1');
$showSidebar = page_findnearest($conf['sidebar']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body id="dokuwiki__top">
    <div id="dokuwiki__site" class="<?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
        <?php html_msgarea() ?>
        <?php tpl_includeFile('header.html') ?>

        <!-- ********** HEADER ********** -->
        <div id="dokuwiki__header">
            <div class="group">
			<h1><?php
				// get logo either out of the template images folder or data/media folder
				$logoSize = array();
				$logo = tpl_getMediaFile(array(':wiki:logo.svg', ':logo.svg', 'images/logo-top.svg'), false, $logoSize);

				// display logo and wiki title in a link to the home page
				tpl_link(
					wl(),
					'<img src="'.$logo.'" '.$logoSize[3].' alt="" />',
					'accesskey="h" title="[H]"'
				);
				?></h1>
                <div class="left">
                </div>
                <div class="right">
                    <button class="btn_search">Search</button>
                    <button class="btn_right" accesskey="m", title="[M]">Edit</button>
                </div>
            </div>
            <div class="search">
                <?php tpl_searchform(); ?>
            </div>
        </div><!-- /header -->

		<!-- ********** topbar ********** -->
		<div class="wrapper" id="topbar_wrapper">
            <?php if ($showSidebar): ?>
            <div id="dokuwiki__topbar"  class="topbar">
                <?php tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                <?php tpl_includeFile('sidebarfooter.html') ?>
			</div><!-- /dokuwiki__topbar -->
            <?php endif; ?>
		</div>
		<hr/>

        <!-- ********** sidebar ********** -->
        <div id="sidebar_wrapper">
            <!-- ********** ASIDE ********** -->

            <div id="dokuwiki__tools" class="sidebar left">
                <!-- PAGE TOOLS -->
                <div id="dokuwiki__pagetools">
                    <h3><?php echo $lang['page_tools'] ?></h3>
                    <ul>
                        <?php white_toolsevent('pagetools', array(
                            'edit'      => tpl_action('edit', 1, 'li', 1, '<span>', '</span>'),
                            'revisions' => tpl_action('revisions', 1, 'li', 1, '<span>', '</span>'),
                            'backlink'  => tpl_action('backlink', 1, 'li', 1, '<span>', '</span>'),
                            'subscribe' => tpl_action('subscribe', 1, 'li', 1, '<span>', '</span>'),
                            'revert'    => tpl_action('revert', 1, 'li', 1, '<span>', '</span>'),
                        )); ?>
                    </ul>
                </div><!-- /dokuwiki__pagetools -->

                <!-- SITE TOOLS -->
                <div id="dokuwiki__sitetools">
                    <h3><?php echo $lang['site_tools'] ?></h3>
                    <ul>
                        <?php white_toolsevent('sitetools', array(
                            'recent'    => tpl_action('recent', 1, 'li', 1, '<span>', '</span>'),
                            'media'     => tpl_action('media', 1, 'li', 1, '<span>', '</span>'),
                            'index'     => tpl_action('index', 1, 'li', 1, '<span>', '</span>'),
                        )); ?>
                    </ul>
                </div><!-- /dokuwiki__sitetools -->

                <!-- USER TOOLS -->
                <?php if ($conf['useacl']): ?>
                <div id="dokuwiki__usertools">
                    <h3><?php echo $lang['user_tools'] ?></h3>
                    <ul>
                        <?php white_toolsevent('usertools', array(
                            'admin'     => tpl_action('admin', 1, 'li', 1, '<span>', '</span>'),
                            'profile'   => tpl_action('profile', 1, 'li', 1, '<span>', '</span>'),
                            'register'  => tpl_action('register', 1, 'li', 1, '<span>', '</span>'),
                            'login'     => tpl_action('login', 1, 'li', 1, '<span>', '</span>'),
                        )); ?>
                    </ul>
                    <?php
                        if (!empty($_SERVER['REMOTE_USER'])) {
                            echo '<div class="user">';
                            tpl_userinfo();
                            echo '</div>';
                        }
                    ?>
                </div><!-- /dokuwiki__usertools -->
                <?php endif ?>
            </div><!-- /dokuwiki__tools -->

            <div id="sidebar_bg">
            </div>

            <div id="to_top">
                <?php tpl_action('top') ?>
            </div>
        </div><!-- /sidebar_wrapper -->

        <div class="wrapper group">
            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="group">
                <?php tpl_flush() ?>
                <?php tpl_includeFile('pageheader.html') ?>

                <!-- BREADCRUMBS -->
                <?php if($conf['breadcrumbs']){ ?>
                    <div class="breadcrumbs"><?php tpl_breadcrumbs($ret='›') ?></div>
                <?php } ?>
                <?php if($conf['youarehere']){ ?>
                    <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                <?php } ?>

                <div class="page group
                <?php if(tpl_getConf('numberedHeading')): ?> numbered_heading<?php endif ?>
                <?php if(tpl_getConf('tocPosition')): ?> toc_<?php echo tpl_getConf('tocPosition') ?><?php endif ?>
                ">
                    <!-- wikipage start -->
                    <?php tpl_content() ?>
                    <!-- wikipage stop -->
                </div>

                <?php tpl_flush() ?>
                <?php tpl_includeFile('pagefooter.html') ?>
            </div></div><!-- /content -->

            <!-- ********** FOOTER ********** -->
			<div id="dokuwiki__footer">
				<div id="ds__footer__logo"><?php
				// get logo either out of the template images folder or data/media folder
				$logoSize = array();
				$logo = tpl_getMediaFile(array(':wiki:logo.svg', ':logo.svg', 'images/logo-bottom.svg'), false, $logoSize);

				// display logo and wiki title in a link to the home page
				echo '<img src="'.$logo.'" '.$logoSize[3].' alt="" />';
				?></div>

                <?php if($INFO['exists']): ?>
                <div class="doc"><?php white_pageinfo() ?></div>
                <?php endif ?>
                <?php tpl_includeFile('sidebarfooter.html') ?>
                <?php tpl_license('badge', false, false) ?>
                <div class="footer">
                <?php tpl_include_page(tpl_getConf('footer'), 1, 1) ?>
                </div>
            </div><!-- /footer -->

            <?php tpl_includeFile('footer.html') ?>
        </div><!-- /wrapper -->

    </div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>
