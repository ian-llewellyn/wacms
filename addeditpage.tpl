<wacms:include header.tpl />
				<script type="text/javascript" src="{cms_dir}ckeditor/ckeditor.js"></script>
				<div class="mpBox">
					<h2 class="template">Add / Edit Page</h2>
					<div class="mpBox_body">
						<form method="post" action="?mode=save">
							<input type="hidden" name="page_id" value="{page_id}" />
							<div class="column fifteen">Page Title:</div>
							<div class="column eightyfive"><input type="text" size="40" name="page_title" value="{page_title}" /></div>

							<div class="column fifteen">Page URL:</div>
							<div class="column eightyfive">http://www.trimcanoeclub.ie/ <input type="text" size="15" name="page_url" value="{page_url}" /></div>

							<div class="column fifteen">Page Text:</div>
							<div class="column eightyfive"><textarea name="page_text" cols="52" rows="15">{page_text}</textarea></div>

							<input type="hidden" name="allow_html" value="<wacms:if NOT {allow_html} IS 0>1</wacms:if NOT {allow_html} IS 0><wacms:if {allow_html} IS 0>0</wacms:if {allow_html} IS 0>" />
							<input type="hidden" name="published" value="<wacms:if NOT {published} IS 0>1</wacms:if NOT {published} IS 0><wacms:if {published} IS 0>0</wacms:if {published} IS 0>" /><br />

							<a href="#" onClick="this.style.display='none';getElementById('advanced_panel').style.display='inline'">Advanced<br /></a>
							<div id="advanced_panel" style="display: none">
								<div class="column fifteen">Page Lead In:</div>
								<div class="column eightyfive"><textarea cols="52" rows="5" name="page_lead_in">{page_lead_in}</textarea></div>
							</div>

							<div class="column fifteen">&nbsp;</div><input type="submit" value="Save" /><input type="reset" value="Reset" />
						</form>
					</div>
				</div>
				<script type="text/javascript">
				CKEDITOR.replace( 'page_text',
					{
						toolbar : [
							['Save','Preview'],
							['Cut','Copy','Paste','PasteText','PasteFromWord'],
							['Undo','Redo','-','SelectAll','RemoveFormat','-','SpellChecker'],
							['Source'],
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