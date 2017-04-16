<input type="text" data-course-code="ITE 111A" id="try">

<script>
$(document).ready(function () {

	var myVal = $('#try').data('course-code');
	alert(myVal);

});
</script>