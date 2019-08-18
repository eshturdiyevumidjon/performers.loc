/*
This script is identical to the above JavaScript function.
*/
var ct = 1;
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
// function to delete the newly added set of elements
function delIt(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
    var parentEle = d.getElementById('newlink');
    parentEle.removeChild(ele);
}