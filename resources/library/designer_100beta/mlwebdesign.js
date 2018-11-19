//
//  Mlweb designer script  (editor)
//
//       v 1.00b, Aug 14, 2008    
//		
//
//     (c) 2003-2008 Martijn C. Willemsen and Eric J. Johnson 
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


function abc_num(str)
{
// convert character to number
out=str.toUpperCase().charCodeAt(0)-65;
return out
}

function repl_sep(a)   
{
// encode separators ^ and ` into HTML code tags 
a=a.replace(/[\x5E]/gi, "&#94;");
a=a.replace(/[\x60]/gi, "&#96;");
return a;
}

function fac(x)
{
// Faculty: x!=x(x-1)...1
var outp=1;
for (var i=1; i<=x; i++)
{outp=outp*i}
return outp
}

function ExpMatrix(M)
{ 
// expand string into data matrix
// ^ is column split, ` is row split
var Mrows=M.split("`");

var outM = new Array();
for (rowcount=0;rowcount<Mrows.length;rowcount++)
	{
	outM[rowcount]=Mrows[rowcount].split("^")
	}
return outM;
}

function ExpRow(M)
{ 
// expand string into data vectors
// ^ is column split

var outM = new Array();
outM = M.split("^") 
return outM;
}

function swapArrayElem(a, col1, col2)
{
// sway two elements of an array
var temp = a[col1];
a[col1] = a[col2];
a[col2] = temp;
}

function copyOfArray(carray)
{
// duplicate the array 
var out = new Array();
for (var i=0;i<carray.length;i++)
{out[i]=carray[i]}
return out
}

function swapArray(array1, array2)
{
// sway two arrays 
var temp = new Array();
temp = copyOfArray(array1);
array1 = copyOfArray(array2);
array2 = copyOfArray(temp);
}

function cHTML(a)
{
a=a.replace(/[<]/gi, "&lt;")
a=a.replace(/[>]/gi, "&gt;")
//a=a.replace(/[\n]/gi, "<BR>")
return a
}

function CountBal(subjnr, num)
{
// counterbalance based on subj number. 
// first subject is 0
// Num is number of options to counterbalance
// (number of orders is Num!)

var numOrd=fac(num);
start = subjnr - numOrd*Math.floor((subjnr-1)/numOrd)

orderstr=""
for (var i=0;i<num;i++)
{orderstr+=i.toString()}

outstr=""
for (var i=num; i>0; i--)
{
var den=fac(i-1);
pos = Math.floor((start-1)/den)+1
outstr+=orderstr.charAt(pos-1)+","
orderstr = orderstr.substring(0,pos-1)+orderstr.substr(pos)
start=start-(pos-1)*den
}
outstr=outstr.substr(0,outstr.length-1)
return outstr.split(",")
}

if (document.getElementById)  
	{
	// IE6/NS6>/Mozilla
	IE6_moz=true;
	IE4_5=false;
	}
else if (document.all)
	{
	IE6_moz=false;
	IE4_5=true;
	}

// insert function to insert text in textarea
// from phpMyAdmin
function insertAtCursor(myField, myValue) 
	{
	//IE support
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
		}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
		} 
		else {
		myField.value += myValue;
		}
}

function scaleDef(name, num_points, showValues, capture, width, value, label)
{ // scale object used for storing scale data
this.name=name
this.num_points = num_points
this.showValues = showValues
this.capture = capture
this.width = width
this.value = value
this.label = label
}
scale = new scaleDef();
scale.value = new Array();
scale.label = new Array();
scale.name = "";
scale.num_points = 0;
scale.capture = false;

function choiceDef(name, num_options, capture, value, label, type)
{
this.name = name
this.num_options = num_options
this.capture = capture
this.value = value
this.label = label
this.type = type
}

choice = new choiceDef();
choice.name="";
choice.num_options = 0;
choice.value = new Array();
choice.label = new Array();
choice.capture = false;

function chkConnects()
{

cf=new Array()  // position of fixed cols
c1=new Array()  // position of c1 cols

for (var i=0; i<colType.length; i++)
	{
	switch (parseInt(colType[i]))
		{ 
		case 0: cf[cf.length]=i;break;
		case 1: c1[c1.length]=i;break;
		}
	}

rf=new Array()  // position of fixed rows
r1=new Array()  // position of c1 rows

for (var i=0; i<rowType.length; i++)
	{
	switch (parseInt(rowType[i]))
		{ 
		case 0: rf[rf.length]=i;break;
		case 1: r1[r1.length]=i;break;
		}
	}

// subjDen is the denominator used to devide the subj number for each counterbalance step

subjDen = 1;   

// first determine column and row connects and switch on that


var numCond = (c1.length>0 ? fac(c1.length) : 1)*(r1.length>0 ? fac(r1.length) : 1);

return numCond;
}

// Set default values
activeRow = -1;
activeCol = -1;

colType = new Array();
rowType = new Array();
colWidth = new Array();
rowHeight = new Array();

CBcolList = new Array();
CBrowList = new Array();

txtM = new Array();
txtM[0]= new Array();

boxM = new Array();
boxM[0]= new Array();

stateM = new Array();
stateM[0]=new Array();

tagM = new Array();
tagM[0]=new Array();

globalshown=false;
globalEdit = 2;  // which part to edit

btnFlg = 0; // 0 is no buttons, 1 is col buttons, 2 is row buttons
btnTxt = new Array();
btnState = new Array();
btnTag = new Array();
btnType = "radio";

masterCond = 1;
nextURL = "thanks.html";
expname = "";
to_email = "";
mlweb_outtype = "";
mlweb_fname = "";
randomOrder = false;

defaultWidth= 100;
defaultHeight = 50;

colFix = false;
rowFix = false;
CBpreset = false;


tmActive = false;
//default values (not used, only for initialization)
// actual defaults are layer in start.html 
tmTotalSec = 60;
tmStepSec = 1;
tmShowTime = true;
tmFill = true;
tmDirectStart = true;
tmWidthPx = 200;
tmMinLabel = "min";
tmSecLabel = "sec";
tmLabel = "Timer: ";
tmPos = 0;

preHTML = "";
postHTML = "";
windowName = "MouselabWEB Survey";
submitName = "Next Page";
warningTxt = "Some questions have not been answered. Please answer all questions before continuing!";

chkFrm = false;

evtOpen = 0;  // default value for open event 0=mouseover, 1=click
evtClose = 0; // default value for close event 0=mouseout, 1=click, 2=none (box stays open)

undo1="";
undo2="";
function changeEvents(formlink)
{
if (formlink.openEvent.selectedIndex) {evtOpen = formlink.openEvent.selectedIndex;} else evtOpen=0;
if (formlink.closeEvent.selectedIndex) {evtClose = formlink.closeEvent.selectedIndex;} else evtClose=0;
}

function addCol(formlink)
{ //adds a column  to the Table
saveFields();

if (formlink.colnum.value == "new")
	{ // add new column at the end
			newcolnum = colType.length;
			activeCol = newcolnum;
			if (btnFlg==1) {btnTxt[newcolnum]="";btnTag[newcolnum]="btn"+(newcolnum+1).toString();btnState[newcolnum]="1";}
			colType[newcolnum]=0; 
		    colWidth[newcolnum]= defaultWidth;
			if (rowType.length>0)
				{
				for (var i=0;i<txtM.length;i++)
					{
					boxM[i][newcolnum]="";
					txtM[i][newcolnum]="";
					tagM[i][newcolnum]=String.fromCharCode(i+97)+newcolnum.toString();
					stateM[i][newcolnum]="1";
					}
				}
	}	
			else
	{
	//change current column
	var colnum = parseInt(formlink.colnum.value);
	var colins = parseInt(formlink.colinsert.value);
	colType[colnum]=formlink.coltype.value; 
    colWidth[colnum]=isNaN(parseInt(formlink.colwidth.value)) ? defaultWidth : parseInt(formlink.colwidth.value);
	swapArrayElem(colType, colnum, colins);
	swapArrayElem(colWidth, colnum, colins);
	if (btnFlg==1)
		{
		swapArrayElem(btnTxt, colnum, colins);
		swapArrayElem(btnState, colnum, colins);
		swapArrayElem(btnTag, colnum, colins);
		}
			for (var i=0;i<txtM.length;i++)
				{
				swapArrayElem(boxM[i], colnum, colins);
				swapArrayElem(txtM[i], colnum, colins);
				swapArrayElem(tagM[i], colnum, colins);
				swapArrayElem(stateM[i], colnum, colins);
				}
	activeCol=colins; // switch to changed column
	}
	
	refreshTable();
}

function addRow(formlink)
{ // adds a row to the Table
saveFields();

if (formlink.rownum.value == "new")
	{
	// add new column at the end
	newrownum = rowType.length;
	rowType[newrownum]=0; 
	if (btnFlg==2) {btnTxt[newrownum]="";btnTag[newrownum]="btn"+(newrownum+1).toString();btnState[newrownum]="1";}
	rowHeight[newrownum]=defaultHeight;
	if (newrownum>0) {
				boxM[newrownum] = new Array();
				txtM[newrownum] = new Array();
				tagM[newrownum] = new Array();
				stateM[newrownum] = new Array();
					};
	if (colType.length>0)
					{
					for (var i=0;i<colType.length;i++)
						{
						boxM[newrownum][i]="";
						txtM[newrownum][i]="";
						tagM[newrownum][i]=String.fromCharCode(newrownum+97)+i.toString();
						stateM[newrownum][i]="1";
						}
					}
	}
	else
	{
	//change current row
	var rownum = parseInt(formlink.rownum.value);
	var rowins = parseInt(formlink.rowinsert.value);
	rowType[rownum]=formlink.rowtype.value; 
    rowHeight[rownum]=isNaN(parseInt(formlink.rowheight.value)) ? defaultHeight : parseInt(formlink.rowheight.value);
	swapArrayElem(rowType, rownum, rowins);
	swapArrayElem(rowHeight, rownum, rowins);
	if (btnFlg==2) 
		{
		swapArrayElem(btnTxt, rownum, rowins);
		swapArrayElem(btnState, rownum, rowins);
		swapArrayElem(btnTag, rownum, rowins);
		}
	var temp = new Array();
	temp = copyOfArray(boxM[rownum]);
	boxM[rownum]=copyOfArray(boxM[rowins]);
	boxM[rowins]=copyOfArray(temp);

	temp = copyOfArray(txtM[rownum]);
	txtM[rownum]=copyOfArray(txtM[rowins]);
	txtM[rowins]=copyOfArray(temp);

	temp = copyOfArray(tagM[rownum]);
	tagM[rownum]=copyOfArray(tagM[rowins]);
	tagM[rowins]=copyOfArray(temp);

	temp = copyOfArray(stateM[rownum]);
	stateM[rownum]=copyOfArray(stateM[rowins]);
	stateM[rowins]=copyOfArray(temp);

	activeRow=rowins;
	}

refreshTable();
}

function changeColBox(colnum)
{ //switch row
activeCol=colnum;
if (colnum==colType.length) {activeCol=-1;}
saveFields();
refreshTable()
}

function changeRowBox(rownum)
{ //switch row
activeRow=rownum;
if (rownum==rowType.length) {activeRow=-1;}
saveFields();
refreshTable();
}


function changeFix(formlink)
{ 
saveFields();
if (formlink.colfix.checked)
	{
	colFix=true;
	}
	else
	{
	colFix=false;
	}

if (formlink.rowfix.checked)
	{
	rowFix=true;
	}
	else
	{
	rowFix=false;
	}
refreshTable();
}
function changeEdit(editno)
{ // switch edit part
globalEdit = editno;
saveFields();
refreshTable();
}

function changeButtons(newBtn)
{ // change button type 
saveFields();
btnFlg=newBtn;
if (btnFlg==0)
		{
		// nothing
		}
		else 
		{
		//add col or row buttons to existing set
		if (btnFlg==1) {newlength=colType.length} else {newlength=rowType.length};

		if (newlength<=btnTxt.length)
			{
			btnTxt=btnTxt.slice(0,newlength);
			btnTag=btnTag.slice(0,newlength);
			btnState=btnState.slice(0,newlength);
			}
		else
			{
			for (i=btnTxt.length;i<newlength;i++)
					{btnTxt[i]="";btnState[i]="1";btnTag[i]="btn"+(i+1).toString();};
			}
	
		}
refreshTable();
}


function delCol(formlink)
{ // delete a column
saveFields();
var colnum = parseInt(formlink.colnum.value);
colType = colType.slice(0,colnum).concat(colType.slice(colnum+1));
colWidth = colWidth.slice(0,colnum).concat(colWidth.slice(colnum+1));
if (btnFlg==1) 
		{
		btnTxt=btnTxt.slice(0,colnum).concat(btnTxt.slice(colnum+1));
		btnTag=btnTag.slice(0,colnum).concat(btnTag.slice(colnum+1));
		btnState=btnState.slice(0,colnum).concat(btnState.slice(colnum+1));
		}

			for (var i=0;i<txtM.length;i++)
				{
				boxM[i]=boxM[i].slice(0,colnum).concat(boxM[i].slice(colnum+1));
				txtM[i]=txtM[i].slice(0,colnum).concat(txtM[i].slice(colnum+1));
				tagM[i]=tagM[i].slice(0,colnum).concat(tagM[i].slice(colnum+1));
				stateM[i]=stateM[i].slice(0,colnum).concat(stateM[i].slice(colnum+1));
				}
// reset lists
refreshTable();
changeColBox(colnum);
}

function delRow(formlink)
{ // delete a row
saveFields();
var rownum = parseInt(formlink.rownum.value);

rowType = rowType.slice(0,rownum).concat(rowType.slice(rownum+1));
rowHeight = rowHeight.slice(0,rownum).concat(rowHeight.slice(rownum+1));
if (btnFlg==2) 
		{
		btnTxt=btnTxt.slice(0,rownum).concat(btnTxt.slice(rownum+1));
		btnTag=btnTag.slice(0,rownum).concat(btnTag.slice(rownum+1));
		btnState=btnState.slice(0,rownum).concat(btnState.slice(rownum+1));
		}

			for (var i=rownum;i<rowType.length;i++)
				{
				boxM[i]=copyOfArray(boxM[i+1]);
				txtM[i]=copyOfArray(txtM[i+1]);
				tagM[i]=copyOfArray(tagM[i+1]);
				stateM[i]=copyOfArray(stateM[i+1]);
				}
boxM.pop();
txtM.pop();
tagM.pop();
stateM.pop();

// recreate arrays if all rows are deleted...
if (rowType.length==0)
	{
	txtM[0]= new Array();
	boxM[0]= new Array();
	stateM[0]=new Array();
	tagM[0]=new Array();
	}
refreshTable(); //first refresh table (such that the fields are updated)
changeRowBox(rownum); // then change the active Row
}

function showMenu(menuType)
{  // show one of the menus to insert HTML code
switch (menuType)
	{
	case "scale":
	top.tableFrm.document.getElementById('scaleLyr').style.visibility='visible';
	top.tableFrm.document.getElementById('choiceLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('fieldLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('tmLyr').style.visibility='hidden';
	break
	case "choice":
	top.tableFrm.document.getElementById('scaleLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('choiceLyr').style.visibility='visible';
	top.tableFrm.document.getElementById('fieldLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('tmLyr').style.visibility='hidden';
	break
	case "field":
	top.tableFrm.document.getElementById('scaleLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('choiceLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('fieldLyr').style.visibility='visible';
	top.tableFrm.document.getElementById('tmLyr').style.visibility='hidden';
	break
	case "CBOrder":
	if (CBpreset==true) {top.tableFrm.document.getElementById('CBLyr').style.visibility='visible';
						changeCB('showList');
						}
	break
	case "tm":
	top.tableFrm.document.getElementById('scaleLyr').style.visibility='hidden';	
	top.tableFrm.document.getElementById('scaleLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('choiceLyr').style.visibility='hidden';
	top.tableFrm.document.getElementById('tmLyr').style.visibility='visible';
	break

}
top.tableFrm.document.getElementById('tempLyr').style.visibility='hidden';
}

function refreshTable(resetDialog)
{ // central function which refreshes/updates the editing frame
if (resetDialog) {
	// if resetDialog is true, the top fields also have to be updated
var formlink=top.common.document.forms[0];
var tbllink=top.tableFrm.document.forms[0];
/*		
if (btnType == "button") 
		{
		if (btnFlg == 1) {buttonSel=2} else {buttonSel=4}
		}
		else
		{
		if (btnFlg == 1) {buttonSel=1} else {buttonSel=3}
		};

if (btnFlg==0) {buttonSel=0;};
formlink.buttons.options[buttonSel].selected = true;
*/
formlink.cssname.value = cssname;
formlink.actclass.value = activeClass;
formlink.inactclass.value = inactiveClass;
formlink.boxclass.value = boxClass;
formlink.formname.value = mlweb_fname;
formlink.nextURL.value = nextURL;
formlink.expname.value = expname;
formlink.masterCond.value = masterCond;
formlink.to_email.value = to_email;
formlink.openEvent.options[evtOpen].selected = true;
formlink.closeEvent.options[evtClose].selected = true;

tbllink.tmTotalSec.value = tmTotalSec;
tbllink.tmStepSec.value = tmStepSec;
tbllink.tmWidthPx.value = tmWidthPx;
if (tmFill) {for (i=0;i<tbllink.tmFill.length;i++) {if (tbllink.tmFill[i].value == "true") {tbllink.tmFill[i].checked = true;} }}
				else
				{for (i=0;i<tbllink.tmFill.length;i++) {if (tbllink.tmFill[i].value == "false") {tbllink.tmFill[i].checked = true;} }}
if (tmShowTime) {tbllink.tmShowTime.checked =true} else {tbllink.tmShowTime.checked =false};
if (tmDirectStart) {for (i=0;i<tbllink.tmDirectStart.length;i++) {if (tbllink.tmDirectStart[i].value == "true") {tbllink.tmDirectStart[i].checked = true;}}}
			else {for (i=0;i<tbllink.tmDirectStart.length;i++) {if (tbllink.tmDirectStart[i].value == "false") {tbllink.tmDirectStart[i].checked = true;}}}
if (tmMinLabel!="false") {tbllink.tmTimeFormat.value = tmMinLabel+":"+tmSecLabel} else {tbllink.tmTimeFormat.value = tmSecLabel} ;
tbllink.tmLabel.value = tmLabel;

if (mlweb_outtype == "XML") {formlink.formatBtn[1].checked=true} else {formlink.formatBtn[0].checked=true}

//if (cnCol) {formlink.cncols.checked=true} else {formlink.cncols.checked=false};
//if (cnRow) {formlink.cnrows.checked=true} else {formlink.cnrows.checked=false};
if (randomOrder) {formlink.randomize.checked=true} else {formlink.randomize.checked=false};


}

numCond = chkConnects();

top.tableFrm.document.forms[0].colnum.value=activeCol;
top.tableFrm.document.forms[0].rownum.value=activeRow;
docstr="<TABLE border=1 width=100%><TR><TD class=\"labelTD\" ><B>Window Title:</B><input type=text name=\"windowname\" value=\""+windowName+"\" size=30></td><TD class=\"labelTD\" ><B>Check all on submit for missing responses</B><input type=checkbox name=\"chkfrm\" value=\"true\""
if (chkFrm)  {docstr+=" Checked"}

docstr+="></td><TD class=\"labelTD\" ><B>Warning Text:</B><input type=text size=30 name=\"warningtxt\" value=\""+warningTxt+"\"></td><TD class=\"labelTD\" ><B>Timer Active</B> <INPUT type=checkbox name=\"tmActive\" value=\"true\""
if (tmActive)  {docstr+=" checked"}
docstr+="><input type=button value=\"timer properties\" onClick=\"top.showMenu('tm')\"></TD></TR><TR><TD class=\"labelTD\"></TD></TR><TR><TD class=\"labelTD\" width=80% colspan=3><B>Pre HTML</B></TD><TD class=\"labelTD\">"
if (globalEdit==1)
	{
	docstr+="<input type=button value=\"edit pre HTML\" onClick=\"top.changeEdit(1);\" disabled></TD></TR><TR><TD class=\"inpTD\" colspan=4><INPUT type=button value=\"Insert Scale\" onClick=\"top.showMenu('scale');\">&nbsp;<INPUT type=button value=\"Insert Option/Choice\" onClick=\"top.showMenu('choice');\">&nbsp;<INPUT type=button value=\"Insert (Text)field\" onClick=\"top.showMenu('field');\"><INPUT type=button value=\"Undo last insert\" name=\"undo1\" onClick=\"top.undoLastInsert();\""
	if (undo1=="") {docstr+=" DISABLED"}
	docstr+="><BR><TEXTAREA cols=200 rows=15 name=\"preHTML\">"+cHTML(preHTML)+"</TEXTAREA>";
	 hiddenstr="";
	}
else 
	{
	docstr+="<input type=button value=\"edit pre HTML\" onClick=\"top.changeEdit(1);\"></TD></TR><TR><TD class=\"inpTD\" colspan=4>"+preHTML
	hiddenstr="<TEXTAREA cols=200 rows=15 name=\"preHTML\">"+cHTML(preHTML)+"</TEXTAREA>"
	}

docstr+="</TD></TR><TR><TD class=\"labelTD\" width=80% colspan=3><B>MouselabWEB Table</B></TD><TD class=\"labelTD\"><input type=button value=\"edit mouselabWEB Table\" onClick=\"top.changeEdit(2);\""
if (globalEdit==2) {docstr+=" DISABLED"} ;
docstr+="></TD></TR><TR><TD class=\"inpTD\" colspan=4>";

	edit2str="<TABLE class=\"tblStyle\"><TR>";
	edit2str+="<TD class=\"labelTD\">Counterbalancing:<BR><input type=radio name=\"CBpreset\" value=\"false\" onClick=\"top.changeCB('setAuto')\""
	if (!CBpreset) {edit2str+=" CHECKED"}
	edit2str+=">Auto <B>("+numCond+" cond)</B><BR><input type=radio name=\"CBpreset\" value=\"true\" onClick=\"top.changeCB('setManual')\""
	if (CBpreset) {edit2str+=" CHECKED>Manual <B>("+CBcolList.length+" cond)</B>";} else {edit2str+=">Manual"}
	edit2str+="&nbsp;<INPUT type=button value=\"Set\" onClick=\"top.showMenu('CBOrder');\">";
	edit2str+="</TD>";

for (j=0;j<colType.length;j++)
	{
		if (j==activeCol) 
				{edit2str+="<TD class=\"labelTD\" style=\"background-color: #60708C; border-left: 3px solid #60708C; border-right: 3px solid #60708C; border-top: 3px solid #60708C;\" ";
				edit2str+="><B>Col: "+(j+1).toString()+"</B>&nbsp;&nbsp;"
				edit2str+="move:<SELECT onChange=\"top.addCol(this.form)\" name=\"colinsert\">";
				for (z=0;z<colType.length;z++) 
						{edit2str+="<option value=\""+z+"\"";
						 if (z==j) {edit2str+=" SELECTED ";}
						edit2str+=">"+(z+1).toString()+"</option>";}
				edit2str+="</select>&nbsp;&nbsp;<input type=button name=\"delcol\" value=\"Del\" onClick=\"top.delCol(this.form)\">";
				edit2str+="<BR>Width:<INPUT type=text size=5 name=\"colwidth\" onChange=\"top.addCol(this.form)\" value=\""+colWidth[j]+"\">";
				edit2str+="Type:<SELECT ID=\"coltype\" onChange=\"top.addCol(this.form)\"><Option value=0";
				if (colType[j]==0) {edit2str+=" selected "};
				edit2str+=">fixed</option><Option value=1";
				if (colType[j]==1) {edit2str+=" selected "};
				edit2str+=">CBal.</option></select>";
				edit2str+="</TD>";
				} 
				else
				{
				edit2str+="<TD class=\"labelTD\" onMouseOver=\"this.style.backgroundColor='#60708C'\" onMouseOut=\"this.style.backgroundColor='#9DACBF'\" onClick=\"top.changeColBox("+j.toString()+")\">Col: "+(j+1).toString()+"<BR>Width: "+colWidth[j]+"&nbsp;&nbsp;Type: ";
				if (colType[j]==0) {edit2str+="fixed "} else {edit2str+="CBal."};
				edit2str+="</TD>";
				}
	}


	if (btnFlg==2) 
		{edit2str+="<TD class=\"labelTD\"><b>Row Buttons</b><br>"
		edit2str+="btn type: <input type=radio name=\"btnType\" value=\"button\" onClick=\"top.btnType='button';\""
		if (btnType=="button") {edit2str+=" CHECKED"}
		edit2str+=">button<input type=radio name=\"btnType\" value=\"radio\" onClick=\"top.btnType='radio';\""
		if (btnType=="radio") {edit2str+=" CHECKED"}
		edit2str+=">radio</TD>"
		}
	edit2str+="<TD class=\"labelTD\" onMouseOver=\"this.style.backgroundColor='#60708C'\" onMouseOut=\"this.style.backgroundColor='#9DACBF'\">"
	
	edit2str+="<input type=checkbox name=\"colfix\" onClick=\"top.changeFix(this.form);\""
	if (colFix) {edit2str+="CHECKED ";}
	edit2str+=">Fix Col labels<BR><input type=button value=\"new Col\" onClick=\"this.form.colnum.value=\'new\';top.addCol(this.form);\">"
	if (btnFlg==1) {edit2str+="<input type=button value=\"to row Btns\" onClick=\"top.changeButtons(2);\">"}
	if (btnFlg==2) {edit2str+="<input type=button value=\"del Btns\" onClick=\"top.changeButtons(0);\">"}
	if (btnFlg==0) {edit2str+="<input type=button value=\"new Btns\" onClick=\"top.changeButtons(2);\">"}
	edit2str+="</TD></TR>";

for (i=0;i<rowType.length;i++)

	{
 	edit2str+="<TR>";
		if (i==activeRow) 
				{
				edit2str+="<TD class=\"labelTD\" style=\"background-color: #60708C; border-left: 3px solid #60708C; border-top: 3px solid #60708C; border-bottom: 3px solid #60708C;\"  ";
				edit2str+="><B>Row: "+(i+1).toString()+"</B>&nbsp;&nbsp;"
				edit2str+="move:<SELECT onChange=\"top.addRow(this.form)\" name=\"rowinsert\">";
				for (z=0;z<rowType.length;z++) 
						{edit2str+="<option value=\""+z+"\"";
						 if (z==i) {edit2str+=" SELECTED ";}
						edit2str+=">"+(z+1).toString()+"</option>";}
				edit2str+="</select>&nbsp;&nbsp;<input type=button name=\"delrow\" value=\"Del\" onClick=\"top.delRow(this.form)\">";
				edit2str+="<BR>Height:<INPUT type=text size=5 name=\"rowheight\" onChange=\"top.addRow(this.form)\" value=\""+rowHeight[i]+"\">";
				edit2str+="<BR>Type:<SELECT ID=\"rowtype\" onChange=\"top.addRow(this.form)\"><Option value=0";
				if (rowType[i]==0) {edit2str+=" selected "};
				edit2str+=">fixed</option><Option value=1";
				if (rowType[i]==1) {edit2str+=" selected "};
				edit2str+=">CBal.</option></SElect>";
				edit2str+="</TD>";
				} 
				else
				{
				edit2str+="<TD class=\"labelTD\" onMouseOver=\"this.style.backgroundColor='#60708C'\" onMouseOut=\"this.style.backgroundColor='#9DACBF'\" onClick=\"top.changeRowBox("+i.toString()+")\">Row: "+(i+1).toString()+"<BR>Height: "+rowHeight[i]+"<BR>Type: ";
				if (rowType[i]==0) {edit2str+="fixed "} else {edit2str+="CBal."};
				edit2str+="</TD>";
				}
	for (j=0;j<colType.length;j++)
		{
		edit2str+="<TD class=\"inpTD\""
		if (j==activeCol) {edit2str+=" style=\"border-left: 3px solid #60708C; border-right: 3px solid #60708C;"; if (i!=rowType.length-1) {edit2str+="\" ";} else {edit2str+=" border-bottom: 3px solid #60708C;\"";} }
		if (i==activeRow) {edit2str+=" style=\"border-top: 3px solid #60708C; border-bottom: 3px solid #60708C;"; if (j!=colType.length-1) {edit2str+="\" ";} else {edit2str+=" border-right: 3px solid #60708C;\"";} } 
		edit2str+=">";
		edit2str+="name: <INPUT type=text size=10 name=tag_"+String.fromCharCode(i+97)+j.toString()+" value=\""+tagM[i][j]+"\">"
		edit2str+="&nbsp;&nbsp;active:<input type=checkbox name=state_"+String.fromCharCode(i+97)+j.toString();
		if (stateM[i][j]=='1') {edit2str+=" checked><BR>"} else {edit2str+="><BR>";}
		edit2str+="boxtxt: <INPUT type=text size=20 name=box_"+String.fromCharCode(i+97)+j.toString()+" value=\""+boxM[i][j]+"\"><BR>";
		edit2str+="text: <INPUT type=text size=20 name=txt_"+String.fromCharCode(i+97)+j.toString()+" value=\""+txtM[i][j]+"\">";
		edit2str+="</TD>";
		}
if (btnFlg==2)		
		{
		edit2str+="<TD class=\"inpTD\">";
		edit2str+="name: <INPUT type=text size=10 name=btntag_"+i.toString()+" value=\""+btnTag[i]+"\">"
		edit2str+="&nbsp;&nbsp;active:<input type=checkbox name=btnstate_"+i.toString();
		if (btnState[i]=='1') {edit2str+=" checked><BR>"} else {edit2str+="><BR>";}
		edit2str+="text: <INPUT type=text size=20 name=btntxt_"+i.toString()+" value=\""+btnTxt[i]+"\">";
		edit2str+="</TD>";
		}
	edit2str+="</TR>";
	}

if (btnFlg==1)	
	{
	edit2str+="<TD class=\"labelTD\"><b>Column Buttons</b><br>"
	edit2str+="btn type: <input type=radio name=\"btnType\" value=\"button\" onClick=\"top.btnType='button';\""
		if (btnType=="button") {edit2str+=" CHECKED"}
		edit2str+=">button<input type=radio name=\"btnType\" value=\"radio\" onClick=\"top.btnType='radio';\""
		if (btnType=="radio") {edit2str+=" CHECKED"}
		edit2str+=">radio</TD>"
		
	for (j=0;j<colType.length;j++)
		{
		edit2str+="<TD class=\"inpTD\">";
		edit2str+="name: <INPUT type=text size=10 name=btntag_"+j.toString()+" value=\""+btnTag[j]+"\">"
		edit2str+="&nbsp;&nbsp;active:<input type=checkbox name=btnstate_"+j.toString();
		if (btnState[j]=='1') {edit2str+=" checked><BR>"} else {edit2str+="><BR>";}
		edit2str+="text: <INPUT type=text size=20 name=btntxt_"+j.toString()+" value=\""+btnTxt[j]+"\">";
		edit2str+="</TD>";
		}
	}
	edit2str+="</TR>";
	edit2str+="<TR><TD class=\"labelTD\" onMouseOver=\"this.style.backgroundColor='#60708C'\" onMouseOut=\"this.style.backgroundColor='#9DACBF'\">"
	edit2str+="<input type=checkbox name=\"rowfix\" onClick=\"top.changeFix(this.form);\""
	if (rowFix) {edit2str+="CHECKED ";}
	edit2str+=">Fix row labels<BR><input type=button value=\"new row\" onClick=\"this.form.rownum.value=\'new\';top.addRow(this.form);\">"
	if (btnFlg==2) {edit2str+="<input type=button value=\"to Col Btns\" onClick=\"top.changeButtons(1);\">"}
	if (btnFlg==1) {edit2str+="<input type=button value=\"del Btns\" onClick=\"top.changeButtons(0);\">"}
	if (btnFlg==0) {edit2str+="<input type=button value=\"new Btns\" onClick=\"top.changeButtons(1);\">"}

	edit2str+="</TD></TR>"
	if (tmActive & tmPos==2) 
			{edit2str+="<TR><td class=\"inpTD\">&nbsp;</td><td colspan="+colType.length+" class=\"inpTD\">"+tmLabel+"</td></tr>";}

	edit2str+="</TABLE>";

show2str="<P>Hidden mouselabWEB structure table"	

if (globalEdit==2) 
	{
	docstr+=edit2str;
	}
	else
	{
	docstr+="<P><i>Hidden table str</P>"
	hiddenstr+=edit2str;
	};

docstr+="</TD></TR><TR><TD class=\"labelTD\" width=80% colspan=3><B>Post HTML</B></TD><TD class=\"labelTD\"><input type=button value=\"edit post HTML\" onClick=\"top.changeEdit(3);\"";
if (globalEdit==3)
	{
	docstr+=" DISABLED></TD></TR><TR><TD class=\"inpTD\" colspan=4><INPUT type=button value=\"Insert Scale\" onClick=\"top.showMenu('scale');\">&nbsp;<INPUT type=button value=\"Insert Option/Choice\" onClick=\"top.showMenu('choice');\">&nbsp;<INPUT type=button value=\"Insert (Text)field\" onClick=\"top.showMenu('field');\"><INPUT type=button value=\"Undo last insert\" name=\"undo2\" onClick=\"top.undoLastInsert();\""; 
	if (undo2=="") {docstr+=" DISABLED"}
	docstr+="><BR><TEXTAREA cols=200 rows=15 name=\"postHTML\">"+cHTML(postHTML)+"</TEXTAREA>";
	 hiddenstr+="";
	}
else 
	{
	docstr+="></TD></TR><TR><TD class=\"inpTD\" colspan=4>"+postHTML
	hiddenstr+="<TEXTAREA cols=200 rows=15 name=\"postHTML\">"+cHTML(postHTML)+"</TEXTAREA>"
	}

docstr+="</TD></TR><TD class=\"labelTD\" colspan=4><B>Text on submit button: </B><input type=text name=\"submitname\" value=\""+submitName+"\" size=20></TD></TR></TABLE>"
top.tableFrm.document.getElementById("edit").innerHTML = docstr;
top.tableFrm.document.getElementById("hidden").innerHTML = hiddenstr;
}

function undoLastInsert()
{ //undo function for editing of pre and postHTML

if (globalEdit==1)
	{
		top.tableFrm.document.forms[0].preHTML.value=undo1;
		undo1="";
		top.tableFrm.document.forms[0].undo1.disabled = true;
	}
	else
	{
		top.tableFrm.document.forms[0].postHTML.value=undo2;
		undo2="";
		top.tableFrm.document.forms[0].undo2.disabled = true;
	}
}
function makeScale(Frm)
{ // create scale labels (2nd level of scale menu) 
// add scale items if number of points has changed
if ((Frm.scaleName.value=="")|(isNaN(parseInt(Frm.scalePoints.value)))) {return}

scale.num_points = parseInt(Frm.scalePoints.value)
scale.name = Frm.scaleName.value
if (0<=parseInt(Frm.scaleWidth.value)<=100) {scale.width=parseInt(Frm.scaleWidth.value)} else {scale.width=80};

top.tableFrm.document.getElementById('scaleLyr').style.visibility="hidden";

docStr="<TABLE class=\"tblStyle\"><TR><TD colspan=2 align=center class=\"labelTD\"><B>Edit values and labels</B>&nbsp;&nbsp;<input type=button value=\" Close \" onClick=\"document.getElementById('tempLyr').style.visibility='hidden'\"></TD></TR><TR><TD class=\"labelTD\">Values:</TD><TD class=\"labelTD\">Labels:</TD></TR>";

if (Frm.scaleShowValues.checked) {scale.showValues = true} else {scale.showValues=false}
if (Frm.scaleCapture.checked) {scale.capture = true} else {scale.capture=false}

begin=parseInt(Frm.scaleBegin.value)
end=parseInt(Frm.scaleEnd.value)

for (i=0; i<scale.num_points; i++)
	{
	if (!(isNaN(end-begin))) {scale.value[i]=Math.round(begin+i*((end-begin)/(scale.num_points-1)))} else {scale.value[i]=""}
	docStr+="<TR><TD class=\"inpTD\"><INPUT type=text size=3 name=value"+i.toString()+" value=\""+scale.value[i]+"\"></TD><TD class=\"inpTD\"><INPUT type=text size=15 name=label"+i.toString()+"></TD></TR>"
	}
docStr+="<TR><TD colspan=2 align=center class=\"inpTD\"><input type=button value=\"Create Scale\" onClick=\"top.makeScaleHTML(this.form)\"></TD></TR>"

	docStr+="</TABLE>"

top.tableFrm.document.getElementById('tempLyr').innerHTML=docStr; 
top.tableFrm.document.getElementById('tempLyr').style.visibility="visible";
}


function makeScaleHTML(Frm)
{ // create HTML code for scale

docStr="<!-- Begin HTML Scale: name="+scale.name+"-->\n<TABLE width="+scale.width+"%><TR>"
for (i=0;i<scale.num_points; i++)
{
scale.value[i]=eval("Frm.value"+i).value
scale.label[i]=eval("Frm.label"+i).value
}
// first line
if (scale.showValues)
{
	for (i=0;i<scale.num_points; i++)
	{docStr+="<TD align=center>"+scale.value[i]+"</TD>"}
docStr+="</TR><TR>"
}
// radio buttons
for (i=0; i<scale.num_points; i++)
{
docStr+="<td width="+Math.round(100/scale.num_points)+"% align=center><INPUT TYPE=RADIO NAME='" +scale.name +"' VALUE='"+ scale.value[i]+"'"
if (scale.capture) {docStr+=" onClick=\"RecordEventData(this,event);\" onMouseOver=\"RecordEventData(this,event);\" onMouseOut=\"RecordEventData(this,event);\""}
docStr+="></td>"}
docStr+="</TR><TR>"
for (i=0; i<scale.num_points; i++)
{
docStr+="<td align=center>"+scale.label[i]+"</td>"
}
docStr+="</TR></TABLE>\n<!-- End HTML Scale: name="+scale.name+"-->\n"
top.tableFrm.document.getElementById('tempLyr').style.visibility="hidden";
if (globalEdit==1)
	{
	undo1 = top.tableFrm.document.forms[0].preHTML.value;
	top.tableFrm.document.forms[0].undo1.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].preHTML, docStr);
	}
	else
	{
	undo2 = top.tableFrm.document.forms[0].postHTML.value;
	top.tableFrm.document.forms[0].undo2.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].postHTML, docStr);
	}
}


function makeBar(Frm)
{
/*tmTotalSec = parseInt(Frm.tmTotalSec.value);
tmStepSec = parseInt(Frm.tmStepSec.value);
tmWidthPx = parseInt(Frm.tmWidthPx.value);
if (Frm.tmFill[0].checked) {tmFill = true} else {tmFill=false}
if (Frm.tmShowTime.checked) {tmShowTime = true} else {tmShowTime=false}
if (Frm.tmDirectStart.checked) {tmDirectStart = true} else {tmDirectStart=false}
if (Frm.tmTimeFormat.value.indexOf(":")!=-1) {tmMinLabel = Frm.tmTimeFormat.value.substr(0,Frm.tmTimeFormat.value.indexOf(":")); tmSecLabel = Frm.tmTimeFormat.value.substr(Frm.tmTimeFormat.value.indexOf(":"+1))};
*/

saveFields();
if (!tmActive) {alert("First activate timer!");return false};

docStr="<!-- Begin HTML Time Bar -->\n<table><tr><td>"+tmLabel+"</td><td colspan=2><div id=\"tmCont\" class=\"tmCont\"><div id=\"tmBar\" class=\"tmBar\"></div><div id=\"tmTime\" class=\"tmTime\"></div></div></td></TR></table>\n<!-- End HTML Time Bar -->\n"

//clear previous text

if (tmPos==1)  {var HTMLtxt = top.tableFrm.document.forms[0].preHTML.value
				HTMLtxt = HTMLtxt.substr(0,HTMLtxt.indexOf("<!-- Begin HTML Time Bar -->"))+HTMLtxt.substr(HTMLtxt.indexOf("<!-- End HTML Time Bar -->")+27);
				top.tableFrm.document.forms[0].preHTML.value=HTMLtxt;
				saveFields();
				}
if (tmPos==3)  {var HTMLtxt = top.tableFrm.document.forms[0].postHTML.value
				HTMLtxt = HTMLtxt.substr(0,HTMLtxt.indexOf("<!-- Begin HTML Time Bar -->"))+HTMLtxt.substr(HTMLtxt.indexOf("<!-- End HTML Time Bar -->")+27);
				top.tableFrm.document.forms[0].postHTML.value=HTMLtxt;
				saveFields();
				}

top.tableFrm.document.getElementById('tmLyr').style.visibility="hidden";


if (globalEdit==1)
			{
			tmPos=1;
			top.tableFrm.document.forms[0].undo1.disabled = true;
			insertAtCursor(top.tableFrm.document.forms[0].preHTML, docStr);
			}
			else if (globalEdit==3)
			{
			tmPos=3;
			top.tableFrm.document.forms[0].undo2.disabled = true;
			insertAtCursor(top.tableFrm.document.forms[0].postHTML, docStr);
			}
			else
			{
			tmPos=2; 
			saveFields();
			refreshTable(false);
			}
}



function makeOptions(Frm)
{ // create option labels (2nd level of choice menu
// add scale items if number of points has changed
if ((Frm.choiceName.value=="")|(isNaN(parseInt(Frm.choiceOptions.value)))) {return}
choice.num_options = parseInt(Frm.choiceOptions.value)
choice.name = Frm.choiceName.value;
if (Frm.choiceType[0].checked) {choice.type="single"} else {choice.type="multi"}; 
if (Frm.choiceCapture.checked) {choice.capture = true} else {choice.capture=false}

top.tableFrm.document.getElementById('choiceLyr').style.visibility="hidden";

docStr="<TABLE class=\"tblStyle\"><TR><TD colspan=2 align=center class=\"labelTD\"><B>Edit values and labels</B>&nbsp;&nbsp;<input type=button value=\" Close \" onClick=\"document.getElementById('tempLyr').style.visibility='hidden';\"></TD></TR><TR><TD class=\"labelTD\">Values:</TD><TD class=\"labelTD\">Labels:</TD></TR>"

for (i=0; i<choice.num_options; i++)
	{
	docStr+="<TR><TD class=\"inpTD\"><INPUT type=text size=3 name=value"+i.toString()+" value=''></TD><TD class=\"inpTD\"><INPUT type=text size=25 name=label"+i.toString()+"></TD></TR>"
	}
docStr+="<TR><TD colspan=2 class=\"inpTD\" align=center><input type=button value=\"Create Options\" onClick=\"top.makeOptionsHTML(this.form)\"></TD></TR>"

	docStr+="</TABLE>"

top.tableFrm.document.getElementById('tempLyr').innerHTML=docStr; 
top.tableFrm.document.getElementById('tempLyr').style.visibility="visible";
}

function makeOptionsHTML(Frm)
{  // create HTML code for choice options
docStr="<!-- Begin HTML Choice: name="+choice.name+"-->\n<TABLE>"

// read values and make HTML
for (i=0;i<choice.num_options; i++)
{
choice.value[i]=eval("Frm.value"+i).value
choice.label[i]=eval("Frm.label"+i).value
if (choice.type=="single")
{docStr+="<TR><td align=center><INPUT TYPE=RADIO NAME='"+choice.name +"' VALUE='"+ choice.value[i]+"'";
if (choice.capture) {docStr+=" onClick=\"RecordEventData(this,event);\" onMouseOver=\"RecordEventData(this,event);\" onMouseOut=\"RecordEventData(this,event);\""}

docStr+="></td><TD align=left>"+choice.label[i]+"</TD></TR>"}
else
{docStr+="<TR><td align=center><INPUT TYPE=checkbox NAME='"+choice.name+"_" +choice.value[i]+"' VALUE='true'";
if (choice.capture) {docStr+=" onClick=\"RecordEventData(this,event);\" onMouseOver=\"RecordEventData(this,event);\" onMouseOut=\"RecordEventData(this,event);\""}

docStr+="></td><TD align=left>"+choice.label[i]+"</TD></TR>"}

}
docStr+="</TABLE>\n<!-- End HTML Choice: name="+choice.name+"-->\n"
top.tableFrm.document.getElementById('tempLyr').style.visibility="hidden";
if (globalEdit==1)
	{
	undo1 = top.tableFrm.document.forms[0].preHTML.value;
	top.tableFrm.document.forms[0].undo1.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].preHTML, docStr);
	}
	else
	{
	undo2 = top.tableFrm.document.forms[0].postHTML.value;
	top.tableFrm.document.forms[0].undo2.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].postHTML, docStr);
	}

}

function maketextHTML(Frm)
{  // create HTML code for text field

fieldName=Frm.textName.value
if (fieldName=="") {return}

textWidth = parseInt(Frm.textWidth.value)
if (textWidth<3) {textWidth=3}
if (textWidth>60) {textWidth=60}

textHeight = parseInt(Frm.textRow.value)
if (textHeight<1) {textHeight=1}
if (textHeight>10) {textHeight=10}

if (textHeight==1) 
{docStr="<INPUT type=Text size="+textWidth.toString()+" name='"+fieldName+"' value=''"
if (Frm.textCapture.checked) {docStr+=" onClick=\"RecordEventData(this,event);\" onMouseOver=\"RecordEventData(this,event);\" onMouseOut=\"RecordEventData(this,event);\""}
docStr+=">"}
else
{docStr="<TEXTAREA cols="+textWidth.toString() +" rows="+textHeight.toString()+" name='"+ fieldName+"'></TEXTAREA>"}
top.tableFrm.document.getElementById('fieldLyr').style.visibility="hidden";
if (globalEdit==1)
	{
	undo1 = top.tableFrm.document.forms[0].preHTML.value;
	top.tableFrm.document.forms[0].undo1.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].preHTML, docStr);
	}
	else
	{
	undo2 = top.tableFrm.document.forms[0].postHTML.value;
	top.tableFrm.document.forms[0].undo2.disabled = false;
	insertAtCursor(top.tableFrm.document.forms[0].postHTML, docStr);
	}

}

function saveFields()
{ //save all information in the edit forms before changing the layout
formlink = top.tableFrm.document.forms[0];
topformlink = top.common.document.forms[0];

if (eval("topformlink.randomize.checked")) {randomOrder=true} else {randomOrder=false};

inactiveClass = topformlink.inactclass.value;
activeClass = topformlink.actclass.value;
boxClass = topformlink.boxclass.value;
cssname = topformlink.cssname.value;
mlweb_fname = topformlink.formname.value;
nextURL = topformlink.nextURL.value;
expname = topformlink.expname.value;
masterCond = parseInt(topformlink.masterCond.value);
//to_email = topformlink.to_email.value;
preHTML = formlink.preHTML.value;
postHTML = formlink.postHTML.value;
windowName = formlink.windowname.value;
if (eval("formlink.chkfrm.checked")) {chkFrm=true} else {chkFrm=false};
submitName = formlink.submitname.value;
warningTxt = formlink.warningtxt.value;
if (eval("formlink.tmActive.checked")) {tmActive=true} else {tmActive=false};

tmTotalSec = parseInt(formlink.tmTotalSec.value);
tmStepSec = parseInt(formlink.tmStepSec.value);
tmWidthPx = parseInt(formlink.tmWidthPx.value);
if (formlink.tmFill[0].checked) {tmFill = true} else {tmFill=false}
if (formlink.tmShowTime.checked) {tmShowTime = true} else {tmShowTime=false}
if (formlink.tmDirectStart[0].checked) {tmDirectStart = true} else {tmDirectStart=false}
if (formlink.tmTimeFormat.value.indexOf(":")!=-1) {tmMinLabel = formlink.tmTimeFormat.value.substr(0,formlink.tmTimeFormat.value.indexOf(":")); tmSecLabel = formlink.tmTimeFormat.value.substr(formlink.tmTimeFormat.value.indexOf(":")+1)} else {tmMinLabel="false";tmSecLabel=formlink.tmTimeFormat.value}


for (i=0;i<topformlink.formatBtn.length;i++)
{
if (topformlink.formatBtn[i].checked) {mlweb_outtype = topformlink.formatBtn[i].value};
}


if (btnFlg>0) 
	{
	for (i=0;i<btnTxt.length;i++)
		{
		btnTxt[i]=eval("formlink.btntxt_"+i.toString()+".value");
		btnTag[i]=eval("formlink.btntag_"+i.toString()+".value");
		if (eval("formlink.btnstate_"+i.toString()+".checked")) {btnState[i]='1'} else {btnState[i]='0'}
		}
	}

if ((colType.length>0)&(rowType.length>0)) 
	{
	for (i=0;i<txtM.length;i++)
		{
	 	for (j=0;j<txtM[0].length;j++)
			{
			tagM[i][j] = eval("formlink.tag_"+String.fromCharCode(i+97)+j.toString()+".value").replace(/"/g, "'");
			txtM[i][j] = eval("formlink.txt_"+String.fromCharCode(i+97)+j.toString()+".value").replace(/"/g, "'");
			boxM[i][j] = eval("formlink.box_"+String.fromCharCode(i+97)+j.toString()+".value").replace(/"/g, "'");
			if (eval("formlink.state_"+String.fromCharCode(i+97)+j.toString()+".checked")) {stateM[i][j]='1'} else {stateM[i][j]='0'};
			}
		}
	}
}

function showHelp()
{ // show help window
helpWin = window.open("mlweb_help.html","helpWin", "scrollbars,Width=800,height=600")
}

function createTableStruct(espFlag)
{ // create the variable structure of a mouselabWEB table

var docstr="";

if (espFlag==true) {docstr+="\n<!--BEGIN phpESP TABLE STRUCTURE-->";
docstr+="\n<SCRIPT language=\"javascript\">\nnewversion=true;\n"}
else {docstr+="\n<!--BEGIN TABLE STRUCTURE-->"; docstr+="\n<SCRIPT language=\"javascript\">\n\/\/override defaults\nmlweb_outtype=\""+mlweb_outtype+"\";\nmlweb_fname=\""+mlweb_fname+"\";\n"}

var tagstr="";
var txtstr="";
var statestr="";
var boxstr="";
// tagChk is used to check if their are double tag names
tagChk =new Array();
tagOk = true;

for (i=0;i<txtM.length;i++)
	{
 	if (i==0) {prestr="\""} else {prestr=" + \""};
	tagstr+=prestr;
	txtstr+=prestr;
	statestr+=prestr;
	boxstr+=prestr;
	
	
	
	for (j=0;j<txtM[0].length;j++)
		{
		if (j<txtM[0].length-1) {sepstr="^"} else {if (i<txtM.length-1) {sepstr="`\"\n"} else {sepstr="\";\n"}}
		for (c = 0; c<tagChk.length; c++)
			{ if (tagM[i][j] == tagChk[c]) {tagOk = false;} }
			
		tagChk[tagChk.length]=tagM[i][j];
		tagstr+=repl_sep(tagM[i][j])+sepstr;
		txtstr+=repl_sep(txtM[i][j])+sepstr;
		statestr+=repl_sep(stateM[i][j])+sepstr;
		boxstr+=repl_sep(boxM[i][j])+sepstr;
		}
	}
if (!tagOk) {alert("WARNING: some boxes have duplicate names. This might cause inconsistencies in the data set. You are advised to use unique names for each box.")}
docstr+="tag = "+tagstr+ "\n" + "txt = " + txtstr + "\n" + "state = " + statestr + "\n" + "box = " + boxstr + "\n";

colstr="";
wcolstr="";

for (i=0;i<colType.length;i++)
{if (i<colType.length-1) { sepstr="^"} else {sepstr="\";\n"};
colstr+=colType[i]+sepstr;
wcolstr+=colWidth[i]+sepstr;
}

rowstr="";
wrowstr="";
for (i=0;i<rowType.length;i++)
{if (i<rowType.length-1) { sepstr="^"} else {sepstr="\";\n"};
rowstr+=rowType[i]+sepstr;
wrowstr+=rowHeight[i]+sepstr;
}

docstr+="CBCol = \"" + colstr;
docstr+="CBRow = \"" + rowstr;

docstr+="W_Col = \"" + wcolstr;
docstr+="H_Row = \"" + wrowstr;


if (btnFlg>0)
{
docstr+="\nchkchoice = false;\n";
btxtstr="";
bstatestr="";
btagstr="";

tagChk =new Array();
for (i=0;i<btnTxt.length;i++)
	{tagChk[i]="btn_"+i.toString();}
tagOk = true;

for (i=0;i<btnTxt.length;i++)
	{if (i<btnTxt.length-1) { sepstr="^"} else {sepstr="\";\n"};
	// tag check to check if there are no duplicate names: duplicate names will break checking and
	// coloring of pressed button
	for (c = 0; c<tagChk.length; c++)
			{ if (btnTag[i] == tagChk[c]) {tagOk = false;} }
	tagChk[tagChk.length]=btnTag[i];		
	
	btxtstr+=repl_sep(btnTxt[i])+sepstr;
	bstatestr+=btnState[i]+sepstr;
	btagstr+=repl_sep(btnTag[i])+sepstr;
	}
if (!tagOk) {alert("ALERT: some buttons have duplicate names, or a non-valid name is used (btn_XX). Buttons need to have unique names to work correctly.");}
}
else
{
docstr+="\nchkchoice = \"nobuttons\";\n";
btxtstr="\";\n";
bstatestr="\";\n";
btagstr="\";\n";
}

docstr+="btnFlg = "+btnFlg+";\n";
docstr+="btnType = \""+btnType+"\";\n";
docstr+="btntxt = \"" +btxtstr;
docstr+="btnstate = \"" + bstatestr;
docstr+="btntag = \"" + btagstr;
docstr+="to_email = \""+ to_email + "\";\n";

docstr+="colFix = "+ colFix + ";\n";
docstr+="rowFix = "+ rowFix + ";\n";
docstr+="CBpreset = " + CBpreset + ";\n"

docstr+="evtOpen = "+ evtOpen + ";\n";
docstr+="evtClose = "+ evtClose + ";\n";

if (CBpreset)
	{
	CBstr="";
	for (i=0;i<CBcolList.length;i++)
		{
		if (i==0) {CBstr+="CBord = \""} else {CBstr+="+ \""}
		CBstr+=CBcolList[i].join("^")+"^"+CBrowList[i].join("^");
		if (i==CBcolList.length-1) {CBstr+="\";\n"} else {CBstr+="`\"\n"}
		}
	docstr+=CBstr+"\n";
	}
			
if (chkFrm) {docstr+="chkFrm=true;\n"} else {docstr+="chkFrm=false;\n"}
docstr+="warningTxt = \""+ warningTxt + "\";\n";

docstr+="tmTotalSec = "+parseInt(tmTotalSec)+";\n";
docstr+="tmStepSec = "+parseInt(tmStepSec)+";\n";
docstr+="tmWidthPx = "+parseInt(tmWidthPx)+";\n";
docstr+="tmFill = "+tmFill+";\n";
docstr+="tmShowTime = "+tmShowTime+";\n";
docstr+="tmCurTime = 0;\n";
docstr+="tmActive = "+tmActive+";\n";
docstr+="tmDirectStart = "+tmDirectStart+";\n";
docstr+="tmMinLabel = \""+tmMinLabel+"\";\n";
docstr+="tmSecLabel = \""+tmSecLabel+"\";\n";
docstr+="tmLabel = \""+tmLabel+"\";\n";

Dlist = new Array();
for (i=0;i<rowType.length;i++)
	{
	for (j=0;j<colType.length;j++)
		{
		if (stateM[i][j]=="1") {Dlist[Dlist.length]=tagM[i][j];}
		}
	}
	
dstr="";
for (i=0;i<Dlist.length;i++)
	{
	if (i==0) {prestr=""} else {prestr=" + \""};
	dstr+=prestr;
	
		for (j=0;j<Dlist.length;j++)
		{
		if (j<Dlist.length-1) {sepstr="^"} else {if (i<Dlist.length-1) {sepstr="`\"\n"} else {sepstr=""}}
		dstr+="0"+sepstr;
		}
	}
docstr+="\n//Delay: "+Dlist.join(" ")+"\ndelay = \""+ dstr + "\";\n";

docstr+="activeClass = \"" + activeClass + "\";\ninactiveClass = \""+ inactiveClass + "\";\nboxClass = \""+ boxClass + "\";\ncssname = \""+cssname+"\";\n";
docstr+="nextURL = \""+nextURL+"\";\nexpname = \""+expname+ "\";\nrandomOrder = "+randomOrder +";\n";
docstr+="recOpenCells = false;\nmasterCond = "+masterCond+";\nloadMatrices();\n<\/SCRIPT>\n";
docstr+="<!--END TABLE STRUCTURE-->\n";
return docstr;
}

function createTable()
{ // create the HTML code for the mouselabWEB boxes

if (evtOpen==0) openEvt="onMouseOver"; else openEvt = "onClick";
if (evtClose==0) closeEvt="onMouseOut"; else 
				{if (evtClose<4) closeEvt = "onClick"; else closeEvt="";}

var docstr="";
docstr+="\n<!-- MOUSELAB TABLE -->\n<TABLE border=1>\n";

for (i=0;i<txtM.length;i++)
	{
	docstr+="<TR>"
	for (j=0;j<txtM[0].length;j++)
		{
		var label = String.fromCharCode(i+97)+j.toString();
		docstr+="\n<!--cell "+label+"(tag:"+tagM[i][j]+")-->\n<TD align=center valign=middle><DIV ID=\"" + label + "_cont\" style=\"position: relative; height: "+ rowHeight[i]+"px; width: "+ colWidth[j]+"px;\"><DIV ID=\""+label+ "_txt\" STYLE=\"position: absolute; left: 0px; top: 0px; height: "+ rowHeight[i]+"px; width: "+ colWidth[j]+"px; clip: rect(0px "+ colWidth[j]+"px "+ rowHeight[i]+"px 0px); z-index: 1;\"><TABLE><TD ID=\""+label+ "_td\" align=center valign=center width="+ (colWidth[j]-5).toString()+" height=" +(rowHeight[i]-5).toString()+" class=\"";
if (stateM[i][j]==1) {docstr+=activeClass;} else {docstr+=inactiveClass;};
docstr+="\">" + txtM[i][j]+"</TD></TABLE></DIV>";
docstr+="<DIV ID=\""+label+ "_box\" STYLE=\"position: absolute; left: 0px; top: 0px; height: "+ rowHeight[i]+"px; width: "+ colWidth[j]+"px; clip: rect(0px "+ colWidth[j]+"px "+ rowHeight[i]+"px 0px); z-index: 2;\"><TABLE><TD ID=\""+label+ "_tdbox\" align=center valign=center width="+ (colWidth[j]-5).toString()+" height=" +(rowHeight[i]-5).toString()+" class=\""+boxClass+"\">" + boxM[i][j]+"</TD></TABLE></DIV>";
docstr+="<DIV ID=\""+label+"_img\" STYLE=\"position: absolute; left: 0px; top: 0px; height: "+ rowHeight[i]+"px; width: "+ colWidth[j]+"px; z-index: 5;\">"
if ((evtOpen==1)&((evtClose==2)|(evtClose==1))) {docstr+="<A HREF=\"javascript:void(0);\" NAME=\""+label+"\" "+openEvt+"=\"SwitchCont('"+label+"',event)\""}
					else {docstr+="<A HREF=\"javascript:void(0);\" NAME=\""+label+"\" "+openEvt+"=\"ShowCont('"+label+"',event)\""
							if (evtClose!=3) {docstr+=" "+closeEvt+"=\"HideCont('"+label+"',event)\""}
					}
docstr+="><IMG NAME=\""+label+"\" SRC=\"transp.gif\" border=0 width="+ colWidth[j]+" height="+ rowHeight[i]+"></A></DIV></DIV></TD>\n";
docstr+="<!--end cell-->";
		}
	if (btnFlg==2) 
				{ if (btnState[i]=="1") 
							{
							docstr+="<TD ID=\"btn_"+i.toString()+"\" style=\"border-left-style: none; border-right-style: none; border-bottom-style: none;\" align=center valign=middle>"
						var functionstr = "onMouseOver=\"timefunction('mouseover','"+btnTag[i]+"','"+btnTxt[i]+"')\" onClick=\"recChoice('onclick','"+btnTag[i]+"','"+btnTxt[i]+"')\" onMouseOut=\"timefunction('mouseout','"+btnTag[i]+"','"+btnTxt[i]+"')\""; 
							if (btnType=="radio") {docstr+="<INPUT type=\"radio\" name=\"mlchoice\" value=\""+btnTag[i]+"\" "+functionstr+">"+btnTxt[i]} 
						   			    else {docstr+="<INPUT type=\"button\" class=\"btnStyle\" name=\"" + btnTag[i] + "\" value=\""+btnTxt[i]+"\" "+functionstr+">"}; 
						docstr+="</TD>\n";
							}
							else
							{docstr+="<TD ID=\"btn_"+i.toString()+"\" style=\"border-top-style: none; border-right-style: none; border-bottom-style: none;\">&nbsp;</TD>";}
				}
	docstr+="</TR>";
	}
	
if (btnFlg==1) 
{
docstr+="<TR>";
for (i=0;i<txtM[0].length;i++)
			{ if (btnState[i]=="1") 
						{
						docstr+="<TD ID=\"btn_"+i.toString()+"\" style=\"border-left-style: none; border-right-style: none; border-bottom-style: none;\" align=center valign=middle>"
						var functionstr = "onMouseOver=\"timefunction('mouseover','"+btnTag[i]+"','"+btnTxt[i]+"')\" onClick=\"recChoice('onclick','"+btnTag[i]+"','"+btnTxt[i]+"')\" onMouseOut=\"timefunction('mouseout','"+btnTag[i]+"','"+btnTxt[i]+"')\""; 
						if (btnType=="radio") {docstr+="<INPUT type=\"radio\" name=\"mlchoice\" value=\""+btnTag[i]+"\" "+functionstr+">"+btnTxt[i]} 
						   			    else {docstr+="<INPUT type=\"button\" name=\"" + btnTag[i] + "\" value=\""+btnTxt[i]+"\" "+functionstr+">"}; 
						docstr+="</TD>\n";
						}
						else
						{docstr+="<TD ID=\"btn_"+i.toString()+"\" style=\"border-left-style: none; border-right-style: none; border-bottom-style: none;\">&nbsp;</TD>";}
			}
docstr+="</TR>";
}
if (tmActive & tmPos==2) 
	{docstr+="<tr><td colspan="+txtM[0].length+"><!-- Begin HTML Time Bar --><table><tr><td>"+tmLabel+"</td><td colspan=2><div id=\"tmCont\" class=\"tmCont\"><div id=\"tmBar\" class=\"tmBar\"></div><div id=\"tmTime\" class=\"tmTime\"></div></div></td></TR></table><!-- End HTML Time Bar --></td></tr>";}
docstr+="</TABLE>\n<!-- END MOUSELAB TABLE -->\n";
return docstr;

}
function testDoc()
{ // test the page in a separate window
if ((colType.length==0)|(rowType.length==0)) {showT=false} else {showT=true};

saveFields();

//create col and row list for CB
	numCond=chkConnects();
	var colList = new Array();
	var rowList = new Array();

// create item for each CB condition
	for (var subjnr=0;subjnr<numCond;subjnr++)
		{
		var subjDen = 1;   
		if (c1.length>0) {c1_order=CountBal(subjnr/subjDen+1,c1.length); 
							subjDen = subjDen*fac(c1.length);} 
		var c1count=0;
		colList[subjnr]= new Array();
		for (var i=0; i<colType.length; i++)
			{
			switch (parseInt(colType[i]))
				{ 
				case 0: colList[subjnr][i]=i;break;
				case 1: colList[subjnr][i]=c1[c1_order[c1count]];c1count++;break;
				}
			}
	// counterbalance rows					
		if (r1.length>0) {r1_order=CountBal(subjnr/subjDen+1,r1.length); subjDen = subjDen * fac(r1.length);} 
		var r1count=0;
		rowList[subjnr]= new Array();
		for (var i=0; i<rowType.length; i++)
			{
			switch (parseInt(rowType[i]))
				{	 
				case 0: rowList[subjnr][i]=i;break;
				case 1: rowList[subjnr][i]=r1[r1_order[r1count]];r1count++;break;
				}
			}
		}

var docstr="";
docstr="<HTML>\n<HEAD>\n<TITLE>Mouselab WEB Table Test</TITLE>\n<script language='javascript' src=\"mlweb.js\"><\/SCRIPT>\n<link rel=\"stylesheet\" href=\""+cssname+"\" type=\"text/css\">\n<\/head>\n\n<body onLoad=\"timefunction('onload','body','body')\">"


if (showT) {docstr+=createTableStruct(false);}

docstr+="<script language=\"javascript\">masterCond=1;\n" 
// set masterCond back to one despite mastercond in page to be able to pbrose the conditions.
if (randomOrder) {docstr+="ref_cur_hit=-1;"} else {docstr+="ref_cur_hit=0;"}
docstr+="</script>\n<H1>Mouselab<sub>WEB</sub> Test Table</H1>"

docstr+="<FORM name=\""+mlweb_fname+"\" onSubmit=\"return checkForm(this)\" action=\"javascript:window.close()\"><INPUT type=hidden name=\"procdata\" value=\"\">\n"
docstr+="<input type=hidden name=\"subject\" value=\"\">\n"
docstr+="<input type=hidden name=\"expname\" value=\""+expname+"\">\n"
docstr+="<input type=hidden name=\"nextURL\" value=\"\">\n"
docstr+="<input type=hidden name=\"choice\" value=\"\">\n"
docstr+="<input type=hidden name=\"condnum\" value=\"\">\n"

docstr+=preHTML;

if (showT) {docstr+=createTable();}

docstr+=postHTML;

if (showT) {
	docstr+="<P>Select condition: <SELECT name=\"condlist\" onChange=\"chgSubj(this.form)\">"
	if (randomOrder) {docstr+="<Option value=-1>randomize</option>\n"}
	if (CBpreset==false) {noTestCond = numCond;} else {noTestCond = CBcolList.length;}

	for (i=0;i<noTestCond;i++)
		{
		if (i>=numCond) {colList[i]=new Array();rowList[i]=new Array();};
		
		for (j=0;j<colType.length;j++)
			{
				if (CBpreset) { colList[i][j]=CBcolList[i][j]+1} 
								else 
								{colList[i][j]=colList[i][j]+1}
			}
		for (j=0;j<rowType.length;j++)
			{
				if (CBpreset) { rowList[i][j]=CBrowList[i][j]+1} 
								else 
								{rowList[i][j]=rowList[i][j]+1}
			}
			
		docstr+="<Option value="+i+">"+(i+1).toString()+":  "
		docstr+="col:"+colList[i].join("|")+"  row:"+rowList[i].join("|")
		docstr+="</option>\n"
		}
	docstr+="</SELECT>"
	docstr+="&nbsp;&nbsp;Press button to view the data: <INPUT type=button name=\"Show\" value=\"Show Data\" onClick=\"document.forms[0].shdata.value=document.forms[0].procdata.value\"></P><TEXTAREA name=\"shdata\" cols=80 rows=8>-</textarea>"
	docstr+="<SCRIPT language=\"javascript\">\nfunction chgSubj(formlink){\n";
docstr+="formlink.procdata.value=\"\";\ndtNewDate = new Date();starttime = dtNewDate.getTime();\nref_cur_hit=parseInt(formlink.condlist.value);if (formlink.condlist.value==-1) {randomOrder=true;} else {randomOrder=false;};\nreorder();\n}\n<\/SCRIPT>\n" 
}
docstr+="<P>Pressing <B>Next page</B> will submit form (if all conditions are met, e.g. choice made etc.) and close this window.</P>"
docstr+="<INPUT type=\"submit\" value=\"Next Page\" onClick=timefunction('submit','submit','submit')></FORM></body></html>\n";

testWin = window.open("","testWin", "scrollbars, status")
testWin.document.write(docstr); 
testWin.document.close();
testWin.focus();
if (document.all)
			{	
			// reload page for IE
			testWin.document.location.reload();
			}
}

function inTableStruct()
{  // input screen to retrieve code from existing pages

saveFields();

var docstr="";
docstr="<h1>Input Table Structure</h1>";
docstr+="<P style=\"color: red;\"><B>This will erase the current structure!</B></P>";
docstr+="<P>Copy and paste HTML (or php) code from any previous mouselabWEB table into the box below.As much information as possible is extracted from the code, such as the window title, pre- and post-HTML, and the mouselabWEB table structure. All other HTML/php code will be ignored</P>";
docstr+="<TEXTAREA name=txt id=txt cols=100 rows=10></TEXTAREA><BR>";
docstr+="<INPUT type=button value=\"get Structure\" onClick=\"top.getStruct()\">&nbsp;&nbsp;<input type=button value=\"close\" onClick=\"top.refreshTable()\">"

top.tableFrm.document.getElementById("edit").innerHTML = docstr;
}
function getStruct()
{ // get the structure from an exsisting page

// check for window title 
htmlCode = top.tableFrm.document.forms[0].txt.value;
startpos=(htmlCode.toUpperCase()).indexOf("<TITLE>");
if (startpos!=-1) {windowName=htmlCode.slice(startpos+7, (htmlCode.toUpperCase()).indexOf("</TITLE>"))} else {windowName="MouselabWEB Survey"};

//check for submit button text 
startpos=(htmlCode.toUpperCase()).indexOf("<INPUT TYPE=\"SUBMIT\"");
if (startpos!=-1) {submitstring=htmlCode.slice(startpos, (htmlCode.toUpperCase()).indexOf(">",startpos)+1);} else {submitstring==""};

//check for expname text 
startpos=htmlCode.indexOf("<input type=hidden name=\"expname\"");
if (startpos!=-1) {expnamestring=htmlCode.slice(startpos, htmlCode.indexOf(">",startpos)+1);} else {expnamestring=""};
//check for nextURL text 
startpos=htmlCode.indexOf("<input type=hidden name=\"nextURL\"");
if (startpos!=-1) {nextURLstring=htmlCode.slice(startpos, htmlCode.indexOf(">",startpos)+1);} else {nextURLstring=""};
																		
//check for toemail text 
startpos=htmlCode.indexOf("<input type=hidden name=\"to_email\"");
if (startpos!=-1) {emailstring=htmlCode.slice(startpos, htmlCode.indexOf(">",startpos)+1);} else {emailstring=""};
																		   
// get pre-HTML and post-HTML
startpos=htmlCode.indexOf("<!--BEGIN preHTML-->");
if (startpos!=-1) {preHTML=htmlCode.slice(startpos+20, htmlCode.indexOf("<!--END preHTML-->"))} else {preHTML=""};
startpos=htmlCode.indexOf("<!--BEGIN postHTML-->");
if (startpos!=-1) {postHTML=htmlCode.slice(startpos+21, htmlCode.indexOf("<!--END postHTML-->"))} else {postHTML=""};


startpos=htmlCode.indexOf("<!--BEGIN TABLE STRUCTURE-->");
if (startpos==-1) {startpos=htmlCode.indexOf("<!--BEGIN phpESP TABLE STRUCTURE-->");var typeESP=true;} else {var typeESP=false;}
endpos=htmlCode.indexOf("<!--END TABLE STRUCTURE-->");

if (startpos==-1)
{//code to input non-mlwebtable page
startpos=htmlCode.indexOf("<!--BEGIN set vars-->");
endpos=htmlCode.indexOf("<!--END set vars-->");
if (startpos!=-1) {scripttxt = htmlCode.slice(startpos, endpos)} else {scripttxt=""}
var docstr="";
docstr+="<HTML><HEAD></HEAD><BODY>"+scripttxt+"<FORM>"+submitstring+expnamestring+nextURLstring+emailstring+"</FORM>Loading Structure</BODY></HTML>"
hiddenFrm.document.write(docstr);
hiddenFrm.document.close();

activeRow = -1;
	activeCol = -1;

	colType = new Array();
	rowType = new Array();
	colWidth = new Array();
	rowHeight = new Array();
	
	txtM = new Array();
	txtM[0]= new Array();
	
	boxM = new Array();
	boxM[0]= new Array();
	
	stateM = new Array();
	stateM[0]=new Array();
	
	tagM = new Array();
	tagM[0]=new Array();
	
	globalshown=false;
	
	btnFlg = 0; // 0 is no buttons, 1 is col buttons, 2 is row buttons
	btnTxt = new Array();
	btnState = new Array();
	btnTag = new Array();
	btnType = "radio";
		
	masterCond = 1;
	if (hiddenFrm.document.forms[0].nextURL) {nextURL=hiddenFrm.document.forms[0].nextURL.value;} else {	nextURL = "thanks.html"};
	if (hiddenFrm.document.forms[0].expname) {expname=hiddenFrm.document.forms[0].expname.value;} else {	expname = "";}
	if (hiddenFrm.document.forms[0].to_email) {to_email=hiddenFrm.document.forms[0].to_email.value;} else {	to_email = "";}
	if (hiddenFrm.document.forms[0].submit) {submitName=hiddenFrm.document.forms[0].elements[0].value;} else {submitName = "Next Page";}
	mlweb_outtype = hiddenFrm.mlweb_outtype;
	mlweb_fname = hiddenFrm.mlweb_fname;
	
	chkFrm=hiddenFrm.chkFrm;
	warningTxt = hiddenFrm.warningTxt;
	randomOrder = false;
	
	refreshTable(true);
}
else
{ // code to input mlwebtable page
var docstr="";
docstr+="<HTML><HEAD><SCRIPT language=\"javascript\">function loadMatrices(){return}<\/SCRIPT></HEAD><BODY>"+htmlCode.slice(startpos, endpos)+"<FORM>"+submitstring+"</FORM>Loading Structure</BODY></HTML>"
hiddenFrm.document.write(docstr);
hiddenFrm.document.close();

if (typeESP) {mlweb_outtype = "XML"; mlweb_fname="mlwebform";} else {mlweb_outtype = hiddenFrm.mlweb_outtype;mlweb_fname=hiddenFrm.mlweb_fname;}

txtM = copyOfArray(ExpMatrix(hiddenFrm.txt));
stateM = copyOfArray(ExpMatrix(hiddenFrm.state));  

tagM = copyOfArray(ExpMatrix(hiddenFrm.tag));	
boxM = copyOfArray(ExpMatrix(hiddenFrm.box));
colWidth = ExpRow(hiddenFrm.W_Col);
rowHeight = ExpRow(hiddenFrm.H_Row);

colType = ExpRow(hiddenFrm.CBCol);
rowType = ExpRow(hiddenFrm.CBRow);
// backwards compatibility with version <1.00
// replace type 2 cols and rows with type 1

for (i=0;i<colType.length;i++)
	{if (parseInt(colType[i])==2) {colType[i]=1}}
for (i=0;i<rowType.length;i++)
	{if (parseInt(rowType[i])==2) {rowType[i]=1}}
	
btnFlg = parseInt(hiddenFrm.btnFlg);
btnType = hiddenFrm.btnType;

btnTxt = ExpRow(hiddenFrm.btntxt);
btnTag = ExpRow(hiddenFrm.btntag);
btnState = ExpRow(hiddenFrm.btnstate);
to_email = hiddenFrm.to_email;

colFix = hiddenFrm.colFix;
rowFix = hiddenFrm.rowFix;
CBpreset = hiddenFrm.CBpreset;
if (CBpreset)
		{	
		CBordM = copyOfArray(ExpMatrix(hiddenFrm.CBord));
		CBcolList = new Array();
		CBrowList = new Array();
		for (i=0;i<CBordM.length;i++)
				{
					CBcolList[i]= new Array();
					for (cols=0;cols<colType.length;cols++)
						{CBcolList[i][cols]=parseInt(CBordM[i][cols]);}
					CBrowList[i]= new Array();
					for (rows=0;rows<rowType.length;rows++)
						{CBrowList[i][rows]=parseInt(CBordM[i][colType.length+rows]);}
				}
		}

activeClass = hiddenFrm.activeClass;
inactiveClass = hiddenFrm.inactiveClass;
boxClass = hiddenFrm.boxClass;
cssname = hiddenFrm.cssname;
randomOrder = hiddenFrm.randomOrder;
nextURL = hiddenFrm.nextURL;
expname = hiddenFrm.expname;
masterCond = hiddenFrm.masterCond;
chkFrm = hiddenFrm.chkFrm;
warningTxt = hiddenFrm.warningTxt;
evtOpen = (hiddenFrm.evtOpen ? hiddenFrm.evtOpen : 0);
evtClose = (hiddenFrm.evtClose ? hiddenFrm.evtClose : 0);

if (tmTotalSec)
{
	tmTotalSec = hiddenFrm.tmTotalSec;
	tmStepSec = hiddenFrm.tmStepSec;
	tmWidthPx = hiddenFrm.tmWidthPx;
	tmFill = hiddenFrm.tmFill;
	tmShowTime = hiddenFrm.tmShowTime;
	tmCurTime = hiddenFrm.tmCurTime;
	tmActive = hiddenFrm.tmActive;
	tmDirectStart = hiddenFrm.tmDirectStart;
	tmMinLabel = hiddenFrm.tmMinLabel;
	tmSecLabel = hiddenFrm.tmSecLabel;
	tmLabel = hiddenFrm.tmLabel;
}
if (hiddenFrm.document.forms[0].submit) {submitName=hiddenFrm.document.forms[0].elements[0].value;} else {submitName="Next Page"}

activeCol=-1;
activeRow=-1;
refreshTable(true);
}

}

function resetStruct()
{ // reset the current structure to empty tables and default values
if (confirm("This will delete the current design. Continue?"))
	{
	activeRow = -1;
	activeCol = -1;

	colType = new Array();
	rowType = new Array();
	colWidth = new Array();
	rowHeight = new Array();
	
	txtM = new Array();
	txtM[0]= new Array();
	
	boxM = new Array();
	boxM[0]= new Array();
	
	stateM = new Array();
	stateM[0]=new Array();
	
	tagM = new Array();
	tagM[0]=new Array();
	
	globalshown=false;
	
	btnFlg = 0; // 0 is no buttons, 1 is col buttons, 2 is row buttons
	btnTxt = new Array();
	btnState = new Array();
	btnTag = new Array();
	btnType = "radio";
	
	masterCond = 1;
	nextURL = "thanks.html";
	expname = "";
	to_email = "";
	mlweb_outtype = "CSV";
	mlweb_fname = "mlwebform";
	randomOrder = false;
	colFix = false;
	rowFix = false;
	
	evtOpen = 0;
	evtClose = 0;
	
	preHTML = "";
	postHTML = "";
	windowName="MouselabWEB survey";
	submitName="Next Page";
	warningTxt = "Some questions have not been answered. Please answer all questions before continuing!";
	chkFrm=false;
	refreshTable(true);
	}
}

function outHTML()
{ // output HTML code
if ((colType.length==0)|(rowType.length==0)) {mlwebTable=false} else {mlwebTable=true};
saveFields();
if (expname=="") 
		{
		alert("Experiment name is empty.\nPlease enter a name before continuing");
		return false;
		}
if (to_email=="")
		{if (!confirm("Email address is empty. If you plan to use the form mailer, a valid email is required. \nDo you want to continue with an empty email adress?")) {return false}
		}
IOWin = window.open("","IOWin", "width=600,height=500, scrollbars, resizable");
docstr="";
docstr+="<HTML><HEAD><TITLE>Output HTML</TITLE><link rel=\"stylesheet\" href=\"mlwebdesign.css\" type=\"text/css\"></HEAD><BODY>";
docstr+="<h1>Output HTML</h1>";
docstr+="<h2>Template document</H2><P>You can create you web page based on the template below. This template uses the mouselabWEB form mailer (which only sends to registered users). Edit the page to add extra instruction texts and then upload it to your web-folder.</P>"
docstr+="<P>The following files should be in the same web-folder as this page, otherwise the page will not work correctly:</P><UL><LI>The stylesheet as assigned in the editor: <I>"+cssname+"</I></LI><LI>The mlweb javascript file: <I>mlweb.js</I> </LI><LI>A transparent image named: <I>transp.gif</I></LI><LI>The next page (nextURL: <I>"+nextURL+"</I>) should exist.</LI></UL>"
docstr += "<FORM method=post action='download.php'><TEXTAREA name=pagetxt cols=100 rows=10>"
docstr +=createTemplate("HTML", mlwebTable);
docstr +="</TEXTAREA>";
docstr+="<BR><input type=hidden name=pagename value='"+expname+".html'><input type=submit value='download'>";

if (mlwebTable) 
{
	docstr+="<h2>Step by Step method (existing pages)</h2><P>The method below can be used for entering code into existing web pages with an existing form. This is for experienced users only</P>"
	docstr+="<h3>Step 1: HTML HEADER</h3><P>Enter a link to the script and the stylesheet into the head of the HTML document (between <code>&lt;HEAD&gt;<code> and <code>&lt;/HEAD&gt;</code>). </P><TEXTAREA cols=100 rows=2><script language=javascript src=\"mlweb.js\"><\/SCRIPT>\n<link rel=\"stylesheet\" href=\""+cssname+"\" type=\"text/css\"></TEXTAREA>";
	docstr+="<h3>Step 2: Adjust body tag</h3><P>Make sure the body tag contains the onload function as in this example: <CODE>&lt;body onLoad=\"timefunction('onload','body','body')\"&gt;</code>. Without this onLoad function, the table cells will not be rearranged/counterbalanced.</P>";
	docstr+="<h3>Step 3: Insert PreHTML (optional)</h3><P>The preHTML code you entered during the design phase can be added to the HTML code. Using the HTML comment tags (like <code>&lt;!--BEGIN preHTML--></code>) allows you to import the HTML file back into the designer later for fine tuning.</P><Textarea cols=100 rows=3>&lt;!--BEGIN preHTML-->\n"+cHTML(preHTML)+"\n&lt;!--END preHTML--></TEXTAREA>";
	docstr+="<h3>Step 4: Enter Table Structure</h3><P>Paste the following script into the document after the body tag. This script contains all table properties.</P><TEXTAREA cols=100 rows=10>"+createTableStruct(false)+"</TEXTAREA>";
	docstr+="<h3>Step 5: The Mouselab Table</h3><P>Enter the mouselab table into the document</P><TEXTAREA cols=100 rows=10>"+createTable()+"</TEXTAREA>";
	docstr+="<h3>Step 6: Insert PostHTML (optional)</h3><P>The postHTML code you entered during the design phase can be added to the HTML code. Using the HTML comment tags (like <code>&lt;!--BEGIN postHTML--></code>) allows you to import the HTML file back into the designer later for fine tuning.</P><Textarea cols=100 rows=3>&lt;!--BEGIN postHTML-->\n"+cHTML(postHTML)+"\n&lt;!--END postHTML--></TEXTAREA>";
	docstr+="<h3>Step 7: Form name</h3><P>The default form name is set in the script that is entered in step 3. Make sure the document contains a form with this name (or change the name in the script). The form should have a (hidden) <code>&lt;INPUT&gt;</code> element that has the name <code>procdata</code>. In this element the process data is stored.<BR>The form tag should also contain this onSubmit function, which checks whether the one of the buttons is pressed:<BR><code>onSubmit=\"return checkForm(this)\"</code><BR><I>Note:</I>This function is not necessary if the mouselab table does not contain buttons.</P>";   
	docstr+="<h3>Step 8: Files needed</h3><P>Make sure that the script file <code>mlweb.js</code>, the transparent image <code>transp.gif</code> are in the same folder as the HTML file.</P>";
}
docstr+="<input type=button value=\"close\" onClick=\"window.close()\">";
docstr+="</FORM></BODY></HTML>";
IOWin.document.write(docstr);
IOWin.document.close();
IOWin.focus();
}

function outPHP()
{ // output PHP
if ((colType.length==0)|(rowType.length==0)) {mlwebTable=false} else {mlwebTable=true};
saveFields();
if (expname=="") 
		{
		alert("Experiment name is empty.\nPlease enter a name before continuing");
		return false;
		}
IOWin = window.open("","IOWin", "width=600,height=500, scrollbars, resizable");
txtstr="";
txtstr+="<HTML><HEAD><TITLE>Output PHP</TITLE><link rel=\"stylesheet\" href=\"mlwebdesign.css\" type=\"text/css\"></HEAD><BODY>";
txtstr+="<h1>Output template for PHP</h1>";
txtstr+="<P>Save the following text as <B>"+expname+".php</B>. FTP the file to an PHP enabled webserver, in the folder where the php-package is installed. Whenever this page is called with two additional attributes, e.g. "+expname+".php?subject=[subjectname]&condnum=[somenumber], it will save the data in a table called mlweb, using this [subjectname] as a subject identifier and counterbalancing on [condnum].</P>";  
txtstr+="<P>The following files should be in the same web-folder as this page, otherwise the page will not work correctly:</P><UL><LI>The stylesheet as assigned in the designer: <I>"+cssname+"</I></LI><LI>The mlweb javascript file: <I>mlweb.js</I> </LI><LI>A transparent image named: <I>transp.gif</I></LI><LI>A <I>configured</I> file that links to the database: <I>mlwebdb.inc.php</I></LI><LI>The file that saves the data in the database: <I>save.php</I></LI><LI>The next page (nextURL: <I>"+nextURL+"</I>) should exist.</LI></UL>"
txtstr+="<P>All these files, including default stylesheets, are in the distribution package and would normally already be installed on the webserver. For installation and setting up the links to the database, see the manual.</P>"

var docstr="";

docstr+=createTemplate("PHP",mlwebTable);

txtstr+="<FORM method=post action='download.php'><TEXTAREA name=pagetxt cols=100 rows=10>"+docstr+"</TEXTAREA><BR>";
txtstr+="<input type=hidden name=pagename value='"+expname+".php'><input type=button value=\"close\" onClick=\"window.close()\">&nbsp;<input type=submit value='download'>";
txtstr+="</FORM></BODY></HTML>";
IOWin.document.write(txtstr);
IOWin.document.close();
IOWin.focus();

}

function createTemplate(type, tableFlag)
{ // create the code for HTML or PHP output, both with and without MLWEB table
var outstr=""

if (tableFlag) 
{
	// tableFlag true: build page with mouselabWeb Table
	if (type=="PHP")
			{
			header="<?php \nif (isset($_GET['subject'])) {$subject=$_GET['subject'];}\n else {$subject=\"anonymous\";}\n"
			+ "if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}\n	else {$condnum=-1;}?>";
			actpage = "save.php";
			varscript="<script language=\"javascript\">\nref_cur_hit = <?php echo($condnum);?>;\nsubject = \"<?php echo($subject);?>\";\n<\/script>\n"
			}
		else
			{
			header="";
			actpage="http://www.mouselabweb.org/mlwebmailer.php"
			varscript="";
			}
	
	outstr=header+"<HTML>\n<HEAD>\n<TITLE>"+windowName+"</TITLE>\n<script language=javascript src=\"mlweb.js\"><\/SCRIPT>\n<link rel=\"stylesheet\" href=\""+cssname+"\" type=\"text/css\">\n<\/head>\n\n<body onLoad=\"timefunction('onload','body','body')\">\n"+varscript;
	outstr+=createTableStruct(false);
	outstr+="\n<FORM name=\""+mlweb_fname+"\" onSubmit=\"return checkForm(this)\" method=\"POST\" action=\""+actpage+"\"><INPUT type=hidden name=\"procdata\" value=\"\">\n";
	outstr+="<input type=hidden name=\"subject\" value=\"\">\n";
	outstr+="<input type=hidden name=\"expname\" value=\"\">\n";
	outstr+="<input type=hidden name=\"nextURL\" value=\"\">\n";
	outstr+="<input type=hidden name=\"choice\" value=\"\">\n";
	outstr+="<input type=hidden name=\"condnum\" value=\"\">\n";
	outstr+="<input type=hidden name=\"to_email\" value=\"\">\n";
	outstr+="<!--BEGIN preHTML-->\n"+cHTML(preHTML)+"\n<!--END preHTML-->";
	outstr+=createTable();
	
	outstr+="<!--BEGIN postHTML-->\n"+cHTML(postHTML)+"\n<!--END postHTML-->";
	
	outstr+="<INPUT type=\"submit\" value=\""+submitName+"\" onClick=timefunction('submit','submit','submit')></FORM></body></html>\n";
}
else
{
	//tableFlag is false: build page with only forms
		
	if (type=="PHP")
			{
			header="<?php \nif (isset($_GET['subject'])) {$subject=$_GET['subject'];}\n else {$subject=\"anonymous\";}\n"
			+ "if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}\n	else {$condnum=-1;}\n?>";
			actpage = "save.php";
			}
		else
			{
			header="";
			actpage="http://www.mouselabweb.org/mlwebmailer.php"
			}
	
	outstr=header+"<HTML>\n<HEAD>\n<TITLE>"+windowName+"</TITLE>\n<script language=javascript src=\"mlweb2.js\"><\/SCRIPT>\n<link rel=\"stylesheet\" href=\""+cssname+"\" type=\"text/css\">\n<\/head>\n\n<body onLoad=\"timefunction('onload','body','body')\">\n";
	outstr+="<!--BEGIN set vars--><script language=\"javascript\">\n\/\/override defaults\nmlweb_outtype=\""+mlweb_outtype+"\";\nmlweb_fname=\""+mlweb_fname+"\";\n";
	if (chkFrm) {outstr+="\nchkFrm=true;\n"} else {outstr+="\nchkFrm=false;\n"}
	outstr+="warningTxt=\""+warningTxt+"\";\n";
	outstr+="</SCRIPT>\n<!--END set vars-->\n";
	outstr+="\n<FORM name=\""+mlweb_fname+"\" method=\"POST\" onSubmit=\"return checkForm(this)\" action=\""+actpage+"\">\n<INPUT type=hidden name=\"procdata\" value=\"\">\n";
	outstr+="<!-- set all variables here -->\n<input type=hidden name=\"expname\" value=\""+expname+"\">\n";
    outstr+="<input type=hidden name=\"nextURL\" value=\""+nextURL+"\">\n";
    outstr+="<input type=hidden name=\"to_email\" value=\""+to_email+"\">\n";
    outstr+="<!--these will be set by the script -->\n";
    outstr+="<input type=hidden name=\"subject\" value=\"<?php echo($subject)?>\">\n";
    outstr+="<input type=hidden name=\"condnum\" value=\"<?php echo($condnum)?>\">\n";
	outstr+="<!--BEGIN preHTML-->\n"+cHTML(preHTML)+"\n<!--END preHTML-->";

	outstr+="<!--BEGIN postHTML-->\n"+cHTML(postHTML)+"\n<!--END postHTML-->";
	
	outstr+="<INPUT type=\"submit\" value=\""+submitName+"\"></FORM></body></html>\n";
}
return outstr;	
}

function buildCBList()
{
if (colType.length<1 | rowType.length<1) {return false};

docstr="<TABLE class=\"tblStyle\"><TR><TD rowspan=2 class=\"labelTD\">Ord.no.</TD><TD colspan="+colType.length+" class=\"labelTD\">Columns</TD><TD rowspan=2 class=\"labelTD\">&nbsp;&nbsp;</TD><TD colspan="+rowType.length+" class=\"labelTD\">Rows</TD><TD rowspan=2 class=\"labelTD\">Sel</TD></TR><TR>";
//draw header row
	for (var i=1;i<=colType.length;i++)
			{
			docstr+="<TD align=center class=\"labelTD\">"+i+"</TD>";
			}
	for (var i=1;i<=rowType.length;i++)
			{
			docstr+="<TD align=center class=\"labelTD\">"+i+"</TD>";
			}
	docstr+="</TR>";
	
	for (var i=0;i<CBcolList.length;i++)
	{
	docstr+="<TR><TD align=center class=\"labelTD\">"+(i+1).toString()+"</TD>";
	for (var cols=0;cols<colType.length;cols++)
			{
			//alert(cols+"\n"+CBcolList[i][cols]);
			docstr+="<TD align=center class=\"inpTD\">"+(CBcolList[i][cols]+1).toString()+"</TD>";
			}
			docstr+="<TD align=center class=\"labelTD\">&nbsp;</TD>";
	for (var rows=0;rows<rowType.length;rows++)
			{
			docstr+="<TD align=center class=\"inpTD\">"+(CBrowList[i][rows]+1).toString()+"</TD>";
			}
	docstr+="<TD align=center class=\"labelTD\"><input type=checkbox value=\""+i.toString()+"\" name=\"listSel"+i.toString()+"\" id=\"listSel"+i.toString()+"\"></TD></TR>"
	}
	docstr+="</TABLE>"
	top.tableFrm.document.getElementById('CBList').innerHTML=docstr;
	
}

function changeCB(action)
{
if (action=="setAuto") {CBpreset=false;}
if (action=="setManual") {CBpreset=true;}

if (action=="selAll") 
	{
		for (i=0;i<CBcolList.length;i++)
			{
				top.tableFrm.document.getElementById('listSel'+i.toString()).checked = true;
			}
	}
	
if (action=="invSel") 
	{
		for (i=0;i<CBcolList.length;i++)
			{
				if (top.tableFrm.document.getElementById('listSel'+i.toString()).checked)
					{top.tableFrm.document.getElementById('listSel'+i.toString()).checked= false;}
					else
					{top.tableFrm.document.getElementById('listSel'+i.toString()).checked = true;}
			}
	}

if (action=="delSel")
	{
	var oldCBcol = new Array();
		var oldCBrow = new Array();
		
		for (i=0;i<CBcolList.length;i++)
			{
			oldCBcol[i] = copyOfArray(CBcolList[i]);
			oldCBrow[i] = copyOfArray(CBrowList[i]);
			}
		CBcolList=new Array();
		CBrowList=new Array();
	
		for (i=0;i<oldCBcol.length;i++)
			{
				if (!top.tableFrm.document.getElementById('listSel'+i.toString()).checked)
					{
						CBcolList[CBcolList.length]=copyOfArray(oldCBcol[i]);
						CBrowList[CBrowList.length]=copyOfArray(oldCBrow[i]);
					}
			}
			
	buildCBList();
	}
	
if (action=='close')
	{
	if (CBcolList.length<1) {CBpreset=false;}
	top.tableFrm.document.getElementById('CBLyr').style.visibility="hidden";
	refreshTable(false);
	}
	
if (action=="showList")
	{
	buildCBList();
	}

if (action=='add')
	{
	var inputCol = top.tableFrm.document.getElementById('colord').value.split(";");
	var inputRow = top.tableFrm.document.getElementById('roword').value.split(";");
	for (i=0;i<inputCol.length;i++)
		{inputCol[i]=parseInt(inputCol[i])-1}
	for (i=0;i<inputRow.length;i++)
		{inputRow[i]=parseInt(inputRow[i])-1}
	var colChk = new Array();
	var rowChk = new Array();
	for (i=0;i<colType.length;i++)
		{colChk[i]=i}
	for (i=0;i<rowType.length;i++)
		{rowChk[i]=i}
		var chkInpCol = copyOfArray(inputCol);
		var chkInpRow = copyOfArray(inputRow);
		
	if (chkInpCol.sort().join() != colChk.join()) {colmsg=true} else {colmsg=false}
	if (chkInpRow.sort().join() != rowChk.join()) {rowmsg=true} else {rowmsg=false}
	
	if (colmsg|rowmsg)
		{msgstr=(colmsg ? "There is an error in the column order\n" : "")+(rowmsg ? "There is an error in the row order\n" : "")+"Please enter the order using numbers, seperated by semicolons (example: 2;1;3)"
		alert(msgstr);}
			else
		{	CBcolList[CBcolList.length]=copyOfArray(inputCol);
			CBrowList[CBrowList.length]=copyOfArray(inputRow);
				buildCBList();
		}
	}
	
if (action=="crList")
	{
	numCond=chkConnects();
	CBcolList = new Array();
	CBrowList = new Array();

// create item for each CB condition
	for (subjnr=0;subjnr<numCond;subjnr++)
		{
		subjDen = 1;   
		if (c1.length>0) {c1_order=CountBal(subjnr/subjDen+1,c1.length); 
							subjDen = subjDen*fac(c1.length);} 
		var c1count=0;
		CBcolList[subjnr]= new Array();
		for (var i=0; i<colType.length; i++)
			{
			switch (parseInt(colType[i]))
				{ 
				case 0: CBcolList[subjnr][i]=i;break;
				case 1: CBcolList[subjnr][i]=c1[c1_order[c1count]];c1count++;break;
				}
			}
	// counterbalance rows					
		if (r1.length>0) {r1_order=CountBal(subjnr/subjDen+1,r1.length); subjDen = subjDen * fac(r1.length);} 
		var r1count=0;
		CBrowList[subjnr]= new Array();
		for (var i=0; i<rowType.length; i++)
			{
			switch (parseInt(rowType[i]))
				{	 
				case 0: CBrowList[subjnr][i]=i;break;
				case 1: CBrowList[subjnr][i]=r1[r1_order[r1count]];r1count++;break;
				}
			}
		}
		buildCBList();
	}
}
