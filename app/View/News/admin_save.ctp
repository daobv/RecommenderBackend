<div id="main">
<div class="full_w">
    <?php
            $button = "Add new";
            $title = "";
            $postCategory=1;
            $category = "";
            $slug = "";
            $desc = "" ;
            $picture = "";
            $date = "";
            $content = "";
            if($news){
                $button = "Update";
                $title =  $news['News']['title'];
                $postCategory = $news['News']['category'];
                $slug = $news['News']['slug'];
                $desc = $news['News']['desc'];
                $picture = $news['News']['picture'];
                $date =  $news['News']['date'];
                $content = $news['News']['content'];
                // $order = $category['Category']['order'];
            }

        ?>
    <div class="h_title"><?php echo $button ?> post</div>
    <form action="" method="post">
        <div class="element">
            <label for="name">Post title</label>
            <input id="name" name="title" value = "<?php echo $title; ?>" size = "64"/>
        </div>
        <div class="element">
            <label for="category">Category</label>

            <select name="category">
            <?php foreach($categories as $category):?>
                <option value="<?php echo $category['Category']['id']?>"
                <?php if($category['Category']['id'] == $postCategory) echo "selected"; ?>>
                <?php echo $category['Category']['category']?>
                </option>
             <?php endforeach;; ?>
            </select>
        </div>
        <div class="element">
                    <label for="name">Slug</label>
                    <input id="name" name="slug" value = "<?php echo $slug; ?>" size = "64"/>
         </div>
        <div class="element">
                     <label for="content">Descripton</label>
                     <textarea name="desc" class="textarea" rows="5"><?php echo $desc; ?></textarea>
        </div>
         <div class="element">
                             <label for="content">Content</label>
                             <textarea name="content" class="textarea"  rows="60"><?php echo $content; ?></textarea>
                </div>
        <div class="element">
                            <label for="name">Image</label>
                            <input id="name" name="picture" value = "<?php echo $picture; ?>" size = "100"/>
        </div>
        <div class="entry">
            <button type="submit" class="add"><?php echo $button;?></button>
        </div>
    </form>
</div>
</div>