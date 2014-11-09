<wacms:include header.tpl />
				<script type="text/javascript" src="{cms_dir}ckeditor/ckeditor.js"></script>
				<div class="mpBox">
					<h2 class="template">Add / Edit News Story</h2>
					<div class="mpBox_body">
						<form method="post" action="?mode=save">
							<input type="hidden" name="news_id" value="{news_id}" />
							<input type="hidden" name="published" value="<wacms:if {published} IS 0>0</wacms:if {published} IS 0><wacms:if NOT {published} IS 0>1</wacms:if NOT {published} IS 0>" />

							<div class="column fifteen">Headline:</div>
							<div class="column eightyfive"><input type="text" name="news_headline" size="40" value="{news_headline}" /></div>

							<input type="hidden" name="news_lead_in" value="" />

							<div class="column fifteen">Story:</div>
							<div class="column eightyfive"><textarea name="news_story" cols="52" rows="15">{news_story}</textarea></div>

							<div class="column fifteen">&nbsp;</div>
							<input type="submit" value="Save" /><input type="reset" value="Reset" />
						</form>
					</div>
				</div>
				<script type="text/javascript">
				CKEDITOR.replace( 'news_story',
					{
						toolbar : [
							['Save','Preview'],
							['Cut','Copy','Paste','PasteText','PasteFromWord'],
							['Undo','Redo','-','SelectAll','RemoveFormat','-','SpellChecker'],
							'/',
							['Format','-','Bold','Italic','Underline','Strike','-','TextColor','BGColor','-','Subscript','Superscript'],
							['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
							['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							['Link','Unlink','Anchor'],
							['Image','Flash','HorizontalRule','Smiley']
						],
						uiColor : '#bbc',
						width : '80%'
					});
				</script>
<wacms:include footer.tpl />