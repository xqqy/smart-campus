"use strict";
//设置
var php = "upload.php",
//php文件存放位置
pkgsize = 200 * 1024,
//单个包文件大小，默认为200K，单位字节
max = 100 * 1024 * 1024; //文件最大大小

//需要用到的全局变量
var pkgnum = 0,
//包的数量
docsize, //源文件大小
docname, //源文件名称
doctype, //源文件后缀名
speed, //当前发送一个包的速度
pkgstart = 0,
//发送当前包头
message = document.getElementById("message"),
//输出框框
doc; //文件指针
function init() {
    var $con = document.getElementById("submit").value;
    if ($con == "开始上传" ? true: false) {
        message.innerHTML = message.innerHTML + "开始获取上传任务"
        //开始上传任务
        //document.getElementById("upload_form").submit();

        if (document.forms["upload_form"]["file"].files.length <= 0) {
            alert("请先选择文件，然后再点击上传");
            return;
        }

        //收集文件信息
        doc = document.forms["upload_form"]["file"].files[0];

        docname = doc.name;
        docsize = doc.size;
        doctype = /\.[^\.]+/.exec(document.getElementById("file").value);
        message.innerHTML = message.innerHTML + "<br />文件名称是：" + docname + " ";
        message.innerHTML = message.innerHTML + "文件大小是：" + docsize + "字节 ";
        message.innerHTML = message.innerHTML + "文件后缀名是：" + doctype + " ";
        message.innerHTML = message.innerHTML + "<br />文件信息获取完成";
        if (docsize > max) {
            alert("文件过大");
        }
        else if(doctype == ".exe" || doctype == ".php") {
            alert("不能上传这种格式，请压缩")
        } 
        else{
            both();
            return;
        }
    }
}

function endupload() {
    message.innerHTML = message.innerHTML + "<br />尝试关闭连接";

    var xhre = new XMLHttpRequest();
    xhre.open("POST", php, true); //后台php路径
    xhre.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhre.send("job=ending&docname=" + docname);

    xhre.onreadystatechange = function() {
        if (xhre.readyState == 4 && xhr.status == 200) {
            if (xhre.responseText == "deldone" ? true: false) {
                message.innerHTML = message.innerHTML + "<br />关闭连接成功";
                return;
            }
        }
    }
}

function push() {
    message.innerHTML = message.innerHTML + "<br />开始连接服务器";
    pkgnum = (docsize - docsize % pkgsize) / pkgsize;

    message.innerHTML = message.innerHTML + "<br />分割包总数为" + (pkgnum+1);
    var now = 0;
    while (now <= pkgnum) {
        var timestamp1 = new Date().getTime();

        var slice = doc.slice(pkgstart, pkgstart + pkgsize);
        pkgstart = pkgstart + pkgsize;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", php, true); //后台php路径
        var post = new FormData();
        post.append("pkg", slice);
        post.append("docname", docname);
        post.append("job", "uploading");
        post.append("pkgnumic", now);
        post.append("pkgnum", pkgnum);
        xhr.send(post);

        document.getElementById("speed").innerHTML = "已发送/总共包:" + (now+1) + "/" + (pkgnum+1);
        document.getElementById("lefttime").innerHTML = "单个包上传速度:" + (new Date().getTime() - timestamp1);
        now++;

    }
    if (now > pkgnum) {
        message.innerHTML = message.innerHTML + "<br />上传完成";
        check();
        return;
    }
}

function ping() {
    message.innerHTML = message.innerHTML + "<br />开始连接服务器";
    var xhrp = new XMLHttpRequest();
    xhrp.open("POST", php, true); //后台php路径
    xhrp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrp.send("job=ping");
    xhrp.onreadystatechange = function() {
        if (xhrp.readyState == 4 && xhrp.status == 200) {
            if (xhrp.responseText == "pingdone" ? true: false) {
                message.innerHTML = message.innerHTML + "<br />服务器连接成功";
                return;
            }
        }
    }
}

function check(){
    var xhrc=new XMLHttpRequest();
    xhrc.open("POST", php, true);
    xhrc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrc.send("job=check&docname="+docname);
    xhrc.onreadystatechange = function() {
        if (xhrc.readyState == 4 && xhrc.status == 200) {
            if (xhrc.responseText == "checkdone" ? true: false) {
                message.innerHTML = message.innerHTML + "<br />服务器接收完成";
                return;
            }
            else{
                message.innerHTML = message.innerHTML + "<br />服务器接收未完成";
                return;
            }
        }
    }
}

function both(){
    var xhrb=new XMLHttpRequest();
    xhrb.open("POST", php, true);
    xhrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrb.send("job=both&docname="+docname);
    xhrb.onreadystatechange = function() {
    if (xhrb.readyState == 4 && xhrb.status == 200) {
        if (xhrb.responseText == "notboth"?true:false) {
            message.innerHTML = message.innerHTML + "<br />服务器上无重复，开始上传";
            push();
            return;
        }
        else{
            message.innerHTML = message.innerHTML + "<br />服务器上有重复，停止上传";
            return;
        }
}
}
}