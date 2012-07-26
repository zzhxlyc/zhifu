
	
	function problemEditInit(){
		var province=$('input[name=province]').val();
		var city=$('input[name=city]').val();
		var district=$('input[name=district]').val();

		var cat=$('input[name=cat]').val();
		var subcat=$('input[name=subcat]').val();



		$(".province_city").province_city_county(province,city,district); 

		$( ".datepicker" ).datepicker({
			dateFormat:"yy-mm-dd"

		});

		//cat从初始化
		var cathtml='';
		$.each(catList, function(i, t) {
			cathtml+='<option value="'+t.id+'">'+t.n+'</option>';
		});
		$('select[name=cat]').append(cathtml);	


		//subcat联动处理
		$('select[name=cat]').change(function(){
			$('select[name=subcat]').children().remove();
			var catId=$('select[name=cat]').val();
			var subCatList=catList[catId].c;
			var subCatHtml='';
			$.each(subCatList, function(i, t) {
				subCatHtml+='<option value="'+t.id+'">'+t.name+'</option>';
			});

			$('select[name=subcat]').append(subCatHtml);	

		});
		//默认值
		$('select[name=cat]').val(cat);	
		var oldSubCatHtml='';
		$.each(catList[cat].c, function(i, t) {
			oldSubCatHtml+='<option value="'+t.id+'">'+t.name+'</option>';
		});

		$('select[name=subcat]').append(oldSubCatHtml);	
		$('select[name=subcat]').val(subcat);
		setOldTagId();
		
		
	}
	
	
		
	
	//old_tag赋值
	function setOldTagId(){
		var oldtagId='';
		$('.tag .old').each(function(){
			oldtagId+= $(this).attr('tagid')+',';

		});
		oldtagId=oldtagId.substring(0,oldtagId.length-1);

		$('input[name=old_tag]').val(oldtagId);
	}
	
	function setNewTagId(){
		var newtagId='';
		$('.tag .new').each(function(){
		
			newtagId+= $(this).text()+',';
		

		});
		newtagId=newtagId.substring(0,newtagId.length-1);

		$('input[name=new_tag]').val(newtagId);
		
	};
	
	function addNewTag(newtag){
		
		$('.tag').append('<a href="javascript:;" class="new">'+newtag+'<img src="'+window.IMAGE_HOME+'/delete.png"></a>');
		
		setNewTagId();
		$('.tag .new').click(function(){
			$(this).remove();
			setNewTagId();
		});
	}
	
	Array.prototype.indexOf = function(val) {
	      for (var i = 0; i < this.length; i++) {
	            if (this[i] == val) return i;
	      }
	      return -1;
	};
	
	
	function checkDuplicate(tagname){
		var tagArray=[];
		$('.tag a').each(function(){
			tagArray.push($(this).text());
			
			
		});
		if(tagArray.indexOf(tagname)>=0)
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	
	
	$('#add-tag').click(function(){
		var newtag=$('#new-tag').val();
		if(newtag.length==0)
		{
			alert('不能为空');
		}
		else{
			if(checkDuplicate(newtag)){
				alert('不能重复');
			}
			else{
				$.ajax({
					type: "POST",
					url: window.ROOT_URL+"/ajax/checkword",
					data:{word:newtag},
					success:function(msg){
						if(msg==0)
						{
							addNewTag(newtag);
							
						}
						else{
							alert('含有敏感词 = =');
						}
					}
				});
			
			}
		}
			
	});
	
	
	$('.hot-tag a').click(function(){
		var newtag=$(this).text();
		if(checkDuplicate(newtag)){
			alert('不能重复');
		}
		else{
			addNewTag(newtag);
		}
		
	});
	

	$('.tag .old').click(function(){
		$(this).remove();
		setOldTagId();
	});
	
	

	
	
	
	
	
	
	
	
	

