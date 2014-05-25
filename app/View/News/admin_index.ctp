<?php $paginator = $this->Paginator;?>
<div class="full_w">
				<h2>Manage post</h2>
				<div class="n_ok"><p><?php echo $this->Session->flash() ?></p>
                </div>
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>

							<th scope="col">Category</th>
							<th scope="col">Title</th>
							<th scope="col">Slug</th>
							<th scope="col">Image</th>
							<th scope="col">Date</th>
							<th scope="col" style="width: 65px;">Modify</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach($news as $post):?>
						<tr>
							<?php $postSingle = $post['News'];?>
							<td class="align-center"><?php echo $post['Category']['category']; ?></td>
                            							<td><?php echo $postSingle['title']; ?></td>
                            							<td><?php echo $postSingle['slug']; ?></td>
                            							<td><img src = "<?php echo $postSingle['picture']; ?>" width = "180px"/></td>
                            							<td><?php echo date('d/m/Y H:i:s',$postSingle['date']); ?></td>

							<td>
								<a href="/admin/news/save/<?php echo $postSingle['id'];?>" class="table-icon edit" title="Edit"></a>
								<a href="" class="table-icon archive" title="Archive"></a>
								<a href="#" class="table-icon delete" title="Delete"></a>
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