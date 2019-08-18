/*
This script is identical to the above JavaScript function.
*/
var ct = 1;
var ct2 = 1;
function new_link()
{
    ct++;
    var div1 = document.createElement('div');
    div1.id = ct;
    // link to delete extended form elements
    var delLink = '<div class="text-right"><a class="btn_red drug" href="javascript:delIt('+ ct +')"><img src="/images/delete.svg" alt="aaa">Удалить</a></div>';
    div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
    document.getElementById('newlink').appendChild(div1);
}
function new_link2()
{
    ct2++;
    var div1 = document.createElement('div');
    div1.id = ct2;
    // link to delete extended form elements
    var delLink = '<a class="forget_pass" href="javascript:delItt('+ ct2 +')">Удалить</a>';
    div1.innerHTML ='<div><div class="row"><div class="col-lg-10 col-sm-9">' + document.getElementById('newlinktpl2').innerHTML + '<div class="col-lg-2 col-sm-3">' + delLink + '</div></div></div></div>';
    document.getElementById('newlink2').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink');
    parentEle.removeChild(ele);
}

function delItt(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink2');
    parentEle.removeChild(ele);
}
function del_link(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink2');
    parentEle.removeChild(ele);
}

