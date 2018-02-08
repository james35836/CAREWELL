<!doctype html>
<html>
<head>
<title>Add options dynamically to bootstrap-select</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/custom.css" rel="stylesheet" />
<link href="plugins/Bootstrap-select v12/css/bootstrap-select.css" rel="stylesheet" />
<style type="text/css">
.dropdown-menu {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
.dropdown-menu a {
   overflow: hidden;
   outline: none;
}
 
.bss-input
{
   border:0;
   margin:-3px;
   padding:3px;
   outline: none;
   color: #000;
   width: 99%;
}
 
.bss-input:hover
{
   background-color: #f5f5f5;
}
 
.additem .check-mark
{
   opacity: 0;
   z-index: -1000;
}
 
.addnewicon {
   position: relative;
   padding: 4px;
   margin: -8px;
   padding-right: 50px;
   margin-right: -50px;
   color: #aaa;
}
 
.addnewicon:hover {
   color: #222;
}
</style>
</head>
<body>
<div class="wrapper">
  <header>
    <div class="container">
    <h1 class="col-lg-9">Add options dynamically to bootstrap-select</h1>
    </div>
  </header>
  <div class="container">
    <h5>Author: Julian Hansen August, 2017</h5>
  <p><b>UPDATE: 2017-08-08</b> Tested with jQuery 3 you can see it <a href="t1161-jq3.html">here</a></p>
  <p><b>UPDATE: 2017-08-08</b> The sample below has been updated to address some issues that were reported with it<p>
  <p>The issue was caused by a change in the way the bootstrap-select markup is created by the plugin. In the version used by the previous version
  of this sample the &lt;select&gt; was placed immediately before the bootstrap-select container. In later versions of the plugin the &lt;select&gt;
  was moved inside the .bootstrap-select container thus breaking this solution</p>
  
  <p>The code below has been updated to bring it in line with version v1.12.X of the bootstrap-select component</p>
  <p>The principle change (apart from the upgrade to version 1.12 of the bootstrap select plugin) was the following line which changed from
  <pre>var p=$(t).closest('.bootstrap-select').prev();</pre>
  To
  <pre>var p=$(t).closest('.bootstrap-select').find('select');</pre></p>
  <p>Other minor changes to markup were also made but do not affect the functionality</p>
  <b>Acknowledgement</b>
  <p>Thank you to Eric Nemchik for picking up the problem and suggesting some code changes</p>
<div class="row">
      <div class="col-lg-6">
        <h2>Select Sample #1</h2>
        <select class="selectpicker" id="select1">
          <option>Mustard</option>
          <option>Ketchup</option>
          <option>Relish</option>
        </select>    
      </div>
      <div class="col-lg-6">
        <h2>Select Sample #2</h2>
        <select class="selectpicker" id="select2">
          <option>Banana</option>
          <option>Peach</option>
          <option>Orange</option>
        </select>    
      </div>
    </div>
<div id="disqus_thread"></div>
<script>
var PAGE_URL ="http://www.marcorpsa.com/ee";
var PAGE_IDENTIFIER = "t1161.html";
 
/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
 
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
 
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://www-marcorpsa-com-ee.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
  </div>
</div>
<footer>
  <div class="container">
    Copyright Julian Hansen &copy; 2015
  </div>
</footer>
 
<script src="https://code.jquery.com/jquery.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="plugins/Bootstrap-select v12/js/bootstrap-select.js"></script>
<script>
$(function() {
  var content = "<input type='text' class='bss-input' onKeyDown='event.stopPropagation();' onKeyPress='addSelectInpKeyPress(this,event)' onClick='event.stopPropagation()' placeholder='Add item'> <span class='glyphicon glyphicon-plus addnewicon' onClick='addSelectItem(this,event,1);'></span>";
 
  var divider = $('<option/>')
          .addClass('divider')
          .data('divider', true);
          
 
  var addoption = $('<option/>', {class: 'addItem'})
          .data('content', content)
      
  $('.selectpicker')
          .append(divider)
          .append(addoption)
          .selectpicker();
 
});
 
function addSelectItem(t,ev)
{
   ev.stopPropagation();
   
   var bs = $(t).closest('.bootstrap-select')
   var txt=bs.find('.bss-input').val().replace(/[|]/g,"");
   var txt=$(t).prev().val().replace(/[|]/g,"");
   if ($.trim(txt)=='') return;
   
   // Changed from previous version to cater to new
   // layout used by bootstrap-select.
   var p=bs.find('select');
   var o=$('option', p).eq(-2);
   o.before( $("<option>", { "selected": true, "text": txt}) );
   p.selectpicker('refresh');
}
 
function addSelectInpKeyPress(t,ev)
{
   ev.stopPropagation();
 
   // do not allow pipe character
   if (ev.which==124) ev.preventDefault();
 
   // enter character adds the option
   if (ev.which==13)
   {
      ev.preventDefault();
      addSelectItem($(t).next(),ev);
   }
}
 
</script>
</body>
</html>