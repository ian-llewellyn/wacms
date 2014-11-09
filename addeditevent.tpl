<wacms:include header.tpl />
				<script type="text/javascript" src="{cms_dir}ckeditor/ckeditor.js"></script>
				<div class="mpBox">
					<h2 class="template">Add / Edit Event</2>
					<div class="mpBox_body">
						<form method="post" action="?mode=save">
							<input type="hidden" name="event_id" value="{event_id}" />
							<div class="column fifteen">Event title:</div>
							<div class="column eightyfive"><input type="text" size="40" name="event_title" value="{event_title}" /></div>
							
							<div class="column fifteen">Event Date:</div>
							<div class="column eightyfive"><select name="event_day">
								<option<wacms:if {event_day} IS 01> selected="selected"</wacms:if {event_day} IS 01>>01</option>
								<option<wacms:if {event_day} IS 02> selected="selected"</wacms:if {event_day} IS 02>>02</option>
								<option<wacms:if {event_day} IS 03> selected="selected"</wacms:if {event_day} IS 03>>03</option>
								<option<wacms:if {event_day} IS 04> selected="selected"</wacms:if {event_day} IS 04>>04</option>
								<option<wacms:if {event_day} IS 05> selected="selected"</wacms:if {event_day} IS 05>>05</option>
								<option<wacms:if {event_day} IS 06> selected="selected"</wacms:if {event_day} IS 06>>06</option>
								<option<wacms:if {event_day} IS 07> selected="selected"</wacms:if {event_day} IS 07>>07</option>
								<option<wacms:if {event_day} IS 08> selected="selected"</wacms:if {event_day} IS 08>>08</option>
								<option<wacms:if {event_day} IS 09> selected="selected"</wacms:if {event_day} IS 09>>09</option>
								<option<wacms:if {event_day} IS 10> selected="selected"</wacms:if {event_day} IS 10>>10</option>
								<option<wacms:if {event_day} IS 11> selected="selected"</wacms:if {event_day} IS 11>>11</option>
								<option<wacms:if {event_day} IS 12> selected="selected"</wacms:if {event_day} IS 12>>12</option>
								<option<wacms:if {event_day} IS 13> selected="selected"</wacms:if {event_day} IS 13>>13</option>
								<option<wacms:if {event_day} IS 14> selected="selected"</wacms:if {event_day} IS 14>>14</option>
								<option<wacms:if {event_day} IS 15> selected="selected"</wacms:if {event_day} IS 15>>15</option>
								<option<wacms:if {event_day} IS 16> selected="selected"</wacms:if {event_day} IS 16>>16</option>
								<option<wacms:if {event_day} IS 17> selected="selected"</wacms:if {event_day} IS 17>>17</option>
								<option<wacms:if {event_day} IS 18> selected="selected"</wacms:if {event_day} IS 18>>18</option>
								<option<wacms:if {event_day} IS 19> selected="selected"</wacms:if {event_day} IS 19>>19</option>
								<option<wacms:if {event_day} IS 20> selected="selected"</wacms:if {event_day} IS 20>>20</option>
								<option<wacms:if {event_day} IS 21> selected="selected"</wacms:if {event_day} IS 21>>21</option>
								<option<wacms:if {event_day} IS 22> selected="selected"</wacms:if {event_day} IS 22>>22</option>
								<option<wacms:if {event_day} IS 23> selected="selected"</wacms:if {event_day} IS 23>>23</option>
								<option<wacms:if {event_day} IS 24> selected="selected"</wacms:if {event_day} IS 24>>24</option>
								<option<wacms:if {event_day} IS 25> selected="selected"</wacms:if {event_day} IS 25>>25</option>
								<option<wacms:if {event_day} IS 26> selected="selected"</wacms:if {event_day} IS 26>>26</option>
								<option<wacms:if {event_day} IS 27> selected="selected"</wacms:if {event_day} IS 27>>27</option>
								<option<wacms:if {event_day} IS 28> selected="selected"</wacms:if {event_day} IS 28>>28</option>
								<option<wacms:if {event_day} IS 29> selected="selected"</wacms:if {event_day} IS 29>>29</option>
								<option<wacms:if {event_day} IS 30> selected="selected"</wacms:if {event_day} IS 30>>30</option>
								<option<wacms:if {event_day} IS 31> selected="selected"</wacms:if {event_day} IS 31>>31</option>
							</select>
							<select name="event_month">
								<option value="01"<wacms:if {event_month} IS 01> selected="selected"</wacms:if {event_month} IS 01>>Jan</option>
								<option value="02"<wacms:if {event_month} IS 02> selected="selected"</wacms:if {event_month} IS 02>>Feb</option>
								<option value="03"<wacms:if {event_month} IS 03> selected="selected"</wacms:if {event_month} IS 03>>Mar</option>
								<option value="04"<wacms:if {event_month} IS 04> selected="selected"</wacms:if {event_month} IS 04>>Apr</option>
								<option value="05"<wacms:if {event_month} IS 05> selected="selected"</wacms:if {event_month} IS 05>>May</option>
								<option value="06"<wacms:if {event_month} IS 06> selected="selected"</wacms:if {event_month} IS 06>>Jun</option>
								<option value="07"<wacms:if {event_month} IS 07> selected="selected"</wacms:if {event_month} IS 07>>Jul</option>
								<option value="08"<wacms:if {event_month} IS 08> selected="selected"</wacms:if {event_month} IS 08>>Aug</option>
								<option value="09"<wacms:if {event_month} IS 09> selected="selected"</wacms:if {event_month} IS 09>>Sep</option>
								<option value="10"<wacms:if {event_month} IS 10> selected="selected"</wacms:if {event_month} IS 10>>Oct</option>
								<option value="11"<wacms:if {event_month} IS 11> selected="selected"</wacms:if {event_month} IS 11>>Nov</option>
								<option value="12"<wacms:if {event_month} IS 12> selected="selected"</wacms:if {event_month} IS 12>>Dec</option>
							</select>
							<select name="event_year">
								<option<wacms:if {event_year} IS 2010> selected="selected"</wacms:if {event_year} IS 2010>>2010</option>
								<option<wacms:if {event_year} IS 2011> selected="selected"</wacms:if {event_year} IS 2011>>2011</option>
								<option<wacms:if {event_year} IS 2012> selected="selected"</wacms:if {event_year} IS 2012>>2012</option>
								<option<wacms:if {event_year} IS 2013> selected="selected"</wacms:if {event_year} IS 2013>>2013</option>
								<option<wacms:if {event_year} IS 2014> selected="selected"</wacms:if {event_year} IS 2014>>2014</option>
								<option<wacms:if {event_year} IS 2015> selected="selected"</wacms:if {event_year} IS 2015>>2015</option>
								<option<wacms:if {event_year} IS 2016> selected="selected"</wacms:if {event_year} IS 2016>>2016</option>
								<option<wacms:if {event_year} IS 2017> selected="selected"</wacms:if {event_year} IS 2017>>2017</option>
								<option<wacms:if {event_year} IS 2018> selected="selected"</wacms:if {event_year} IS 2018>>2018</option>
								<option<wacms:if {event_year} IS 2019> selected="selected"</wacms:if {event_year} IS 2019>>2019</option>
							</select>
							Time: <select name="event_hour">
								<option<wacms:if {event_hour} IS 00> selected="selected"</wacms:if {event_hour} IS 00>>00</option>
								<option<wacms:if {event_hour} IS 01> selected="selected"</wacms:if {event_hour} IS 01>>01</option>
								<option<wacms:if {event_hour} IS 02> selected="selected"</wacms:if {event_hour} IS 02>>02</option>
								<option<wacms:if {event_hour} IS 03> selected="selected"</wacms:if {event_hour} IS 03>>03</option>
								<option<wacms:if {event_hour} IS 04> selected="selected"</wacms:if {event_hour} IS 04>>04</option>
								<option<wacms:if {event_hour} IS 05> selected="selected"</wacms:if {event_hour} IS 05>>05</option>
								<option<wacms:if {event_hour} IS 06> selected="selected"</wacms:if {event_hour} IS 06>>06</option>
								<option<wacms:if {event_hour} IS 07> selected="selected"</wacms:if {event_hour} IS 07>>07</option>
								<option<wacms:if {event_hour} IS 08> selected="selected"</wacms:if {event_hour} IS 08>>08</option>
								<option<wacms:if {event_hour} IS 09> selected="selected"</wacms:if {event_hour} IS 09>>09</option>
								<option<wacms:if {event_hour} IS 10> selected="selected"</wacms:if {event_hour} IS 10>>10</option>
								<option<wacms:if {event_hour} IS 11> selected="selected"</wacms:if {event_hour} IS 11>>11</option>
								<option<wacms:if {event_hour} IS 12> selected="selected"</wacms:if {event_hour} IS 12><wacms:if NOT {event_hour}> selected="selected"</wacms:if NOT {event_hour}>>12</option>
								<option<wacms:if {event_hour} IS 13> selected="selected"</wacms:if {event_hour} IS 13>>13</option>
								<option<wacms:if {event_hour} IS 14> selected="selected"</wacms:if {event_hour} IS 14>>14</option>
								<option<wacms:if {event_hour} IS 15> selected="selected"</wacms:if {event_hour} IS 15>>15</option>
								<option<wacms:if {event_hour} IS 16> selected="selected"</wacms:if {event_hour} IS 16>>16</option>
								<option<wacms:if {event_hour} IS 17> selected="selected"</wacms:if {event_hour} IS 17>>17</option>
								<option<wacms:if {event_hour} IS 18> selected="selected"</wacms:if {event_hour} IS 18>>18</option>
								<option<wacms:if {event_hour} IS 19> selected="selected"</wacms:if {event_hour} IS 19>>19</option>
								<option<wacms:if {event_hour} IS 20> selected="selected"</wacms:if {event_hour} IS 20>>20</option>
								<option<wacms:if {event_hour} IS 21> selected="selected"</wacms:if {event_hour} IS 21>>21</option>
								<option<wacms:if {event_hour} IS 22> selected="selected"</wacms:if {event_hour} IS 22>>22</option>
								<option<wacms:if {event_hour} IS 23> selected="selected"</wacms:if {event_hour} IS 23>>23</option>
							</select>
							<select name="event_minute">
								<option<wacms:if {event_minute} IS 00> selected="selected"</wacms:if {event_minute} IS 00>>00</option>
								<option<wacms:if {event_minute} IS 15> selected="selected"</wacms:if {event_minute} IS 15>>15</option>
								<option<wacms:if {event_minute} IS 30> selected="selected"</wacms:if {event_minute} IS 30>>30</option>
								<option<wacms:if {event_minute} IS 45> selected="selected"</wacms:if {event_minute} IS 45>>45</option>
								<option disabled>--</option>
								<option>00</option>
								<option<wacms:if {event_minute} IS 01> selected="selected"</wacms:if {event_minute} IS 01>>01</option>
								<option<wacms:if {event_minute} IS 02> selected="selected"</wacms:if {event_minute} IS 02>>02</option>
								<option<wacms:if {event_minute} IS 03> selected="selected"</wacms:if {event_minute} IS 03>>03</option>
								<option<wacms:if {event_minute} IS 04> selected="selected"</wacms:if {event_minute} IS 04>>04</option>
								<option<wacms:if {event_minute} IS 05> selected="selected"</wacms:if {event_minute} IS 05>>05</option>
								<option<wacms:if {event_minute} IS 06> selected="selected"</wacms:if {event_minute} IS 06>>06</option>
								<option<wacms:if {event_minute} IS 07> selected="selected"</wacms:if {event_minute} IS 07>>07</option>
								<option<wacms:if {event_minute} IS 08> selected="selected"</wacms:if {event_minute} IS 08>>08</option>
								<option<wacms:if {event_minute} IS 09> selected="selected"</wacms:if {event_minute} IS 09>>09</option>
								<option<wacms:if {event_minute} IS 10> selected="selected"</wacms:if {event_minute} IS 10>>10</option>
								<option<wacms:if {event_minute} IS 11> selected="selected"</wacms:if {event_minute} IS 11>>11</option>
								<option<wacms:if {event_minute} IS 12> selected="selected"</wacms:if {event_minute} IS 12>>12</option>
								<option<wacms:if {event_minute} IS 13> selected="selected"</wacms:if {event_minute} IS 13>>13</option>
								<option<wacms:if {event_minute} IS 14> selected="selected"</wacms:if {event_minute} IS 14>>14</option>
								<option>15</option>
								<option<wacms:if {event_minute} IS 16> selected="selected"</wacms:if {event_minute} IS 16>>16</option>
								<option<wacms:if {event_minute} IS 17> selected="selected"</wacms:if {event_minute} IS 17>>17</option>
								<option<wacms:if {event_minute} IS 18> selected="selected"</wacms:if {event_minute} IS 18>>18</option>
								<option<wacms:if {event_minute} IS 19> selected="selected"</wacms:if {event_minute} IS 19>>19</option>
								<option<wacms:if {event_minute} IS 20> selected="selected"</wacms:if {event_minute} IS 20>>20</option>
								<option<wacms:if {event_minute} IS 21> selected="selected"</wacms:if {event_minute} IS 21>>21</option>
								<option<wacms:if {event_minute} IS 22> selected="selected"</wacms:if {event_minute} IS 22>>22</option>
								<option<wacms:if {event_minute} IS 23> selected="selected"</wacms:if {event_minute} IS 23>>23</option>
								<option<wacms:if {event_minute} IS 24> selected="selected"</wacms:if {event_minute} IS 24>>24</option>
								<option<wacms:if {event_minute} IS 25> selected="selected"</wacms:if {event_minute} IS 25>>25</option>
								<option<wacms:if {event_minute} IS 26> selected="selected"</wacms:if {event_minute} IS 26>>26</option>
								<option<wacms:if {event_minute} IS 27> selected="selected"</wacms:if {event_minute} IS 27>>27</option>
								<option<wacms:if {event_minute} IS 28> selected="selected"</wacms:if {event_minute} IS 28>>28</option>
								<option<wacms:if {event_minute} IS 29> selected="selected"</wacms:if {event_minute} IS 29>>29</option>
								<option>30</option>
								<option<wacms:if {event_minute} IS 31> selected="selected"</wacms:if {event_minute} IS 31>>31</option>
								<option<wacms:if {event_minute} IS 32> selected="selected"</wacms:if {event_minute} IS 32>>32</option>
								<option<wacms:if {event_minute} IS 33> selected="selected"</wacms:if {event_minute} IS 33>>33</option>
								<option<wacms:if {event_minute} IS 34> selected="selected"</wacms:if {event_minute} IS 34>>34</option>
								<option<wacms:if {event_minute} IS 35> selected="selected"</wacms:if {event_minute} IS 35>>35</option>
								<option<wacms:if {event_minute} IS 36> selected="selected"</wacms:if {event_minute} IS 36>>36</option>
								<option<wacms:if {event_minute} IS 37> selected="selected"</wacms:if {event_minute} IS 37>>37</option>
								<option<wacms:if {event_minute} IS 38> selected="selected"</wacms:if {event_minute} IS 38>>38</option>
								<option<wacms:if {event_minute} IS 39> selected="selected"</wacms:if {event_minute} IS 39>>39</option>
								<option<wacms:if {event_minute} IS 40> selected="selected"</wacms:if {event_minute} IS 40>>40</option>
								<option<wacms:if {event_minute} IS 41> selected="selected"</wacms:if {event_minute} IS 41>>41</option>
								<option<wacms:if {event_minute} IS 42> selected="selected"</wacms:if {event_minute} IS 42>>42</option>
								<option<wacms:if {event_minute} IS 43> selected="selected"</wacms:if {event_minute} IS 43>>43</option>
								<option<wacms:if {event_minute} IS 44> selected="selected"</wacms:if {event_minute} IS 44>>44</option>
								<option>45</option>
								<option<wacms:if {event_minute} IS 46> selected="selected"</wacms:if {event_minute} IS 46>>46</option>
								<option<wacms:if {event_minute} IS 47> selected="selected"</wacms:if {event_minute} IS 47>>47</option>
								<option<wacms:if {event_minute} IS 48> selected="selected"</wacms:if {event_minute} IS 48>>48</option>
								<option<wacms:if {event_minute} IS 49> selected="selected"</wacms:if {event_minute} IS 49>>49</option>
								<option<wacms:if {event_minute} IS 50> selected="selected"</wacms:if {event_minute} IS 50>>50</option>
								<option<wacms:if {event_minute} IS 51> selected="selected"</wacms:if {event_minute} IS 51>>51</option>
								<option<wacms:if {event_minute} IS 52> selected="selected"</wacms:if {event_minute} IS 52>>52</option>
								<option<wacms:if {event_minute} IS 53> selected="selected"</wacms:if {event_minute} IS 53>>53</option>
								<option<wacms:if {event_minute} IS 54> selected="selected"</wacms:if {event_minute} IS 54>>54</option>
								<option<wacms:if {event_minute} IS 55> selected="selected"</wacms:if {event_minute} IS 55>>55</option>
								<option<wacms:if {event_minute} IS 56> selected="selected"</wacms:if {event_minute} IS 56>>56</option>
								<option<wacms:if {event_minute} IS 57> selected="selected"</wacms:if {event_minute} IS 57>>57</option>
								<option<wacms:if {event_minute} IS 58> selected="selected"</wacms:if {event_minute} IS 58>>58</option>
								<option<wacms:if {event_minute} IS 59> selected="selected"</wacms:if {event_minute} IS 59>>59</option>
							</select></div>
							
							<input type="hidden" name="event_lead_in" value="" />
							
							<div class="column fifteen">Event Description:</div>
							<div class="column eightyfive"><textarea name="event_description" cols="52" rows="15">{event_description}</textarea></div>
							
							<input type="hidden" name="published" value="<wacms:if {published} IS 0>0</wacms:if {published} IS 0><wacms:if NOT {published} IS 0>1</wacms:if NOT {published} IS 0>" />
							<input type="hidden" name="allow_html" value="<wacms:if {allow_html} IS 0>0</wacms:if {allow_html} IS 0><wacms:if NOT {allow_html} IS 0>1</wacms:if NOT {allow_html} IS 0>" />
							
							<div class="column fifteen">&nbsp;</div>
							<input type="submit" value="Save" /><input type="reset" value="Reset" />
						</form>
					</div>
				</div>
				<script type="text/javascript">
				CKEDITOR.replace( 'event_description',
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