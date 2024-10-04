        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

       	 
        	<div class="row">
          		<div class="col-lg">

          			<?php if(validation_errors()) : ?>
          				<div class="alert alert-danger" role="alert">
          					<?= validation_errors(); ?> 
          				</div>

          			<?php endif; ?>

          			<?= $this->session->flashdata('message'); ?>
          			
          			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewMenuModal"> Add New Menu </a>

          			<table class="table table-hover">
						  <thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Title</th>
						      <th scope="col">Menu</th>
						      <th scope="col">Url</th>
						      <th scope="col">Icon</th>
						      <th scope="col">Active</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>

						  	<?php $i = 1; ?>
						  	<?php foreach ($subMenu as $sm) : ?>

						    <tr>
						      <th scope="row">1</th>
						      <td> <?= $sm['title']; ?> </td>
						      <td> <?= $sm['menu']; ?> </td>
						      <td> <?= $sm['url']; ?> </td>
						      <td> <?= $sm['icon']; ?> </td>
						      <td> <?= $sm['is_active']; ?> </td>
						      <td>
						      	<button type="button" class="btn btn-success"><a href="">edit</a></button>
						      	<button type="button" class="btn btn-danger"><a href="">delete</a></button>
						      </td>
						    </tr>

						    <?php $i++; ?>
							<?php endforeach; ?>
						      
						  </tbody>
						</table>

          		</div>
          	</div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- Modal -->

	 

			<!-- Modal -->
			<div class="modal fade" id="NewMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="NewSubMenuModalLabel"> Add new Submenu </h5> 
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <form action="<?= base_url('menu/submenu');?>" method="post">

					      <div class="modal-body">
					        	  <div class="form-group">
								    <input type="text" class="form-control" id="title" placeholder="Submenu tittle" name="title">
								  </div>

								  <div class="form-group">
								  	<select name="menu_id" id="menu_id" class="form-control">
								  		<option value="">Select Menu</option>
								  		<?php foreach($menu as $m) :  ?>
								  		<option value="<?=  $m['id']; ?>"><?= $m['menu']; ?></option>
								  		<?php endforeach; ?>
								  	</select>
								  </div>

								  <div class="form-group">
								    <input type="text" class="form-control" id="url" placeholder="Submenu Url" name="url" checked>
								  </div>

								  <div class="form-group">
								    <input type="text" class="form-control" id="icon" placeholder="Submenu icon" name="icon">
								  </div>

								  <div class="form-group">
								  	<div class="form-check">
								  		<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
								  		<label class="form-check-label" for="is_active">
								  			Active ?
								  		</label>
								  	</div>
								  </div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Add</button>
					      </div>
					    </div>

			    </form>

			  </div>
			</div>
