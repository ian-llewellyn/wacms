<wacms:if {stage} IS 1>Choose an image to upload (must be a jpg, less than 5 MB):<br />
<form action="?stage=2" method="post" enctype="multipart/form-data" style="text-align: center">
<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
<input type="hidden" name="gallery_id" value="{gallery_id}" />
<input type="file" name="upload" size="16" /><br />
<input type="submit" value="Next &gt;" /></form>
</wacms:if {stage} IS 1>

<wacms:if {stage} IS 2>Please provide a Title:
<form action="?stage=3" method="post">
<!--<div style="float: left"><img src="{cms_dir}assets/thumbnails/{file_name}" /></div>-->
<input type="hidden" name="file_name" value="{file_name}" />
<input type="hidden" name="gallery_id" value="{gallery_id}" />
<input type="text" name="title" /><br />
and Caption: <input type="text" name="caption" /><br />
<input type="submit" value="Finish" />
</form>
</wacms:if {stage} IS 2>

<wacms:if {stage} IS 3>
<wacms:if NOT {error}>The file was successfully uploaded and the gallery will refresh is 1 seconds.
<script type="text/javascript">
setTimeout('top.location.href="{cms_dir}gallery/?id={gallery_id}&image_id={image_id}"',1000);
</script>
</wacms:if NOT {error}>
<wacms:if {error}>There was an error saving information about the file. Errors have been logged for the site administrator.</wacms:if {error}>
</wacms:if {stage} IS 3>