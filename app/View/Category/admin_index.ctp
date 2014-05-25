<?php $paginator = $this->Paginator;?>
<div class="full_w">
				<h2>Manage categories</h2>
				<div class="n_ok"><p><?php echo $this->Session->flash() ?></p>
                    </div>
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Category</th>
							<th scope="col">Slug</th>
							<th scope="col">Order</th>
							<th scope="col" style="width: 65px;">Modify</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach($categories as $category):?>
						<tr>
							<?php $categoryArray = $category['Category'];?>
							<td class="align-center"><?php echo $categoryArray['id']; ?></td>
                            							<td><?php echo $categoryArray['category']; ?></td>
                            							<td><?php echo $categoryArray['slug']; ?></td>
                            							<td><?php echo $categoryArray['order']; ?></td>

							<td>
								<a href="/admin/category/save/<?php  echo $categoryArray['id']?>" class="table-icon edit" title="Edit"></a>
								<a href="" class="table-icon archive" title="Archive"></a>
								<a href="" cat-id= "<?php  echo $categoryArray['id']?>" class="table-icon-delete" title="Delete"></a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>

				<div class="entry">
					<div class="pagination">
					<?php

                                // the 'first' page button
                                echo $paginator->first("First");

                                // 'prev' page button,
                                // we can check using the paginator hasPrev() method if there's a previous page
                                // save with the 'next' page button
                                if($paginator->hasPrev()){
                                    echo $paginator->prev("Prev");
                                }

                                // the 'number' page buttons
                                echo $paginator->numbers(array('modulus' => 2));

                                // for the 'next' button
                                if($paginator->hasNext()){
                                    echo $paginator->next("Next");
                                }

                                // the 'last' page button
                                echo $paginator->last("Last");
                            ?>
					</div>
					<div class="sep"></div>
					<a class="button add" href="save">Add new category</a>
			</div>
			<script type = "text/javascript">
			    $(function(){
                    $('.table-icon-delete').click(function(){
                        var id = $(this).attr('cat-id');

                        if(confirm ("Are you sure you want to delete from the database?")){

                            $.ajax({
                                type: "POST",
                                url: '/category/index',
                                 data: "id="+id,
                                success: function(){
                                     alert(id);
                                }
                            });

                        }
                     });
                });
			</script>