<div id="main">
    <div class="wrap clear">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <article class="page type-page status-publish hentry">
                    <div class="entry-content">
						<div class="row">
                            <h2 class="section-title"><span class="ss-label orange"><?php echo $news[0]['Category']['category'];?></span></h2>
							<?php
							foreach($news as $new){
							?>
							<div class="entry-list clear">
                                <div class="entry-list-left">
                                    <div class="entry-thumb">
                                        <a href="<?php echo $this->base;?>/tin-tuc/<?php echo $new['Category']['slug'];?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>" class=""><img src="<?php echo $new['News']['picture'];?>" alt="<?php echo $new['News']['title'];?>" title="<?php echo $new['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                                    </div>
                                </div>
                                <div class="entry-list-right">
                                    <h3><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo $new['News']['title'];?>"><?php echo $new['News']['title'];?></a></h3>
                                    <p class="post-excerpt"><?php echo $new['News']['desc'];?></p>
                                    <span class="entry-meta"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $new['Category']['slug']?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a><span class="sep category-sep"> | </span><span class="post-category"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $new['Category']['slug']?>" title="Xem toàn bộ bài viết" rel="tag"><?php echo $new['Category']['category']?></a></span></span>
                                </div>
                            </div>
							<?php
							}
							?>
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
        </div>
    </div>
</div>
