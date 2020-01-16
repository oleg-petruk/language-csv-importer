<div class="wrap">
<h2>Edil all entries</h2>

<div id="center-panel" style="width: 95%; margin: 3px auto 3px auto;">
	 <table class="widefat">
	 
	  <thead>
	    <tr class="table-header">
		 <th>English text</th>
		 <th>French text</th>
		 <th>Arabic text</th>
		 <th>Dublicate</th>
		 <th>Edit</th>
		</tr>
	  </thead>
	  
	  <tbody>
	   <?php if (count($data['all_csv-entries']) > 0): ?>
	   <?php foreach ($data['all_csv-entries'] as $key => $record): ?>
		<tr>
		 <td>  
		     <?php echo $record['english_text'] ?>
		 </td>
		 <td>
             <?php echo $record['french_text'] ?>
		 </td>
		 <td>
		     <?php echo $record['arabic_text'] ?>
		 </td>
		 <td>
		     <?php echo $record['dublicate'] ?>
		 </td>
		 <td>
		  <div><a href="admin.php?page=edit_all_csv_entries&action=edit&id=<?php echo $record['id']; ?>">Edit</a></div>
		  <div><a onclick="return deleteService(); " href="admin.php?page=edit_all_csv_entries&action=delete&id=<?php echo $record['id'];?>">Delete</a></div>
		 </td>
		</tr>
	   <?php endforeach; ?>
	   
	   <?php else:?>
	    <tr>
		 <td colspan="4" style="text-align:center">DB clear</td>
		</tr>
	   <?php endif;?>
	  </tbody>

	 </table> 
</div> <!-- /#center-panel -->
</div>

