<form name="downloadForm" action="{{$AcsUrl}}" method="POST">
    <input type="hidden" name="PaReq" value="{{$PaReq}}">
    <input type="hidden" name="MD" value="{{$MD}}">
    <input type="hidden" name="TermUrl" value="{{applicationPaymentUrl()}}">
</form>
<script>
    window.onload = submitForm;
    function submitForm() { downloadForm.submit(); }
</script>
