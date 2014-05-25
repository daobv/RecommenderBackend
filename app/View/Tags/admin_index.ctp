<?php $paginator = $this->Paginator;?>
<div class="full_w">
				<h2>Manage tags</h2>
				<div class="n_ok"><p><?php echo $this->Session->flash() ?></p>
                    </div>
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Tags</th>
							<th scope="col">Slug</th>
							<th scope="col">Post relate</th>
							<th scope="col" style="width: 65px;">Modify</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach($tags as $tag):?>
						<tr>
							<?php $tagArray = $tag['Tags'];?>
							<td class="align-center"><?php echo $tagArray['id']; ?></td>
                            							<td><?php echo $tagArray['tags']; ?></td>
                            							<td><?php echo $tagArray['slug']; ?></td>
                            							<td><?php echo $tag['Tags_meta']['news']; ?></td>

							<td>
								<a href="/admin/tags/save/<?php  echo $tagArray['id']?>" class="table-icon edit" title="Edit"></a>
								<a href="" class="table-icon archive" title="Archive"></a>
								<a href="" cat-id= "<?php  echo $tagArray['id']?>" class="table-icon-delete" title="Delete"></a>
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