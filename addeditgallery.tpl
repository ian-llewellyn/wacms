<wacms:include header.tpl />
				<div class="mpBox">
					<h2 class="template">Add / Edit Gallery</h2>
					<div class="mpBox_body">
						<form action="?mode=save" method="post">
							<input type="hidden" name="gallery_id" value="{gallery_id}" />
							<div class="column fifteen">Gallery Name:</div>
							<div class="column eightyfive"><input type="text" name="gallery_name" value="{gallery_name}" /></div>
		
							<div class="column fifteen">&nbsp;</div>
							<input type="submit" value="Save" /><input type="reset" />
						</form>
					</div>
				</div>
<wacms:include footer.tpl />