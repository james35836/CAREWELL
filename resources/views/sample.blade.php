<html><head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
{{-- <script type="text/javascript">
$(document).ready(function(){
var result = [];
  $('table tr').each(function(){
    $('td', this).each(function(index, val)
    {
      if(!result[index]) result[index] = 0;
      result[index] += parseInt($(val).text());
    });
  });
  
  $('table').append('<tr></tr>');
  $(result).each(function(){
    $('table tr').last().append('<td>'+this+'</td>')
  });
});
 
</script> --}}
<script type="text/javascript">
 $(document).ready(function(){
    $(".expenses").each(function() {

      $(this).keyup(function(){
            sum($(this).parents("tr"));
      });
    });
});
function sum(parent){
    var sum = 0;
    $(parent).find(".expenses").each(function(){
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }
    });
    $(parent).find(".expenses_sum").val(sum.toFixed(2));
}
</script>
</head>
<body>
  <table border="1">
  <tr>
    <th>sl</th>
    <th>TA</th>
    <th>DA</th>
    <th>HA</th>
    <th>Total</th>
  </tr>
  <tr>
    <td>1</td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses_sum"></td>
  </tr>
  <tr>
    <td>2</td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses_sum"></td>
  </tr>
  <tr>
    <td>3</td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses"></td>
    <td><input class="expenses_sum"></td>
  </tr>
</table>
{{-- <table style="border:2px solid black;">
    <tr>
      <td>2</td>
      <td>49</td>
      <td>98</td>
    </tr>
    <tr>
      <td>55</td>
      <td>1211</td>
      <td>2</td>
    </tr>
    <tr>
      <td>99</td>
      <td>1</td>
      <td>21</td>
    </tr>
    <tr><td>183</td>
      <td>12</td>
      <td>55</td>
    </tr>
</table> --}}
</body>
</html>