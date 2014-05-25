<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Trang thông tin điện tử:
		<?php echo $title_for_layout; ?>
	</title>
	<?php

		echo $this->Html->meta('icon');

		echo $this->Html->css('css');
		echo $this->Html->css('prettyPhoto');
		echo $this->Html->css('responsive');
		echo $this->Html->css('style');
		echo $this->Html->css('user');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-migrate.min');
		echo $this->Html->script('confirm.min');
		echo $this->Html->script('jquery.ui.widget.min');
		echo $this->Html->script('jquery.ui.tabs.min');
		echo $this->Html->script('jquery.ui.core.min');
		echo $this->Html->script('jquery.ui.accordion.min');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('jquery.hoverIntent.minified');
		echo $this->Html->script('jquery.flexslider-min');
		echo $this->Html->script('jquery.easing.min');
		echo $this->Html->script('jquery.cookie.min');
		echo $this->Html->script('jquery.blockUI.min');
		echo $this->Html->script('froogaloop2.min');
		echo $this->Html->script('comment-reply.min');
		echo $this->Html->script('custom');
		echo $this->Html->script('editor');
		echo $this->Html->script('tabs');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body class="home-page home page page-id-319 page-template-default custom-background custom-font-enabled js" style="">
<div id="page" class="hfeed site clear">
	<header id="header" class="site-header" role="banner">
		<div class="wrap clear">
			<div class="brand" role="banner">
				<h1 class="site-title">
					<a href="<?php echo $this->base;?>/index.php" title="Recommender System" rel="home"><span>Recommender</span>System</a><span class="site-description">All purpose Magazine</span>
				</h1>                
			</div>
		</div>
	</header>
	<nav id="main-nav" class="primary-nav" role="navigation">
        <div class="wrap">
            <ul id="menu-menu-1" class="nav-menu clear">
                <li class="menu-item <?php if($title_for_layout == 'Homes'){echo 'current_page_item'; $slug = "";}?>"><a href="<?php echo $this->base;?>/index.php">Trang chủ</a></li>
                <?php
                foreach($categories as $category){
                ?>
                <li class="menu-item <?php if($category['Category']['slug'] == $slug) echo 'current_page_item';?>"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $category['Category']['slug'];?>"><?php echo $category['Category']['category'];?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
	<?php echo $this->fetch('content'); ?>
	<div id="secondary" role="complementary">
		<div class="wrap clear">
			<div class="column one-fourth">
				<aside id="text-4" class="widget widget_text">
					<div class="textwidget">
						<p>NewsPlus is an all purpose WordPress theme designed for online magazine, technology blog, news and editorial ventures. The theme is fully responsive, retina ready, and supports proportional layout scaling. </p>
						<p>Key features include language localization, optimization for SEO and Micro-Formats, RTL support, visual short-codes, custom templates and much more.</p>
					</div>
				</aside>
			</div>
			<div class="column one-fourth">
				<aside id="newsplus-categories-4" class="widget newsplus_categories">
					<ul>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
					</ul>
				</aside>
			</div>
			<div class="column one-fourth">
				<aside id="newsplus-categories-4" class="widget newsplus_categories">
					<ul>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
					</ul>
				</aside>
			</div>
			<div class="column one-fourth last">
				<aside id="newsplus-categories-4" class="widget newsplus_categories">
					<ul>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
						<li class="cat-item">
							<a href="#" title="View all posts filed under Featured">Featured</a>
						</li>
					</ul>
				</aside>
			</div>
		</div>
	</div>
	<footer id="footer" role="contentinfo">
		<div class="wrap clear">
			<div class="notes-left">© 2014 <a href="#">NewsPlus</a>. Your footer notes here.</div>
			<div class="notes-right">Designed by <a href="#">Myself</a>.</div>
		</div>
	</footer>
</div>
<div class="scroll-to-top" style="display: none;"><a href="#" title="Scroll to top"></a></div>
<script type="text/javascript">
	var ss_custom = {"enable_responsive_menu":"1"};
</script>
</body>
</html>
