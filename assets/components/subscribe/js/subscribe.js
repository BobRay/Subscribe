//<![CDATA[
/* minified jsonParse function from json-sans-eval Google code */
/* if you don't want to support IE7, you can eliminate this and use
 * JSON.parse() in the checkForm() function
 */
window.jsonParse=function(){var r="(?:-?\\b(?:0|[1-9][0-9]*)(?:\\.[0-9]+)?(?:[eE][+-]?[0-9]+)?\\b)",k='(?:[^\\0-\\x08\\x0a-\\x1f"\\\\]|\\\\(?:["/\\\\bfnrt]|u[0-9A-Fa-f]{4}))';k='(?:"'+k+'*")';var s=new RegExp("(?:false|true|null|[\\{\\}\\[\\]]|"+r+"|"+k+")","g"),t=new RegExp("\\\\(?:([^u])|u(.{4}))","g"),u={'"':'"',"/":"/","\\":"\\",b:"\u0008",f:"\u000c",n:"\n",r:"\r",t:"\t"};function v(h,j,e){return j?u[j]:String.fromCharCode(parseInt(e,16))}var w=new String(""),x=Object.hasOwnProperty;return function(h,
j){h=h.match(s);var e,c=h[0],l=false;if("{"===c)e={};else if("["===c)e=[];else{e=[];l=true}for(var b,d=[e],m=1-l,y=h.length;m<y;++m){c=h[m];var a;switch(c.charCodeAt(0)){default:a=d[0];a[b||a.length]=+c;b=void 0;break;case 34:c=c.substring(1,c.length-1);if(c.indexOf("\\")!==-1)c=c.replace(t,v);a=d[0];if(!b)if(a instanceof Array)b=a.length;else{b=c||w;break}a[b]=c;b=void 0;break;case 91:a=d[0];d.unshift(a[b||a.length]=[]);b=void 0;break;case 93:d.shift();break;case 102:a=d[0];a[b||a.length]=false;
b=void 0;break;case 110:a=d[0];a[b||a.length]=null;b=void 0;break;case 116:a=d[0];a[b||a.length]=true;b=void 0;break;case 123:a=d[0];d.unshift(a[b||a.length]={});b=void 0;break;case 125:d.shift();break}}if(l){if(d.length!==1)throw new Error;e=e[0]}else if(d.length)throw new Error;if(j){var p=function(n,o){var f=n[o];if(f&&typeof f==="object"){var i=null;for(var g in f)if(x.call(f,g)&&f!==n){var q=p(f,g);if(q!==void 0)f[g]=q;else{i||(i=[]);i.push(g)}}if(i)for(g=i.length;--g>=0;)delete f[i[g]]}return j.call(n,
o,f)};e=p({"":e},"")}return e}}();

function emailCheck(emailStr) {

    var checkTLD = 1;
    var knownDomsPat = /^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
    var emailPat = /^(.+)@(.+)$/;
    var specialChars = "\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
    var validChars = "\[^\\s" + specialChars + "\]";
    var quotedUser = "(\"[^\"]*\")";
    var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
    var atom = validChars + '+';
    var word = "(" + atom + "|" + quotedUser + ")";
    var userPat = new RegExp("^" + word + "(\\." + word + ")*$");
    var domainPat = new RegExp("^" + atom + "(\\." + atom + ")*$");
    var matchArray = emailStr.match(emailPat);

    if (matchArray == null) {
        return false;
    }
    var user = matchArray[1];
    var domain = matchArray[2];

    for (i = 0; i < user.length; i++) {
        if (user.charCodeAt(i) > 127) {
            return false;
        }
    }
    for (i = 0; i < domain.length; i++) {
        if (domain.charCodeAt(i) > 127) {

            return false;
        }
    }
    if (user.match(userPat) == null) {

        return false;
    }
    var IPArray = domain.match(ipDomainPat);
    if (IPArray != null) {
        for (var i = 1; i <= 4; i++) {
            if (IPArray[i] > 255) {
                return false;
            }
        }
        return true;
    }
    var atomPat = new RegExp("^" + atom + "$");
    var domArr = domain.split(".");
    var len = domArr.length;
    for (i = 0; i < len; i++) {
        if (domArr[i].search(atomPat) == -1) {
            return false;
        }
    }
    if (checkTLD && domArr[domArr.length - 1].length != 2 &&
        domArr[domArr.length - 1].search(knownDomsPat) == -1) {
        return false;
    }
    if (len < 2) {
        return false;
    }

    return true;
}
function checkform(form) {
    var a = form['interests[]'];
    var u = form['unsubscribe'];
    var lex = document.getElementById('sbs_js_lexicon').innerHTML;

    //var lex = '{"String1":"value1","String2":"value2","String3":"value3"}';
    //var lexArray = JSON.parse(lex);
    var lexArray = jsonParse(lex);
    if (u) {
        if (u.checked) {
            return true;
        }
    }
    var register = form.username;
    if (register) {
        if (form.username.value == "") {
            alert(lexArray.sbs_js_username_required);
            form.username.focus();
            return false;
        }
        if (form.username.value.length < 6) {
            alert(lexArray.sbs_js_username_too_short);
            form.username.focus();
            return false;
        }
        if (form.password.value == "") {
            alert(lexArray.sbs_js_password_required);
            form.password.focus();
            return false;
        }
        if (form.password.value.length < 6) {
            alert(lexArray.sbs_js_password_too_short);
            form.password.focus();
            return false;
        }
        if (form.password_confirm.value != form.password.value) {
            alert(lexArray.sbs_js_password_mismatch);
            form.password.focus();
            return false;
        }
        if (form.fullname.value == "") {
            alert(lexArray.sbs_js_fullname_required);
            form.fullname.focus();
            return false;
        }
        if (form.email.value == "") {
            alert(lexArray.sbs_js_email_required);
            form.email.focus();
            return false;
        }
        if (emailCheck(form.email.value) == false) {
            alert(lexArray.sbs_js_bad_email);
            form.email.focus();
            return false;
        }
    }

    //alert('Length:'+a.length);
    var p = 0;
    for (i = 0; i < a.length; i++) {
        if (a[i].checked) {
            //alert(a[i].value);
            p = 1;
        }
    }
    if (p == 0) {
        alert(lexArray.sbs_js_interests_required);
        return false;
    }
    return true;
}
//]]>




