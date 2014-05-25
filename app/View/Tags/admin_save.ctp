<div id="main">
<div class="full_w">
    <?php
        $button = "Add";
        $tag = "";
        $slug = "";
        $postRelate = "" ;
        if($tags){
            $button = "Update";
            $tag =  $tags['Tags']['tags'];
            $slug = $tags['Tags']['slug'];
            $postRelate = $tags['Tags_meta']['news'];
        }
    ?>
    <div class="h_title"><?php echo $button ?> Category</div>
    <form action="" method="post">
        <div class="element">
            <label for="name">Name </label>
            <input id="name" name="tags" value = "<?php echo $tag ?>"/>
        </div>
        <div class="element">
             <label for="name">Slug</label>
             <input id="name" name="slug" value = "<?php echo $slug ?>"/>
        </div>
        <div class="element">
               <label for="name">Post Relate</span></label>
               <input id="name" name="news" value = "<?php echo $postRelate ?>"/>
        </div>
        <div class="entry">

            <button type="submit" class="add"><?php echo $button;?></button>

        </div>
    </form>
</div>
</div>