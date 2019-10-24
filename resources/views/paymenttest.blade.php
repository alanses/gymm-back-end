<form name="downloadForm" action="https://demo.cloudpayments.ru/acs" method="POST">
    <input type="hidden" name="PaReq" value="+/eyJNZXJjaGFudE5hbWUiOm51bGwsIkZpcnN0U2l4IjoiNDAxMjg4IiwiTGFzdEZvdXIiOiIxODgxIiwiQW1vdW50IjoxMC4wLCJDdXJyZW5jeUNvZGUiOiJSVUIiLCJEYXRlIjoiMjAxOS0xMC0yNFQwMDowMDowMCswMzowMCIsIkN1c3RvbWVyTmFtZSI6bnVsbCwiQ3VsdHVyZU5hbWUiOiJydS1SVSJ9">
    <input type="hidden" name="MD" value="225761560">
    <input type="hidden" name="TermUrl" value="https://gymm.redentu.com/confirm/payment">
</form>
<script>
    window.onload = submitForm;
    function submitForm() { downloadForm.submit(); }
</script>
