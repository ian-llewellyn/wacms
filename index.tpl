<wacms:include header.tpl />
				<div class="column onethird">
<wacms:start welcome>					<div class="mpBox">
						<h2 class="template">{page_title}</h2>
						<div class="mpBox_body">
							{page_lead_in}
						</div>
					</div>
</wacms:end welcome>
<wacms:start connect>
					<div id="connect" class="mpBox">
						<h3 class="template">{page_title}</h3>
						<div class="mpBox_body">
							{page_lead_in}
						</div>
						<a href="{cms_dir}{page_url}" class="more">more...</a>
					</div>
</wacms:end connect>
<wacms:start related>
					<div id="activities" class="mpBox">
						<h3 class="template">{page_title}</h3>
						<div class="mpBox_body">
							{page_lead_in}
						</div>
						<a href="{cms_dir}{page_url}" class="more">more...</a>
					</div>
</wacms:end related>
				</div>
				<div class="column onethird">
<wacms:if news>					<div id="news" class="mpBox">
						<h3 class="template"><a href="/news/">Latest News</a></h3>
						<div class="mpBox_body">
<wacms:start news>							<div class="news_item">
								<div class="news_date">{day}<wacms:include dayuru.tpl /> <wacms:include monthconvert.tpl /></div>
								<div class="news_headline"><wacms:if news_id><a href="/news/?id={news_id}">{news_headline}</a></wacms:if news_id><wacms:if NOT news_id>{news_headline}</wacms:if NOT news_id></div>
<wacms:if news_lead_in>								<div class="news_lead_in">{news_lead_in}</div>
</wacms:if news_lead_in><wacms:if news_id>								<div class="news_more"><a href="/news/?id={news_id}">more...</a></div>
</wacms:if news_id>							</div>
</wacms:end news>						</div>
						<a href="/news/" class="more">View all news</a>
					</div>
</wacms:if news><wacms:if recent_photos>
					<div id="photos" class="mpBox">
						<h3 class="template">Recent Photos</h3>
						<div class="mpBox_body">
							<wacms:start recent_photos><a href="/gallery/?id={gallery_id}&image_id={image_order}"><img src="/assets/thumbnails/{file_name}" class="photo_box" alt="{title}" title="{title}"  /></a></wacms:end recent_photos>
						</div>
					</div>
</wacms:if recent_photos>				</div>

				<div class="column onethird">
<wacms:if events>					<div id="events" class="mpBox">
						<h3 class="template"><a href="/events/">Upcoming Events</a></h3>
						<div class="mpBox_body">
<wacms:start events>							<div class="event_item">
								<div class="event_datetime"><div class="month"><wacms:include monthconvert.tpl /></div><div class="day">{day}</div></div>
								<div class="event_title"><wacms:if event_id><a href="/events/?id={event_id}">{event_title}</a></wacms:if event_id><wacms:if NOT event_id>{event_title}</wacms:if NOT event_id></div>
<wacms:if event_lead_in>								<div class="event_lead_in">{event_lead_in}</div>
</wacms:if event_lead_in><wacms:if event_id>								<div class="event_more"><a href="/events/?id={event_id}">more...</a></div>
</wacms:if event_id>							</div>
</wacms:end events>						</div>
						<a href="/events/" class="more">View all events</a>
					</div>
</wacms:if events>
<wacms:start merchandise>					<div id="merchandise" class="mpBox">
						<h3 class="template">{page_title}</h3>
						<div class="mpBox_body">
							{page_lead_in}
						</div>
						<a href="{cms_dir}{page_url}" class="more">more...</a>
					</div>
</wacms:end merchandise>				</div>
<wacms:include footer.tpl />