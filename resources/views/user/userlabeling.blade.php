<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	 <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
 
<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js">
	</script>
	
	<style type="text/css">
		*{
			margin: auto;
		}
		#container{
			width: 100%;
			height: 500px;
			/*overflow: auto;*/
			/*background-color: #eee;*/
		}
		#left{
			float: left;
			width: 50%;
			height: 100%;
			background-color: #EEEEEE;
			overflow: auto;
			
			/*border-radius: 5%;*/
		}
		/*#mdNP{
			background-color: blue;
			color: red;
		}*/
		#right{
			margin-left: 5px;
			float: left;
			width: 49.5%;
			height: 100%;
			background-color: #EEEEEE; 
			overflow: auto;
			/*border-radius: 5%;*/
		}

		
		#dongvitu1{
			margin: 10px 10px;
			background-color: #66FFCC;
			overflow: auto;
			height: 1.5em;
		}
		.group{
			width: 98%;
			height: 30%;
			/*margin: 15px 15px 5px 15px;*/
			margin: auto;
			margin-top: 15px;
	

			background-color: #008ae6;
		}
		#doanvan{
			width: 98%;
			height: 100%;
			margin-top: 15px;
			background-color: LightGray;
		}
		#demo{
			background-color: green;
		}
		.daitu:hover{
			cursor: hand;
			cursor: pointer;
		}
		.group:hover{cursor: hand;
			cursor: pointer;}
		.dagomnhom{
			background-color: green;
			margin-left: 10px;
			background-color: White;
		}

		.dagomnhom:hover{cursor: hand;
			background-color: red;
			font-size: 20px;
			font:bold;
		}

		/*#modal_id_0{cursor: hand;}*/
		.back{
			background-color: white;
			color: red;
		}
		.daitu{
			/*color: blue;*/
		}
	</style>
</head>
<body>  
	<input type="button" value="Show_File" onclick="showOnDiv('left_p');">
	<input type="button" value="New Group" onclick="createNewGroup()">
	<input class="save_group" type="button" value="Save">
	<input class="finshed_labeling" type="button" value="Finish">
	<input id="btn" type="button" value="Sửa 1 file đã gom nhóm" onclick="sua()">
	<div id="container" class="row">
		<div class="col-md-6"  id ="left">
			<div id="doanvan">
				<p id ="left_p"></p>
			</div>
				<!-- <div id="dongvitu1">Le Minh Duong <div class="glyphicon glyphicon-remove-circle"></div></div> -->
			
		</div>

		<div class="col-md-6" id = "right" name="right">
			<!-- <div id="1" class="group" onclick="selectGroup(this.id)"></div> -->
			<!-- <div id="2" class="group" onclick="selectGroup(this.id)"></div>
			<div id="3" class="group" onclick="selectGroup(this.id)"></div> -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1" id="demo"></div>
	</div>
	@include('user.npview')
	<!-- <button id="btn" >click here</button> -->
</body>
<script>
		//************************************************highlight**************************************************************//

		// **********************cần 1 mảng đại từ (id) , vị trí bắt đầu, kết thúc, mang nội dung đại từ(cacDaiTu) và nội đoạn văn.
		var _words=[];
		var _arrayID=[];
		var _indexStart=[];		
		var _arrDt=[] ;					// mảng lưu nội dung đại từ
		var _arrGroup=[];					// mảng lưu ds gom nhóm đại từ
		var _contentFile;				// nội dung 1 file (kieu String)
		var _idG=-1;                     // id nhóm được chọn
		var _idAuto=0;					// id tự sinh khi tạo mới Group
		var _visitted = [];
		var _maxG=-1;
		var _save=0;
		var _haveChild=[];
		var _indexEnd=[];
		var _isChild =[];
		// var _color=['B2001F','DF0029', 'FF69B4', '9F79EE'];
		

		var belongGroup = [];
		var mark=[];
		function pushEmptyArr(length){
			for (var i = length- 1; i >= 0; i--) {
				var empty = [];
				belongGroup.push(empty);

			}
		}
		function subGroup(start, end){
			pushEmptyArr(start.length);
			for (var i = 0; i <start.length ; i++) {
				for (var j = i+1; j<start.length; j++) {
					if(mark[j]!=1 && start[i]<=start[j] && end[i]>=start[j]){
						belongGroup[i].push(j);
						mark[j]=1;
						_isChild[j]=1;
					}
				}
			}
		}

		function modify(){
			for(var i = 0; i < _arrDt.length;i++){
				_indexStart[i]=parseInt(_indexStart[i]);
				_indexEnd[i]=parseInt(_indexEnd[i]);
			}
		}

		function isChild(){

		}
		function  highlight(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,contentFile,kichthuoc) {
			// _words = contentFile.split(" ");
			var s='';
			for(var i = 0; i<=_indexStart.length-1;i++){
				_words[_indexStart[i]]= '<b title="" data-toggle="" data-target="" style="font-size:'+kichthuoc+'" index='+i+' class="daitu" id='+arrayID[i]+' value='+arrDaiTu[i]+' onclick="clickDaiTu(this.id)">'+_words[_indexStart[i]];
				_words[_indexEnd[i]]+='</b>';
			}
			for(var i =0; i<_words.length;i++){
				s+= _words[i]+" ";
			}
			return s;
		}


		

		//Mang bd trong file, ket thuc trong file, 
		//Mang cac dai
		$(document).ready(function(){
			_contentFile = '{{$data['corpus']}}';	
			_words = <?php echo json_encode($data['list_token']); ?>;
			// alert(_words);
			_arrayID = <?php echo json_encode($data['listNP']); ?>; 
			_indexStart = <?php echo json_encode($data['begin_on_file']) ?>;
			_indexEnd=  <?php echo json_encode($data['end_on_file']) ?>;
			_arrDt=<?php echo json_encode($data['list_content_np']) ?>;
			modify();
			subGroup(_indexStart,_indexEnd);
			// console.log(belongGroup[0]);
		});
		function showOnDiv(idCard){
			if(_save==1){
				alert("Luu lai ket qua lam viec truoc khi tao moi ! "); return false;
			}
			else{
				var s = highlight(_arrayID,_arrDt,_indexStart,_indexEnd,_contentFile,"20px");
				document.getElementById('left_p').innerHTML=s;
				_save=1;
				thongbaoNhom();
	
			}
			
				
			
		}
		function thongbaoNhom(){
			$('.daitu').hover(
					function(){
			        	var indexDT = document.getElementById(this.id).attributes['index'].value;
			        	var tbG = "Nhom : ";
			        	var vG = parseInt(_arrGroup[indexDT])+1;
			        	// tbG+=vG+": "+_haveChild[parseInt(_arrGroup[indexDT])];
			        	tbG+=vG+": "+indexDT;
				        if(_arrGroup[indexDT]>=0){document.getElementById(this.id).attributes['title'].value = tbG}
				        	else{document.getElementById(this.id).attributes['title'].value = "Chưa được gom nhóm : "+indexDT}
				        // if(_arrGroup[indexDT]==-1){document.getElementById(this.id).attributes['title'].value = "Chưa được gom nhóm"}


		    		},
		    		function(){
		    		}
		    	);
		}

		function thongbaoDaiTuGoc(id){
			var index=parseInt(id.substring(5,id.length));
			var hover = document.getElementById(_arrayID[index]);
			$('#'+id).hover(
					function(){
						hover.style.color='blue';hover.style.fontSize='30px';
		    		},
		    		function(){
		    			hover.style.fontSize='100%';hover.style.color='#222222';
		    		}
		    	);
		}

		// *************************************Đại Từ**************************************//
		
		
		function chuyenDaiTuSangNhom(g,dt,chuyensangdau){
					document.getElementById(_arrayID[parseInt(g)]).style.fontSize="100%";
					_arrGroup[parseInt(g)]=_idG;  
					_visitted[parseInt(g)]=1;
					var para = document.createElement("span");
					var idmoi = "newID"+g;para.id = idmoi;
					para.className='dagomnhom';
					
					var thongtinDaiTu=_arrDt[parseInt(g)];
					var node = document.createTextNode(thongtinDaiTu+" ");
					var node2 = document.createElement("span");
					var dx = document.createTextNode("X");
					node2.className="back";
					node2.appendChild(dx);
					para.appendChild(node);
					para.appendChild(node2);
					var element = document.getElementById(chuyensangdau);
					element.appendChild(para);
					// document.getElementById(idmoi).attributes['onmouseover']=back();
					document.getElementById(idmoi).addEventListener("click", function(){
						back(this.id);
						$('#'+idmoi).remove();
					});

					thongbaoDaiTuGoc(idmoi);
					if(_idG>_maxG){_maxG=_idG;}			
		}

		
		function clickDaiTu(idDaiTu){
				if(_idG==-1){
					createNewGroup();
				}
				var dt=document.getElementById(idDaiTu);
				var g = dt.attributes['index'].value;
				var index = parseInt(g);
				var x = $("#"+idDaiTu).children("b");
				alert(_arrDt[index]);
				if(_isChild[index]!=1){
					if(belongGroup[index].length==0){
						chuyenDaiTuSangNhom(g,dt,_idG);	
					}
					else{
						var bool = false;
						for(var i = 0; i<belongGroup[index].length;i++){
							if(_visitted[belongGroup[index][i]]!=1||_visitted[index]!=1){
								bool=true;
								break;
							}
						}
						// alert(bool);
						if(bool){
							document.getElementById("listNP").innerHTML="";

							dt.attributes["data-toggle"].value="modal";
							dt.attributes["data-target"].value="#npview";
							if(_visitted[index]!=1){
								var id_parent = "modal_id_"+g;
								var parent = '<p id="'+id_parent+'" class="mod">' +_arrDt[g]+' </p>';
								$('#listNP').append(parent);
								$("#"+id_parent).click(function(){
										getIndex(this.id);
									});
							}
							for(var i = 0; i<belongGroup[index].length;i++){
								var index_child = parseInt(belongGroup[index][i]);
								if(_visitted[index_child]!=1){
									var nid= "modal_id_"+index_child;
									var np = '<p id="'+nid+'" class="mod">' +_arrDt[index_child]+' </p>';
									$('#listNP').append(np);
									$("#"+nid).click(function(){
										getIndex(this.id);
									});
								}
							}
						}
						else{
							dt.attributes["data-toggle"].value="";
							dt.attributes["data-target"].value="";
						}
					
					}
				}
				

		}

		var modal_id= "modal_id_";
		function getIndex(id){
			var index=parseInt(id.substring(modal_id.length,id.length));
			
				chuyenDaiTuSangNhom(index,_arrDt[index],_idG);
				$("#"+id).remove();
			
		}
		function back(idBack){
			var index=parseInt(idBack.substring(5,idBack.length));
			_arrGroup[index]=-1;
			_visitted[index]=-1;
			document.getElementById(_arrayID[index]).style.fontSize="20px";
			document.getElementById(_arrayID[index]).style.color="#222222";
		}

		// *************************************Nhóm Đại Từ*********************************//
		function createNewGroup(){
			if(_idAuto>_maxG+1){alert("Nhóm mới nhất tạo ra chưa được sử dụng !"); return false;}
			if(_idG>=0){document.getElementById(_idG).style.background = "LightGray";}
			_idG=_idAuto;
			var newDiv = document.createElement('div');
			var h=_idAuto;
			newDiv.id=h;
			newDiv.className='group';
			var element = document.getElementById("right");
			element.appendChild(newDiv);
			document.getElementById(h).addEventListener("click", function selectGroup(){
				document.getElementById(_idG).style.background = "LightGray";
				_idG=this.id;
				document.getElementById(_idG).style.background = "#AAAAAA";
				console.log(_idG);
			});
			document.getElementById(h).style.background = "#AAAAAA";
			_idAuto++;
			$('#'+h).each(function(){
				var x = "<p>"; x+="Group : "+(h+1)+'</p>'
				$(this).append(x);
			});
		}
		
		// *************************************Đại từ đã được chọn và gom nhóm*********************************//

		
		// *************************************Save*********************************//
		function save(){
			console.log(_arrGroup.length);
			if(_arrGroup.length!=0){
				// var max=-1;
				

				//chuan hoa mang Group
				for(var i =0 ; i<_arrDt.length;i++){
					if(_visitted[i]!=1){
						_arrGroup[i]=-1;
					}
				}
				console.log('Ket Qua:');
				
				for(var i =0;i<_arrDt.length;i++){
					console.log(_arrDt[i]+": "+_arrayID[i]+_arrGroup[i]);
				}
				rF();

				alert("Ket qua cua ban da duoc luu lai ! ");
			}
			else{
				alert("Chon file lam viec");
			}
		}

		// *************************************Làm tươi khi cập nhật file mới (luu ket qua)*********************************//
		function rF(){
			_words=[];
			_arrayID=[];
			_indexStart=[];		
			_arrDt =[] ;					// mảng lưu nội dung đại từ
			_arrGroup=[];					// mảng lưu ds gom nhóm đại từ
			_contentFile=[];				// nội dung 1 file (kieu String)
			_idG=-1;                     // id nhóm được chọn
			_idAuto=0;					// id tự sinh khi tạo mới Group
			_visitted=[];
			_save=0;
			_indexEnd=[];
			belongGroup=[];
			mark=[];
			document.getElementById('left_p').innerHTML="";
			$('#right').children().each(function(){
       			$(this).remove();
   			});
   			_maxG=-1;
		}
		
		// *************************************Làm tươi khi sửa 1 file đã gom nhóm*********************************//
		function update(){
			rF();
			_arrayID=arrayID;
			_arrDt=arrDaiTu;
			 
			_indexStart=arrIndexStart;
			_indexEnd=arrIndexEnd;
			_arrGroup=arrGroup;
			modify();
			subGroup(_indexStart,_indexEnd);

			// console.log(_arrDt)
			// _words=contentFile.split(" ");
			var slG=-1;
			for (var i = 0; i < arrGroup.length; i++) {

				if(arrGroup[i]>=0){_visitted[i]=1}
				if(arrGroup[i]>slG){slG++}
			}
			_maxG=slG;

			for (var i = 0; i <= slG; i++) {
				createNewGroup();
			}
			var s = highlight(_arrayID,_arrDt,_indexStart,_indexEnd,contentFile,"100%");
			document.getElementById('left_p').innerHTML=s;
			// document.getElementsByClassName('daitu').style.fontSize="100%";
			_save=1;
			thongbaoNhom();
			for(var i=0; i<_arrayID.length;i++){
				if(_arrGroup[i]==-1){
					document.getElementById(_arrayID[i]).style.fontSize="20px";
				}
			}
			

			for (var i = 0; i <=arrDaiTu.length; i++) {
				if(_arrGroup[i]>=0){
					var dt=document.getElementById(arrayID[i]);
					chuyenDaiTuSangNhom(i,dt,arrGroup[i]);
				}
			}

			
		}

		function sua(){
			if(_save==1){
				alert("Luu lai ket qua lam viec truoc khi lam file moi ! "); return false;
			}else{
				// var arrayID=["d1","d2","d3","d4","d5","d6"];
				// var arrDaiTu=["Duong","sinh_vien","sinh","Anh_ay","Co_ta","nguoi"];
				// var contentFile="Duong la sinh vien , Anh ay choi ghita va co ta la nguoi yeu";
				// //					0   1   2   3   4  5   6   7    8    9   10   11  12   13
				// var arrIndexStart =[0,2,2,5,10,13];
				// var arrIndexEnd =  [0,3,2,6,11,13];

				// arrGroup=		   [-1,1,0,-1,1,-1];
				_words=contentFile.split(" ");
				// console.log(_words[0])	
				// update(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,arrGroup,contentFile);
				update();
				// console.log(_words);

				// alert("Nhom dang chon: "+_idG+", SL nhom: "+_idAuto);
			}
			
		}

		
		var token = '{{ Session::token() }}'
		var curr_url = document.URL;
		var file_id = curr_url.split('/')[curr_url.split('/').length - 1];
		$('.save_group').click(function(){
			var groups = [];
			i = 1;
			$('.group').each(function(){
				// alert("select ok");
				var nps = [];
				
				$(this).find('.dagomnhom').each(function(){
					var id = $(this).attr('id');

					nps.push(_arrayID[parseInt(id.substring(5, id.length))]);
				});
			
				groups.push(nps);
			});

			//DESC
			groups = sortGroupById(groups);

			$.ajax({
				type: 'post',
				data:{_token: token, groups: groups, file: file_id},
				dataType: 'json',
				url: 'save',
				success: function(data){
					alert(data);
				}


			});
			save();
		});

		function sortGroupById(groups){
			groups.sort(function(gr1, gr2){return minIndex(gr2) - minIndex(gr1)});
			return groups;
		}

		function minIndex(gr){
			var min = 100000;
			for(var i = 0; i < gr.length; i ++){
				var infos = gr[i].split('_');
				var mention_id = parseInt(infos[infos.length - 1]);
				if(mention_id < min){
					min = mention_id;
				}
			}
			return min;
		}
	</script>
</html>
