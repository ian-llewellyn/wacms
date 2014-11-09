<wacms:include header.tpl />
				<div class="mpBox">
					<h2 class="template">Photo Galleries</h2>
					<div class="mpBox_body">
						<wacms:start galleries><div style="float: left; text-align: center; margin: 1em 3em"><a href="?id={gallery_id}"><img src="/assets/thumbnails/{poster_image}" alt="{gallery_name}" title="{gallery_name}"><br />{gallery_name}</a></div></wacms:end galleries>
						<div style="clear:both"></div>
					</div>
				</div>
<wacms:include footer.tpl />