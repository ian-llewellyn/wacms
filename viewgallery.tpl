<wacms:include header.tpl />

				<div class="column twothirds">
<wacms:if NOT gallery_images>&nbsp;</wacms:if NOT gallery_images>
<wacms:if gallery_images>
					<div class="mpBox" style="text-align: center">
						<h2 class="template">{title}</h2>
						<img src="{cms_dir}assets/{file_name}" alt="{title}" title="{caption}" style="max-width:100%" />
						<div class="mpBox_body">
							<!-- Previous Image -->
<!--							<input type="button" value="&lt; Prev" style="float: left" />-->
							<!-- Next Image -->
<!--							<input type="button" value="Next &gt;" style="float: right" />-->
							{caption}
						</div>
					</div>
<wacms:if logged_in>
					<div class="mpBox">
						<h3 class="template">Edit Image</h3>
						<div class="mpBox_body">
							<!-- Update Image Details -->
							<form action="?mode=save" method="post"><input type="hidden" name="file_name" value="{file_name}" />
								<input type="hidden" name="image_order" value="{image_order}" />
								<input type="hidden" name="gallery_id" value="{gallery_id}" />
								<div class="column onethird">New Title:</div>
								<div class="column twothirds"><input type="text" size="35" name="title" value="{title}" /></div>
	
								<div class="column onethird">New Caption:</div>
								<div class="column twothirds"><input type="text" size="35" name="caption" value="{caption}" /></div>
	
								<div class="column onethird">&nbsp;</div>
								<div class="column twothirds"><input type="submit" value="Update Details" /><input type="reset" /></div>
							</form>
	
							<!-- Move Down
							<form action="?mode=save" method="post"><input type="hidden" name="file_name" value="{file_name}" />
								<input type="hidden" name="move" value="down" />
								<input type="hidden" name="image_order" value="{image_order}" />
								<input type="hidden" name="gallery_id" value="{gallery_id}" />
								<input type="hidden" name="title" value="{title}" />
								<input type="hidden" name="caption" value="{caption}" />
								<div class="column onethird">&nbsp;</div>
								<div class="column twothirds"><input type="button" value="Move Up" onClick="alert(this.parent.action)" /><input type="submit" value="Move Down" onClick="alert(this.value)" /></div>
							</form>-->

							<!-- Delete this image -->
							<form action="?mode=delete" method="post"><input type="hidden" name="file_name" value="{file_name}" />
								<input type="hidden" name="image_order" value="{image_order}" />
								<input type="hidden" name="gallery_id" value="{gallery_id}" />
								<input type="hidden" name="title" value="{title}" />
								<input type="hidden" name="caption" value="{caption}" />
								<div class="column onethird">&nbsp;</div>
								<input type="submit" value="Delete this image" />
							</form>
						</div>
					</div>
</wacms:if logged_in>
</wacms:if gallery_images>
				</div>
				<div class="column onethird">
<wacms:if gallery_images>
					<div class="mpBox">
						<h3 class="template">Gallery Photos</h3>
						<wacms:start gallery_images><a href="?id={gallery_id}&image_id={image_order}"><img src="{cms_dir}assets/thumbnails/{file_name}" style="margin: 0.3em; width: 5em;" alt="{title}" title="{title}" /></a></wacms:end gallery_images>
					</div>
</wacms:if gallery_images><wacms:if logged_in>
					<div class="mpBox">
						<h3 class="template">Upload Photo</h3>
						<iframe src="{cms_dir}upload/?gallery_id={gallery_id}" width="100%" frameborder="0">Your browser does not support iframes</iframe>
					</div>
</wacms:if logged_in>
				</div>
<wacms:include footer.tpl />