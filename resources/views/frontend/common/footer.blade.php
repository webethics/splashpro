<script>
$('#datepicker1').datepicker(); 
</script>
<script>
 document.getElementById("search-label").addEventListener("click", function(e) {
  if (e.target == this) {
    e.preventDefault();
    this.classList.toggle("clicked");
  }
});	
</script>