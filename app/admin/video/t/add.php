<form action="" method="post" <?php $HTML->file_form_need()?>>
<table>
<tr>
	<td>标题</td>
	<td>
		<input size="100" type="text" name="title" value="<?php echo $video->title?>" />
		<span class="error"><?php echo $errors['title']?></span>
	</td>
</tr>
<tr>
	<td>简介</td>
	<td>
		<textarea cols="90" rows="10" name="desc" class="text"><?php echo $video->desc?></textarea>
		<span class="error"><?php echo $errors['desc']?></span>
	</td>
</tr>
<tr>
	<td>网址</td>
	<td>
		<input size="100" type="text" name="url" value="<?php echo $video->url?>" />
		<span class="error"><?php echo $errors['url']?></span><br>
		优酷的视频直接填写html地址即可，也不用填封面图片
	</td>
</tr>
<tr>
	<td>类别</td>
	<td>
		<select name="parent" >
			<option value="">无</option>
			<?php
			if(is_array($cat_list)){
				cat_list_walk($cat_list, $video->category, 'output_select_cat_option');
			}
			?>
		</select>
		<span class="error"><?php echo $errors['category']?></span>
	</td>
</tr>
<tr>
	<td>封面图</td>
	<td>
		<input size="100" type="text" name="image" value="<?php echo $video->image?>" />
		<span class="error"><?php echo $errors['image']?></span>
	</td>
</tr>
<tr>
	<td>上传图片</td>
	<td>
		<input type="file" name="image2"/>
		<span class="error"><?php echo $errors['image2']?></span>
	</td>
</tr>
<tr><td colspan="2">
<div class="row">
	<label for="tag">领域标签</label>
	<input size="20" type="text" value="" id="new-tag" /> <a href="javascript:;" id="add-tag">添加</a>
</div>	

<div class="tag row">
	<label for="">标签</label>
	<?php 
	if(is_array($tag_list)){
		foreach($tag_list as $tag){
	?>
		<a href="javascript:;" class="old" count="<?php $tag->count?>" tagid="<?php echo $tag->id?>" id="tag_<?php echo $tag->id?>"><?php echo $tag->name?><img src="../../images/delete.png"></a>	
	<?php 
		}
	}
	?>
</div>
<div class="hot-tag row">
	<label for="">热门标签</label>
	<?php 
	if(is_array($most_common_tags)){
		foreach($most_common_tags as $tag){
	?>
		<a href="javascript:;" count="<?php echo $tag['count']?>" tagid="<?php echo $tag['id']?>" id="tag_<?php echo $tag['id']?>"><?php echo $tag['name']?></a>	
	<?php 
		}
	}
	?>
</div>
</td></tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="new_tag" />
		<input type="hidden" name="old_tag" />
		<input type="submit" value="添加" />
		<input type="button" value="返回" onclick="location.href='<?php echo $home?>/index'" />
	</td>
</tr>
</table>
</form>

<script type="text/javascript">
$(document).ready(function($){
	tagEventInit();
});	
</script>