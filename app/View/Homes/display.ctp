<div id="main">
    <div class="wrap clear">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <article class="page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="row">
                            <div class="column half">
                                <h2 class="section-title">
                                    <span class="ss-label black"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[0]['Category']['slug']?>" title="Xem toàn bộ bài viết">Thời sự</a></span>
                                </h2>
                                <script type="text/javascript">
                                    jQuery(window).load(function(){
                                        jQuery("#slider-10549").flexslider({
                                            animation: "slide",
                                            easing: "swing",
                                            animationSpeed:600,
                                            slideshowSpeed:4000,
                                            selector: ".slides > .slide",
                                            pauseOnAction: true,
                                            smoothHeight: true,
                                            controlNav: true,
                                            directionNav: true,
                                            useCSS: false,
                                            prevText: "Trước",
                                            nextText: "Sau",
                                            controlsContainer: "#slider-10549-controls",
                                            animationLoop: false,
                                            start: function(slider) {
                                                jQuery(slider).removeClass("flex-loading");
                                            }
                                        });
                                    })
                                </script>
                                <div class="flexslider" id="slider-10549">
                                    <div class="slides" style="width: 800%; margin-left: -960px;">
									<?php
									$num1 = 0;
									foreach($news as $new){
										if($new['News']['category'] == 1){
									?>
										<div class="slide" style="float: left; display: block; width: 320px;">
											<a class="slide-image" href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                            <div class="flex-caption">
                                                <h3><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                                <p class="slide-excerpt"><?php echo $new['News']['desc'];?></p>
                                                <span class="entry-meta">
													<a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time">
														<time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time>
													</a>
													<span class="sep category-sep"> | </span>
													<span class="post-category">
														<a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[0]['Category']['slug']?>" title="Xem tất cả bài viết" rel="tag"><?php echo $new['Category']['category']?></a>
													</span>
												</span>
                                            </div>
                                        </div>
									<?php
											$num1++;
										}
										if($num1 == 7) break;
									}
									?>
                                   </div>
                                </div>
                                <div class="flex-controls-container main-slider" id="slider-10549-controls"></div>
                            </div>
                            <div class="column half last">
                                <h2 class="section-title"><span class="ss-label red"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[2]['Category']['slug']?>" title="Xem toàn bộ bài viết">Thế giới</a></span></h2>
                                <ul class="post-list">
								<?php
								$num2 = 0;
								foreach($news as $new){
									if($new['News']['category'] == 3){
								?>
									<li>
                                        <div class="post-thumb">
                                            <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                        </div>
                                        <div class="post-content ">
                                            <h3><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                            <span class="entry-meta">
                                                <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a>
                                            </span>
                                        </div>
                                    </li>
								<?php
										$num2++;
									}
									if($num2 == 7) break;
								}
								?>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row">
                            <h2 class="section-title"><span class="ss-label"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[1]['Category']['slug']?>" title="Xem toàn bộ bài viết">Kinh doanh</a></span></h2>
                            <ul class="two-col clear">
							<?php
							$num3 = 0;
							foreach($news as $new){
								if($new['News']['category'] == 2){
							?>
								<li class="entry-grid <?php if($num3 % 2 == 0) echo 'first-grid'; else echo 'last-grid';?>">
									<div class="post-thumb">
										<a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
									</div>
                                    <div class="entry-content">
                                        <h3><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                        <p class="post-excerpt"><?php echo $new['News']['desc'];?></p>
                                        <span class="entry-meta"><a href="tin-tuc/<?php echo $new['Category']['slug']?>/?slug=<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a><span class="sep category-sep"> | </span><span class="post-category"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[1]['Category']['slug']?>" title="Xem toàn bộ tin tức" rel="tag"><?php echo $new['Category']['category'];?></a></span></span>
                                    </div>
                                </li>
							<?php
									$num3++;
								}
								if($num3 == 6) break;
							}
							?>
                            </ul>
                        </div>
                        <div class="row">
                            <h2 class="section-title"><span class="ss-label orange">Đời sống</span></h2>
							<?php
							$num4 = 0;
							foreach($news as $new){
								if($new['News']['category'] == 4){
							?>
							<div class="entry-list clear">
                                <div class="entry-list-left">
                                    <div class="entry-thumb">
                                        <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                    </div>
                                </div>
                                <div class="entry-list-right">
                                    <h3><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                    <p class="post-excerpt"><?php echo $new['News']['desc'];?></p>
                                    <span class="entry-meta"><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a><span class="sep category-sep"> | </span><span class="post-category"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[3]['Category']['slug']?>" title="Xem toàn bộ bài viết" rel="tag">Đời sống</a></span></span>
                                </div>
                            </div>
							<?php
									$num4++;
								}
								if($num4 == 4) break;
							}
							?>
                        </div>
                        <div class="row"></div>
                        <a href="<?php echo $this->base;?>/tin-tuc/<?php echo $categories[4]['Category']['slug']?>"><h2 class="section-title"><span class="ss-label aqua">Giải trí</span></h2></a>
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
								$num5 = 0;
								foreach($news as $new){
									if($new['News']['category'] == 5){
								?>
									<div class="slide" style="float: left; display: block; width: 208px;">
                                        <div class="post-thumb">
                                            <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                        </div>
                                        <div class="entry-content">
                                            <h3><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                            <p class="post-excerpt"><?php echo $new['News']['desc'];?></p>
                                            <span class="entry-meta"><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a></span>
                                        </div>
                                    </div>
								<?php
										$num5++;
									}
									if($num5 == 10) break;
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
			<?php
			foreach($categories as $category){
			if($category['Category']['id'] > 5){
			?>
            <aside id="newsplus-popular-posts-2" class="widget newsplus_popular_posts">
                <a href="<?php echo $this->base;?>/tin-tuc/<?php echo $category['Category']['slug']?>"><h3 class="sb-title"><?php echo $category['Category']['category'];?></h3></a>
                <ul class="post-list">
				<?php
				$j = 0;
				foreach($news as $new){
					if($new['News']['category'] == $category['Category']['id']){
				?>
                    <li>
                        <div class="post-thumb">
                            <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                        </div>
                        <div class="post-content">
                            <h4><a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h4>
                            <span class="entry-meta">
                                <a href="tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a>
                            </span>
                        </div>
                    </li>
				<?php
						$j++;
					}
					if($j == 7) break;
				}
				?>
                </ul>
            </aside>
			<?php
			}
			}
			?>
        </div>
    </div>
</div>
