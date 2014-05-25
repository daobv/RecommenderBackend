<div id="main">
<div class="full_w">
    <?php
        $button = "Add";
        $title = "";
        $slug = "";
        $order = "" ;
        if($category){
            $button = "Update";
            $title =  $category['Category']['category'];
            $slug = $category['Category']['slug'];
             $order = $category['Category']['order'];
        }
    ?>
    <div class="h_title"><?php echo $button ?> Category</div>
    <form action="" method="post">
        <div class="element">
            <label for="name">Name </label>
            <input id="name" name="category" value = "<?php echo $title ?>"/>
        </div>
        <div class="element">
             <label for="name">Slug</label>
             <input id="name" name="slug" value = "<?php echo $slug ?>"/>
        </div>
        <div class="element">
               <label for="name">Order</span></label>
               <input id="name" name="order" value = "<?php echo $order ?>"/>
        </div>
        <div class="entry">

            <button type="submit" class="add"><?php echo $button;?></button>

        </div>
    </form>
</div>
</div>