

function timeChooseEventInit(){
	$('.choose-time span').toggle(function(){
		$(this).addClass('selected');
		
		setDayAvailable();

	},
	function(){
		$(this).removeClass('selected');
		setDayAvailable();
		
	});
	
}



function setDayAvailable(){
	var day0=[],
		day1=[],
		day2=[],
		day3=[],
		day4=[],
		day5=[],
		day6=[];
	$('.choose-time .day0').each(function(){
		if($(this).hasClass('selected'))
		{
			day0.push('1');
		}
		else{
			day0.push('0');
		}
		
	});
	day0=day0.join('-');
	
	$('.choose-time .day1').each(function(){
		if($(this).hasClass('selected'))
		{
			day1.push('1');
		}
		else{
			day1.push('0');
		}
		
	});
	day1=day1.join('-');
	
	$('.choose-time .day2').each(function(){
		if($(this).hasClass('selected'))
		{
			day2.push('1');
		}
		else{
			day2.push('0');
		}
		
	});
	day2=day2.join('-');
	
	$('.choose-time .day3').each(function(){
		if($(this).hasClass('selected'))
		{
			day3.push('1');
		}
		else{
			day3.push('0');
		}
		
	});
	day3=day3.join('-');
	
	$('.choose-time .day4').each(function(){
		if($(this).hasClass('selected'))
		{
			day4.push('1');
		}
		else{
			day4.push('0');
		}
		
	});
	day4=day4.join('-');
	
	$('.choose-time .day5').each(function(){
		if($(this).hasClass('selected'))
		{
			day5.push('1');
		}
		else{
			day5.push('0');
		}
		
	});
	day5=day5.join('-');
	
	$('.choose-time .day6').each(function(){
		if($(this).hasClass('selected'))
		{
			day6.push('1');
		}
		else{
			day6.push('0');
		}
		
	});
	day6=day6.join('-');
	
	var available=day0+' '+day1+' '+day2+' '+day3+' '+day4+' '+day5+' '+day6;
	
	//alert(available);
	$('input[name=available]').val(available);
}




function dateEventInit(){
	$( ".datepicker" ).datepicker({
		dateFormat:"yy-mm-dd"

	});

}
	function provinceEventInit(){
		
		var province=$('input[name=province]').val();
		var city=$('input[name=city]').val();
		var district=$('input[name=district]').val();
		
		$(".province_city").province_city_county(province,city,district); 
	}
	
	
	function catEventInit(){
		var cat=$('input[name=cat]').val();
		var subcat=$('input[name=subcat]').val();
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
		
		
	}
		
		
		
	function tagEventInit(){
		
		setOldTagId();
		
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
	
	
	
	

	
	
	
	
	
	
	
	
	

