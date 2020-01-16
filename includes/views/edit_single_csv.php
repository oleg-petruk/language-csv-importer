<div class="wrap" id="center-panel">
<h2>Edit entrie</h2>

 <form action="admin.php?page=edit_all_csv_entries&action=submit" method="POST">
  <table class="input-table" style="width:100%; margin:0 auto;">
      <thead>
	    <tr class="table-header">
		 <th>English text</th>
		 <th>French text</th>
		 <th>Arabic text</th>
		</tr>
	  </thead>
   <tr>
    <td>
	    <textarea name="english_text" rows="20" id="english_text"><?php echo $data['single-csv-entries']['english_text'] ?></textarea>
	</td>
    <td>
        <textarea name="french_text" rows="20" id="french_text"><?php echo $data['single-csv-entries']['french_text'] ?></textarea>
	</td>
    <td>
        <textarea name="arabic_text" rows="20" id="arabic_text"><?php echo $data['single-csv-entries']['arabic_text'] ?></textarea>
	</td>
   </tr>
  </table>
  
  <div style="text-align:center">
    <input type="hidden" name="id" value="<?php echo $data['single-csv-entries']['id'] ?>" />
  	<a href="admin.php?page=edit_all_csv_entries">Back</a>
	<input type="submit" class="button" name="send" value="Save" />
  </div>
 </form>
</div> <!-- /#center-panel -->
