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
		var _color=['B2001F','DF0029', 'FF69B4', '9F79EE'];
		

		


		function  highlight(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,contentFile,kichthuoc) {
			var iStart_End=0;// chi so mang arrIndexStart va arrIndexEnd
			var vs_S=[];
			var vs_E=[];
			_words = contentFile.split(" ");
			var l = _words.length;
			var s='';
			for (var i =  0; i <= _words.length-1; i++) {
				if(i==arrIndexStart[iStart_End]){
						if(vs_S[i]!=1){
							_words[i]='<b title="" data-toggle="" data-target="" style="font-size:'+kichthuoc+'" index='+iStart_End+' class="daitu" id='+arrayID[iStart_End]+' value='+arrDaiTu[iStart_End]+' onclick="clickDaiTu(this.id)">'+_words[i];
							vs_S[i]=1;
						}
						if(vs_E[arrIndexEnd[iStart_End]]!=1){
							_words[arrIndexEnd[iStart_End]]=_words[arrIndexEnd[iStart_End]]+'</b>';
							vs_E[arrIndexEnd[iStart_End]]=1;
						}
						
						iStart_End++;
				}

				s+=_words[i]+' ';
			}
			console.log(s);
			return s;
		}


		function showID(id){
			console.log('id :'+id);
		}

		//Mang bd trong file, ket thuc trong file, 
		//Mang cac dai
		$(document).ready(function(){
			_contentFile = 'Bên cạnh văn nghị luận xã hội thì trong chương trình Ngữ văn lớp 10 còn có một thể loại văn nữa là bài văn tả cảnh . Giúp chúng ta hiểu rõ hơn về thể loại này . Dưới đây là một số bài văn mẫu về thể loại này mời các bạn cũng tham khảo .';	
			_words=_contentFile.split(" ");
			_arrayID = ["d1","d2","d3","d4","d5","d6","d7","d8","d9","d10"]; 
			_indexStart = [2,3,5,9,11,18,23,29,35,44];
			_indexEnd=    [6,4,5,10,12,19,23,29,35,44];
			// // _indexEnd = 
			_arrDt=["văn_nghị_luận_xã_hội","nghị_luận","xã_hội"];
			// var start_S =[2,3,5,9,11,18,23,1,7,5];
			// var end_S=[5,4,5,10,13,19,24,2,9,7];
			// for(var i = 0 ; i< start_S.length;i++){
			// 		var len = (end_S[i]-start_S[i])+1;
			// 		_indexEnd[i]=(_indexStart[i]+len)-1;
			// }
			// // update_haveChild_arrDT(_indexStart,_indexEnd);
			// for(var i =0; i<_isChild.length;i++){
			// 		console.log(_arrayID[i]+": " +_isChild[i]);
			// 	}
			// console.log(_arrDt);
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
			        	tbG+=vG+": "+_haveChild[parseInt(_arrGroup[indexDT])];
				        if(_arrGroup[indexDT]>=0){document.getElementById(this.id).attributes['title'].value = tbG}
				        	else{document.getElementById(this.id).attributes['title'].value = "Chưa được gom nhóm"}
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
						$('#'+idmoi).remove();
						back(this.id);
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
				
				
				

				if (_visitted[index]!=1){	
					if(x.length==0){                  // khong co Np con ben trong
						dt.style.fontSize="100%";
						console.log(_haveChild[index]);
						_arrGroup[index]=_idG;  
						_visitted[index]=1;
						var tb = _arrDt[index]  +' : '+_arrGroup[index];                      
						// console.log(tb);
						chuyenDaiTuSangNhom(g,dt,_idG);	
					}
					else{                                     // neu co con thi phai dua ra lua chon
						// var childs = $('#'+idDaiTu).children();
						// console.log(childs.length+": con");
						// for(var i =0; i<childs.length;i++){
						// 	var idex = parseInt(childs[i].attributes['index'].value);
						// 	console.log(_arrDt[idex]);
						// }

						// <button class = "btn btn-primary edit" data-toggle = "modal" data-target = "#editModal">Edit</button>
						// alert("ok");
						dt.attributes["data-toggle"].value="modal";
						dt.attributes["data-target"].value="#npview";
						var s ="";
						var r = "";
						for(var i =0; i<x.length; i++){
							var index = parseInt(x[i].attributes['index'].value);
							
							r+=_arrDt[index]+" ";
						}
						alert("Co "+x.length+" con : "+r);
					}
					
				}
				else{
					return false;
				}
			


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


			// document.getElementById(_idAuto).addEventListener("click",selectGroup(this.id));
			document.getElementById(h).addEventListener("click", function selectGroup(){
				// alert(this.id);
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
					console.log(_arrDt[i]+": "+_arrGroup[i]);
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
			document.getElementById('left_p').innerHTML="";
			$('#right').children().each(function(){
       			$(this).remove();
   			});
   			_maxG=-1;
		}
		
		// *************************************Làm tươi khi sửa 1 file đã gom nhóm*********************************//
		function update(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,arrGroup,contentFile){
			rF();
			_arrayID=arrayID; _arrDt=arrDaiTu; _indexStart=arrIndexStart; _indexEnd=arrIndexEnd; _arrGroup=arrGroup;
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
				var arrayID=["d1","d2","d3","d4","d5"];
				var arrDaiTu=["Duong","sinh_vien","Anh_ay","Co_ta","nguoi"];
				var contentFile="Duong la sinh vien , Anh ay choi ghita va co ta la nguoi yeu";
				//					0   1   2   3   4  5   6   7    8    9   10   11  12   13
				var arrIndexStart =[0,2,5,10,13];
				var arrIndexEnd =  [0,3,6,11,13];
				arrGroup=		   [-1,1,-1,1,-1];
				update(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,arrGroup,contentFile);

				// alert("Nhom dang chon: "+_idG+", SL nhom: "+_idAuto);
			}
			
		}

		function setUpNew(file,start_File,start_S,end_S){
			
			// _words=file.split(" ");
			// _indexStart=start_File;
			// update_arrDT_IndexEnd_f(arrIndexStart_S,arrIndexEnd_S,arrIndexStart_File,_words);      // cap nhat cho mang _arrDT va indexEnd
			// for(var i = 0 ; i< start_S.length){
			// 	var len = (end_S[i]-start_S[i])+1;
			// 	_indexEnd[i]=(start_File[i]+len)-1;
			// 	var s="";
			// 	for(var j = start_File[i]; j<start_File[i]+len;j++){
			// 		s+=arrWords[j]+" ";
			// 		_arrDt[i]=s;
			// 	}
			// }
		}

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
	<input id="btn" type="button" value="New Group" onclick="createNewGroup()">
	<input id="btn" type="button" value="Save" onclick="save()">
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
</html>
