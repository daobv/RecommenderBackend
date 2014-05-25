<div id="main">
    <div class="wrap clear">
        <div id="primary" class="site-content">
            <div id="content" role="main">
				<h2 class="section-title"><span class="ss-label orange"><?php echo $new['Category']['category'];?></span></h2>
				<article id="post-57" class="post-57 post type-post status-publish format-standard has-post-thumbnail hentry category-lifestyle">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo $new['News']['title'];?></h1>
						<aside id="meta-57" class="entry-meta"><span class="posted-on">Đăng lúc </span><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $new['Category']['slug'];?>/<?php echo $new['News']['slug'];?>" title="<?php echo date("H:i:s A", $new['News']['date']);?>" class="post-time"><time class="entry-date updated" datetime="<?php echo $new['News']['date'];?>"><?php echo date("F j, Y, g:i A", $new['News']['date']);?></time></a>
						</aside>
					</header>
					<div class="entry-content">
						<p><strong><?php echo $new['News']['desc'];?></strong></p>
						<?php echo $new['News']['content'];?>
					</div>
					<footer>
						<div class="txt_tag">Tags</div>
						<?php 
						foreach($tags as $tag){
							echo '<a href="'.$this->base.'/tags/'.$tag['Tags']['slug'].'" class="tag_item">'.$tag['Tags']['tags'].'</a> ';
						}
						?>
					</footer>
				</article>
				<div class="related-posts clear">
				<h3>Bài viết nên đọc</h3>
					<ul class="thumb-style clear">
						<?
						foreach($suggested as $suggest){
						?>
						<li>
							<a class="rp-thumb" href="<?php echo $suggest['News']['slug'];?>" title="<?php echo $suggest['News']['title'];?>"><img src="<?php echo $suggest['News']['picture'];?>" alt="<?php echo $suggest['News']['title'];?>" title="<?php echo $suggest['News']['title'];?>"></a>
							<h4><a href="<?php echo $suggest['News']['slug'];?>" title="<?php echo $suggest['News']['title'];?>"><?php echo $suggest['News']['title'];?></a></h4>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
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
                <h3 class="sb-title">Cùng chuyên mục</h3>
                <ul class="post-list">
				<?php
				foreach($related as $relate){
				?>
                    <li>
                        <div class="post-thumb">
                            <a href="<?php echo $relate['News']['slug'];?>" title="<?php echo $relate['News']['title'];?>" class=""><img src="<?php echo $relate['News']['picture'];?>" alt="<?php echo $relate['News']['title'];?>" title="<?php echo $relate['News']['title'];?>" style="visibility: visible; opacity: 1;"></a>
                        </div>
                        <div class="post-content">
                            <h4><a href="<?php echo $relate['News']['slug'];?>" title="<?php echo $relate['News']['title'];?>"><?php echo $relate['News']['title'];?></a></h4>
                            <span class="entry-meta">
                                <a href="<?php echo $relate['News']['slug'];?>" title="<?php echo date("H:i:s A", $relate['News']['date']);?>" class="post-time"><time class="entry-date" datetime="<?php echo $relate['News']['date'];?>"><?php echo date("F j, Y, g:i A", $relate['News']['date']);?></time></a><span class="sep category-sep"> | </span><span class="post-category"><a href="<?php echo $this->base;?>/tin-tuc/<?php echo $relate['Category']['slug'];?>" title="Xem toàn bộ bài viết" rel="tag"><?php echo $relate['Category']['category'];?></a></span>
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
