<?php $attributes = array('id' => 'adminForm', 'class' => 'form-inline row'); ?>
<?php echo form_open('admin/table/'.$tableName, $attributes); ?>
	<div class="form-group col-xs-5">
		<label for="per_page">Rows  </label>
		<select name="per_page" id="per_page" class="c-select form-control">
			<option value="10" <?php echo ($per_page == '10') ? 'selected' : ''; ?>>10</option>
			<option value="15" <?php echo ($per_page == '15') ? 'selected' : ''; ?>>15</option>
			<option value="20" <?php echo ($per_page == '20') ? 'selected' : ''; ?>>20</option>
			<option value="25" <?php echo ($per_page == '25') ? 'selected' : ''; ?>>25</option>
			<option value="50" <?php echo ($per_page == '50') ? 'selected' : ''; ?>>50</option>
			<option value="100" <?php echo ($per_page == '100') ? 'selected' : ''; ?>>100</option>
			<option value="all" <?php echo ($per_page == 'all') ? 'selected' : ''; ?>>all</option>
		</select>
	</div>
	<div class="form-group col-xs-3">
		<label for="orderby">Order By  </label>
		<select name="orderby" id="orderby" class="c-select form-control">
				<option value=''></option>
			<?php foreach ($fields as $field) : ?>
				<option value="<?php echo $field; ?>" <?php echo ($orderby == $field) ? 'selected' : ''; ?>><?php echo $field; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group col-xs-2">
		<input type="checkbox" value="ASC" id="asc" name="asc" class="switch" <?php echo ($orderbyoption == 'ASC') ? 'checked' : ''; ?>/>
		<label for="asc">Ascending</label>
	</div>
	<div class="form-group col-xs-2">
		<input type="checkbox" value="DESC" id="desc" name="desc" class="switch" <?php echo ($orderbyoption == 'DESC') ? 'checked' : ''; ?>/>
		<label for="desc">Descending</label>
	</div>
<?php echo form_close(); ?>
<div class="table-responsive">
	<?php echo $this->table->generate($records); ?>
</div>
<ul class="pagination">
	<?php echo $this->pagination->create_links(); ?>
</ul>