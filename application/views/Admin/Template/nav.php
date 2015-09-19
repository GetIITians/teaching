		<nav>
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-item">
					<a href="<?php echo site_url().'admin/' ?>" class="nav-link <?php echo ($active == 1) ? 'active' : ''; ?>"><i class="material-icons">home</i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php echo ($active == 2) ? 'active' : ''; ?>" data-toggle="collapse" href="#dbTables" aria-expanded="false" aria-controls="dbTables"><i class="material-icons">list</i></a>
					<div class="collapse <?php echo $collapse ?>" id="dbTables">
						<ul class="nav nav-pills nav-stacked">
							<?php foreach ($tables as $table) : ?>
							<li class="nav-item">
								<a href="<?php echo site_url().'admin/table/'.$table ?>" class="nav-link <?php echo ($this->uri->segment(3) === $table) ? 'active' : '' ; ?>"><?php echo $table; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
