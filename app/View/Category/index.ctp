<div id="main">
    <div class="wrap clear">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <article class="page type-page status-publish hentry">
                    <div class="entry-content">
						<div class="row">
                            <h2 class="section-title"><span class="ss-label orange"><?php echo $news[0]['Category']['category'];?></span></h2>
							<?php
							for($i = 0; $i < 10; $i++){
							?>
							<div class="entry-list clear">
                                <div class="entry-list-left">
                                    <div class="entry-thumb">
                                        <a href="<?php echo $news[$i]['Category']['slug'];?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>" class=""><img src="<?php echo $news[$i]['News']['picture'];?>" alt="<?php echo $news[$i]['News']['title'];?>" title="<?php echo $news[$i]['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                    </div>
                                </div>
                                <div class="entry-list-right">
                                    <h3><a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>"><?php echo $news[$i]['News']['title'];?></a></h3>
                                    <p class="post-excerpt"><?php echo $news[$i]['News']['desc'];?></p>
                                    <span class="entry-meta"><a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo date("H:i:s A", $news[$i]['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $news[$i]['News']['date'];?>"><?php echo date("F j, Y, g:i A", $news[$i]['News']['date']);?></time></a><span class="sep category-sep"> | </span><span class="post-category"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $news[$i]['Category']['slug']?>" title="Xem toàn bộ bài viết" rel="tag"><?php echo $news[$i]['Category']['category']?></a></span></span>
                                </div>
                            </div>
							<?php
							}
							?>
                        </div>
                        <div class="row"></div>
                        <div class="slider-wrap clear">
                            <script type="text/javascript">
                                jQuery(window).load(function(){
                                    parentWidth = jQuery( "#slider-2505" ).width();
                                    bodyFontSize = jQuery("body").css("font-size");
                                    bodyFontSizeNum = parseFloat ( bodyFontSize );
                                    item_width = Math.floor( ( parentWidth - bodyFontSizeNum * 3 ) / 3 );
                                    item_margin = bodyFontSizeNum * 1.5;
                                    max_items = 3;
                                    if ( parentWidth < 480 ) {
                                        item_width = Math.floor( ( parentWidth - bodyFontSizeNum * 1.5 ) / 2 );
                                        max_items = 2;
                                    }
                                    jQuery("#slider-2505").flexslider({
                                        animation: "slide",
                                        easing:"swing",
                                        animationSpeed:600,
                                        slideshowSpeed:4000,
                                        selector: ".slides > .slide",
                                        useCSS:false,
                                        prevText: "Trước",
                                        nextText: "Sau",
                                        controlsContainer: "#slider-2505-controls",
                                        animationLoop: false,
                                        controlNav: true,
                                        directionNav: true,
                                        itemWidth: item_width,
                                        itemMargin: item_margin,
                                        minItems: 1,
                                        maxItems: max_items,
                                        move: 0,
                                        start: function(slider) {
                                            jQuery(slider).removeClass("flex-loading");
                                        }
                                    });
                                })
                            </script>
                            <div class="flexslider carousel" id="slider-2505">
                                <div class="slides" style="width: 1600%; margin-left: -1130px;">
								<?php
								for($i = 10; $i < 20; $i++){
								?>
									<div class="slide" style="float: left; display: block; width: 208px;">
                                        <div class="post-thumb">
                                            <a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>" class=""><img src="<?php echo $news[$i]['News']['picture'];?>" alt="<?php echo $news[$i]['News']['title'];?>" title="<?php echo $news[$i]['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                        </div>
                                        <div class="entry-content">
                                            <h3><a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>"><?php echo $news[$i]['News']['title'];?></a></h3>
                                            <p class="post-excerpt"><?php echo $news[$i]['News']['desc'];?></p>
                                            <span class="entry-meta"><a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo date("H:i:s A", $news[$i]['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $news[$i]['News']['date'];?>"><?php echo date("F j, Y, g:i A", $news[$i]['News']['date']);?></time></a></span>
                                        </div>
                                    </div>
								<?php
								}
								?>
                                </div>
                            </div>
                            <div class="flex-controls-container" id="slider-2505-controls"></div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div id="sidebar" class="widget-area" role="complementary">
            <aside id="search-2" class="widget widget_search">
                <div class="searchbox">
                    <form role="search" method="get" id="searchform" action="<?php echo $this->base;?>/tim-kiem/bai-viet">
                        <input type="text" value="Tìm bài viết" name="s" id="s" onblur="if(this.value == &#39;&#39;){this.value = &#39;Tìm bài viết&#39;;}" onfocus="if(this.value == &#39;Tìm bài viết&#39;){this.value = &#39;&#39;;}">
                        <input type="submit" id="searchsubmit" value="Tìm">
                    </form>
                </div>
            </aside>
            <aside id="newsplus-popular-posts-2" class="widget newsplus_popular_posts">
                <ul class="post-list">
				<?php
				if(sizeof($news) > 40) $j = 40;
				else $j = sizeof($news);
				for($i = 20; $i < $j; $i++){
				?>
                    <li>
                        <div class="post-thumb">
                            <a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>" class=""><img src="<?php echo $news[$i]['News']['picture'];?>" alt="<?php echo $news[$i]['News']['title'];?>" title="<?php echo $news[$i]['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                        </div>
                        <div class="post-content">
                            <h4><a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo $news[$i]['News']['title'];?>"><?php echo $news[$i]['News']['title'];?></a></h4>
                            <span class="entry-meta">
                                <a href="<?php echo $news[$i]['Category']['slug']?>/<?php echo $news[$i]['News']['slug'];?>" title="<?php echo date("H:i:s A", $news[$i]['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $news[$i]['News']['date'];?>"><?php echo date("F j, Y, g:i A", $news[$i]['News']['date']);?></time></a>
                            </span>
                        </div>
                    </li>
				<?php
				}
				?>
                </ul>
            </aside>
        </div>
    </div>
</div>
