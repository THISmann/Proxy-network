        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

       	 
        	<div class="row">
          		<div class="col-lg-6">

          			<?= form_error('menu','<div class="alert alert-danger" role="alert">','</div>'); ?>

          			<?= $this->session->flashdata('message'); ?>
          			
          			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#NewMenuModal"> Add New Menu </a>

          			<table class="table table-hover">
						  <thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Menu</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>

						  	<?php $i = 1; ?>
						  	<?php foreach ($menu as $m) : ?>

						    <tr>
						      <th scope="row">1</th>
						      <td> <?= $m['menu']; ?> </td>
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
			        <h5 class="modal-title" id="NewMenuModal"> Add new Menu </h5> 
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <form action="<?= base_url('menu');?>" method="post">

			      <div class="modal-body">
			        	  <div class="form-group">
						    <input type="text" class="form-control" id="menu" placeholder="Menu name" name="menu">
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
