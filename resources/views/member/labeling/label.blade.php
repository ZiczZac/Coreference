@extends('member.layout.member-layout')
<link rel="stylesheet" href="{!! asset('css/member/labeling.css') !!}">
@section('banner')
    <h1>Labeling</h1>
    <div class="row">
        <div class="btn-group">
            <button type="button" onclick="createNewGroup()" class="btn btn-primary">New Group</button>
            <button type="button" class="btn btn-primary save_group">Save</button>
            <button type="button" class="btn btn-primary finshed_labeling" >Finish</button>
            <button type="button" onclick="sua()" class="btn btn-primary" id="btn">Sửa 1 file đã gom nhóm</button>
        </div>
    </div>
@stop
@section('content-main')

    <div class="row">
        <div class="col-sm-6" id="left">
            <div id="doanvan">
                <p id="left_p"></p>
            </div>
        </div>
        <div class="col-sm-6" id="right">

        </div>
    </div>
@include('member.labeling.npview')
@stop
@section('script')
    <script type="text/javascript">
        //************************************************highlight**************************************************************//

// **********************cần 1 mảng đại từ (id) , vị trí bắt đầu, kết thúc, mang nội dung đại từ(cacDaiTu) và nội đoạn văn.
var _words=[];
var _arrayID=[];
var _indexStart=[];
var _arrDt=[] ;                 // mảng lưu nội dung đại từ
var _arrGroup=[];                   // mảng lưu ds gom nhóm đại từ
var _contentFile;               // nội dung 1 file (kieu String)
var _idG=-1;                     // id nhóm được chọn
var _idAuto=0;                  // id tự sinh khi tạo mới Group
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
        _words[_indexStart[i]]= '<b title="" data-toggle="" data-target="" style="font-size:'+kichthuoc+'" index='+i+' class="daitu" id='+arrayID[i]+' onclick="clickDaiTu(this.id)">'+_words[_indexStart[i]];
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
    //Triệu -> show file
    showOnDiv('left_p');
});
function showOnDiv(idCard){
    _contentFile = '{{$data['corpus']}}';   
            _words = <?php echo json_encode($data['list_token']); ?>;
    // alert(_words);
    _arrayID = <?php echo json_encode($data['listNP']); ?>; 
    _indexStart = <?php echo json_encode($data['begin_on_file']) ?>;
    _indexEnd=  <?php echo json_encode($data['end_on_file']) ?>;
    _arrDt=<?php echo json_encode($data['list_content_np']) ?>;
    modify();
    subGroup(_indexStart,_indexEnd);

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
            tbG+=vG;
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
    document.getElementById(_arrayID[parseInt(g)]).style.fontSize="100%";
    _arrGroup[parseInt(g)]=_idG;
    _visitted[parseInt(g)]=1;
    var para = document.createElement("span");
    var idmoi = "newID"+g;para.id = idmoi;
    para.className='dagomnhom';

    var thongtinDaiTu=_arrDt[parseInt(g)];
    var node = document.createTextNode(thongtinDaiTu+" ");
    //Trieu : Bỏ dấu x đi
/*    var node2 = document.createElement("span");
    var dx = document.createTextNode("X");*/
    //node2.className="back";
    //node2.appendChild(dx);
    para.appendChild(node);
    //para.appendChild(node2);
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

    if(_isChild[index]!=1){
        if(belongGroup[index].length==0){
            if(_visitted[index]!=1){chuyenDaiTuSangNhom(g,dt,_idG);}
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
    _arrDt =[] ;                    // mảng lưu nội dung đại từ
    _arrGroup=[];                   // mảng lưu ds gom nhóm đại từ
    _contentFile=[];                // nội dung 1 file (kieu String)
    _idG=-1;                     // id nhóm được chọn
    _idAuto=0;                  // id tự sinh khi tạo mới Group
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
    // var contentFile="Duong la sinh vien , Anh ay choi ghita va co ta la nguoi yeu";
    //                0     1   2   3   4  5   6  7    8     9  10 11 12 13    14
    _contentFile = 'Nguyễn Kỳ Sơn chỉ là một trong hàng chục vạn người lính đã nằm xuống cho độc lập tự do của Tổ quốc , anh cũng chỉ là một liệt sĩ bình thường như hàng ngàn người lính đã hi sinh nay vẫn chưa tìm thấy thân xác . Nhưng những dòng nhật ký của anh là câu chuyện chân thực và đầy thuyết phục về một thế hệ , họ đã sống cho lý tưởng , cống hiến tuổi xuân một cách đầy lãng mạn . Sáng 27 - 7 , như mọi năm tôi vào thắp hương ở đài tưởng niệm Thành Cổ Quảng Trị . Buổi sáng hôm ấy ràn rạt gió Lào , nhang trên đài tưởng niệm thắp xong cứ cháy bùng lên thành lửa ngọn . Như một nghi lễ thiêng liêng , hàng trăm người vẫn đến dâng hương vào ngày này . Nhưng có hai người phụ nữ hơi khác thường : khi dâng hương đã khóc vật vã trên đài . Họ là hai chị em gái quê tận Quảng Bình , gần 30 năm nay đi tìm mộ của người anh trai ngã xuống ở vùng đất này mà cho đến giờ vẫn chưa tìm thấy . Thì vẫn có hàng ngàn cuộc kiếm tìm như vậy , nhưng câu chuyện về người anh trai của hai người phụ nữ tôi gặp trong buổi sáng 27 - 7 trên đài tưởng niệm Thành Cổ Quảng Trị thì không như những cuộc kiếm tìm khác . Hai chị lấy từ trong túi xách ra một cuốn nhật ký đã ố vàng . Cuốn nhật ký của một người lính trẻ , anh là Nguyễn Kỳ Sơn . Đồng đội anh đã chuyển cuốn nhật ký về cho gia đình sau khi anh hi sinh và được gia đình gìn giữ như một báu vật thiêng liêng . Và những trang nhật ký ấy khiến chúng tôi vô cùng xúc động . Đang là sinh viên năm 2 của Trường đại học Thủy lợi Hà Nội , đến đợt động viên năm 1972 thì anh Nguyễn Kỳ Sơn vào lính . Khi ấy anh 20 tuổi . Có một thế hệ sinh viên đã vào trận như thế . Lãng mạn , yêu nước , đầy nhiệt huyết . Lần giở những trang nhật ký của liệt sĩ Nguyễn Kỳ Sơn sau hơn 30 năm , những dòng chữ rắn rỏi của một sinh viên , viết giữa đạn bom ác liệt , khoảng lặng giữa hai trận đánh . Tự thân đã nói lên nhiều điều . Sau gần 30 bài thơ anh viết khi đang huấn luyện ở hậu phương là những trang nhật ký viết trong bom đạn . Chúng tôi chỉ xin trích lại đây những dòng nhật ký ấy được viết ở Ái Tử , một trận địa nằm không xa Thành Cổ : ... 8 - 1972 . Dứt tiếng máy bay , bầu trời như được vút lên cao . Cả bốn phương lồng lộng cái gió nam của tháng bảy , cái rực vàng của những tia nắng đầu những ngày mưa . Cây lá hình như xanh hơn , thắm hơn nhờ được tắm sau trận mưa đêm qua hay muốn tranh thủ lớn thêm một tí trong phút giây ngắn ngủi thanh bình này ? Bầu trời ở đây có khác gì bầu trời quê ta , bầu trời miền Bắc thanh bình có chim có bướm mà dưới khoảng xanh ấy có tuổi trẻ của ta , ước mơ của ta ... Ta yêu hòa bình , ta yêu màu xanh , cho ta sống mãi với màu xanh này , màu xanh tương lai , màu xanh mà ta phải tranh đấu . Trong bom đạn tưởng chừng như không bao giờ dứt , một phút như thế này có ý nghĩa biết bao nhiêu . Ta càng yêu quí cuộc sống đến bao nhiêu ... Một đoạn nhật ký khác khiến người đọc bật cười rồi chợt nao lòng vì sự hồn nhiên của những người lính trẻ : Bây giờ đã 7 giờ tối thế mà vẫn không dứt tiếng máy bay Mỹ , tiếng đại bác đì đùng ... Đêm ngày giờ khắc vẫn được tính bằng khoảng cách thời gian giữa những trận B .52 , những trận pháo kích . Tiểu đội tôi bốn người đã đào được ba hầm vòm . Bây giờ chỉ còn mình tôi với một ngọn đèn . Gió nhẹ đưa đẩy bản hợp xướng của hàng trăm chú muỗi ... Và việc của tôi lại bắt đầu ... Những lúc như thế này thì việc lý thú nhất vẫn là việc bắt muỗi bằng ngọn đèn làm bằng vỏ hộp Coca Cola Mỹ . Những chú muỗi gầy có , béo có , nhỏ có , to có lần lượt lao vào ngọn đèn đầy muội đen . A ! OV .10 này .';
    _words = ["Nguy\u1ec5n","K\u1ef3","S\u01a1n","ch\u1ec9","l\u00e0","m\u1ed9t","trong","h\u00e0ng","ch\u1ee5c","v\u1ea1n","ng\u01b0\u1eddi","l\u00ednh","\u0111\u00e3","n\u1eb1m","xu\u1ed1ng","cho","\u0111\u1ed9c","l\u1eadp","t\u1ef1","do","c\u1ee7a","T\u1ed5","qu\u1ed1c",",","anh","c\u0169ng","ch\u1ec9","l\u00e0","m\u1ed9t","li\u1ec7t","s\u0129","b\u00ecnh","th\u01b0\u1eddng","nh\u01b0","h\u00e0ng","ng\u00e0n","ng\u01b0\u1eddi","l\u00ednh","\u0111\u00e3","hi","sinh","nay","v\u1eabn","ch\u01b0a","t\u00ecm","th\u1ea5y","th\u00e2n","x\u00e1c",".","Nh\u01b0ng","nh\u1eefng","d\u00f2ng","nh\u1eadt","k\u00fd","c\u1ee7a","anh","l\u00e0","c\u00e2u","chuy\u1ec7n","ch\u00e2n","th\u1ef1c","v\u00e0","\u0111\u1ea7y","thuy\u1ebft","ph\u1ee5c","v\u1ec1","m\u1ed9t","th\u1ebf","h\u1ec7",",","h\u1ecd","\u0111\u00e3","s\u1ed1ng","cho","l\u00fd","t\u01b0\u1edfng",",","c\u1ed1ng","hi\u1ebfn","tu\u1ed5i","xu\u00e2n","m\u1ed9t","c\u00e1ch","\u0111\u1ea7y","l\u00e3ng","m\u1ea1n",".","S\u00e1ng","27","-","7",",","nh\u01b0","m\u1ecdi","n\u0103m","t\u00f4i","v\u00e0o","th\u1eafp","h\u01b0\u01a1ng","\u1edf","\u0111\u00e0i","t\u01b0\u1edfng","ni\u1ec7m","Th\u00e0nh","C\u1ed5","Qu\u1ea3ng","Tr\u1ecb",".","Bu\u1ed5i","s\u00e1ng","h\u00f4m","\u1ea5y","r\u00e0n","r\u1ea1t","gi\u00f3","L\u00e0o",",","nhang","tr\u00ean","\u0111\u00e0i","t\u01b0\u1edfng","ni\u1ec7m","th\u1eafp","xong","c\u1ee9","ch\u00e1y","b\u00f9ng","l\u00ean","th\u00e0nh","l\u1eeda","ng\u1ecdn",".","Nh\u01b0","m\u1ed9t","nghi","l\u1ec5","thi\u00eang","li\u00eang",",","h\u00e0ng","tr\u0103m","ng\u01b0\u1eddi","v\u1eabn","\u0111\u1ebfn","d\u00e2ng","h\u01b0\u01a1ng","v\u00e0o","ng\u00e0y","n\u00e0y",".","Nh\u01b0ng","c\u00f3","hai","ng\u01b0\u1eddi","ph\u1ee5","n\u1eef","h\u01a1i","kh\u00e1c","th\u01b0\u1eddng",":","khi","d\u00e2ng","h\u01b0\u01a1ng","\u0111\u00e3","kh\u00f3c","v\u1eadt","v\u00e3","tr\u00ean","\u0111\u00e0i",".","H\u1ecd","l\u00e0","hai","ch\u1ecb","em","g\u00e1i","qu\u00ea","t\u1eadn","Qu\u1ea3ng","B\u00ecnh",",","g\u1ea7n","30","n\u0103m","nay","\u0111i","t\u00ecm","m\u1ed9","c\u1ee7a","ng\u01b0\u1eddi","anh","trai","ng\u00e3","xu\u1ed1ng","\u1edf","v\u00f9ng","\u0111\u1ea5t","n\u00e0y","m\u00e0","cho","\u0111\u1ebfn","gi\u1edd","v\u1eabn","ch\u01b0a","t\u00ecm","th\u1ea5y",".","Th\u00ec","v\u1eabn","c\u00f3","h\u00e0ng","ng\u00e0n","cu\u1ed9c","ki\u1ebfm","t\u00ecm","nh\u01b0","v\u1eady",",","nh\u01b0ng","c\u00e2u","chuy\u1ec7n","v\u1ec1","ng\u01b0\u1eddi","anh","trai","c\u1ee7a","hai","ng\u01b0\u1eddi","ph\u1ee5","n\u1eef","t\u00f4i","g\u1eb7p","trong","bu\u1ed5i","s\u00e1ng","27","-","7","tr\u00ean","\u0111\u00e0i","t\u01b0\u1edfng","ni\u1ec7m","Th\u00e0nh","C\u1ed5","Qu\u1ea3ng","Tr\u1ecb","th\u00ec","kh\u00f4ng","nh\u01b0","nh\u1eefng","cu\u1ed9c","ki\u1ebfm","t\u00ecm","kh\u00e1c",".","Hai","ch\u1ecb","l\u1ea5y","t\u1eeb","trong","t\u00fai","x\u00e1ch","ra","m\u1ed9t","cu\u1ed1n","nh\u1eadt","k\u00fd","\u0111\u00e3","\u1ed1","v\u00e0ng",".","Cu\u1ed1n","nh\u1eadt","k\u00fd","c\u1ee7a","m\u1ed9t","ng\u01b0\u1eddi","l\u00ednh","tr\u1ebb",",","anh","l\u00e0","Nguy\u1ec5n","K\u1ef3","S\u01a1n",".","\u0110\u1ed3ng","\u0111\u1ed9i","anh","\u0111\u00e3","chuy\u1ec3n","cu\u1ed1n","nh\u1eadt","k\u00fd","v\u1ec1","cho","gia","\u0111\u00ecnh","sau","khi","anh","hi","sinh","v\u00e0","\u0111\u01b0\u1ee3c","gia","\u0111\u00ecnh","g\u00ecn","gi\u1eef","nh\u01b0","m\u1ed9t","b\u00e1u","v\u1eadt","thi\u00eang","li\u00eang",".","V\u00e0","nh\u1eefng","trang","nh\u1eadt","k\u00fd","\u1ea5y","khi\u1ebfn","ch\u00fang","t\u00f4i","v\u00f4","c\u00f9ng","x\u00fac","\u0111\u1ed9ng",".","\u0110ang","l\u00e0","sinh","vi\u00ean","n\u0103m","2","c\u1ee7a","Tr\u01b0\u1eddng","\u0111\u1ea1i","h\u1ecdc","Th\u1ee7y","l\u1ee3i","H\u00e0","N\u1ed9i",",","\u0111\u1ebfn","\u0111\u1ee3t","\u0111\u1ed9ng","vi\u00ean","n\u0103m","1972","th\u00ec","anh","Nguy\u1ec5n","K\u1ef3","S\u01a1n","v\u00e0o","l\u00ednh",".","Khi","\u1ea5y","anh","20","tu\u1ed5i",".","C\u00f3","m\u1ed9t","th\u1ebf","h\u1ec7","sinh","vi\u00ean","\u0111\u00e3","v\u00e0o","tr\u1eadn","nh\u01b0","th\u1ebf",".","L\u00e3ng","m\u1ea1n",",","y\u00eau","n\u01b0\u1edbc",",","\u0111\u1ea7y","nhi\u1ec7t","huy\u1ebft",".","L\u1ea7n","gi\u1edf","nh\u1eefng","trang","nh\u1eadt","k\u00fd","c\u1ee7a","li\u1ec7t","s\u0129","Nguy\u1ec5n","K\u1ef3","S\u01a1n","sau","h\u01a1n","30","n\u0103m",",","nh\u1eefng","d\u00f2ng","ch\u1eef","r\u1eafn","r\u1ecfi","c\u1ee7a","m\u1ed9t","sinh","vi\u00ean",",","vi\u1ebft","gi\u1eefa","\u0111\u1ea1n","bom","\u00e1c","li\u1ec7t",",","kho\u1ea3ng","l\u1eb7ng","gi\u1eefa","hai","tr\u1eadn","\u0111\u00e1nh",".","T\u1ef1","th\u00e2n","\u0111\u00e3","n\u00f3i","l\u00ean","nhi\u1ec1u","\u0111i\u1ec1u",".","Sau","g\u1ea7n","30","b\u00e0i","th\u01a1","anh","vi\u1ebft","khi","\u0111ang","hu\u1ea5n","luy\u1ec7n","\u1edf","h\u1eadu","ph\u01b0\u01a1ng","l\u00e0","nh\u1eefng","trang","nh\u1eadt","k\u00fd","vi\u1ebft","trong","bom","\u0111\u1ea1n",".","Ch\u00fang","t\u00f4i","ch\u1ec9","xin","tr\u00edch","l\u1ea1i","\u0111\u00e2y","nh\u1eefng","d\u00f2ng","nh\u1eadt","k\u00fd","\u1ea5y","\u0111\u01b0\u1ee3c","vi\u1ebft","\u1edf","\u00c1i","T\u1eed",",","m\u1ed9t","tr\u1eadn","\u0111\u1ecba","n\u1eb1m","kh\u00f4ng","xa","Th\u00e0nh","C\u1ed5",":","...","8","-","1972",".","D\u1ee9t","ti\u1ebfng","m\u00e1y","bay",",","b\u1ea7u","tr\u1eddi","nh\u01b0","\u0111\u01b0\u1ee3c","v\u00fat","l\u00ean","cao",".","C\u1ea3","b\u1ed1n","ph\u01b0\u01a1ng","l\u1ed3ng","l\u1ed9ng","c\u00e1i","gi\u00f3","nam","c\u1ee7a","th\u00e1ng","b\u1ea3y",",","c\u00e1i","r\u1ef1c","v\u00e0ng","c\u1ee7a","nh\u1eefng","tia","n\u1eafng","\u0111\u1ea7u","nh\u1eefng","ng\u00e0y","m\u01b0a",".","C\u00e2y","l\u00e1","h\u00ecnh","nh\u01b0","xanh","h\u01a1n",",","th\u1eafm","h\u01a1n","nh\u1edd","\u0111\u01b0\u1ee3c","t\u1eafm","sau","tr\u1eadn","m\u01b0a","\u0111\u00eam","qua","hay","mu\u1ed1n","tranh","th\u1ee7","l\u1edbn","th\u00eam","m\u1ed9t","t\u00ed","trong","ph\u00fat","gi\u00e2y","ng\u1eafn","ng\u1ee7i","thanh","b\u00ecnh","n\u00e0y","?","B\u1ea7u","tr\u1eddi","\u1edf","\u0111\u00e2y","c\u00f3","kh\u00e1c","g\u00ec","b\u1ea7u","tr\u1eddi","qu\u00ea","ta",",","b\u1ea7u","tr\u1eddi","mi\u1ec1n","B\u1eafc","thanh","b\u00ecnh","c\u00f3","chim","c\u00f3","b\u01b0\u1edbm","m\u00e0","d\u01b0\u1edbi","kho\u1ea3ng","xanh","\u1ea5y","c\u00f3","tu\u1ed5i","tr\u1ebb","c\u1ee7a","ta",",","\u01b0\u1edbc","m\u01a1","c\u1ee7a","ta","...","Ta","y\u00eau","h\u00f2a","b\u00ecnh",",","ta","y\u00eau","m\u00e0u","xanh",",","cho","ta","s\u1ed1ng","m\u00e3i","v\u1edbi","m\u00e0u","xanh","n\u00e0y",",","m\u00e0u","xanh","t\u01b0\u01a1ng","lai",",","m\u00e0u","xanh","m\u00e0","ta","ph\u1ea3i","tranh","\u0111\u1ea5u",".","Trong","bom","\u0111\u1ea1n","t\u01b0\u1edfng","ch\u1eebng","nh\u01b0","kh\u00f4ng","bao","gi\u1edd","d\u1ee9t",",","m\u1ed9t","ph\u00fat","nh\u01b0","th\u1ebf","n\u00e0y","c\u00f3","\u00fd","ngh\u0129a","bi\u1ebft","bao","nhi\u00eau",".","Ta","c\u00e0ng","y\u00eau","qu\u00ed","cu\u1ed9c","s\u1ed1ng","\u0111\u1ebfn","bao","nhi\u00eau","...","M\u1ed9t","\u0111o\u1ea1n","nh\u1eadt","k\u00fd","kh\u00e1c","khi\u1ebfn","ng\u01b0\u1eddi","\u0111\u1ecdc","b\u1eadt","c\u01b0\u1eddi","r\u1ed3i","ch\u1ee3t","nao","l\u00f2ng","v\u00ec","s\u1ef1","h\u1ed3n","nhi\u00ean","c\u1ee7a","nh\u1eefng","ng\u01b0\u1eddi","l\u00ednh","tr\u1ebb",":","B\u00e2y","gi\u1edd","\u0111\u00e3","7","gi\u1edd","t\u1ed1i","th\u1ebf","m\u00e0","v\u1eabn","kh\u00f4ng","d\u1ee9t","ti\u1ebfng","m\u00e1y","bay","M\u1ef9",",","ti\u1ebfng","\u0111\u1ea1i","b\u00e1c","\u0111\u00ec","\u0111\u00f9ng","...","\u0110\u00eam","ng\u00e0y","gi\u1edd","kh\u1eafc","v\u1eabn","\u0111\u01b0\u1ee3c","t\u00ednh","b\u1eb1ng","kho\u1ea3ng","c\u00e1ch","th\u1eddi","gian","gi\u1eefa","nh\u1eefng","tr\u1eadn","B",".52",",","nh\u1eefng","tr\u1eadn","ph\u00e1o","k\u00edch",".","Ti\u1ec3u","\u0111\u1ed9i","t\u00f4i","b\u1ed1n","ng\u01b0\u1eddi","\u0111\u00e3","\u0111\u00e0o","\u0111\u01b0\u1ee3c","ba","h\u1ea7m","v\u00f2m",".","B\u00e2y","gi\u1edd","ch\u1ec9","c\u00f2n","m\u00ecnh","t\u00f4i","v\u1edbi","m\u1ed9t","ng\u1ecdn","\u0111\u00e8n",".","Gi\u00f3","nh\u1eb9","\u0111\u01b0a","\u0111\u1ea9y","b\u1ea3n","h\u1ee3p","x\u01b0\u1edbng","c\u1ee7a","h\u00e0ng","tr\u0103m","ch\u00fa","mu\u1ed7i","...","V\u00e0","vi\u1ec7c","c\u1ee7a","t\u00f4i","l\u1ea1i","b\u1eaft","\u0111\u1ea7u","...","Nh\u1eefng","l\u00fac","nh\u01b0","th\u1ebf","n\u00e0y","th\u00ec","vi\u1ec7c","l\u00fd","th\u00fa","nh\u1ea5t","v\u1eabn","l\u00e0","vi\u1ec7c","b\u1eaft","mu\u1ed7i","b\u1eb1ng","ng\u1ecdn","\u0111\u00e8n","l\u00e0m","b\u1eb1ng","v\u1ecf","h\u1ed9p","Coca","Cola","M\u1ef9",".","Nh\u1eefng","ch\u00fa","mu\u1ed7i","g\u1ea7y","c\u00f3",",","b\u00e9o","c\u00f3",",","nh\u1ecf","c\u00f3",",","to","c\u00f3","l\u1ea7n","l\u01b0\u1ee3t","lao","v\u00e0o","ng\u1ecdn","\u0111\u00e8n","\u0111\u1ea7y","mu\u1ed9i","\u0111en",".","A","!","OV",".10","n\u00e0y","."];
    // alert(_words);
    _arrayID = ["1_5_22_5_3","1_16_22_16_2","1_21_22_21_1","1_28_47_28_5","1_34_47_34_4","2_6_6_55_6","2_8_19_57_8","2_17_19_66_7","2_25_26_74_9","2_32_36_81_10","3_6_7_93_11","3_13_19_100_13","3_16_19_103_12","4_2_3_110_14","4_6_7_114_15","4_11_13_119_16","4_21_22_129_17","5_1_5_133_18","5_15_16_147_19","6_12_12_162_20","6_19_19_168_21","7_2_9_172_24","7_6_9_176_23","7_8_9_178_22","7_20_28_189_26","7_26_28_195_25","7_32_32_201_27","8_3_9_210_28","8_15_17_222_29","8_19_38_226_33","8_26_30_233_30","8_32_38_239_32","8_35_38_242_31","8_42_46_249_34","9_5_6_260_35","10_4_13_275_38","10_9_13_280_37","10_11_13_282_36","11_10_11_296_39","11_13_16_299_40","13_7_13_337_42","13_12_13_342_41","13_16_20_346_43","17_8_12_394_44","17_14_16_400_45","17_18_40_404_51","17_24_26_410_46","17_30_33_416_47","17_30_40_416_50","17_35_40_421_49","17_38_40_424_48","19_1_13_437_53","19_12_13_448_52","19_15_22_451_55","19_21_22_457_54","20_15_25_475_58","20_18_25_478_57","20_24_25_484_56","22_1_3_493_59","23_5_10_510_61","23_5_22_510_65","23_9_10_514_60","23_12_22_517_64","23_16_22_521_63","23_20_22_525_62","24_13_16_542_67","24_15_16_544_66","24_26_32_555_68","25_3_3_566_69","25_7_10_570_70","25_24_26_587_71","25_28_31_591_73","25_31_31_594_72","25_33_36_596_75","25_36_36_599_74","26_15_17_616_76","26_19_22_620_78","26_21_22_622_77","26_24_30_625_79","27_1_9_634_80","27_14_15_647_81","28_7_8_663_82","29_19_22_685_83","30_2_5_692_84","30_12_15_701_87","30_13_15_702_86","30_15_15_704_85","30_17_21_706_88","31_9_22_720_91","31_14_17_725_89","31_19_22_730_90","33_5_6_751_92","33_8_10_754_93","34_8_11_766_94","35_3_3_774_95","36_3_4_782_96","36_12_24_791_99","36_16_24_795_98","36_20_24_799_97","37_18_22_823_101","37_21_22_826_100","38_2_4_831_102"];
    _indexStart = ["5","16","21","28","34","55","57","66","74","81","93","100","103","110","114","119","129","133","147","162","168","172","176","178","189","195","201","210","222","226","233","239","242","249","260","275","280","282","296","299","337","342","346","394","400","404","410","416","416","421","424","437","448","451","457","475","478","484","493","510","510","514","517","521","525","542","544","555","566","570","587","591","594","596","599","616","620","622","625","634","647","663","685","692","701","702","704","706","720","725","730","751","754","766","774","782","791","795","799","823","826","831"];
    _indexEnd=  [22,22,22,47,47,55,68,68,75,85,94,106,106,111,115,121,130,137,148,162,168,179,179,179,197,197,201,216,224,245,237,245,245,253,261,284,284,284,297,302,343,343,350,398,402,426,412,419,426,426,426,449,449,458,458,485,485,485,495,515,527,515,527,527,527,545,545,561,566,573,589,594,594,599,599,618,623,623,631,642,648,664,688,695,704,704,704,710,733,728,733,752,756,769,774,783,803,803,803,827,827,833];
    _arrDt=["m\u1ed9t_trong_h\u00e0ng_ch\u1ee5c_v\u1ea1n_ng\u01b0\u1eddi_l\u00ednh_\u0111\u00e3_n\u1eb1m_xu\u1ed1ng_cho_\u0111\u1ed9c_l\u1eadp_t\u1ef1_do_c\u1ee7a_T\u1ed5_qu\u1ed1c","\u0111\u1ed9c_l\u1eadp_t\u1ef1_do_c\u1ee7a_T\u1ed5_qu\u1ed1c","T\u1ed5_qu\u1ed1c","m\u1ed9t_li\u1ec7t_s\u0129_b\u00ecnh_th\u01b0\u1eddng_nh\u01b0_h\u00e0ng_ng\u00e0n_ng\u01b0\u1eddi_l\u00ednh_\u0111\u00e3_hi_sinh_nay_v\u1eabn_ch\u01b0a_t\u00ecm_th\u1ea5y_th\u00e2n_x\u00e1c","h\u00e0ng_ng\u00e0n_ng\u01b0\u1eddi_l\u00ednh_\u0111\u00e3_hi_sinh_nay_v\u1eabn_ch\u01b0a_t\u00ecm_th\u1ea5y_th\u00e2n_x\u00e1c","anh","c\u00e2u_chuy\u1ec7n_ch\u00e2n_th\u1ef1c_v\u00e0_\u0111\u1ea7y_thuy\u1ebft_ph\u1ee5c_v\u1ec1_m\u1ed9t_th\u1ebf_h\u1ec7","m\u1ed9t_th\u1ebf_h\u1ec7","l\u00fd_t\u01b0\u1edfng","m\u1ed9t_c\u00e1ch_\u0111\u1ea7y_l\u00e3ng_m\u1ea1n","m\u1ecdi_n\u0103m","\u0111\u00e0i_t\u01b0\u1edfng_ni\u1ec7m_Th\u00e0nh_C\u1ed5_Qu\u1ea3ng_Tr\u1ecb","Th\u00e0nh_C\u1ed5_Qu\u1ea3ng_Tr\u1ecb","h\u00f4m_\u1ea5y","gi\u00f3_L\u00e0o","\u0111\u00e0i_t\u01b0\u1edfng_ni\u1ec7m","l\u1eeda_ng\u1ecdn","m\u1ed9t_nghi_l\u1ec5_thi\u00eang_li\u00eang","ng\u00e0y_n\u00e0y","h\u01b0\u01a1ng","\u0111\u00e0i","hai_ch\u1ecb_em_g\u00e1i_qu\u00ea_t\u1eadn_Qu\u1ea3ng_B\u00ecnh","qu\u00ea_t\u1eadn_Qu\u1ea3ng_B\u00ecnh","Qu\u1ea3ng_B\u00ecnh","ng\u01b0\u1eddi_anh_trai_ng\u00e3_xu\u1ed1ng_\u1edf_v\u00f9ng_\u0111\u1ea5t_n\u00e0y","v\u00f9ng_\u0111\u1ea5t_n\u00e0y","gi\u1edd","h\u00e0ng_ng\u00e0n_cu\u1ed9c_ki\u1ebfm_t\u00ecm_nh\u01b0_v\u1eady","ng\u01b0\u1eddi_anh_trai","hai_ng\u01b0\u1eddi_ph\u1ee5_n\u1eef_t\u00f4i_g\u1eb7p_trong_bu\u1ed5i_s\u00e1ng_27_-_7_tr\u00ean_\u0111\u00e0i_t\u01b0\u1edfng_ni\u1ec7m_Th\u00e0nh_C\u1ed5_Qu\u1ea3ng_Tr\u1ecb","bu\u1ed5i_s\u00e1ng_27_-_7","\u0111\u00e0i_t\u01b0\u1edfng_ni\u1ec7m_Th\u00e0nh_C\u1ed5_Qu\u1ea3ng_Tr\u1ecb","Th\u00e0nh_C\u1ed5_Qu\u1ea3ng_Tr\u1ecb","nh\u1eefng_cu\u1ed9c_ki\u1ebfm_t\u00ecm_kh\u00e1c","t\u00fai_x\u00e1ch","m\u1ed9t_ng\u01b0\u1eddi_l\u00ednh_tr\u1ebb_,_anh_l\u00e0_Nguy\u1ec5n_K\u1ef3_S\u01a1n","anh_l\u00e0_Nguy\u1ec5n_K\u1ef3_S\u01a1n","Nguy\u1ec5n_K\u1ef3_S\u01a1n","gia_\u0111\u00ecnh","khi_anh_hi_sinh","Tr\u01b0\u1eddng_\u0111\u1ea1i_h\u1ecdc_Th\u1ee7y_l\u1ee3i_H\u00e0_N\u1ed9i","H\u00e0_N\u1ed9i","\u0111\u1ee3t_\u0111\u1ed9ng_vi\u00ean_n\u0103m_1972","li\u1ec7t_s\u0129_Nguy\u1ec5n_K\u1ef3_S\u01a1n","h\u01a1n_30_n\u0103m","nh\u1eefng_d\u00f2ng_ch\u1eef_r\u1eafn_r\u1ecfi_c\u1ee7a_m\u1ed9t_sinh_vi\u00ean_,_vi\u1ebft_gi\u1eefa_\u0111\u1ea1n_bom_\u00e1c_li\u1ec7t_,_kho\u1ea3ng_l\u1eb7ng_gi\u1eefa_hai_tr\u1eadn_\u0111\u00e1nh","m\u1ed9t_sinh_vi\u00ean","\u0111\u1ea1n_bom_\u00e1c_li\u1ec7t","\u0111\u1ea1n_bom_\u00e1c_li\u1ec7t_,_kho\u1ea3ng_l\u1eb7ng_gi\u1eefa_hai_tr\u1eadn_\u0111\u00e1nh","kho\u1ea3ng_l\u1eb7ng_gi\u1eefa_hai_tr\u1eadn_\u0111\u00e1nh","hai_tr\u1eadn_\u0111\u00e1nh","g\u1ea7n_30_b\u00e0i_th\u01a1_anh_vi\u1ebft_khi_\u0111ang_hu\u1ea5n_luy\u1ec7n_\u1edf_h\u1eadu_ph\u01b0\u01a1ng","h\u1eadu_ph\u01b0\u01a1ng","nh\u1eefng_trang_nh\u1eadt_k\u00fd_vi\u1ebft_trong_bom_\u0111\u1ea1n","bom_\u0111\u1ea1n","\u00c1i_T\u1eed_,_m\u1ed9t_tr\u1eadn_\u0111\u1ecba_n\u1eb1m_kh\u00f4ng_xa_Th\u00e0nh_C\u1ed5","m\u1ed9t_tr\u1eadn_\u0111\u1ecba_n\u1eb1m_kh\u00f4ng_xa_Th\u00e0nh_C\u1ed5","Th\u00e0nh_C\u1ed5","ti\u1ebfng_m\u00e1y_bay","c\u00e1i_gi\u00f3_nam_c\u1ee7a_th\u00e1ng_b\u1ea3y","c\u00e1i_gi\u00f3_nam_c\u1ee7a_th\u00e1ng_b\u1ea3y_,_c\u00e1i_r\u1ef1c_v\u00e0ng_c\u1ee7a_nh\u1eefng_tia_n\u1eafng_\u0111\u1ea7u_nh\u1eefng_ng\u00e0y_m\u01b0a","th\u00e1ng_b\u1ea3y","c\u00e1i_r\u1ef1c_v\u00e0ng_c\u1ee7a_nh\u1eefng_tia_n\u1eafng_\u0111\u1ea7u_nh\u1eefng_ng\u00e0y_m\u01b0a","nh\u1eefng_tia_n\u1eafng_\u0111\u1ea7u_nh\u1eefng_ng\u00e0y_m\u01b0a","nh\u1eefng_ng\u00e0y_m\u01b0a","tr\u1eadn_m\u01b0a_\u0111\u00eam_qua","\u0111\u00eam_qua","ph\u00fat_gi\u00e2y_ng\u1eafn_ng\u1ee7i_thanh_b\u00ecnh_n\u00e0y","\u0111\u00e2y","b\u1ea7u_tr\u1eddi_qu\u00ea_ta","kho\u1ea3ng_xanh_\u1ea5y","tu\u1ed5i_tr\u1ebb_c\u1ee7a_ta","ta","\u01b0\u1edbc_m\u01a1_c\u1ee7a_ta","ta","m\u00e0u_xanh_n\u00e0y","m\u00e0u_xanh_t\u01b0\u01a1ng_lai","t\u01b0\u01a1ng_lai","m\u00e0u_xanh_m\u00e0_ta_ph\u1ea3i_tranh_\u0111\u1ea5u","bom_\u0111\u1ea1n_t\u01b0\u1edfng_ch\u1eebng_nh\u01b0_kh\u00f4ng_bao_gi\u1edd_d\u1ee9t","th\u1ebf_n\u00e0y","bao_nhi\u00eau","nh\u1eefng_ng\u01b0\u1eddi_l\u00ednh_tr\u1ebb","\u0111\u00e3_7_gi\u1edd_t\u1ed1i","ti\u1ebfng_m\u00e1y_bay_M\u1ef9","m\u00e1y_bay_M\u1ef9","M\u1ef9","ti\u1ebfng_\u0111\u1ea1i_b\u00e1c_\u0111\u00ec_\u0111\u00f9ng","kho\u1ea3ng_c\u00e1ch_th\u1eddi_gian_gi\u1eefa_nh\u1eefng_tr\u1eadn_B_.52_,_nh\u1eefng_tr\u1eadn_ph\u00e1o_k\u00edch","nh\u1eefng_tr\u1eadn_B_.52","nh\u1eefng_tr\u1eadn_ph\u00e1o_k\u00edch","m\u00ecnh_t\u00f4i","m\u1ed9t_ng\u1ecdn_\u0111\u00e8n","h\u00e0ng_tr\u0103m_ch\u00fa_mu\u1ed7i","t\u00f4i","th\u1ebf_n\u00e0y","vi\u1ec7c_b\u1eaft_mu\u1ed7i_b\u1eb1ng_ng\u1ecdn_\u0111\u00e8n_l\u00e0m_b\u1eb1ng_v\u1ecf_h\u1ed9p_Coca_Cola_M\u1ef9","ng\u1ecdn_\u0111\u00e8n_l\u00e0m_b\u1eb1ng_v\u1ecf_h\u1ed9p_Coca_Cola_M\u1ef9","v\u1ecf_h\u1ed9p_Coca_Cola_M\u1ef9","ng\u1ecdn_\u0111\u00e8n_\u0111\u1ea7y_mu\u1ed9i_\u0111en","mu\u1ed9i_\u0111en","OV_.10_n\u00e0y"];
    _arrGroup=[];
    modify();
    subGroup(_indexStart,_indexEnd);
    console.log(belongGroup[1].length);
    // console.log(_arrDt)
    // _words=contentFile.split(" ");
    var slG=-1;
    for (var i = 0; i < _arrGroup.length; i++) {

        if(_arrGroup[i]>=0){_visitted[i]=1}
        if(_arrGroup[i]>slG){slG++}
    }
    _maxG=slG;

    for (var i = 0; i <= slG; i++) {
        createNewGroup();
    }
    var s = highlight(_arrayID,_arrDt,_indexStart,_indexEnd,"","100%");
    document.getElementById('left_p').innerHTML=s;
    // document.getElementsByClassName('daitu').style.fontSize="100%";
    _save=1;
    thongbaoNhom();
    for(var i=0; i<_arrayID.length;i++){
        if(_arrGroup[i]==-1){
            document.getElementById(_arrayID[i]).style.fontSize="20px";
        }
    }


    for (var i = 0; i <=_arrDt.length; i++) {
        if(_arrGroup[i]>=0){
            var dt=document.getElementById(_arrayID[i]);
            chuyenDaiTuSangNhom(i,dt,_arrGroup[i]);
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
        // //                   0   1   2   3   4  5   6   7    8    9   10   11  12   13
        // var arrIndexStart =[0,2,2,5,10,13];
        // var arrIndexEnd =  [0,3,2,6,11,13];

        // arrGroup=           [-1,1,0,-1,1,-1];
        // _words=contentFile.split(" ");
        // console.log(_words[0])
        // update(arrayID,arrDaiTu,arrIndexStart,arrIndexEnd,arrGroup,contentFile);
        update();
        // console.log(_words);

        // alert("Nhom dang chon: "+_idG+", SL nhom: "+_idAuto);
    }

}


var token = 'gPYRGwiK7lLGxtRTbCQu7OjLsZxjexvWgvDQsMJu'
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
@stop