/**
 * jQuery :  省市县联动插件
 * @author   kxt
 * @example  $("#test").province_city_county();
 */
$.fn.province_city_county = function(vprovince,vcity,vtown){

	
	var _self = this;
	//定义3个默认值
	_self.data("province",["请选择", ""]);
	_self.data("city",["请选择", ""]);
	_self.data("county",["请选择", ""]);
	//插入3个空的下拉框
	//_self.append("<select id='province' name='province'></select>");
	//_self.append("<select id='city' name='city'></select>");
	//_self.append("<select id='county' name='county'></select>");
	
	
    _self.html('<select name="province" id="province"></select><span id="province_error" class="error"></span> <select name="city" id="city" ></select><span id="city_error" class="error"></span><select name="district" id="county"></select><span id="district_error" class="error"></span>');
	//分别获取3个下拉框
	var $sel1 = _self.find("select").eq(0);
	var $sel2 = _self.find("select").eq(1);
	var $sel3 = _self.find("select").eq(2);
	//默认省级下拉
	if(_self.data("province")){
		$sel1.append("<option value='"+_self.data("province")[1]+"'>"+_self.data("province")[0]+"</option>");
	}
	$.get(window.ROOT_URL+'/js/province_city.xml', function(data){
        var arrList = [];
		$(data).find('province').each(function(){
			var $province = $(this);
			$sel1.append("<option value='"+$province.attr('value')+"'>"+$province.attr('value')+"</option>");
		});
        if(typeof vprovince != undefined){
            
			setTimeout(function() { $sel1.val(vprovince);	 $sel1.change();}, 1);
			
			
           
        }

	});
	//默认城市下拉
	if(_self.data("city")){
		$sel2.append("<option value='"+_self.data("city")[1]+"'>"+_self.data("city")[0]+"</option>");
	}
	//默认县区下拉
	if(_self.data("county")){
		$sel3.append("<option value='"+_self.data("county")[1]+"'>"+_self.data("county")[0]+"</option>");
	}
	//省级联动控制
	var index1 = "" ;
	var provinceValue = "";
	var cityValue = "";
	$sel1.change(function(){
		//清空其它2个下拉框
		$sel2[0].options.length=0;
		$sel3[0].options.length=0;
		index1 = this.selectedIndex;
		if(index1 == 0){	//当选择的为 “请选择” 时
			if(_self.data("city")){
				$sel2.append("<option value='"+_self.data("city")[1]+"'>"+_self.data("city")[0]+"</option>");
			}
			if(_self.data("county")){
				$sel3.append("<option value='"+_self.data("county")[1]+"'>"+_self.data("county")[0]+"</option>");
			}
		} else{
			provinceValue = $('#province').val();
			$.get(window.ROOT_URL+'/js/province_city.xml', function(data){
				$(data).find('province[value="'+provinceValue+'"] > city').each(function(){
					var $city = $(this);
					$sel2.append("<option value='"+$city.attr('value')+"'>"+$city.attr('value')+"</option>");
				});
				cityValue = $("#city").val();
				$(data).find('city[value="'+cityValue+'"] > county').each(function(){
					var $county = $(this);
					$sel3.append("<option value='"+$county.attr('value')+"'>"+$county.attr('value')+"</option>");
				});

                if(typeof vcity != undefined){
					setTimeout(function() { $sel2.val(vcity);	 $sel2.change();}, 1);
                    //$sel2.val(vcity);
				
                    //$sel2.change();
                }

                if(typeof vtown != undefined){
					setTimeout(function() {  $sel3.val(vtown);}, 1);
                    //$sel3.val(vtown);
                }
			});
		}
	}).change();
	//城市联动控制
	var index2 = "" ;
	$sel2.change(function(){
		$sel3[0].options.length=0;
		var cityValue2 = $('#city').val();
		$.get(window.ROOT_URL+'/js/province_city.xml', function(data){
			$(data).find('city[value="'+cityValue2+'"] > county').each(function(){
				var $county = $(this);
				$sel3.append("<option value='"+$county.attr('value')+"'>"+$county.attr('value')+"</option>");
			});
            if(typeof vtown != undefined){
                    //$sel3.val(vtown);
					setTimeout(function() {  $sel3.val(vtown);}, 1);
            }
		});
	});
	return _self;
};