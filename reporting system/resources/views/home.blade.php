@extends('layouts.app')
@section('content')
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <script language="JavaScript">
        function NiftyCheck() {
            if (!document.getElementById || !document.createElement)
                return (false);
            isXHTML = /html\:/.test(document.getElementsByTagName('body')[0].nodeName);
            if (Array.prototype.push == null) {
                Array.prototype.push = function () {
                    this[this.length] = arguments[0];
                    return (this.length);
                }
            }
            return (true);
        }

        function Rounded(selector, wich, bk, color, opt) {
            var i, prefixt, prefixb, cn = "r",
                ecolor = "",
                edges = false,
                eclass = "",
                b = false,
                t = false;

            if (color == "transparent") {
                cn = cn + "x";
                ecolor = bk;
                bk = "transparent";
            } else if (opt && opt.indexOf("border") >= 0) {
                var optar = opt.split(" ");
                for (i = 0; i < optar.length; i++)
                    if (optar[i].indexOf("#") >= 0) ecolor = optar[i];
                if (ecolor == "") ecolor = "#666";
                cn += "e";
                edges = true;
            } else if (opt && opt.indexOf("smooth") >= 0) {
                cn += "a";
                ecolor = Mix(bk, color);
            }
            if (opt && opt.indexOf("small") >= 0) cn += "s";
            prefixt = cn;
            prefixb = cn;
            if (wich.indexOf("all") >= 0) {
                t = true;
                b = true
            } else if (wich.indexOf("top") >= 0) t = "true";
            else if (wich.indexOf("tl") >= 0) {
                t = "true";
                if (wich.indexOf("tr") < 0) prefixt += "l";
            } else if (wich.indexOf("tr") >= 0) {
                t = "true";
                prefixt += "r";
            }
            if (wich.indexOf("bottom") >= 0) b = true;
            else if (wich.indexOf("bl") >= 0) {
                b = "true";
                if (wich.indexOf("br") < 0) prefixb += "l";
            } else if (wich.indexOf("br") >= 0) {
                b = "true";
                prefixb += "r";
            }
            var v = getElementsBySelector(selector);
            var l = v.length;
            for (i = 0; i < l; i++) {
                if (edges) AddBorder(v[i], ecolor);
                if (t) AddTop(v[i], bk, color, ecolor, prefixt);
                if (b) AddBottom(v[i], bk, color, ecolor, prefixb);
            }
        }

        function AddBorder(el, bc) {
            var i;
            if (!el.passed) {
                if (el.childNodes.length == 1 && el.childNodes[0].nodeType == 3) {
                    var t = el.firstChild.nodeValue;
                    el.removeChild(el.lastChild);
                    var d = CreateEl("span");
                    d.style.display = "block";
                    d.appendChild(document.createTextNode(t));
                    el.appendChild(d);
                }
                for (i = 0; i < el.childNodes.length; i++) {
                    if (el.childNodes[i].nodeType == 1) {
                        el.childNodes[i].style.borderLeft = "1px solid " + bc;
                        el.childNodes[i].style.borderRight = "1px solid " + bc;
                    }
                }
            }
            el.passed = true;
        }

        function AddTop(el, bk, color, bc, cn) {
            var i, lim = 4,
                d = CreateEl("b");

            if (cn.indexOf("s") >= 0) lim = 2;
            if (bc) d.className = "artop";
            else d.className = "rtop";
            d.style.backgroundColor = bk;
            for (i = 1; i <= lim; i++) {
                var x = CreateEl("b");
                x.className = cn + i;
                x.style.backgroundColor = color;
                if (bc) x.style.borderColor = bc;
                d.appendChild(x);
            }
            el.style.paddingTop = 0;
            el.insertBefore(d, el.firstChild);
        }

        function AddBottom(el, bk, color, bc, cn) {
            var i, lim = 4,
                d = CreateEl("b");

            if (cn.indexOf("s") >= 0) lim = 2;
            if (bc) d.className = "artop";
            else d.className = "rtop";
            d.style.backgroundColor = bk;
            for (i = lim; i > 0; i--) {
                var x = CreateEl("b");
                x.className = cn + i;
                x.style.backgroundColor = color;
                if (bc) x.style.borderColor = bc;
                d.appendChild(x);
            }
            el.style.paddingBottom = 0;
            el.appendChild(d);
        }

        function CreateEl(x) {
            if (isXHTML) return (document.createElementNS('http://www.w3.org/1999/xhtml', x));
            else return (document.createElement(x));
        }

        function getElementsBySelector(selector) {
            var i, selid = "",
                selclass = "",
                tag = selector,
                f, s = [],
                objlist = [];

            if (selector.indexOf(" ") > 0) { //descendant selector like "tag#id tag"
                s = selector.split(" ");
                var fs = s[0].split("#");
                if (fs.length == 1) return (objlist);
                f = document.getElementById(fs[1]);
                if (f) return (f.getElementsByTagName(s[1]));
                return (objlist);
            }
            if (selector.indexOf("#") > 0) { //id selector like "tag#id"
                s = selector.split("#");
                tag = s[0];
                selid = s[1];
            }
            if (selid != "") {
                f = document.getElementById(selid);
                if (f) objlist.push(f);
                return (objlist);
            }
            if (selector.indexOf(".") > 0) { //class selector like "tag.class"
                s = selector.split(".");
                tag = s[0];
                selclass = s[1];
            }
            var v = document.getElementsByTagName(tag); // tag selector like "tag"
            if (selclass == "")
                return (v);
            for (i = 0; i < v.length; i++) {
                if (v[i].className.indexOf(selclass) >= 0) {
                    objlist.push(v[i]);
                }
            }
            return (objlist);
        }

        function Mix(c1, c2) {
            var i, step1, step2, x, y, r = new Array(3);
            if (c1.length == 4) step1 = 1;
            else step1 = 2;
            if (c2.length == 4) step2 = 1;
            else step2 = 2;
            for (i = 0; i < 3; i++) {
                x = parseInt(c1.substr(1 + step1 * i, step1), 16);
                if (step1 == 1) x = 16 * x + x;
                y = parseInt(c2.substr(1 + step2 * i, step2), 16);
                if (step2 == 1) y = 16 * y + y;
                r[i] = Math.floor((x * 50 + y * 50) / 100);
            }
            return ("#" + r[0].toString(16) + r[1].toString(16) + r[2].toString(16));
        }

        window.onload = function () {
            if (!NiftyCheck())
                return;
            checkheight();
            Rounded("div#content", "all", "#f9f8f8", "#f9f8f8", "border #ccc");
            Rounded("div#logo", "all", "#fff", "#fff", "border #ccc");
            Rounded("div#shopper", "all", "#fff", "#fff", "border #ccc");
            document.readerform.login.focus();
        }

        function checkheight() {
            var elem;
            elem = document.getElementById("maintable").offsetHeight;
            elem += 10;
            document.getElementById("important").style.height = elem;
        }
    </script>
    <style type="text/css">
        <!-- body {
            background-color: #FFFFFF;
            height: 100%;
            margin-top: 1px;
        }

        .rtop,
        .artop {
            display: block
        }

        .rtop *,
        .artop * {
            display: block;
            height: 1px;
            overflow: hidden;
            font-size: 1px
        }

        .artop * {
            border-style: solid;
            border-width: 0 1px
        }

        .r1,
        .rl1,
        .re1,
        .rel1 {
            margin-left: 5px
        }

        .r1,
        .rr1,
        .re1,
        .rer1 {
            margin-right: 5px
        }

        .r2,
        .rl2,
        .re2,
        .rel2,
        .ra1,
        .ral1 {
            margin-left: 3px
        }

        .r2,
        .rr2,
        .re2,
        .rer2,
        .ra1,
        .rar1 {
            margin-right: 3px
        }

        .r3,
        .rl3,
        .re3,
        .rel3,
        .ra2,
        .ral2,
        .rs1,
        .rsl1,
        .res1,
        .resl1 {
            margin-left: 2px
        }

        .r3,
        .rr3,
        .re3,
        .rer3,
        .ra2,
        .rar2,
        .rs1,
        .rsr1,
        .res1,
        .resr1 {
            margin-right: 2px
        }

        .r4,
        .rl4,
        .rs2,
        .rsl2,
        .re4,
        .rel4,
        .ra3,
        .ral3,
        .ras1,
        .rasl1,
        .res2,
        .resl2 {
            margin-left: 1px
        }

        .r4,
        .rr4,
        .rs2,
        .rsr2,
        .re4,
        .rer4,
        .ra3,
        .rar3,
        .ras1,
        .rasr1,
        .res2,
        .resr2 {
            margin-right: 1px
        }

        .rx1,
        .rxl1 {
            border-left-width: 5px
        }

        .rx1,
        .rxr1 {
            border-right-width: 5px
        }

        .rx2,
        .rxl2 {
            border-left-width: 3px
        }

        .rx2,
        .rxr2 {
            border-right-width: 3px
        }

        .re2,
        .rel2,
        .ra1,
        .ral1,
        .rx3,
        .rxl3,
        .rxs1,
        .rxsl1 {
            border-left-width: 2px
        }

        .re2,
        .rer2,
        .ra1,
        .rar1,
        .rx3,
        .rxr3,
        .rxs1,
        .rxsr1 {
            border-right-width: 2px
        }

        .rxl1,
        .rxl2,
        .rxl3,
        .rxl4,
        .rxsl1,
        .rxsl2,
        .ral1,
        .ral2,
        .ral3,
        .ral4,
        .rasl1,
        .rasl2 {
            border-right-width: 0
        }

        .rxr1,
        .rxr2,
        .rxr3,
        .rxr4,
        .rxsr1,
        .rxsr2,
        .rar1,
        .rar2,
        .rar3,
        .rar4,
        .rasr1,
        .rasr2 {
            border-left-width: 0
        }

        .r4,
        .rl4,
        .rr4,
        .re4,
        .rel4,
        .rer4,
        .ra4,
        .rar4,
        .ral4,
        .rx4,
        .rxl4,
        .rxr4 {
            height: 2px
        }

        .rer1,
        .rel1,
        .re1,
        .res1,
        .resl1,
        .resr1 {
            border-width: 1px 0 0;
            height: 0px !important;
            height/**/
            : 1px
        }

        div#content {
            width: 200px;
            min-hegiht: 100%;
            background: #f9f8f8;
        }

        div#logo {
            float: left;
            width: 500px;
            height: auto;
            background: #ffffff;
        }

        div#shopper {
            float: left;
            width: 500px;
            height: auto;
            background: #ffffff;
        }

        .style1 {
            font-family: "Myriad Pro", Verdana, serif;
            font-size: 16px;
        }

        .style2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .style3 {
            font-size: 12px;
            color: #003399;
        }

        .style4 {
            font-size: 18px
        }

        .style5 {
            font-family: "Myriad Pro", Verdana, serif;
            font-size: 12px;
        }

        .style7 {
            color: #FF0000
        }

        .style8 {
            font-family: "Myriad Pro", Verdana, serif
        }

        A {
            TEXT-DECORATION: none;
            COLOR: #000080;
        }

        A:hover {
            COLOR: #FF0000;
            TEXT-DECORATION: underline;
        }

        A:visited {
            COLOR: #000080;
            text-decoration: none;
        }

        .input {
            width: 130px
        }

        input.submit:hover {
            color: blue;
        }

        h1 {
            font-family: Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
            color: #003399;
            letter-spacing: -1px;
            margin: 0;
        }

        #gloLink {
            float: right;
            font: Icon;
            font-size: 11px;
            margin-right: 0px;
            color: #BBBBBB;
        }

        html>body>table #gloLink {
            float: right;
            font: Icon;
            font-size: 11px;
            margin-right: 8px;
        }

        #gloLink img {
            vertical-align: middle;
            border: none 0px;
        }

        -->
    </style>
</head>

<body>

    <table style="width: 730px;" ID="Table1" align="center">
        <tr>
            <td style="width: 730px;">
                <!--	Adds language picker:	-->
                <script src="/document/globalization/GlobalizationSelectLanguage.asp" type="text/javascript"></script>
            </td>
        </tr>
    </table>
    <table width="730" border="0" align="center" cellpadding="0" cellspacing="0" height="5" id="maintable">
        <tr>
            <td>&nbsp;</td>
            <td>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td valign="top">
  <div align="left" id="logo">
                    <div align="center">
                        <img src="C:\Users\Amani Kooli\Pictures/by.png" height="50%" width="50%">
                    </div>
                </div>
		   <div align="left" style="margin-top:20px" id="shopper">
                    <div style="height:70px; padding-left:50px; padding-top:20px;" align="left" valign="middle">
                        <a href="shopperSignup.asp" class="style3 style4">
                            <span class="style8">
                               Become a shopper
                            </span>
                        </a>
                        <br />
                        <span style="margin-top:10px" class="style5">
                            S&#39;il vous plaît suivez le lien ci-dessus pour terminer votre enregistrement
                        </span>
                        <br>
                    </div>
                </div>
            </td>
            <td height="100%" valign="top">
                <div id="content">
                    <div style="width:auto;" id="important">
                        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top">
                                    <form name="readerform" id="readerform" method="post" action="loginProcess.asp">
                                        <table width="130" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <div style="padding-bottom:10px; padding-top:10px">
                                                        <h1>
                                                            Identifiez-vous:</h1>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="style2">
                                                        E-mail ou nom d&#39;utilisateur:</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="padding-top:3px" align="left">
                                                        <input name="login" type="text" tabindex="1" class="input" id="login3" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="padding-top:10px">
                                                        <span class="style2">
                                                            Mot de passe: </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="padding-top:3px" align="left">
                                                        <input name="password" type="password" tabindex="2" class="input" id="password3" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top">
                                                    <div style="padding-top:5px" align="right">
                                                        <input name="B1" type="submit" class="submit" tabindex="3" id="B13" value="Login" />
                                                        <br />
                                                        <hr align="right" width="60%" />
                                                        <div align="right" class="style1 style3">
                                                            <br>
                                                            <a href="ForgotPassword.asp">
                                                                Mot de passe oublié?</a>
                                                            <br>
                                                            <div align="center">
                                                                <span class="style7">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>


@endsection
